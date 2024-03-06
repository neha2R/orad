<?php

namespace App\Http\Livewire\Training;

use Livewire\Component;
use App\Models\ContentCategory;
use App\Models\Content as ContentModel;

class Content extends Component
{

    public $search,$catfilter;

    public function render()
    {
        $data = ContentModel::query();
        if ($this->search) {
            $data = $data->where('title', 'LIKE', "%{$this->search}%")->orWhere('description', 'LIKE', "%{$this->search}%")->orWhere('tags', 'LIKE', "%{$this->search}%");
        }
        if ($this->catfilter) {
            $data = $data->where('category', $this->catfilter);
        }
        $data = $data->paginate(10);
        $categories = ContentCategory::all();
        return view('livewire.training.content',compact('categories','data'));
    }
}
