<?php

namespace App\Http\Livewire\Website;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Faq as FAQs;

class Faq extends Component
{
   
    public function render()
    {
        $faqsData = FAQs::where('is_active','1')->where('include_in_policy','0')->get();
        $policyData = FAQs::where('is_active','1')->where('include_in_policy','1')->get();
        return view('website.faq',compact('faqsData','policyData'))
        ->layout('website.layouts.app');
    }
}
