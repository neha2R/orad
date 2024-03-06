<?php

namespace App\Http\Livewire\Sales;

use App\Models\Demo;
use App\Models\Slot;
use App\Models\User;
use Livewire\Component;
use App\Models\LeadStatus;
use Livewire\WithPagination;

class Reports extends Component
{
    use WithPagination;

    public $pageheading = 'Reports';
    public $salesSearch, $isDateFilled, $leadSearch,$from, $to, $editID, $name, $email, $mobile, $reference, $state, $countrycode, $mobilecode, $growth, $edulevel, $langaugesknown, $gender, $comments, $search, $slot, $date, $assignto;
    protected $listeners = ['searchByDate'=>'searchByDate'];
    protected $paginationTheme = 'bootstrap';

    public function searchByDate()
    {
        $this->isDateFilled = (!$this->from) ? false : true;

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
        $searchTerm = $this->salesSearch;
        
        $leadSearch = $this->leadSearch;

        $juniorMarketingTeam = User::where('parent_id', auth()->user()->id)->get();
        
        $data = LeadStatus::query();
        if ($this->salesSearch) {
            $data = $data->where('assignedto',$searchTerm);
        }else {
            $data = $data->whereIn('assignedto',$juniorMarketingTeam->pluck('id'));
        }
        
        if ($this->isDateFilled) {
            $from = $this->from." 00:00:00";
            $to = (!$this->to ? date('Y-m-d') : $this->to)." 23:59:59";
            $data = $data->whereBetween('created_at', [$from, $to]);
        }
        if ($this->leadSearch) {
            $data = $data->whereHas('userRelation',function($query) use($leadSearch){
                return $query->where('name', 'LIKE', "%{$leadSearch}%")
                ->orWhere('email', 'LIKE', "%{$leadSearch}%")
                ->orWhere('mobile', 'LIKE', "%{$leadSearch}%");
            });
        }
        $data = $data->paginate(10);

        $slots = Slot::all();
        $seniortrainers = User::where(['department' => 4, 'role' => 2])->withCount('assignedusers')->get();
        
        return view('livewire.sales.reports',  ['data' => $data, 'slots' => $slots, 'seniortrainers' => $seniortrainers, 'juniorMarketingTeam'=>$juniorMarketingTeam])->layout('layouts.app', ['pageheading' => $this->pageheading]);
    }
}
