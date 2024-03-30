<?php

namespace App\Livewire;

use App\Enums\LevelEnum;
use Livewire\Component;

class LevelComponent extends Component
{
    public $levels;

    public function mount()
    {
        $this->levels = LevelEnum::values();
    }

    public function render()
    {
        return view('livewire.level-component');
    }

    public function selectLevel($level)
    {
        if ($this->levels->contains($level)) {
            $this->redirect('/play/'.$level);
        }
    }
}
