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

function estatusUsuario($i, $icon = null){
    if (is_null($icon)){
        $suspendido = "Suspendido";
        $activado = "Activo";
    }else{
        $suspendido = '<i class="fa fa-user-slash"></i>';
        $activado = '<i class="fa fa-user-check"></i>';
    }

    $status = [
        '0' => '<span class="text-danger">'.$suspendido.'</span>',
        '1' => '<span class="text-success">'.$activado.'</span>'/*,
        '2' => '<span class="text-success">Confirmado</span>'*/
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
    if ($format == null){ $format = "j/n/Y"; }
    return $carbon->parse($fecha)->format($format);
}

function cuantosDias($fecha_inicio, $fecha_final){

    if ($fecha_inicio == null){
        return 0;
    }

    $carbon = new Carbon();
    $fechaEmision = $carbon->parse($fecha_inicio);
    $fechaExpiracion = $carbon->parse($fecha_final);
    $diasDiferencia = $fechaExpiracion->diffInDays($fechaEmision);
    return $diasDiferencia;
}

function fechaFeria($fecha){
    $explode = explode('-', $fecha);
    $diaSemana = date("w",strtotime($fecha));
    $diasEspanol = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $mes = $meses[$explode[1] - 1];
    $fechaFeria = $mes." ".$explode[2].", ".$diasEspanol[$diaSemana];
    return $fechaFeria;
}

function diaEspanol($fecha){
    $diaSemana = date("w",strtotime($fecha));
    $diasEspanol = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
    $dia = $diasEspanol[$diaSemana];
    return $dia;
}

function mesEspanol($numMes){
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $mes = $meses[$numMes - 1];
    return $mes;
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
        return 'nulo';
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
        'BMS'     => 'BMS'
    ];
    if (is_null($i)){
        return $status;
    }else{
        return $status[$i];
    }
}

function colorBarra($porcentaje){
    switch ($porcentaje){
        case $porcentaje <= 40:
            return "bg-danger";
        break;
        case $porcentaje <= 80:
            return "bg-warning";
        break;
        case $porcentaje <= 90:
            return "bg-info";
        break;
        case $porcentaje == 100:
            return "bg-success";
        break;
        case $porcentaje > 100:
            return "bg-orange";
        break;
        default:
            return "bg-info";
        break;
    }
}

function semaforoDias($dias, $text = false){

    if ($text){

        if ($dias == 0){
            return 'text-success';
        }

        switch ($dias){
            case $dias <= 30:
                return "text-success";
                break;
            case $dias > 40:
                return "text-danger";
                break;
            default:
                return "text-warning";
                break;
        }

    }else{

        if ($dias == 0){
            return 'bg-success';
        }

        switch ($dias){
            case $dias <= 30:
                return "bg-success";
                break;
            case $dias > 40:
                return "bg-danger";
                break;
            default:
                return "bg-warning";
                break;
        }

    }


}

//Alertas de sweetAlert2
function verSweetAlert2($mensaje, $alert = null, $type = 'success', $icono = '<i class="fa fa-trash-alt"></i>', $title = '¡Éxito!')
{
    switch ($alert){
        default:
            alert()->success('¡Éxito!',$mensaje)->persistent(true,false);
            break;
        case "iconHtml":
            alert($title, $mensaje, $type)->iconHtml($icono)->persistent(true,false)->toHtml();
            break;
        case "toast":
            toast($mensaje, $type);
            break;
    }
    /*alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');
        alert()->info('InfoAlert','Lorem ipsum dolor sit amet.');
        alert()->warning('WarningAlert','Lorem ipsum dolor sit amet.');
        alert()->error('ErrorAlert','Lorem ipsum dolor sit amet.');
        alert()->question('QuestionAlert','Lorem ipsum dolor sit amet.');
        toast('Success Toast','success');.
        // example:
        alert()->success('Post Created', '<strong>Successfully</strong>')->toHtml();
        // example:
        alert('Title','Lorem Lorem Lorem', 'success')->addImage('https://unsplash.it/400/200');
        // example:
        alert('Title','Lorem Lorem Lorem', 'success')->width('720px');
        // example:
        alert('Title','Lorem Lorem Lorem', 'success')->padding('50px');
        */
    // example:
    //alert()->success('¡Éxito!',$mensaje)->persistent(true,false);
    // example:
    //alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.')->showConfirmButton('Confirm', '#3085d6');
    // example:
    //alert()->question('Are you sure?','You won\'t be able to revert this!')->showCancelButton('Cancel', '#aaa');
    // example:
    //toast('Post Updated','success','top-right')->showCloseButton();
    // example:
    //toast('Post Updated','success','top-right')->hideCloseButton();
    // example:
    /*alert()->question('Are you sure?','You won\'t be able to revert this!')
        ->showConfirmButton('Yes! Delete it', '#3085d6')
        ->showCancelButton('Cancel', '#aaa')->reverseButtons();*/

    // example:
    // alert()->error('Oops...', 'Something went wrong!')->footer('<a href="#">Why do I have this issue?</a>');
    // example:
    //alert()->success('Post Created', 'Successfully')->toToast();
    // example:
    //alert('Title','Lorem Lorem Lorem', 'success')->background('#2acc56');
    // example:
    //()->success('Post Created', 'Successfully')->buttonsStyling(false);
    // example:
    //alert()->success('Post Created', 'Successfully')->iconHtml('<i class="far fa-thumbs-up"></i>');
    // example:
    //alert()->question('Are you sure?','You won\'t be able to revert this!')->showCancelButton()->showConfirmButton()->focusConfirm(true);
    // example:
    //alert()->question('Are you sure?','You won\'t be able to revert this!')->showCancelButton()->showConfirmButton()->focusCancel(true);
    // example:
    //toast('Signed in successfully','success')->timerProgressBar();

}


