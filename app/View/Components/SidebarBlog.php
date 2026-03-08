<?php
;

namespace App\View\Components;

use App\Models\Blogs;
use Illuminate\View\Component;

class SidebarBlog extends Component
{
    public $latest;

    public function __construct()
    {
        $this->latest = Blogs::latest()->take(5)->get();
    }

    public function render()
    {
        return view('components.sidebar-blog');
    }
}

