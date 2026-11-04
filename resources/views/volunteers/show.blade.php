@extends('layouts.admin')

@section('title', 'Detalle del voluntario')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid"></div>
    </section>

    @include('layouts.partials.msg')

    <section class="content">
        <div class="container-fluid">

            {{-- Datos del voluntario --}}
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3>{{ $volunteer->first_name }} {{ $volunteer->last_name }}</h3>
                </div>
                <div class="card-body">
                    @if($volunteer->image)
                    <img src="{{ asset('storage/' . $volunteer->image) }}" alt="Foto" class="mb-3" style="max-width:150px;">
                    @endif
                    <p><strong>Correo:</strong> {{ $volunteer->email }}</p>
                    <p><strong>Teléfono:</strong> {{ $volunteer->phone }}</p>
                    <p><strong>Ciudad:</strong> {{ $volunteer->city }}</p>
                    <p><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($volunteer->birth_date)->format('Y-m-d') }}</p>
                </div>
            </div>

            {{-- Organizaciones a las que pertenece --}}
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3>Organizaciones vinculadas</h3>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse($volunteer->membership as $membership)
                        <li>
                            {{ $membership->organization->name }} -
                            {{ $membership->role }}
                            (desde {{ \Carbon\Carbon::parse($membership->join_date)->format('Y-m-d') }})
                        </li>
                        @empty
                        <li>No vinculado a organizaciones</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="{{ route('volunteers.index') }}" class="btn btn-outline-primary btn-flat">Atrás</a>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
