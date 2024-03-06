<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slot;
use Livewire\Component;
use Livewire\WithPagination;

class SlotComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $pageheading, $status;

    public function mount(){
        $this->pageheading = 'Slots Management';
    }

    public function changestatus($id, $status){
        $status = 1-$status;
        Slot::findorFail($id)->update(['is_active' => $status]);
        $this->emit('flashMessage', 'Status changed successfully');
    }

    public function render()
    {
        $data = Slot::paginate(10);
        return view('livewire.admin.slot-component', ['data' => $data])->layout('layouts.app', ['pageheading' => $this->pageheading]);
    }
}
