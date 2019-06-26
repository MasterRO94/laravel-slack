<?php

namespace Pdffiller\LaravelSlack\RequestBody\Json;

use Illuminate\Contracts\Support\Arrayable;

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
}
