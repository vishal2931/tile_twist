<?php

namespace App\Livewire;

use App\Enums\LevelEnum;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class TileComponent extends Component
{
    public $per_row = 5;

    public $flipped_tiles = [];

    public $points = 0;

    public $is_win = false;

    public $is_lost = false;

    public $attempted_flipped_tiles = [];

    public $level;

    public $icon_names;

    public $total_steps;

    public $steps;

    public function mount($level)
    {
        $this->icon_names = collect([]);
        $this->flipped_tiles = collect([]);
        $this->level = $level;
        $this->total_steps = LevelEnum::steps()[$level];
        $this->steps = $this->total_steps;
        $this->generateTiles();
    }

    public function render()
    {
        return view('livewire.tile-component');
    }

    public function flipTile($flipped_tile, $chunk, $key)
    {
        if (! in_array($flipped_tile, $this->flipped_tiles->toArray()) && (! isset($this->attempted_flipped_tiles[$key]) || $this->attempted_flipped_tiles[$key] != $flipped_tile)) {
            $this->attempted_flipped_tiles[$key] = $flipped_tile;
            $this->steps -= 1;
            if (count($this->attempted_flipped_tiles) === 2) {
                if (count(array_unique($this->attempted_flipped_tiles)) === 1) {
                    $this->flipped_tiles = $this->flipped_tiles->union($this->attempted_flipped_tiles);
                    $this->points += 1;
                }
                $this->dispatch('flip-different-tiles');
            }
        }
    }

    public function reFlipDifferentTiles()
    {
        if (count($this->attempted_flipped_tiles) === 2) {
            $this->attempted_flipped_tiles = [];
        }
        if ($this->icon_names->flatten()->count() === $this->flipped_tiles->count()) {
            $this->dispatch('win-the-game');
            $this->winGame();
        } elseif ($this->steps <= 0) {
            $this->lostGame();
        }
    }

    public function resetTiles()
    {
        sleep(1);
        $this->attempted_flipped_tiles = [];
        $this->icon_names = collect([]);
        $this->flipped_tiles = collect([]);
        $this->points = 0;
        $this->is_win = false;
        $this->is_lost = false;
        $this->steps = $this->total_steps;
        $this->generateTiles();
        $this->dispatch('reset-tiles');
    }

    public function lostGame()
    {
        $this->is_lost = true;
    }

    public function winGame()
    {
        $this->is_win = true;
    }

    private function generateTiles()
    {
        collect(File::allFiles(public_path('assets/images')))->each(function ($file) {
            $this->icon_names->push($file->getFileName());
        });
        $this->icon_names = $this->icon_names->merge($this->icon_names->toArray())->shuffle()->chunk($this->per_row);
    }
}
