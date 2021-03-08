<?php

namespace App\Imports;

use App\Models\Censo;
use App\Models\Lider;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class CensoImport implements WithMappedCells, ToModel
{
    public function __construct($id_clap, $id_import)
    {
        $this->id_clap = $id_clap;
        $this->id_import = $id_import;
        $this->i = 0;
    }

    public function mapping(): array
    {
        $mapp = [];

        for ($i = 1, $j = 4; $i <= 5000; $i++, $j++) {

            $mapp['miembro_familia'.$i]  = 'C'.$j;
            $mapp['nombre_completo'.$i]  = 'D'.$j;
            $mapp['tipo_ci'.$i] = 'E'.$j;
            $mapp['cedula'.$i] = 'F'.$j;
            $mapp['telefono_1'.$i]  = 'G'.$j;
            $mapp['telefono_2'.$i]  = 'H'.$j;
            $mapp['estructura_clap'.$i]  = 'I'.$j;
            $mapp['email'.$i]  = 'J'.$j;
            $mapp['direccion'.$i]  = 'K'.$j;
            $mapp['lideres_id'.$i]  = 'L'.$j;
            $mapp['cdlp'.$i]  = 'M'.$j;
            $mapp['observaciones'.$i]  = 'O'.$j;

        }

        return $mapp;

    }

    public function model(array $row)
    {
        $familia = Censo::orderBy('num_familia', 'DESC')->first();
        if ($familia){
            $num_familia = $familia->num_familia;
        }else{
            $num_familia = 0;
        }

        try {

            for ($i = 1, $j = 4; $i <= 5000; $i++, $j++) {

                if (!is_null($row['miembro_familia' . $i]) && !is_null($row['nombre_completo' . $i])) {

                    if ($row['miembro_familia' . $i] == "Jefe de Familia") {
                        $num_familia++;
                    }

                    if ($row['estructura_clap'.$i] == "Ninguno"){
                        $row['estructura_clap'.$i] = null;
                    }

                    if (!is_null($row['lideres_id' . $i])) {
                        $lider = Lider::where('nombre_completo', strtoupper(trim($row['lideres_id' . $i])))->where('import_id', $this->id_import)->first();
                        if ($lider) {
                            $id_lider = $lider->id;
                        } else {
                            $id_lider = null;
                        }
                    } else {
                        $id_lider = null;
                    }

                    $censo = new Censo();
                    $censo->claps_id = $this->id_clap;
                    $censo->num_familia = $num_familia;
                    $censo->miembro_familia = $row['miembro_familia' . $i];
                    $censo->nombre_completo = strtoupper(trim($row['nombre_completo' . $i]));
                    $censo->tipo_ci = strtoupper(trim($row['tipo_ci' . $i]));
                    $censo->cedula = $row['cedula' . $i];
                    $censo->telefono_1 = $row['telefono_1' . $i];
                    $censo->telefono_2 = $row['telefono_2' . $i];
                    $censo->estructura_clap = $row['estructura_clap' . $i];
                    $censo->email = strtolower(trim($row['email' . $i]));
                    $censo->direccion = strtoupper(trim($row['direccion' . $i]));
                    $censo->lideres_id = $id_lider;
                    $censo->cdlp = $row['cdlp' . $i];
                    $censo->observaciones = strtoupper($row['observaciones' . $i]);
                    $censo->import_id = $this->id_import;
                    $censo->save();

                } else {
                    $censo = null;
                }

            }

        }catch (\ErrorException $e) {
            $censo = null;
        }

        return $censo;

    }


}
