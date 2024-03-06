<?php

use App\Enums\LevelEnum;
use App\Livewire\LevelComponent;
use App\Livewire\TileComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', LevelComponent::class)->name('tiles.level');
Route::get('/play/{level}', TileComponent::class)->whereIn('level', LevelEnum::values()->toArray())->name('tiles.play');
