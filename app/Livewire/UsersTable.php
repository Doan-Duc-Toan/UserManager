<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;
    #[Url()]
    public $perPage = 5;
    #[Url(history:true)]
    public $search = '';
    #[Url(history:true)]
    public $admin = '';
    #[Url(history:true)]
    public $sortBy = 'created_at';
    #[Url(history:true)]
    public $sortDir = 'DESC';
    public function delete(User $user)
    {
        $user->delete();
    }
    public function updateSearch(){
        $this->resetPage();
    }
    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }
    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::search($this->search)->when($this->admin !== '', function ($query) {
                $query->where('is_admin', $this->admin);
            })
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage)
        ]);
    }
}
