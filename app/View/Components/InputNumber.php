<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputNumber extends Component {

    public $id;
    public $name;
    public $label;
    public $placeholder;
    public $maxlength;
    public $required;
    public $width;
    public $column;

    /**
     * Create a new instance.
     *
     * @param int $id The identifier of the input.
     * @param string $name The name of the input.
     * @param string $label The label of the input.
     * @param string $placeholder The placeholder content of the input.
     * @param int $maxlength The maximum length of the input.
     * @param bool $required Whether the input is required.
     * @param int $width The width of the input in the column.
     * @param int $column The column in which the input is placed.
     * @return void
     */
    public function __construct($id, $name, $label, $placeholder, $maxlength, $required=false, $width="0", $column="") {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->maxlength = $maxlength;
        $this->required = $required;
        $this->width = $width;
        $this->column = $column;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-number');
    }
}
