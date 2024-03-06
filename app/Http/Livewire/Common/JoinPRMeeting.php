<?php

namespace App\Http\Livewire\Common;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\PRJoinee;
use App\Models\Department;
use Livewire\WithPagination;
use App\Models\PerformanceReview;

class JoinPRMeeting extends Component
{
    use WithPagination;

    // feedback variables  
    public $editId, $rating, $comments;

    // search and pagination of table
    public $search, $paginate=10;

    public function store(){
        $validateData = $this->validate([
            'rating' => 'required',
            'comments' => 'required|string|max:255',
        ]);
        $joinees = PRJoinee::findorFail($this->editId)->update($validateData);

        $this->emit('flashmessage','Thanks for the feedback!');
        $this->resetInputs();
    }

    public function show($id){
        $this->editId = $id;
    }
    
    public function resetInputs(){
        $this->editId = '';
        $this->rating = '';
        $this->comments = '';
    }

    public function render()
    {
        $data = PRJoinee::query();
        $data = $data->where('employee_id',auth()->user()->id);
        if ($this->search) {
            $searchTerm = $this->search;
            $data = $data->whereHas('prmeeting',function ($query) use ($searchTerm)
            {
                $query->where('agenda', 'LIKE', "%{$this->search}%")->orWhere('date', 'LIKE', "%{$this->search}%");
            });
        }
        $data = $data->paginate($this->paginate);
        
        return view('livewire.auth.join-meeting',['data'=>$data])->layout('layouts.new-app');
        
    }
}
