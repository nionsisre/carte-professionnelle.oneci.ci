<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputSelect extends Component {

    public $name;
    public $label;
    public $options;
    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $options, $required=false) {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.inputs.input-select');
    }

}
