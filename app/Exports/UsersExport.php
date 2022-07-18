<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersExport implements FromView, WithTitle, WithProperties, ShouldAutoSize
{
    public function view(): View
    {
        $users = User::all();
        return view('admin.usuarios_new.export')
            ->with('users', $users);
    }
    public function title(): string
    {
        return "Usuarios Registrados";
    }
    public function properties(): array
    {
        return [
            'creator'        => 'Sistema Proyecto',
            'lastModifiedBy' => Auth::user()->name,
            'title'          => 'Usuarios Registrados',
            'company'        => 'Proyecto',
        ];
    }
}
