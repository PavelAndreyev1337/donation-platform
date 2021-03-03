<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Widget extends Component
{
    /**
     * Id
     *
     * @var string
     */
    public $id;

    /**
     * Title
     *
     * @var string
     */
    public $title;

    /**
     * Number
     *
     * @var int
     */
    public $number;

    /**
     * Name
     *
     * @var string
     */
    public $name;

    /**
     * Create a new component instance.
     *
     * @param  string $title
     * @param  int $number
     * @param  string $email
     * @return void
     */
    public function __construct(string $id, string $title, int $number = 0, string $name = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->number = $number;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.widget');
    }
}
