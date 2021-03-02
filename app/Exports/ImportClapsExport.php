<?php

namespace App\Exports;

use App\Models\ImportClap;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ImportClapsExport implements FromView, WithTitle, WithColumnFormatting
{
    public function __construct($imports, $revision = false)
    {
        $this->imports = $imports;
        $this->revision = $revision;
    }

    public function view(): View
    {
        // TODO: Implement view() method.
        if ($this->revision){
            return view('admin.claps.exports.import_claps')->with('imports', $this->imports);
        }else{
            return view('admin.claps.exports.claps')->with('imports', $this->imports);
        }

    }

    public function title(): string
    {
        // TODO: Implement title() method.
        if ($this->revision){
            return "CLAPS Por Revisión";
        }else{
            return "Lista de CLAPS";
        }

    }
    public function columnFormats(): array
    {
        // TODO: Implement columnFormats() method.
        return [
            'P' => NumberFormat::FORMAT_DATE_DMYSLASH,
        ];
    }

}
