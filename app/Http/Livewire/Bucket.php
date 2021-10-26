<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Bucket extends Component
{

    public $bucket;

    public function render()
    {
        return view('livewire.bucket')->with('bucket', $this->bucket);
    }
}
