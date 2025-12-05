<?php

namespace App\Http\Livewire;

use Illuminate\View\View;

class StatCard
{
    public string $title = '';
    public $value = null;
    public string $icon = '';

    public function mount($title = '', $value = null, $icon = ''): void
    {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
    }

    public function render(): View
    {
        return view('livewire.stat-card');
    }
}
