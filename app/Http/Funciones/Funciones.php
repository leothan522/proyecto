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

