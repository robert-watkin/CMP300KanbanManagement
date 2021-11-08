<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bucket;

class BucketComponent extends Component
{

    public $bucket;
    public $bucketTitle;

    public function render()
    {
        $this->bucketTitle = $this->bucket->title;
        return view('livewire.bucket-component')->with('bucket', $this->bucket);
    }

    public function deleteBucket()
    {
        $this->bucket->delete();
        $this->emit('bucketDeleted');
    }

    public function updateBucket()
    {
        $this->bucket->title = $this->bucketTitle;
        $this->bucket->save();
    }
}
