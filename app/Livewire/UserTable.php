<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $query = '';
    public $status = '';
    public $perPage = 10;

    protected $paginationTheme = 'bootstrap';

    public function updatingQuery($value)
    {
        $this->query = trim($value);
    }

    public function updatingStatus($value)
    {
        $this->status = $value;
    }
    public function updatingPerPage($value)
    {
        $this->perPage = $value;
    }

    public function resetFilters()
    {
        $this->query = '';
        $this->status = '';
        $this->perPage = 10;
        $this->resetPage();
    }


    public function hasActiveFilters()
    {
        return $this->query || $this->status !== '';
    }

    public function render()
    {
        $users = User::query()
            ->when($this->query, function ($query) {
                $search = trim($this->query);
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.user-table', [
            'users' => $users
        ]);
    }
}
