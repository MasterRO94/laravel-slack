<?php

namespace Pdffiller\LaravelSlack\RequestBody\Json;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

/**
 * Class AttachmentAction
 *
 * @package Pdffiller\LaravelSlack\RequestBody\Json
 */
class AttachmentAction implements Arrayable
{
    public const BUTTON_TYPE = 'button';

    /**
     * @var string
     */
    private $type;

    /**
     * @var mixed
     */
    private $name;

    /**
     * @var string
     */
    private $text;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var string
     */
    private $style;

    public static function create()
    {
        return new static();
    }

    public static function createFromArray(array $array)
    {
        if (! self::validateArray($array)) {
            throw new \Exception("Field array should contain 'text', 'name' and 'value' options");
        }

        $self = new static();
        $self->setText($array['text']);

        $self->setName($array['name']);
        $self->setValue($array['value']);
        if (Arr::has($array, 'type')) {
            $self->setType($array['type']);
        }
        if (Arr::has($array, 'style')) {
            $self->setText($array['style']);
        }

        return $self;
    }

    public function __construct()
    {
        $this->type = self::BUTTON_TYPE;
    }

    /**
     * @param string|null $type
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\AttachmentAction
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param $name
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\AttachmentAction
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $text
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\AttachmentAction
     */
    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param $value
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\AttachmentAction
     */
    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param string|null $style
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\AttachmentAction
     */
    public function setStyle(?string $style): self
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'  => $this->type,
            'name'  => $this->name,
            'text'  => $this->text,
            'value' => $this->value,
            'style' => $this->style,
        ];
    }

    /**
     * @param array $array
     *
     * @return bool
     */
    private static function validateArray(array $array)
    {
        return Arr::has($array, 'text') &&
               Arr::has($array, 'name') &&
               Arr::has($array, 'value');
    }
}
