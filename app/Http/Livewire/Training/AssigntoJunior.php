<?php

namespace App\Http\Livewire\Training;

use App\Models\Content;
use App\Models\ContentCategory;
use App\Models\Demo;
use App\Models\LeadStatus;
use App\Models\Slot;
use App\Models\User;
use Livewire\Component;
use App\Services\WhatsappService;

class AssigntoJunior extends Component
{
    public $leadid, $search, $catfilter, $contents = [], $slot, $date, $trainers, $assignto,$leadstatus;
    public $pageheading = 'Assign Lead to Junior Trainer';

    public function mount($id,$leadid){
        $this->leadid = $leadid;
        $this->leadstatus=decrypt($id);
        $demo = Demo::where(['leadid' =>  $this->leadid, 'is_rescheduled' => 0])->first();
        $this->slot = $demo->slot;
        $this->date = $demo->date;
        $busytrainers = Demo::where(['date' => $this->date, 'slot' => $this->slot])->whereNotNull('trainerid')->pluck('trainerid')->toArray();
        $this->trainers = User::where(['department' => 4, 'role' => 3])->whereNotIn('id', $busytrainers)->withCount('assignedusers')->get();
    }

    public function store(){
        $validatedData = $this->validate(
            [
                'assignto' => 'required',
                'contents' => 'required',
            ],
            [
                'assignto.required' => 'Select trainer to assign lead and content',
                'contents.required' => 'Select Content',
            ]
        );
        $userdetails=User::findorFail($this->leadid);
        $trainerdetails=User::findorFail($this->assignto);
        $url=url('/');
        $message= 
"Dear ".$userdetails->name.",Greetings! Your ORAD Spoken English trial class is confirmed for 2 .We look forward to ".$trainerdetails->name."  being proficient in Spoken English for life with a creative, activity-based curriculum, taught by a dedicated live 1:1 trainer.
Please login to the class from ".$url." via your LAPTOP/COMPUTER/MOBILE PHONE. 
If you face any issue or need more information, email us at info@orad.in OR Call us on 70232 57320                                                                                                                                                                                                                                                                                                                               Happy Learning!!!
Thank you,
Team ORAD";
        WhatsappService::sendmessage($message,$userdetails->mobile);
        $content = $this->contents;
        $contents = json_encode($content);
        LeadStatus::findorFail($this->leadstatus)->update(['is_transferred' => 1]);
        $leadcreated= LeadStatus::create(['leadid'=>$this->leadid, 'assignedby'=>auth()->user()->id, 'assignedto'=>$this->assignto, 'level'=>3, 'department'=>4, 'comments'=>'Lead assigned from senior trainer to junior trainer']);
        $id=Demo::where(['leadid' =>  $this->leadid, 'is_rescheduled' => 0])->update(['trainerid' => $this->assignto, 'content' => $contents,'leadstatus'=>$leadcreated->id]);
        
        return redirect('/training/seniordashboard');
    }

    public function render()
    {
        $data = Content::query();
        $slots = Slot::all();
        if ($this->search) {
            $data = $data->where('title', 'LIKE', "%{$this->search}%")->orWhere('description', 'LIKE', "%{$this->search}%")->orWhere('tags', 'LIKE', "%{$this->search}%");
        }
        if ($this->catfilter) {
            $data = $data->where('category', $this->catfilter);
        }
        $data = $data->paginate(10);
        $categories = ContentCategory::all();
        return view('livewire.training.assignto-junior', ['data' => $data, 'categories' => $categories, 'slots' => $slots])->layout('layouts.app', ['pageheading' => $this->pageheading]);
    }
}
