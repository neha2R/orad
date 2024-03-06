<?php

namespace App\Http\Livewire\Training;

use Livewire\Component;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Slot;
use App\Models\Classes;
use App\Models\User;
use App\Models\CoursePayments;
use App\Models\ContentCategory;
use App\Models\OradContent;

class CreateClasses extends Component
{
    public $startdate,$enddate,$demoid,$leadid,$class_date,$slot,$trainerid,$availabletrainers,$slots,$content,$newid;

    public function mount($id){
        $this->newid=$id;
       
       $this->availabletrainers=User::where(['department'=>4,'role'=>3])->get();
       $this->slots=Slot::all();
    }
    public function submit(){
       
        $coursedetails=CoursePayments::where('lead_id',$this->newid)->first();
        $slot=$this->slot;
        $trainerid=$this->trainerid;
        $starting=$this->startdate;
        $ending=$this->enddate;
        
        $carbonstartdate=Carbon::parse($starting);
        $carbonenddate=Carbon::parse($ending);
          
        
        $dateRange = CarbonPeriod::create($carbonstartdate, $carbonenddate);
        
        $classes=collect();

        foreach ($dateRange->toArray() as $key => $value) {            
            if ($value->dayOfWeek != 0) {
                $classes->push(['leadid'=>$this->newid,'class_date'=>$value,'slot'=>$this->slot,'trainerid'=>$this->trainerid,'course_id'=>$coursedetails->id,'seniortrainer_id'=>auth()->user()->id,'content_id'=>$this->content]);
            }
        }
        // dd($classes);
        $new= Classes::insert($classes->toArray());
        
    }

    public function render()
    {
        $previousclasses=Classes::where('leadid',$this->newid)->get();
        $coursedetails=CoursePayments::where('lead_id',$this->newid)->first();
        $contentcategory=ContentCategory::where('is_active',1)->get();
        // dd($content);
        $todaycontent=Classes::where('class_date',today())->first();
        // dd($todaycontent);
        // $todaycontent=OradContent::where('proofreadsenior',1)->where('keyword',$todaycontent->content_id)->get();
        if ($todaycontent) {
            
            $todaycontent=OradContent::where('proofreadsenior',1)->where('keyword',$todaycontent->content_id)->get();
        }else{
            $todaycontent=[];
        }

        return view('livewire.training.create-classes',compact('previousclasses','coursedetails','contentcategory','todaycontent'));
    }
}
