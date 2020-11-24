<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function usuariosRegistrados()
    {
        $carbon = new Carbon();
        $users = User::paginate(30);
        return view('android.usuarios')
            ->with('users', $users)
            ->with('carbon', $carbon);
    }
}
