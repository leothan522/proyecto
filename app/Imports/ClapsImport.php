<?php

namespace App\Imports;

use App\Models\Clap;
use App\Models\ImportClap;
use App\Models\Municipio;
use App\Models\Parametro;
use App\Models\Parroquia;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClapsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function __construct($id_import)
    {
        $this->id_import = $id_import;
    }

    public function model(array $row)
    {
        try {
            $data = [
                'programa' => $row['programa'],
                'municipios_id' => $row['municipio'],
                'parroquias_id' => $row['parroquia'],
                'comunidad' => $row['comunidad'],
                'nombre_clap' => $row['nombre_clap'],
                'codigo_spda' => $row['codigo_spda'],
                'codigo_sica' => $row['codigo_sica'],
                'bloques_id' => $row['bloque'],
                'cedula_lider' => $row['cedula'],
                'primer_nombre_lider' => $row['primer_nombre'],
                'segundo_nombre_lider' => $row['segundo_nombre'],
                'primer_apellido_lider' => $row['primer_apellido'],
                'segundo_apellido_lider' => $row['segundo_apellido'],
                'nacionalidad_lider' => $row['nacionalidad'],
                'genero' => $row['genero'],
                'fecha_nac_lider' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject( $row['fecha_de_nacimiento']),
                'profesion_lider' => $row['profesion'],
                'trabajo_lider' => $row['trabajo'],
                'telefono_1_lider' => $row['n_de_telefono_1'],
                'telefono_2_lider' => $row['n_de_telefono_2'],
                'email_lider' => $row['correo'],
                'estatus_lider' => $row['estatus_responsable'],
                'direccion' => $row['direccion'],
                'longitud' => $row['longitud'],
                'latitud' => $row['latitud'],
                'google_maps' => $row['google_maps'],
                'import_id' => $this->id_import
            ];

            $municipio = Municipio::where('nombre_completo', $data['municipios_id'])->first();
            $parroquia = Parroquia::where('nombre_completo', $data['parroquias_id'])->first();

            if ($municipio && $parroquia) {
                $data['municipios_id'] = $municipio->id;
                $data['parroquias_id'] = $parroquia->id;
                if ($data['bloques_id'] == "" || !is_numeric($data['bloques_id'])) {
                    $data['bloques_id'] = "BMS";
                }
                $bloque = Parametro::where('nombre', 'bloques')->where('valor', $data['bloques_id'])->first();
                if ($bloque) {
                    $data['bloques_id'] = $bloque->id;
                } else {
                    $nuevoBloque = new Parametro();
                    $nuevoBloque->nombre = "bloques";
                    $nuevoBloque->tabla_id = $data['municipios_id'];
                    $nuevoBloque->valor = $data['bloques_id'];
                    $nuevoBloque->save();
                    $data['bloques_id'] = $nuevoBloque->id;
                }
                $import = new Clap($data);
            } else {
                $observaciones = [];
                if ($municipio) {
                    $observaciones['municipio'] = null;
                } else {
                    $observaciones['municipio'] = "true";
                }
                if ($parroquia) {
                    $observaciones['parroquia'] = null;
                } else {
                    $observaciones['parroquia'] = "true";
                }
                $data['observaciones'] = json_encode($observaciones);
                $import = new ImportClap($data);
            }
        }catch (\ErrorException $e) {
            $import = null;
        }

        return $import;

    }

    public function headingRow(): int
    {
        return 2;
    }

}
