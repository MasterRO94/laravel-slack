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
     * @param string $type
     *
     * @return \App\RequestBody\Json\AttachmentAction
     */
    public function setType(string $type): self
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
     * @param string $text
     *
     * @return AttachmentAction
     */
    public function setText(string $text): self
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
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'  => $this->type,
            'name'  => $this->name,
            'text'  => $this->text,
            'value' => $this->value,
        ];
    }
}
