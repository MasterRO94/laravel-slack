<?php

namespace Pdffiller\LaravelSlack\RequestBody\Json;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Pdffiller\LaravelSlack\RequestBody\BaseRequestBody;

/**
 * Class JsonBodyObject
 *
 * @package Pdffiller\LaravelSlack\RequestBody\Json
 */
class JsonBodyObject extends BaseRequestBody implements Arrayable
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
     * @var \Pdffiller\LaravelSlack\RequestBody\Json\Dialog
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
     * @return JsonBodyObject
     */
    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @param string $triggerId
     *
     * @return JsonBodyObject
     */
    public function setTriggerId(string $triggerId): self
    {
        $this->triggerId = $triggerId;

        return $this;
    }

    /**
     * @param bool $asUser
     *
     * @return JsonBodyObject
     */
    public function setAsUser(bool $asUser): self
    {
        $this->asUser = $asUser;

        return $this;
    }

    /**
     * @param bool $replaceOriginal
     *
     * @return JsonBodyObject
     */
    public function setReplaceOriginal(bool $replaceOriginal): self
    {
        $this->replaceOriginal = $replaceOriginal;

        return $this;
    }

    /**
     * @param string $ts
     *
     * @return JsonBodyObject
     */
    public function setTs(string $ts): self
    {
        $this->ts = $ts;

        return $this;
    }

    /**
     * @param string $text
     *
     * @return JsonBodyObject
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param \Pdffiller\LaravelSlack\RequestBody\Json\Dialog $dialog
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\JsonBodyObject
     */
    public function setDialog(Dialog $dialog): self
    {
        $this->dialog = $dialog;

        return $this;
    }

    /**
     * @param \Pdffiller\LaravelSlack\RequestBody\Json\Attachment $attachment
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\JsonBodyObject
     */
    public function addAttachment(Attachment $attachment): self
    {
        $this->attachments->push($attachment);

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAttachments(): Collection
    {
        return $this->attachments;
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
            'dialog'           => $this->dialog ? $this->dialog->toArray() : null,
            'attachments'      => $this->attachments->toArray(),
        ];
    }
}
