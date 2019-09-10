<?php

namespace Pdffiller\LaravelSlack\RequestBody\Json;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Pdffiller\LaravelSlack\RequestBody\Json\AttachmentField;
use Pdffiller\LaravelSlack\RequestBody\Json\AttachmentAction;

/**
 * Class Attachment
 *
 * @package Pdffiller\LaravelSlack\RequestBody\Json
 */
class Attachment implements Arrayable
{
    public const DEFAULT_TYPE = 'default';
    public const DEFAULT_COLOR = '#D3D3D3';

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

    public static function create()
    {
        return new static();
    }

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
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\Attachment
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string|null $callbackId
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\Attachment
     */
    public function setCallbackId(?string $callbackId): self
    {
        $this->callbackId = $callbackId;

        return $this;
    }

    /**
     * @param string|null $fallback
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\Attachment
     */
    public function setFallback(?string $fallback): self
    {
        $this->fallback = $fallback;

        return $this;
    }

    /**
     * @param string|null $text
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\Attachment
     */
    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param string|null $color
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\Attachment
     */
    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @param \Pdffiller\LaravelSlack\RequestBody\Json\AttachmentField $field
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\Attachment
     */
    public function addField(AttachmentField $field): self
    {
        $this->fields->push($field);

        return $this;
    }


    /**
     * @param array $fields
     */
    public function addFields(array $fields)
    {
        $this->fields = new Collection();
        collect($fields)->each(function ($field, $key) {
            if ($field instanceof AttachmentField) {
                $this->addField($field);
            } else {
                $this->addField(AttachmentField::createFromArray($field));
            }
        });

        return $this;
    }

    /**
     * @param \Pdffiller\LaravelSlack\RequestBody\Json\AttachmentAction $action
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\Attachment
     */
    public function addAction(AttachmentAction $action): self
    {
        $this->actions->push($action);

        return $this;
    }

    /**
     * @param array $actions
     */
    public function addActions(array $actions)
    {
        $this->actions = new Collection();

        collect($actions)->each(function ($action, $key) {
            if ($action instanceof AttachmentAction) {
                $this->addAction($action);
            } else {
                $this->addAction(AttachmentAction::createFromArray($action));
            }
        });

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
            'fields'          => $this->fields->toArray(),
            'actions'         => $this->actions->toArray(),
        ];
    }
}
