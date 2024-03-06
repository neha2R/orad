<?php

namespace App\Http\Livewire\Website;
use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\School;
use App\Models\UserIp;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Models\ParentsDetail;
use App\Mail\GeneratePassword;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\Scholarship as TriggerScholarshipMail;

class Scholarship extends Component
{
    public $loader=false;
    public $name, $guardian_name, $guardian_occupation, $email, $mobile, $whatsapp, $school, $class;
    public $city;
    public $state;
    public $selectedCity = 0;
    // default state rajasthan 
    public $selectedState = 8;

    protected $listeners = ['reset' => 'resetInputs'];


    public function mount()
    {
        $this->state = State::where('status','1')->orderBy('name','asc')->get();
        $this->city = City::where('states_id', $this->selectedState)->get();
    }
    
    /**
     * on state change this function will be trigger and update cities
     * 
     * @param stateId
     * @return response
     */
    public function updatedSelectedState($state)
    {
        $this->city = City::where('states_id', $this->selectedState)->get();
        $this->selectedState = $state;
    }

    public function render()
    {
        
        return view('website.scholarship')
        ->layout('website.layouts.scholarship-app');
    }

    public function rules()
    {
        return [
            'name'    => 'required|regex:/^[\pL\s\-]+$/u|string|min:3|max:50',
            'guardian_name'  => 'required|regex:/^[\pL\s\-]+$/u|string|min:3|max:50',
            'guardian_occupation'  => 'required|string|min:3',
            'selectedCity'  => 'required',
            'selectedState'  => 'required',
            // 'father_name'  => 'required|regex:/^[\pL\s\-]+$/u|string|min:3|max:50',
            // 'mother_name'  => 'required|regex:/^[\pL\s\-]+$/u|string|min:3|max:50',
            // 'father_occupation'  => 'required|string|min:3',
            // 'mother_occupation'  => 'required|string|min:3',
            'email'   => 'required|email|string|max:255|unique:users',
            'mobile'  => 'required|numeric|digits_between:10,13',
            'whatsapp'=> 'required|numeric|digits_between:10,13',
            'school'  => 'required|string|min:3|max:255',
            'class'  => 'required|string|min:1|max:50',
        ];
    }


    public function resetInputs(){
        $this->name = '';
        $this->guardian_name = '';
        $this->guardian_occupation = '';
        $this->city = '';
        $this->state = '';
        $this->email = '';
        $this->mobile = '';
        $this->whatsapp = '';
        $this->school = '';
        $this->class = '';
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
