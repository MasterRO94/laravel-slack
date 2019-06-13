<?php

namespace App\RequestBody\Json;

use Illuminate\Support\Collection;

/**
 * Class Attachment
 *
 * @package App\RequestBody\Json
 */
class  Attachment
{
    public const DEFAULT_TYPE = 'default';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $callbackId;

    /**
     * @var string
     */
    private $fallback;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $color;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $fields;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $actions;

    /**
     * Attachment constructor.
     */
    public function __construct()
    {
        $this->type = self::DEFAULT_TYPE;
        $this->fields = new Collection();
        $this->actions = new Collection();
    }

    /**
     * @param string|null $type
     *
     * @return \App\RequestBody\Json\Attachment
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string|null $callbackId
     *
     * @return \App\RequestBody\Json\Attachment
     */
    public function setCallbackId(?string $callbackId): self
    {
        $this->callbackId = $callbackId;

        return $this;
    }

    /**
     * @param string|null $fallback
     *
     * @return \App\RequestBody\Json\Attachment
     */
    public function setFallback(?string $fallback): self
    {
        $this->fallback = $fallback;

        return $this;
    }

    /**
     * @param string|null $text
     *
     * @return \App\RequestBody\Json\Attachment
     */
    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param string|null $color
     *
     * @return \App\RequestBody\Json\Attachment
     */
    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @param \App\RequestBody\Json\AttachmentAction $action
     *
     * @return \App\RequestBody\Json\Attachment
     */
    public function addAction(AttachmentAction $action): self
    {
        $this->actions->add($action);

        return $this;
    }

    /**
     * @param \App\RequestBody\Json\AttachmentField $field
     *
     * @return \App\RequestBody\Json\Attachment
     */
    public function addField(AttachmentField $field): self
    {
        $this->fields->add($field);

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'fallback'        => $this->fallback,
            'callback_id'     => $this->callbackId,
            'color'           => $this->color,
            'attachment_type' => $this->type,
            'text'            => $this->text,
            'fields'          => $this->fields->map(function (AttachmentField $field) {
                return $field->toArray();
            })->all(),
            'actions'         => $this->actions->map(function (AttachmentAction $action) {
                return $action->toArray();
            })->all(),
        ];
    }
}
