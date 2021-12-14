<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Post extends Component
{
    /**
     * The post object
     *
     * @var \App\Models\Post
     */

    public $post;

    /**
     * Create a new component instance.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function __construct(\App\Models\Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post');
    }
}
