<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public array $links) // This will create a public variable called links which will pass the links variable to the breadcrumbs.blade.php file
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumbs');
    }
}
