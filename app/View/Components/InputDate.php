<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputDate extends Component {

    public $id;
    public $name;
    public $label;
    public $placeholder;
    public $required;
    public $max;
    public $width;
    public $column;

    /**
     * Constructs a new instance of the class.
     *
     * @param mixed $id The identifier of the element.
     * @param string $name The name of the element.
     * @param string $label The label for the element.
     * @param string $placeholder The placeholder text for the element.
     * @param bool $required Determines if the element is required.
     * @param int $max The maximum value for the element.
     * @param int $width The width of the element.
     * @param int $column The column of the element.
     */
    public function __construct($id, $name, $label, $placeholder, $required=false, $max="100", $width="0", $column="") {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->max = $max;
        $this->width = $width;
        $this->column = $column;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render() {
        return view('components.input-date');
    }
}
