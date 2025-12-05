<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChartCard extends Component
{
    public $title;
    public $canvasId;

    public function __construct($title = '', $canvasId = 'chart')
    {
        $this->title = $title;
        $this->canvasId = $canvasId;
    }

    public function render()
    {
        return view('components.chart-card');
    }
}
