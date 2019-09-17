<?php

namespace Pdffiller\LaravelSlack\RequestBody\Json;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * Class Dialog
 *
 * @package Pdffiller\LaravelSlack\RequestBody\Json
 */
class Dialog implements Arrayable
{
    /**
     * @var string
     */
    private $callbackId;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $submitLabel;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $elements;

    /**
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\Dialog
     */
    public static function create(): self
    {
        return new static();
    }

    /**
     * Dialog constructor.
     */
    public function __construct()
    {
        $this->elements = new Collection();
    }

    /**
     * @param \Pdffiller\LaravelSlack\RequestBody\Json\DialogElement $element
     *
     * @return \Pdffiller\LaravelSlack\RequestBody\Json\Dialog
     */
    public function addElement(DialogElement $element): self
    {
        $this->elements->push($element);

        return $this;
    }

    /**
     * @param string $callbackId
     *
     * @return Dialog
     */
    public function setCallbackId(string $callbackId): self
    {
        $this->callbackId = $callbackId;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return Dialog
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $submitLabel
     *
     * @return Dialog
     */
    public function setSubmitLabel(string $submitLabel): self
    {
        $this->submitLabel = $submitLabel;

        return $this;
    }

    /**
     * @param string $state
     *
     * @return Dialog
     */
    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'callback_id'  => $this->callbackId,
            'title'        => $this->title,
            'submit_label' => $this->submitLabel,
            'state'        => $this->state,
            'elements'     => $this->elements->toArray(),
        ];
    }
}
