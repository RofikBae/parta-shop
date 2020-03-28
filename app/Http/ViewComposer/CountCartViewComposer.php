<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;

class CountCartViewComposer
{
    protected $count;

    public function __construct()
    {
        $this->count = session('cart');
    }

    public function compose(View $view)
    {
        $count = $this->count ? count($this->count) : 0;
        return $view->with('count', $count);
    }
}
