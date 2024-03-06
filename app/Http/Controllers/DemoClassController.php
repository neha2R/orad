<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DemoClassController extends Controller
{
    public function index()
    {
        return view('website.demo_class');
    }
    
    public function whatsappTest()
    {
    
        $data = WhatsappService::optin("7734977437");
        $data = WhatsappService::sendScholarshipWhatsappMsg(477);
        dd($data);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|regex:/^[\pL\s\-]+$/u|string|min:3|max:50',
            'email'     => 'required|email|string|max:255',
            'mobile'    => 'required|numeric|digits_between:10,13',
            'whatsapp'  => 'required|numeric|digits_between:10,13',
        ]);
        
        if ($request->password) {
            $request->validate([
                'password' => ['required'],
                'confirm_password' => ['required','same:password'],
            ]);
            $encryptedPassword=Hash::make($request->passowrd);
            $password = $request->password;
        }else {
            $encryptedPassword = Hash::make($request->mobile);
            $password = $request->mobile;
        }
        // check user is already exists or not in user table 
        $user = User::where('email',$request->email)->orWhere('mobile',$request->mobile)->first();

        if ($user == null) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobilecode = '+91';
            $user->mobile = $request->mobile;
            $user->whatsappnumber = $request->whatsapp;
            $user->department = '0';
            $user->role = '0';
            $user->password = $encryptedPassword;
            $user->user_type = '2';
            if($user->save()){
                $message="Welcome to orad. Here are your username: $request->email password: $password . Follow this link orad.in for more details.";
                WhatsappService::optin($request->mobile);
                WhatsappService::sendmessage("Your demo booking is accepted",$request->whatsapp);
                SmsService::sendDemolink($request->mobile,$request->email);

                // notifiy to admin 
                leadRegister();
               return redirect()->route('home')->with('success','Registration successful, Thank you...'); 
            }else {
                return back()->with('error','Something went wrong...'); 
                
            }
        }
        return redirect()->route('home')->with('success','Registration successful, Thank you...'); 
    }
}