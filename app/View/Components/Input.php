<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * The input label
     *
     * @var string
     */
    public $label;

    /**
     * The input type
     *
     * @var string
     */
    public $type;

    /**
     * The input name
     *
     * @var string
     */
    public $name;

    /**
     * The input placeholder
     *
     * @var string
     */
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param string $type
     * @param string $name
     * @param string $placeholder
     * @return void
     */
    public function __construct($label, $type, $name, $placeholder)
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
