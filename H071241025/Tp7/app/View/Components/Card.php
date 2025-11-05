<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $image;
    public $description;

    public function __construct($title, $image, $description)
    {
        $this->title = $title;
        $this->image = $image;
        $this->description = $description;
    }

    public function render()
    {
        return view('components.card');
    }
}