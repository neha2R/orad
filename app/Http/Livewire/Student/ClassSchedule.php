<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\ClassFeedback;
use App\Models\Classes;
use App\Models\User;
use App\Models\ContentComplaint;

class ClassSchedule extends Component
{
    public function render()
    {
        $data=ModelClass::where('leadid',auth()->user()->id)->get();
        $slots=Slot::all();
        $content=ContentCategory::all();
        $todaycontent=ModelClass::where('class_date',today())->first();
        if ($todaycontent) {
            $todaycontent=OradContent::where('proofreadsenior',1)->where('keyword',$todaycontent->content_id)->get();

        }else{
            $todaycontent=[];
        }
        
        // $todaycontent=OradContent::where('proofreadsenior',1)->where('keyword',$todaycontent->content_id)->get();
        return view('livewire.school.classes',compact('data','slots','content','todaycontent'));
    }
}