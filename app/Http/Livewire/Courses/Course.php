<?php

namespace App\Http\Livewire\Courses;

use App\Models\Courses;
use Livewire\Component;
use App\Models\CoursesType;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ContentCategory;

class Course extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $componentName='Course';

    public $pageheading = 'Manage Course';

    // parent course variables
    public $editId, $name, $course_type ;

    // active course type variable 
    public $activeCourse=0, $parentCourseCount, $childCourseCount, $activeCourseName='Parent';

    // search and pagination of table
    public $search, $paginate=10;

    protected $listeners = ['reset' => 'resetInputs', 'taginputevent' => 'taginput'];

    // child course variables 
    public $carriculam_file, $description, $price, $discount, $course, $days, $class_duration,  $no_of_classes;
    public $multipleCourse = [];

    public function changeActiveCourse($course)
    {
        $this->activeCourse=$course;
        $this->activeCourseName= !$course ? 'Parent':'Child';
    }

    public function statsRefresh(){
        $this->parentCourseCount = Courses::all()->count();
        $this->childCourseCount = CoursesType::all()->count();
        
    }

    public function mount(){
        $this->statsRefresh();
    }

    // reset child course inputs 
    public function resetChildInputs(){
        $this->editId = '';
        $this->name = '';
        $this->price = '';
        $this->course = '';
        $this->multipleCourse = '';
        $this->days = '';
        $this->no_of_classes = '';
        $this->discount = '';
        $this->description = '';
        $this->class_duration = '';
        $this->carriculam_file = '';
    }
    
    public function storeParent(){
        $validateddata=  $this->validate([
            'name' => 'required',
            'course_type' => 'required',
            'description' => 'required',
        ]);
        if ($this->editId) {
            Courses::findorFail($this->editId)->update($validateddata);
        }else {
            Courses::create($validateddata);
        }
        $status = $this->editId ? 'Update':'Create';
        $this->emit('flashmessage', "Parent Course $status successfully");
        $this->resetInputs();
    }

    public function storeChild(){
        $validateddata=  $this->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|string|min:3|max:50',
            'description' => 'required|string|min:3|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'multipleCourse'=> 'required|array|min:1',
            'days'=> 'required|numeric|integer|min:1',
            'no_of_classes'=> 'required|numeric|min:1',
            'discount'=> 'required|numeric|min:0',
            'class_duration'=> 'required|numeric|min:1',
        ]);
        if ($this->carriculam_file) {
          $carriculam_file=$this->carriculam_file->store('courses','public');
        }else {
            $carriculam_file = null;
        }
        $total_discount = $validateddata['price'] * $validateddata['discount'] / 100;
        $mrp_price=(float)$validateddata['price'];
        $discounted_price=(float) $validateddata['price'] - $total_discount;
        $description=$validateddata['description'];
        foreach ($this->multipleCourse as $key => $value) {
            $coursesTypeData = ['name'=>$validateddata['name'], 'description'=>$description, 'price'=>$mrp_price, 'course_id'=>$value, 'days'=>$validateddata['days'], 'no_of_classes'=>$validateddata['no_of_classes'], 'discount'=>$validateddata['discount'], 'carriculam_file'=>$carriculam_file, 'class_duration'=>$validateddata['class_duration'], 'discounted_price'=>$discounted_price, 'total_discount'=>$total_discount];
            
            CoursesType::create($coursesTypeData);
        }
        
        $status = $this->editId ? 'Update':'Create';
        $this->emit('flashmessage', "Child Course $status successfully");
        $this->resetChildInputs();
    }

    public function edit($id){
        if ($this->activeCourse) {
            $editdata = CoursesType::findorFail($id);
            $this->price = $editdata->price;
            $this->course = $editdata->course_id;
            $this->class_duration = $editdata->class_duration;
            $this->discount = $editdata->discount;
            $this->days = $editdata->days;
            $this->no_of_classes = $editdata->no_of_classes;
        }else {
            $editdata = Courses::findorFail($id);
            $this->course_type = $editdata->course_type;
        }
        $this->editId = $id;
        $this->name = $editdata->name;
        $this->description = $editdata->description;
        
    }



    public function update(){
        $validateddata=  $this->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|string|min:3|max:50',
            'description' => 'required|string|min:3|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'course'=> 'required|integer|min:0',
            'days'=> 'required|numeric|integer|min:1',
            'no_of_classes'=> 'required|integer|min:1',
            'discount'=> 'required|integer|min:0',
            'class_duration'=> 'required|integer|min:1',
        ]);
        
        if ($this->carriculam_file) {
          $validateddata['carriculam_file']=$this->carriculam_file->store('courses','public');
        }
        $validateddata['course_id']=$validateddata['course'];
        $validateddata['total_discount'] = $validateddata['price'] * $validateddata['discount'] / 100;
        $validateddata['description'] = $validateddata['description'];
        $validateddata['price']=(float)$validateddata['price'];
        $validateddata['discounted_price']=(float) $validateddata['price'] - $validateddata['total_discount'];
        unset($validateddata['course']);
        $data = CoursesType::findorFail($this->editId)->update($validateddata);
        
        $this->emit('flashmessage', 'Child course updated successfully');
        
        $this->resetChildInputs();
    }



    public function resetInputs(){
        $this->editId = '';
        $this->name = '';
        $this->course_type = '';
    }

    public function changestatus($id, $status){
    // dd("call");
        $status = 1- $status;
        //dd($this->activeCourse);
       if (!$this->activeCourse || $this->activeCourse==0) {
            Courses::findorFail($id)->update(['isactive' => "$status"]);
        }else {
            CoursesType::findorFail($id)->update(['isactive' => "$status"]);
        }
        $this->emit('flashmessage', 'Status changed successfully');
    }


    public function render()
    {
        $parentCourse = Courses::where('isactive',1)->get()->groupBy('course_type');
        $data = !$this->activeCourse ? Courses::query() : CoursesType::query();
        // if ($this->search) {
        //     $data = $data->where('name', 'LIKE', "%{$this->search}%");
        // } 
        if ($this->search=="Group")
        {
            if($this->activeCourse)
            {
               $coursetype= Courses::where('course_type','0')->pluck('id')->toArray();
                $data = $data->where('name', 'LIKE', "%{$this->search}%")->
                orWhereIn('course_id',  $coursetype); 
            }
            else
            {
            $data = $data->where('name', 'LIKE', "%{$this->search}%")->
            orWhere('course_type',  '0'); 
            }
        }
        elseif ($this->search=="Personal")
        {
            if($this->activeCourse)
            {
                $coursetype= Courses::where('course_type','1')->pluck('id')->toArray();
                $data = $data->where('name', 'LIKE', "%{$this->search}%")->
                orWhereIn('course_id',  $coursetype); 
            }
            else
            {
            $data = $data->where('name', 'LIKE', "%{$this->search}%")->
            orWhere('course_type',  '1'); 
            }
        }
        elseif ($this->search)
        {
            if($this->activeCourse)
            {
            $courseparent= Courses::where('name',$this->search)->pluck('id')->toArray();
               if($courseparent)
               {
                $data = $data->where('name', 'LIKE', "%{$this->search}%")->
            orWhere('description', 'LIKE', "%{$this->search}%")->
            orWhereIn('course_id', $courseparent);

               }
               else
               {
                $data = $data->where('name', 'LIKE', "%{$this->search}%")->
                orWhere('description', 'LIKE', "%{$this->search}%");
               }
            }
            else
            {
            $data = $data->where('name', 'LIKE', "%{$this->search}%")->
            orWhere('description', 'LIKE', "%{$this->search}%");
            }

        }
        $data = $data->orderBy('id','desc')->paginate($this->paginate);
        return view('livewire.courses.course', ['data' => $data, 'parentCourse'=>$parentCourse])->layout('layouts.new-app', ['pageheading' => $this->pageheading]);
    }
}
