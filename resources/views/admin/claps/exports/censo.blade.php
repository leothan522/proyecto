<table>
    <thead>
    <tr>
        <th style="
        width: 5px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">#</th>
        <th style="
        width: 25px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">Miembro de familia</th>
        <th style="
        width: 25px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">Nombres y Apellidos</th>
        <th style="
        width: 10px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">Tipo CI</th>
        <th style="
        width: 20px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">Cédula de Identidad</th>
        <th style="
        width: 25px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">Teléfono (1)</th>
        <th style="
        width: 25px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">Teléfono (2)</th>
        <th style="
        width: 25px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">Estructura Clap</th>
        <th style="
        width: 25px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">e-mail</th>
        <th style="
        width: 25px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">Dirección</th>
        <th style="
        width: 25px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">Líder de Calle</th>
        <th style="
        width: 15px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">CDLP Activo</th>
        <th style="
        width: 25px;
        border: 1px solid #000000;
        background-color: #D0CECE;
        font-family: Calibri;
        font-size: 11px;
        font-weight: bold;
        text-align: center;
        ">Observaciones</th>
    </tr>
    </thead>
    <tbody>
    @php($i = 0)
    @foreach($censo as $persona)
        @php($i++)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $persona->miembro_familia }}</td>
            <td>{{ $persona->nombre_completo }}</td>
            <td>{{ $persona->tipo_ci }}</td>
            <td>{{ $persona->cedula }}</td>
            <td>{{ $persona->telefono_1 }}</td>
            <td>{{ $persona->telefono_2 }}</td>
            <td>{{ $persona->estructura_clap }}</td>
            <td>{{ $persona->email }}</td>
            <td>{{ $persona->direccion }}</td>
            @if ($persona->lideres_id != null)
                <td>{{ $persona->lider->nombre_completo }}</td>
                @else
                <td></td>
            @endif
            <td>{{ strtoupper($persona->cdlp) }}</td>
            <td>{{ $persona->observaciones }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
