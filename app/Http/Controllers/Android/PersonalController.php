<?php

namespace App\Http\Controllers\Android;

use App\Http\Controllers\Controller;
use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index($cedula = null)
    {
        $personal = Personal::where('cedula', $cedula)->first();
        return view('android.personal_alguarisa.index')
            ->with('personal', $personal);
    }
}
