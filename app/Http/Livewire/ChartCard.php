<?php

namespace App\Http\Livewire;

use Illuminate\View\View;

class ChartCard
{
    public string $title = '';
    public array $labels = [];
    public array $letters = [];
    public array $reports = [];

    public function mount($title = '', $labels = [], $letters = [], $reports = []): void
    {
        $this->title = $title;
        $this->labels = $labels;
        $this->letters = $letters;
        $this->reports = $reports;
    }

    public function render(): View
    {
        return view('livewire.chart-card');
    }
}
