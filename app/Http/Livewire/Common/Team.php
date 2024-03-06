<?php

namespace App\Http\Livewire\Common;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Team extends Component
{
    use WithPagination;

    // search and pagination of table
    public $search, $paginate=10;

    public function render()
    {
        if ($this->search) {
            $searchTerm = $this->search;
            $data = User::where('parent_id', auth()->user()->id)->where(function($query) use($searchTerm){
                $query->orWhere('name', 'LIKE', "%{$searchTerm}%") 
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
               })->withCount('assignedusers')->paginate($this->paginate);
        } else {
            $data = User::where('parent_id', auth()->user()->id)->withCount('assignedusers')->paginate(10);
        }
        return view('includes.team', ['data' => $data])->layout('layouts.new-app');
    }
}
