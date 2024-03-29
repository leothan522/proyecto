<table>
    <thead>
    <tr>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; width: 5px;">ID</th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; width: 40px;">NOMBRE</th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; width: 40px;">EMAIL</th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; width: 20px;">ROL</th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; width: 20px;">ESTATUS</th>
        <th style="border: 1px solid #000000;background-color: #00B0F0; font-weight: bold; text-align: center; width: 20px;">REGISTRO</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td style="border: 1px solid #000000; text-align: center">{{ $user->id }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ ucwords($user->name) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $user->email }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ role($user->role) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{!! estatusUsuario($user->status)  !!}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ fecha($user->created_at) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

