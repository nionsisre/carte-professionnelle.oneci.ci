<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputSelect2 extends Component {

    public $id;
    public $title;
    public $name;
    public $label;
    public $options;
    public $required;
    public $width;
    public $column;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($options, $id="", $title="", $name="", $label="", $required=false, $width="0", $column="") {
        $this->id = $id;
        $this->title = $title;
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->required = $required;
        $this->width = $width;
        $this->column = $column;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.inputs.input-select2');
    }

}
