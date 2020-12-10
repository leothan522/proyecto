<?php
//Funciones Personalizadas para el Proyecto

use Carbon\Carbon;

function hola(){
    return "Funciones Personalidas bien creada";
}

function status($i){
    $status = [
        '0' => '<span class="text-danger">Suspendido</span>',
        '1' => '<span class="text-primary">Activo</span>',
        '2' => '<span class="text-success">Confirmado</span>'
    ];
    return $status[$i];
}

function role($i = null){
    $status = [
        '0'     => 'Estandar',
        '1'     => 'Administrador',
        '100'   => 'Root'
    ];
    if (is_null($i)){
        unset($status["100"]);
        return $status;
    }else{
        return $status[$i];
    }
}

function haceCuanto($fecha){
    $carbon = new Carbon();
    return $carbon->parse($fecha)->diffForHumans();
}

function fecha($fecha, $format = null){
    $carbon = new Carbon();
    if ($format == null){ $format = "d-m-Y"; }
    return $carbon->parse($fecha)->format($format);
}

function iconoPlataforma($plataforma){
    if ($plataforma == 0){
        return '<i class="fas fa-desktop"></i>';
    }else{
        return '<i class="fas fa-mobile"></i>';
    }
}

//Leer JSON
function leerJson($json, $key)
{
    if ($json == null){
        return null;
    }else{
        $json = $json;
        $json = json_decode($json, true);
        if (array_key_exists($key, $json)){
            return $json[$key];
        }else{
            return null;
        }
    }
}

//funcion formato millares
function formatoMillares($cantidad, $decimal = 2){
    return number_format($cantidad, $decimal, ',', '.');
}

//Ceros a la izquierda
function cerosIzquierda($cantidad, $cantCeros = 2){
    if ($cantidad == 0){
        return 0;
    }
    return str_pad($cantidad, $cantCeros, "0", STR_PAD_LEFT);
}

//calculo de porcentaje
function obtenerPorcentaje($cantidad, $total) {
    if ($total != 0){
        $porcentaje = ((float)$cantidad * 100) / $total; // Regla de tres
        $porcentaje = round($porcentaje, 2);  // Quitar los decimales
        return $porcentaje;
    }
    return 0;
}

function programa($i = null){
    $status = [
        'CLAP'     => 'CLAP',
        'BASE'     => 'BASE'
    ];
    if (is_null($i)){
        return $status;
    }else{
        return $status[$i];
    }
}


