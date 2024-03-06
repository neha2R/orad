<?php

namespace App\Http\Livewire\Content;

use Livewire\Component;
use App\Models\OradContent;
use App\Models\User;
use App\Models\ContentCategory;
use Livewire\WithPagination;
use App\Models\ContentComplaint;

class Seniordashboard extends Component
{   
    use WithPagination;
   
    public $contentexplaination,$selectedjunior,$totalcontent=0,$proofread=0,$totalcompalint=0,$statsswitch=0;
    
    public $contentcategoryid,$totalcount,$contentnumber;
    public function stats(){
        // dd(auth()->user()->id);
        $this->totalcount=OradContent::where(['proofreadjunior'=>0,'assignedby'=>auth()->user()->id])->count();
        $this->proofread=OradContent::where(['proofreadjunior'=>1,'assignedby'=>auth()->user()->id])->count();
        $this->totalcompalint=ContentComplaint::where(['senior_proofread'=>0,'assigned_to'=>auth()->user()->id])->count();
    }

    protected $paginationTheme = 'bootstrap';
    
    public function mount(){
        $this->stats();
    }

    public function assigncontent($contentid,$trainerid){
        // dd($contentid,$trainerid);
        ContentComplaint::findorFail($contentid)->update(['assigned_to_junior'=>$trainerid]);
    }   

    public function markasproofreadcomplaint($contentid){
        ContentComplaint::findorFail($contentid)->update(['senior_proofread'=>1]);
    }

    public function markasproofread($id){
        OradContent::findorFail($id)->update(['proofreadsenior'=>1]);
        $this->emit('flashMessage','Marked Content as Proof Read');
    }

    public function store(){
        $validatedData = $this->validate([
            'contentexplaination' => 'required',
            'selectedjunior'=>'required',
            'contentcategoryid'=>'required'
        ]);
        $data=['contentexplaination'=>$this->contentexplaination,'creator'=>$this->selectedjunior,'assignedby'=>auth()->user()->id,'keyword'=>$this->contentcategoryid];
       
        for ($i=1; $i <= $this->contentnumber ; $i++) { 
            OradContent::create($data);
        }
       
        $this->emit('flashMessage','Content Request Successfully Created');
        $this->stats();
    }

    public function statswitchhandel($value){
    
        $this->statsswitch=$value;
    }

    public function render()
    {
        switch ($this->statsswitch) {
            case 0:
                $data=OradContent::where('assignedby',auth()->user()->id)->where('proofreadjunior',0)->with(['contentfile' => function($query) {
                    $query->orderBy('id', 'desc');
                }])->orderBy('id','desc')->paginate(10);
                break;
            case 1:
                $data=OradContent::where('assignedby',auth()->user()->id)->where('proofreadjunior',1)->with(['contentfile' => function($query) {
                    $query->orderBy('id', 'desc');
                }])->orderBy('id','desc')->paginate(10);
                break;
            case 2:
                $data=ContentComplaint::where('assigned_to',auth()->user()->id)->paginate(10);
                break;
            default:
                # code...
                break;
        }
        
        $juniorcontentwriters=User::where(['department'=>5,'is_active'=>1,'role'=>3])->get();
        $contentcategory=ContentCategory::where('is_active',1)->get();

        return view('livewire.content.seniordashboard',compact('data','juniorcontentwriters','contentcategory'));
    }
}
