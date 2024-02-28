<?php

namespace App\Livewire;

use Illuminate\Support\Facades\File;
use Livewire\Component;

class TileComponent extends Component
{
    public $per_row = 5;

    public $icon_names;

    public $flipped_tiles = [];

    public $attempted_flipped_tiles;


    public function mount()
    {
        $this->icon_names = collect([]);
        $this->flipped_tiles = collect([]);
        collect(File::allFiles(public_path('assets/images')))->each(function ($file) {
            $this->icon_names->push($file->getFileName());
        });
        $this->icon_names = $this->icon_names->merge($this->icon_names->toArray())->shuffle()->chunk($this->per_row);
    }

    public function render()
    {
        return view('livewire.tile-component');
    }

    public function flipTile($flipped_tile, $chunk, $key)
    {
        $this->attempted_flipped_tiles[$key] = $flipped_tile;
        if (count($this->attempted_flipped_tiles) === 2) {
            if (count(array_unique($this->attempted_flipped_tiles)) === 1) {
                $this->flipped_tiles = $this->flipped_tiles->union($this->attempted_flipped_tiles);
            }
            $this->dispatch('flip-different-tiles');
        }
    }

    public function reFlipDifferentTiles()
    {
        if (count($this->attempted_flipped_tiles) === 2) {
            $this->attempted_flipped_tiles = [];
        }
    }
}
