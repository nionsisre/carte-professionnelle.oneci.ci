<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputSelect2 extends Component {

    public $title;
    public $name;
    public $label;
    public $options;
    public $required;
    public $width;
    public $column;

    /**
     * Constructor method for the class.
     *
     * Description: Initializes all the properties of the class.
     *
     * @param array $options
     * @param string $title
     * @param string $name
     * @param string $label
     * @param bool $required
     * @param string $width
     * @param string $column
     * @return void
     */
    public function __construct($options, $title="", $name="", $label="", $required=false, $width="0", $column="") {
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
        return view('components.input-select2');
    }

}
