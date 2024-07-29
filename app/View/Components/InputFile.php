<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputFile extends Component {

    public $name;
    public $icon;
    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $icon="", $required=false) {
        $this->name = $name;
        $this->icon = $icon;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.inputs.input-file');
    }

}
