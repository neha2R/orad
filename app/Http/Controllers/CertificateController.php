<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Demo;
class CertificateController extends Controller
{
    public function index($id,$demoid){
        $id=decrypt($id);
        $demoid=decrypt($demoid);
        $user=User::findorFail($id);
        $demodetails=Demo::findorFail($demoid);
        return view('livewire.school.certificate',compact('user','demodetails'));
    }
}
