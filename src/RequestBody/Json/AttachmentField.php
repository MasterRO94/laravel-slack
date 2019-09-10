<?php

namespace Pdffiller\LaravelSlack\RequestBody\Json;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

/**
 * Class AttachmentField
 *
 * @package Pdffiller\LaravelSlack\RequestBody\Json
 */
class AttachmentField implements Arrayable
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var boolean
     */
    private $short;

    public static function create()
    {
        return new static();
    }

    public static function createFromArray(array $array)
    {
        if (! self::validateArray($array)) {
            throw new \Exception("Field array should contain 'title' and 'value' options");
        }

        $self = new static();
        $self->setValue($array['value']);
        $self->setTitle($array['title']);
        if (Arr::has($array, 'short')) {
            $self->setShort($array['short']);
        } else {
            $self->setShort(true);
        }

        return $self;
    }

    /**
     * @param string|null $title
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\AttachmentField
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param $value
     *
     * @return AttachmentField
     */
    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param bool|null $short
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\AttachmentField
     */
    public function setShort(?bool $short): self
    {
        $this->short = $short;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'value' => $this->value,
            'short' => $this->short,
        ];
    }

    /**
     * @param array $array
     *
     * @return bool
     */
    private static function validateArray(array $array)
    {
        return Arr::has($array, 'value') &&
               Arr::has($array, 'title');
    }
}
