<?php

namespace App\Http\Livewire\Sales;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SeniorSalesTeam extends Component
{
    use WithPagination;

    public $pageheading = 'Team Members';
    public $search;
    
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        if ($this->search) {
            $searchTerm = $this->search;
            $data = User::where('parent_id', auth()->user()->id)->where(function($query) use($searchTerm){
                $query->orWhere('name', 'LIKE', "%{$searchTerm}%") 
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
               })->withCount('assignedusers')->paginate(10);
        } else {
            $data = User::where('parent_id', auth()->user()->id)->withCount('assignedusers')->paginate(10);
        }
        return view('livewire.sales.senior-sales-team', ['data' => $data])->layout('layouts.app', ['pageheading' => $this->pageheading]);
    }
}
