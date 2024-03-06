<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class LeadGodMode extends Component
{
    
    public function render()
    {
        $leads=User::where('user_type',2)->with(['seniorMarketingRelation','juniorMarketingRelation','seniorTrainerRelation','juniorTrainerRelation','demo'])->get();
        // dd($leads);
        return view('livewire.lead-god-mode',compact('leads'));
    }
}
