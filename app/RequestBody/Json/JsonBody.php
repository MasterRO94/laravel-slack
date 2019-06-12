<?php

namespace App\RequestBody\Json;

use Illuminate\Support\Collection;

/**
 * Class JsonBody
 *
 * @package App\RequestBody
 */
class JsonBody
{
    /**
     * @var string
     */
    private $channel;

    /**
     * @var string
     */
    private $triggerId;

    /**
     * @var boolean
     */
    private $asUser;

    /**
     * @var boolean
     */
    private $replaceOriginal;

    /**
     * @var string
     */
    private $ts;

    /**
     * @var string
     */
    private $text;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $attachments;

    /**
     * @var \App\RequestBody\Json\Dialog
     */
    private $dialog;

    /**
     * JsonBody constructor.
     */
    public function __construct()
    {
        $this->attachments = new Collection();
    }

    /**
     * @param string $channel
     *
     * @return JsonBody
     */
    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @param string $triggerId
     *
     * @return JsonBody
     */
    public function setTriggerId(string $triggerId): self
    {
        $this->triggerId = $triggerId;

        return $this;
    }

    /**
     * @param bool $asUser
     *
     * @return JsonBody
     */
    public function setAsUser(bool $asUser): self
    {
        $this->asUser = $asUser;

        return $this;
    }

    /**
     * @param bool $replaceOriginal
     *
     * @return JsonBody
     */
    public function setReplaceOriginal(bool $replaceOriginal): self
    {
        $this->replaceOriginal = $replaceOriginal;

        return $this;
    }

    /**
     * @param string $ts
     *
     * @return JsonBody
     */
    public function setTs(string $ts): self
    {
        $this->ts = $ts;

        return $this;
    }

    /**
     * @param string $text
     *
     * @return JsonBody
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param \App\RequestBody\Json\Dialog $dialog
     *
     * @return \App\RequestBody\Json\JsonBody
     */
    public function setDialog(Dialog $dialog): self
    {
        $this->dialog = $dialog;

        return $this;
    }

    /**
     * @param \App\RequestBody\Json\Attachment $attachment
     *
     * @return JsonBody
     */
    public function addAttachment(Attachment $attachment): self
    {
        $this->attachments->add($attachment);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'channel'          => $this->channel,
            'trigger_id'       => $this->triggerId,
            'ts'               => $this->ts,
            'as_user'          => $this->asUser,
            'replace_original' => $this->replaceOriginal,
            'text'             => $this->text,
            'dialog'           => $this->dialog,
            'attachments'      => $this->attachments->map(function (Attachment $attachment) {
                return $attachment->toArray();
            })->all(),
        ];
    }
}
