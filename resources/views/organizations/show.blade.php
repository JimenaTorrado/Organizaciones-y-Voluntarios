@extends('layouts.admin')

@section('title', 'Detalle de la organización')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid"></div>
    </section>

    @include('layouts.partials.msg')

    <section class="content">
        <div class="container-fluid">

            {{-- Datos de la organización --}}
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3>{{ $organization->name }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>Tipo:</strong> {{ $organization->type }}</p>
                    <p><strong>Correo:</strong> {{ $organization->email }}</p>
                    <p><strong>Teléfono:</strong> {{ $organization->phone }}</p>
                    <p><strong>Dirección:</strong> {{ $organization->address }}, {{ $organization->city }}</p>
                    <p><strong>Fecha de creación:</strong> {{ \Carbon\Carbon::parse($organization->creation_date)->format('Y-m-d') }}</p>
                    <p><strong>Descripción:</strong> {{ $organization->description }}</p>
                </div>
            </div>

            {{-- Formulario para vincular --}}
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3>Vincular voluntario</h3>
                </div>
                <form method="POST" action="{{ route('organizations.vincular', $organization) }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="volunteer_id">Voluntario</label>
                                    <select name="volunteer_id" id="volunteer_id"
                                            class="form-control @error('volunteer_id') is-invalid @enderror" required>
                                        <option value="">Seleccione voluntario</option>
                                        @foreach($volunteers as $v)
                                        <option value="{{ $v->id }}" {{ old('volunteer_id') == $v->id ? 'selected' : '' }}>{{ $v->first_name }} {{ $v->last_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('volunteer_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Rol</label>
                                    <select name="role" id="role"
                                            class="form-control @error('role') is-invalid @enderror" required>
                                        @foreach(\App\Models\OrganizationVolunteer::ROLES as $role)
                                        <option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-flat">Vincular</button>
                        <a href="{{ route('organizations.index') }}" class="btn btn-outline-primary btn-flat">Atrás</a>
                    </div>
                </form>
            </div>

            {{-- Lista de voluntarios vinculados --}}
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3>Voluntarios vinculados</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Voluntario</th>
                            <th>Rol</th>
                            <th>Desde</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($organization->membership as $membership)
                        <tr>
                            <td>{{ $membership->volunteer->first_name }} {{ $membership->volunteer->last_name }}</td>
                            <td>{{ $membership->role }}</td>
                            <td>{{ \Carbon\Carbon::parse($membership->join_date)->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-muted">Sin voluntarios vinculados</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
