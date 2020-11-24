@extends('layouts.admin.master')

@section('title', 'Dashboard')

@section('nav-a')
    @if (leerJson(Auth::user()->permisos, 'admin.dashboard'))
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>
        </li>
    @endif

@endsection

@section('content')
  {{--  <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <x-jet-welcome/>

                </div>
            </div>
        </div>
    </x-app-layout>--}}

@endsection

