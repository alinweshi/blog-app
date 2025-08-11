<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class PostsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $query = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingQuery($value)
    {
        $this->query = trim($value);
    }


    public function updatingPerPage()
    {
        $this->resetPage();
    }
    public function resetFilters()
    {
        $this->query = '';
        $this->perPage = 10;
        $this->resetPage();
        $this->search = '';
    }

    public function render()
    {
        // Add this line for debugging
        \Log::info('PostsTable render method called');

        $posts = Post::with('user:id,first_name,last_name')
            ->when($this->search, function ($q) {
                $searchTerm = trim($this->search);
                $q->where(function ($sub) use ($searchTerm) {
                    $sub->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('description', 'like', "%{$searchTerm}%");
                });
            })

            ->latest()
            ->paginate($this->perPage);

        // Add this line for debugging
        \Log::info('Posts count: ' . $posts->count());

        return view('livewire.posts-table', compact('posts'));
    }
}
