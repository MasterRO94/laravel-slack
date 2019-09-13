# Send slack messages and handle interactions with it

## Description

This package is used for sending Slack messages and handling interactions with slack messages: clicking on messages buttons and interacting with users through dialogs.

## Installition

Install the package via composer:

``` bash
composer require pdffiller/laravel-slack
```

Install service provider:

```php
// config/app.php
'providers' => [
    ...
    Pdffiller\LaravelSlack\LaravelSlackServiceProvider::class,
];
```

Publish config and database migration file:

```bash
php artisan vendor:publish --provider="Pdffiller\LaravelSlack\LaravelSlackServiceProvider"
```

Run migrations:

```bash
php artisan migrate
```

This is the contents of the published config file:

```php
return [
    /*
     * OAuth Access Token from Slack App
     */
    'user-token' => env('SLACK_USER_TOKEN', null),

    /*
     * Bot User OAuth Access from Slack App
     */
    'bot-token' => env('SLACK_BOT_TOKEN', null),

    /*
     * Verification token from Slack App
     */
    'verification_token' => env('SLACK_VERIFICATION_TOKEN', null),

    /*
     * Handlers are processed by controller
     */
    'handlers' => [
    ],
];
```

## Usage

### Sending messages

Plugin supports this methods from slack api:
- [chat.postMessage](https://api.slack.com/methods/chat.postMessage)
- [chat.update](https://api.slack.com/methods/chat.update)
- [dialog.open](https://api.slack.com/methods/dialog.open)
- [files.upload](https://api.slack.com/methods/files.upload)

Accepted content type for `chat.postMessage`, `chat.update` and `dialog.open` method is `application/json`.
Accepted content type for `files.upload` method is `multipart/form-data`.

For building and sending messages `Pdffiller\LaravelSlack\Services\LaravelSlackPlugin` service can be injected to your code.
Service has 2 methods:
- `buildMessage((AbstractMethodInfo $method), [Model $model])`
- `sendMessage([$message])`

Instances of these classes can be used as a `$method` parameter:
- `Pdffiller\LaravelSlack\AvailableMethods\ChatPostMessage`
- `Pdffiller\LaravelSlack\AvailableMethods\ChatUpdate`
- `Pdffiller\LaravelSlack\AvailableMethods\DialogOpen`
- `Pdffiller\LaravelSlack\AvailableMethods\FilesUpload`

Eloquent models can be used as a not obligatory `$body` parameter.

All sent slack messages via `chat.postMessage` method are saved in the database in the `laravel_slack_message` table.
Slack message `ts` and `channel` are saved for every message.
If eloquent model is sent as the `$body` parameter to the `buildMessage` method, model's primary key and model's path are also saved.
You can then use `ts` and `channel` parameters in `chat.update` method in order to update existing slack message.

#### Sending plain text message
```php
use Pdffiller\LaravelSlack\Services\LaravelSlackPlugin;
use Pdffiller\LaravelSlack\AvailableMethods\ChatPostMessage;

$laravelSlackPlugin = resolve(LaravelSlackPlugin::class);
$laravelSlackPlugin->buildMessage(new ChatPostMessage())
                   ->setChannel("#ABCDEF")
                   ->setText("asdsadsad");
$laravelSlackPlugin->sendMessage();
```

#### Update slack message
```php
use Pdffiller\LaravelSlack\Services\LaravelSlackPlugin;
use Pdffiller\LaravelSlack\AvailableMethods\ChatUpdate;

$laravelSlackPlugin = resolve(LaravelSlackPlugin::class);
$laravelSlackPlugin->buildMessage(new ChatUpdate())
                   ->setChannel("#ABCDEF")
                   ->setTs('1405894322.002768')
                   ->setText("updated text");
$laravelSlackPlugin->sendMessage();
```

### Building messages with attachments

For building messages with [attachments](https://api.slack.com/docs/message-attachments) plugin has this classes:
- `Pdffiller\LaravelSlack\RequestBody\Json\Attachment`
- `Pdffiller\LaravelSlack\RequestBody\Json\AttachmentField`
- `Pdffiller\LaravelSlack\RequestBody\Json\AttachmentAction`

#### Sending message with text attachment
```php
use Pdffiller\LaravelSlack\RequestBody\Json\Attachment;
use Pdffiller\LaravelSlack\Services\LaravelSlackPlugin;
use Pdffiller\LaravelSlack\AvailableMethods\ChatPostMessage;
$laravelSlackPlugin = resolve(LaravelSlackPlugin::class);
$laravelSlackPlugin->buildMessage(new ChatPostMessage())
                   ->setChannel("#ABCDEF")
                   ->addAttachment(Attachment::create()
                                             ->setText("this is text")
                                             ->setColor('#36a64f'));
$laravelSlackPlugin->sendMessage();
```


#### Sending message with attachment including fields
```php
use Pdffiller\LaravelSlack\RequestBody\Json\Attachment;
use Pdffiller\LaravelSlack\RequestBody\Json\AttachmentField;
use Pdffiller\LaravelSlack\Services\LaravelSlackPlugin;
use Pdffiller\LaravelSlack\AvailableMethods\ChatPostMessage;

$laravelSlackPlugin = resolve(LaravelSlackPlugin::class);
$laravelSlackPlugin->buildMessage(new ChatPostMessage())
                   ->setChannel("#ABCDEF")
                   ->addAttachment(Attachment::create()
                                     ->addFields([
                                             [                                  // add from array
                                                 'title' => 'User Id',
                                                 'value' => 10
                                                 /*, 'short'=true/false*/
                                             ],
                                             AttachmentField::create()          // add from object
                                                        ->setTitle('Team Id')
                                                        ->setValue(30),
                                         ]
                                     ));
$laravelSlackPlugin->sendMessage();
```

#### Sending message with attachment including actions
```php
use Pdffiller\LaravelSlack\RequestBody\Json\Attachment;
use Pdffiller\LaravelSlack\RequestBody\Json\AttachmentAction;
use Pdffiller\LaravelSlack\Services\LaravelSlackPlugin;
use Pdffiller\LaravelSlack\AvailableMethods\ChatPostMessage;

$laravelSlackPlugin = resolve(LaravelSlackPlugin::class);
$laravelSlackPlugin->buildMessage(new ChatPostMessage())
                   ->setChannel("#ABCDEF")
                   ->addAttachment(Attachment::create()
                       ->setCallbackId('callback-id-is-used-in-handler')
                       ->setFallback('Fallback text')
                       ->setColor('#36a64f')
                       ->addActions([
                               [
                                   'name' => 'button-name',
                                   'text' => 'Accept',
                                   'value' => 1,
                                   /*'style' => '...',
                                   'type'  => 'button'*/
                               ],
                               AttachmentAction::create()
                                   ->setName('button-name')
                                   ->setText('Decline')
                                   ->setValue(0)
                           ]
                       ));
$laravelSlackPlugin->sendMessage();
```

### Sending message with [file](https://api.slack.com/methods/files.upload)
```php
use Pdffiller\LaravelSlack\AvailableMethods\FilesUpload;
use Pdffiller\LaravelSlack\Services\LaravelSlackPlugin;

$laravelSlackPlugin = resolve(LaravelSlackPlugin::class);
$laravelSlackPlugin->buildMessage(new FilesUpload())
                   ->setChannel("#ABCDEF")
                    ->setFilePath("...")
                    ->setFileName("...);
$laravelSlackPlugin->sendMessage();
```

### Open [dialogs](https://api.slack.com/methods/dialog.open) after messages interaction

Dialog can be opened after interaction with message, for example clicking on button. After interaction with message, `trigger_id` is sent in the request payload. This parameter is used in the `dialog.open` method.

For building dialog plugin has this classes:
- `Pdffiller\LaravelSlack\RequestBody\Json\Dialog`
- `Pdffiller\LaravelSlack\RequestBody\Json\DialogElement`

```php
use Pdffiller\LaravelSlack\RequestBody\Json\Dialog;
use Pdffiller\LaravelSlack\RequestBody\Json\DialogElement;
use Pdffiller\LaravelSlack\AvailableMethods\DialogOpen;
use Pdffiller\LaravelSlack\Services\LaravelSlackPlugin;

$laravelSlackPlugin = resolve(LaravelSlackPlugin::class);
$laravelSlackPlugin->buildMessage(new DialogOpen())
                   ->setTriggerId('trigger_id')
                   ->setDialog(Dialog::create()
                           ->setCallbackId('will-be-used-in-handler')
                           ->setTitle('Title')
                           ->setSubmitLabel('Save')
                           ->setState(json_encode([]))
                           ->addElement(DialogElement::create()
                                             ->setName('reason')
                                             ->setLabel('.')
                                             ->setType(DialogElement::TEXTAREA_TYPE))
                   );
$laravelSlackPlugin->sendMessage();
```
