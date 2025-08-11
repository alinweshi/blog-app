<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserPosts extends Component
{
    use WithPagination;

    public $user;
    public $search = '';
    public $status = '';
    public $perPage = 10;
    public $query = '';

    protected $updatesQueryString = ['search', 'status', 'perPage', 'page'];

    protected $paginationTheme = 'bootstrap';

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function updating($field)
    {
        // Reset to page 1 when filter changes
        if (in_array($field, ['search', 'status', 'perPage'])) {
            $this->resetPage();
        }
    }
    public function updatingQuery($value)
    {
        $this->query = trim($value);
    }


    public function render()
    {
        $posts = $this->user->posts()
            ->when($this->search, function ($q) {
                $searchTerm = trim($this->search);
                $q->where(function ($sub) use ($searchTerm) {
                    $sub->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('description', 'like', "%{$searchTerm}%");
                });
            })
            ->when($this->status, function ($q) {
                $q->where('status', $this->status);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.user-posts', [
            'posts' => $posts
        ]);
    }
    public function resetFilters()
    {
        $this->search = '';
        $this->status = '';
        $this->perPage = 10;
        $this->resetPage();
    }


    public function hasActiveFilters()
    {
        return $this->search || $this->status !== '' || $this->perPage !== 10;
    }
}
