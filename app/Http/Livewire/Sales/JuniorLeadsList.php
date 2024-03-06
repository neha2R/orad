<?php

namespace App\Http\Livewire\Sales;

use App\Models\Demo;
use App\Models\LeadStatus;
use App\Models\Slot;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class JuniorLeadsList extends Component
{
    use WithPagination;

    public $jid, $intern, $pageheading, $editID, $name, $email, $mobile, $reference, $state, $countrycode, $mobilecode, $growth, $edulevel, $langaugesknown, $gender, $comments, $search, $slot, $date, $assignto;

    protected $paginationTheme = 'bootstrap';

    public function mount($id){
        $this->jid = decrypt($id);
        $this->intern = User::findorFail($this->jid)->name;
        $this->pageheading = 'List of Leads for Marketing Intern "'.$this->intern.'"';
    }

    public function edit($id){
        $this->emit('taginput', 1);
        $this->editID = $id;
        $editdata = User::findorFail($id);
        $this->name = $editdata->name;
        $this->email = $editdata->email;
        $this->mobilecode = $editdata->mobilecode;
        $this->mobile = $editdata->mobile;
        $this->state = optional($editdata->userDetails)->state;
        $this->growth = optional($editdata->userDetails)->growth;
        $this->edulevel = optional($editdata->userDetails)->edulevel;
        $this->gender = optional($editdata->userDetails)->gender;
        $this->comments = optional($editdata->userDetails)->comments;
        $lang = optional($editdata->userDetails)->langaugesknown;
        if ($lang) {
            $lang = json_decode($lang);
            $this->langaugesknown = implode(",",$lang);
        } else {
            $this->langaugesknown = $lang;
        }
        $this->reference = getReference(optional($editdata->userDetails)->refrence);
        $getdemodetails = Demo::where(['leadid' => $id, 'is_rescheduled' => 0])->first();
        if ($getdemodetails) {
            $this->slot = $getdemodetails->slot;
            $this->date = $getdemodetails->date;
        } else {
            $this->slot = '';
            $this->date = '';
        }
        $getseniortrainer = LeadStatus::where(['leadid' => $id, 'department' => 4, 'level' => 2])->orderBy('id', 'DESC')->first();
        if ($getseniortrainer) {
            $this->assignto = $getseniortrainer->assignedto;
        } else {
            $this->assignto = '';
        }
    }

    public function render()
    {
        $leadids = LeadStatus::where(['assignedto' => $this->jid])->pluck('leadid');
        if ($this->search) {
            $searchTerm=$this->search;
            $data = User::whereIn('id',$leadids)->where(function($query) use($searchTerm){
                $query->orWhere('name', 'LIKE', "%{$searchTerm}%") 
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
               })->paginate(10);
        } else {
            $data = User::whereIn('id',$leadids)->paginate(10);
        }
        $slots = Slot::all();
        $seniortrainers = User::where(['department' => 4, 'role' => 2])->withCount('assignedusers')->get();
        return view('livewire.sales.junior-leads-list', ['data' => $data, 'slots' => $slots, 'seniortrainers' => $seniortrainers])->layout('layouts.app', ['pageheading' => $this->pageheading]);
    }
}
