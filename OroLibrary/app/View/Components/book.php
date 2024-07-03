<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class book extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $description;
    public $price;
    public $bookId;
    public $liked;
    public $image;
    public $out;
    public function __construct($title, $description, $price, $bookId, $liked, $image, $out)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->bookId = $bookId;
        $this->liked=$liked;
        $this->image=$image;
        $this->out = $out;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.book');
    }
}