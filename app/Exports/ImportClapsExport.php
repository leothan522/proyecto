<?php

namespace App\Exports;

use App\Models\ImportClap;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class ImportClapsExport implements FromView, WithTitle
{
    public function __construct($imports)
    {
        $this->imports = $imports;
    }

    public function view(): View
    {
        // TODO: Implement view() method.
        return view('admin.claps.exports.import_claps')->with('imports', $this->imports);
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return "CLAPS Por Revisión";
    }

}
