<?php

namespace App\RequestBody\Json;

/**
 * Class AttachmentAction
 *
 * @package App\RequestBody\Json
 */
class AttachmentAction
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

    /**
     * @param string|null $type
     *
     * @return \App\RequestBody\Json\AttachmentAction
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param $name
     *
     * @return AttachmentAction
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $text
     *
     * @return \App\RequestBody\Json\AttachmentAction
     */
    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param $value
     *
     * @return AttachmentAction
     */
    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param string|null $style
     *
     * @return \App\RequestBody\Json\AttachmentAction
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
}
