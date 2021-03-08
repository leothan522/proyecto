<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ClapsCensoImport implements WithMultipleSheets
{
    public function __construct($id_clap, $id_import)
    {
        $this->id_clap = $id_clap;
        $this->id_import = $id_import;
    }

    public function sheets(): array
    {
        try {
            return [
                0 => new LideresImport($this->id_clap, $this->id_import),
                1 => new CensoImport($this->id_clap, $this->id_import)
            ];
        }catch (\ErrorException $e) {
            return null;
        }
    }

}
