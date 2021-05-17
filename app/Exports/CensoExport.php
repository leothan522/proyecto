<?php

namespace App\Exports;

use App\Censo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class CensoExport implements FromView, WithTitle
{

    public function __construct($clap, $censo)
    {
        $this->clap = $clap;
        $this->censo = $censo;
    }

    public function view(): View
    {
        // TODO: Implement view() method.
        return view('admin.claps.exports.censo')
            ->with('clap', $this->clap)
            ->with('censo', $this->censo)
            ;
    }
    public function title(): string
    {
        // TODO: Implement title() method.
        return "CLAP ".$this->clap->nombre_clap;
    }
}
