<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DownloadSong extends Component
{
    public function mount($song)
    {
        $this->song = $song;
    }
    public function render()
    {
        return view('livewire.download-song');
    }
}
