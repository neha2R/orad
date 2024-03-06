<?php

namespace App\Http\Livewire\Content;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\OradContent;
use App\Models\ContentFiles;
use Livewire\WithPagination;

class Juniordashboard extends Component
{

    use WithFileUploads,WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name,$keyword,$file,$totalcontent=0,$proofread=0,$totalcompalint=0;
    public $editid,$statswitch;
    public function edit($id){
        $this->editid=$id;
        $content=OradContent::findorFail($id);
        $this->name=$content->name;
        $this->keyword=$content->keyword;
    }

    public function stats(){
        $this->totalcontent=OradContent::where(['creator'=>auth()->user()->id,'proofreadjunior'=>0])->count();
        $this->proofread=OradContent::where(['creator'=>auth()->user()->id,'proofreadjunior'=>1])->count();
    }

    public function statsswitchhandel($id){
        $this->statswitch=$id;
    }

    public function mount(){
        $this->stats();
    }

    public function store(){
        // dd('dd');
        $validatedData = $this->validate([
            'name' => 'required',
            'keyword' => 'required',
            'file' => 'required',
        ]);
        $file= $this->file->store('content','public');
        $data=['name'=>$this->name,'keyword'=>$this->keyword,'creator'=>auth()->user()->id,'proofreadjunior'=>1];    
        $created= OradContent::findorFail($this->editid)->update($data);  
        $files=ContentFiles::create(['content_id'=>$this->editid,'file'=>$file]);  
        $this->emit('flashMessage','Content Created Successfully');
        $this->stats();
    }

    public function render()
    {   
        switch ($this->statswitch) {
            case 0:
                $data=OradContent::where(['creator'=>auth()->user()->id])->where('proofreadjunior',0)->with(['contentfile' => function($query) {
                    $query->orderBy('id', 'desc');
                }])->orderBy('id','desc')->paginate(10);
                break;
            case 1:
                $data=OradContent::where(['creator'=>auth()->user()->id])->where('proofreadjunior',1)->with(['contentfile' => function($query) {
                    $query->orderBy('id', 'desc');
                }])->orderBy('id','desc')->paginate(10);
                break;
            case 2:
                # code...
                break;
            default:
                # code...
                break;
        }
       
        
        return view('livewire.content.juniordashboard',compact('data'));
    }
}
