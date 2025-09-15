<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class BlogPosts extends Component
{
    public $limit = 6;
    public $showAll = false;

    public function render()
    {
        $posts = Post::active()
            ->ofType('blog')
            ->ordered()
            ->when(!$this->showAll, fn($query) => $query->limit($this->limit))
            ->get();

        return view('livewire.blog-posts', compact('posts'));
    }

    public function loadMore()
    {
        $this->showAll = true;
    }
}
