<?php

namespace App\RequestBody\Json;

use Illuminate\Support\Collection;

class Dialog
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
     * Dialog constructor.
     */
    public function __construct()
    {
        $this->elements = new Collection();
    }

    /**
     * @param \App\RequestBody\Json\DialogElement $element
     *
     * @return \App\RequestBody\Json\Dialog
     */
    public function addElement(DialogElement $element): self
    {
        $this->elements->add($element);

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
            'elements'     => $this->elements->map(function(DialogElement $element) {
                return $element->toArray();
            })->all(),
        ];
    }
}
