<?php

namespace Pdffiller\LaravelSlack\RequestBody\Json;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class DialogElement
 *
 * @package Pdffiller\LaravelSlack\RequestBody\Json
 */
class DialogElement implements Arrayable
{
    public const TEXT_TYPE = 'text';
    public const TEXTAREA_TYPE = 'textarea';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $name;

    /**
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\DialogElement
     */
    public static function create(): self
    {
        return new static();
    }

    /**
     * @param string $type
     *
     * @return DialogElement
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string $label
     *
     * @return DialogElement
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return DialogElement
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'  => $this->type,
            'label' => $this->label,
            'name'  => $this->name,
        ];
    }
}
