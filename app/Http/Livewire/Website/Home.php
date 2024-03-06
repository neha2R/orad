<?php

namespace App\Http\Livewire\Website;

use Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserIp;
use App\Models\Courses;
use Livewire\Component;
use App\Models\OurClient;
use App\Models\CoursesType;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    public $courseid, $coursesType;
    public $parentId='1';
    public $isRegistered = false;
    public $newIp;

    public function mount()
    {
        $this->newIp = Request::ip();
        
        $data = Courses::where('isactive','1')->where('course_type',"$this->parentId")->first();
        if ($data != null) {
            $this->courseid = $data->id;
        }else {
            $this->courseid = Courses::where('isactive','1')->where('course_type',"0")->first()->id;
        }
        
    }
    
    public function changeCourseParent($courseGroup)
    {
        $this->parentId = $courseGroup;
        $data = Courses::where('isactive','1')->where('course_type',"$this->parentId")->first();
        $this->courseid = $data != null ? $data->id : null;
        $this->emit('contentChanged');
    }
    
    public function changeCourseChild($courseTypeParentId)
    {
        $this->courseid = $courseTypeParentId;
        $this->coursesType = CoursesType::where('isactive','1')->where('course_id',"$this->courseid")->get();
        $this->emit('contentChanged');
    }

    public function render()
    {
        
        $this->isRegistered = UserIp::where('ip',$this->newIp)->exists();
        // 0=group classes, 1=personal classes 
        $parentCourse = collect([0=>['id'=>'1', 'name'=>'Personal','detail'=>'1 Teacher & 1 Student'], 1=>['id'=>'0', 'name'=>'Group','detail'=>'1 Teacher & 4 Student ']]);
        $courses = Courses::where('isactive','1')->where('course_type',"$this->parentId")->get();
        
        $this->coursesType = CoursesType::where('isactive','1')->where('course_id',"$this->courseid")->get();
        
        $defaultCourse = CoursesType::where('isactive','1')->whereNotNull('course_id')->first();
        
        $clients = OurClient::where('is_active','1')->get();
        // dd($this->isRegistered);
        return view('website.home',['courses' =>$courses, 'clients' => $clients, 'parentCourse' => $parentCourse, 'defaultCourse' => $defaultCourse])
        ->layout('website.layouts.app');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
    }
}
