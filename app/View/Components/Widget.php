<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Widget extends Component
{
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
     * Email
     *
     * @var string
     */
    public $email;

    /**
     * Create a new component instance.
     *
     * @param  string $title
     * @param  int $number
     * @param  string $email
     * @return void
     */
    public function __construct(string $title, int $number, string $email = '')
    {
        $this->title = $title;
        $this->number = $number;
        $this->email = $email;
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
