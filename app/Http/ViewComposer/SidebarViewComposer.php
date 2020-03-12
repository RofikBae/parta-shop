<?php

namespace App\Http\ViewComposer;

use App\Model\Category;
use Illuminate\View\View;

class SidebarViewComposer
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function compose(View $view)
    {
        $categories = $this->category->with('products')->get();

        return $view->with('categories', $categories);
    }
}
