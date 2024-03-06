<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Imports\WebImport;
use Maatwebsite\Excel\Facades\Excel as MaatwebsiteExcel;
use Livewire\WithFileUploads;
use App\Models\Importedlead;

class ImportModule extends Component
{
    use WithFileUploads;
    public  $importfile;

    public function store(){
        
        // Importedlead::create(['mobile'=>"902",'optin'=>1,'template'=>1,'responseoptin'=>1,'responsesendmessage'=>1]);
        MaatwebsiteExcel::import(new WebImport, $this->importfile);

    }

    public function render()
    {
        return view('livewire.import-module')
        ->layout('welcome');
    }
}
