<?php

namespace App\RequestBody\Json;

/**
 * Class AttachmentField
 *
 * @package App\RequestBody\Json
 */
class AttachmentField
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

    /**
     * @param string|null $title
     *
     * @return \App\RequestBody\Json\AttachmentField
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
     * @return \App\RequestBody\Json\AttachmentField
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
}
