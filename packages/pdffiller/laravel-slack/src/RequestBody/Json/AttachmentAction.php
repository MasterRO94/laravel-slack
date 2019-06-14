<?php

namespace Pdffiller\LaravelSlack\RequestBody\Json;

/**
 * Class AttachmentAction
 *
 * @package Pdffiller\LaravelSlack\RequestBody\Json
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
}
