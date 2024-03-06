<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\School;
use Illuminate\Support\Str;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Models\ParentsDetail;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function index()
    {
        return view('website.exam.instructions');
    }
    public function exam()
    {
        return view('website.exam.exam');
    }

}