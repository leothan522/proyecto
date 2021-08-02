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
        //dd($row);
        try {
            $data = [
                'programa' => trim($row['programa']),
                'municipios_id' => trim($row['municipio']),
                'parroquias_id' => trim($row['parroquia']),
                'comunidad' => trim($row['comunidad']),
                'nombre_clap' => trim($row['nombre_clap']),
                //'codigo_spda' => trim($row['codigo_spda']),
                //'codigo_sica' => trim($row['codigo_sica']),
                'bloques_id' => trim($row['bloque']),
                'cedula_lider' => trim($row['cedula']),
                'primer_nombre_lider' => trim($row['primer_nombre']),
                //'segundo_nombre_lider' => trim($row['segundo_nombre']),
                'primer_apellido_lider' => trim($row['primer_apellido']),
                //'segundo_apellido_lider' => trim($row['segundo_apellido']),
                'nacionalidad_lider' => trim($row['nacionalidad']),
                'genero' => trim($row['genero']),
                //'fecha_nac_lider' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(trim($row['fecha_de_nacimiento'])),
                //'profesion_lider' => trim($row['profesion']),
                //'trabajo_lider' => trim($row['trabajo']),
                //'telefono_1_lider' => trim($row['n_de_telefono_1']),
                //'telefono_2_lider' => trim($row['n_de_telefono_2']),
                //'email_lider' => trim($row['correo']),
                'estatus_lider' => trim($row['estatus_responsable']),
                //'direccion' => trim($row['direccion']),
                //'longitud' => trim($row['longitud']),
                //'latitud' => trim($row['latitud']),
                'google_maps' => trim($row['google_maps']),
                'import_id' => $this->id_import
            ];

            //FECHA DE NACIMIENTO
            if ($row['fecha_de_nacimiento']){
                $data['fecha_nac_lider'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(trim($row['fecha_de_nacimiento']));
            }else{
                $data['fecha_nac_lider'] = null;
            }

            //CODIGO SPDA
            if ($row['codigo_spda']){
                $data['codigo_spda'] = trim($row['codigo_spda']);
            }else{
                $data['codigo_spda'] = null;
            }

            //CODIGO SICA
            if ($row['codigo_sica']){
                $data['codigo_sica'] = trim($row['codigo_sica']);
            }else{
                $data['codigo_sica'] = null;
            }

            //SEGUNDO NOMBRE
            if ($row['segundo_nombre']){
                $data['segundo_nombre_lider'] = trim($row['segundo_nombre']);
            }else{
                $data['segundo_nombre_lider'] = null;
            }

            //SEGUNDO APELLIDO
            if ($row['segundo_apellido']){
                $data['segundo_apellido_lider'] = trim($row['segundo_apellido']);
            }else{
                $data['segundo_apellido_lider'] = null;
            }

            //SEGUNDO PROFESION
            if ($row['profesion']){
                $data['profesion_lider'] = trim($row['profesion']);
            }else{
                $data['profesion_lider'] = null;
            }

            //TRABAJO
            if ($row['trabajo']){
                $data['trabajo_lider'] = trim($row['trabajo']);
            }else{
                $data['trabajo_lider'] = null;
            }

            //TELEFONO 1
            if ($row['n_de_telefono_1']){
                $data['telefono_1_lider'] = trim($row['n_de_telefono_1']);
            }else{
                $data['telefono_1_lider'] = null;
            }

            //TELEFONO 2
            if ($row['n_de_telefono_2']){
                $data['telefono_2_lider'] = trim($row['n_de_telefono_2']);
            }else{
                $data['telefono_2_lider'] = null;
            }

            //CORREO
            if ($row['correo']){
                $data['email_lider'] = trim($row['correo']);
            }else{
                $data['email_lider'] = null;
            }

            //DIRECCION
            if ($row['direccion']){
                $data['direccion'] = trim($row['direccion']);
            }else{
                $data['direccion'] = null;
            }

            //LONGITUD
            if ($row['longitud']){
                $data['longitud'] = trim($row['longitud']);
            }else{
                $data['longitud'] = null;
            }

            //LATITUD
            if ($row['latitud']){
                $data['latitud'] = trim($row['latitud']);
            }else{
                $data['latitud'] = null;
            }

            //GOOGLE MAPS
            if ($row['google_maps']){
                $data['google_maps'] = trim($row['google_maps']);
            }else{
                $data['google_maps'] = null;
            }

            //CEDULA
            if ($row['cedula']){
                $data['cedula_lider'] = trim($row['cedula']);
            }else{
                $data['cedula_lider'] = null;
            }

            //PRODUCTIVO
            if ($row['esta_produciendo']){
                $data['productivo'] = trim($row['esta_produciendo']);
            }else{
                $data['productivo'] = null;
            }

            //TIPO_PRODUCCION
            if ($row['tipo_de_produccion']){
                $data['tipo_produccion'] = trim($row['tipo_de_produccion']);
            }else{
                $data['tipo_produccion'] = null;
            }

            //DETALLES_PRODUCCION
            if ($row['especifique']){
                $data['detalles_produccion'] = trim($row['especifique']);
            }else{
                $data['detalles_produccion'] = null;
            }

            //NUM_FAMILIAS
            if ($row['numero_de_familias']){
                $data['num_familias'] = trim($row['numero_de_familias']);
            }else{
                $data['num_familias'] = null;
            }

            //NUM_LIDERES
            if ($row['numero_de_lideres_de_calle']){
                $data['num_lideres'] = trim($row['numero_de_lideres_de_calle']);
            }else{
                $data['num_lideres'] = null;
            }



            $municipio = Municipio::where('nombre_completo', $data['municipios_id'])->first();
            $parroquia = Parroquia::where('nombre_completo', $data['parroquias_id'])->first();


            if ($municipio){
                $bloque = Parametro::where('nombre', 'bloques')->where('tabla_id', $municipio->id)->where('valor', $data['bloques_id'])->first();
            }else{
                $bloque = false;
            }

            /*if ($data['bloques_id'] == "" || !is_numeric($data['bloques_id'])) {
                $data['bloques_id'] = "BMS";
            }*/
            /*if ($bloque) {
                $data['bloques_id'] = $bloque->id;
            } else {
                $nuevoBloque = new Parametro();
                $nuevoBloque->nombre = "bloques";
                $nuevoBloque->tabla_id = $data['municipios_id'];
                $nuevoBloque->valor = $data['bloques_id'];
                $nuevoBloque->save();
                $data['bloques_id'] = $nuevoBloque->id;
            }*/


            if ($municipio && $parroquia && $bloque) {

                $data['municipios_id'] = $municipio->id;
                $data['parroquias_id'] = $parroquia->id;
                $data['bloques_id'] = $bloque->id;

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
                if ($bloque) {
                    $observaciones['parroquia'] = null;
                } else {
                    $observaciones['bloque'] = "true";
                }

                $data['observaciones'] = json_encode($observaciones);
                $import = new ImportClap($data);
            }
        }catch (\ErrorException $e) {
            dd($e);
            $import = null;
        }

        return $import;

    }

    public function headingRow(): int
    {
        return 2;
    }

}
