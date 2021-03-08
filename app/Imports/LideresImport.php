<?php

namespace App\Imports;

use App\Models\Lider;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class LideresImport implements WithMappedCells, ToModel
{
    public function __construct($id_clap, $id_import)
    {
        $this->id_clap = $id_clap;
        $this->id_import = $id_import;
    }

    public function mapping(): array
    {
        $mapp = [];

        for ($i = 1, $j = 13; $i <= 50; $i++, $j++) {
            $mapp['nombres_' . $i] = 'C' . $j;
            $mapp['tipo_ci_' . $i] = 'D' . $j;
            $mapp['cedula_' . $i] = 'E' . $j;
        }

        return $mapp;
    }

    public function model(array $row)
    {
        try {

            for ($i = 1; $i <= 50; $i++) {
                if (!is_null($row['nombres_' . $i]) && !is_null($row['tipo_ci_' . $i]) && !is_null($row['cedula_' . $i])) {
                    $lider = new Lider();
                    $lider->claps_id = $this->id_clap;
                    $lider->nombre_completo = strtoupper(trim($row['nombres_' . $i]));
                    $lider->tipo_ci = strtoupper(trim($row['tipo_ci_' . $i]));
                    $lider->cedula = strtoupper(trim($row['cedula_' . $i]));
                    $lider->import_id = $this->id_import;
                    $lider->save();
                }else{
                    $lider = null;
                }
            }

        }catch (\ErrorException $e) {
            $lider = null;
        }
        return $lider;
    }

}
