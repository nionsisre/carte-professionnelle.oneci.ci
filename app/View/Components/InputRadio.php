<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputRadio extends Component {

    public $title;
    public $name;
    public $options;
    public $required;

    /**
     * Class constructor.
     *
     * @param string $name The name of the component.
     * @param array $options The options for the component.
     * @return void
     */
    public function __construct($options, $name, $title="", $required=false) {
        $this->title = $title;
        $this->name = $name;
        $this->options = $options;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.input-radio');
    }

}
