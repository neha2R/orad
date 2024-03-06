<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\School;
use App\Models\UserIp;
use App\Mail\Scholarship;
use Illuminate\Support\Str;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Models\ParentsDetail;
use App\Mail\GeneratePassword;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ScholarshipController extends Controller
{

    public function store(Request $request)
    {
        
        $request->validate([
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
            'school'  => 'required',
            'class'  => 'required',
        ]);

        // check user is already exists or not in user table 
        $user = User::where('mobile',$request->mobile)->first();
        // $user = null;

        if ($user == null) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobilecode = '+91';
            $user->mobile = $request->mobile;
            $user->whatsappnumber = $request->whatsapp;
            $user->department = '0';
            $user->role = '0';
            $user->password = Hash::make($request->mobile);
            $user->user_type = '2';
            $user->is_scholorship_user = '1';
            if($user->save()){
                // store school name 
                $school = ucwords($request->school);
                $schoolData = School::where('name',$school)->first();
                if ($schoolData == null) {
                    $schoolData = School::create(['name'=>$school]);
                }
                

                $alreadyExists = ParentsDetail::where('user_id',$user->id)->exists();
                if (!$alreadyExists) {
                    ParentsDetail::create([
                        'user_id'=>$user->id,
                        'school_id'=>$schoolData->id,
                        'father_name'=>ucwords($request->guardian_name),
                        'mother_name'=>ucwords($request->guardian_name),
                        'father_occupation'=>$request->guardian_occupation,
                        'mother_occupation'=>$request->guardian_occupation,
                        'city'=>$request->city,
                        'state'=>$request->state,
                        'class'=>$request->state,
                    ]);
                }
                
                WhatsappService::optin($request->mobile);
                WhatsappService::sendScholarshipWhatsappMsg($user->id);
                SmsService::sendScholarsipLink($user->id);
                
                Mail::to($request->email)->send(new Scholarship($user->id));

                // register user ip 
                $isAlreadyRegistered = UserIp::where('user_id',$user->id)->first();
                if($isAlreadyRegistered == null){
                    UserIp::create(['ip'=>request()->ip(), 'user_id'=>$user->id]);
                }
               return back()->with('success','Registration successful, Thank you...'); 
            }else {
                return back()->with('error','Something went wrong...'); 
                
            }
        }else {
            return back()->with('success','Thank you for your interest, you are already registerd ...'); 
            
        }
        // return redirect()->route('home')->with('success','Registration successful, Thank you...'); 
    }
}