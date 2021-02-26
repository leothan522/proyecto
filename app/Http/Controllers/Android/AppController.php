<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{

    public function autenticar($id)
    {
        $user = User::findOrFail($id);
        return Auth::loginUsingId($user->id, true);
    }

    public function usuariosRegistrados()
    {
        $carbon = new Carbon();
        $users = User::where('status', 1)->paginate(30);
        return view('android.usuarios')
            ->with('users', $users)
            ->with('carbon', $carbon);
    }
}
