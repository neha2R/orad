<?php

namespace App\Http\Livewire\Courses;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\CoursesType;
use App\Models\Courses;

class Coursetype extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $componentName='Course Type';

    public $pageheading = 'Manage Course Type';

    public $editId, $name, $carriculam_image, $description, $price, $discount, $course, $days, $class_duration,  $no_of_classes;
    public $multipleCourse = [];
    public $tableFeilds=['name','price','isactive'];
   

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['reset' => 'resetInputs'];


    // public function mount(){
    //     $this->parentCourse = Courses::where('isactive',1)->get()->groupBy('course_type');
    // }



    public function store(){
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
        if ($this->carriculam_image) {
          $carriculam_file=$this->carriculam_image->store('courses','public');
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
        $this->emit('flashMessage', ''.$this->componentName.' created successfully');
        $this->resetInputs();
    }

    public function edit($id){
        $editdata = CoursesType::findorFail($id);
        $this->name = $editdata->name;
        $this->price = $editdata->price;
        $this->course = $editdata->course_id;
        $this->class_duration = $editdata->class_duration;
        $this->discount = $editdata->discount;
        $this->description = $editdata->description;
        $this->days = $editdata->days;
        $this->no_of_classes = $editdata->no_of_classes;
        $this->editId = $id;
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
        
        if ($this->carriculam_image) {
          $validateddata['carriculam_file']=$this->carriculam_image->store('courses','public');
        }
        $validateddata['course_id']=$validateddata['course'];
        $validateddata['total_discount'] = $validateddata['price'] * $validateddata['discount'] / 100;
        $validateddata['description'] = $validateddata['description'];
        $validateddata['price']=(float)$validateddata['price'];
        $validateddata['discounted_price']=(float) $validateddata['price'] - $validateddata['total_discount'];
        unset($validateddata['course']);
        $data = CoursesType::findorFail($this->editId)->update($validateddata);
        $this->emit('flashMessage', ''.$this->componentName.' updated successfully');
        $this->resetInputs();
    }

    public function resetInputs(){
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
        $this->carriculam_image = '';

    }


    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    

    public function changestatus($id, $status){
        $status = 1- $status;
        CoursesType::findorFail($id)->update(['isactive' => "$status"]);
        $this->emit('flashMessage', 'Status changed successfully');
    }
    

    public function showOnLandingPage($id, $show_on_dashboard){
        $show_on_dashboard = 1- $show_on_dashboard;
        $data = CoursesType::findorFail($id)->update(['show_on_dashboard' =>"$show_on_dashboard"]);
        $this->emit('flashMessage', 'Status changed successfully');
    }


    public function render()
    {
        $parentCourse = Courses::where('isactive',1)->get()->groupBy('course_type');
        
        $data = CoursesType::query();
        $data = $data->orderBy('id','desc')->paginate(10);
        return view('livewire.courses.coursetype', compact('data', 'parentCourse'))->layout('layouts.app', ['pageheading' => $this->pageheading]);
    }
}
