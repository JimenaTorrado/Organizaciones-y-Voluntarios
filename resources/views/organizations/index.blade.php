@extends('layouts.admin')

@section('title', 'Lista de organizaciones')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        </div>
    </section>
    @include('layouts.partials.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-secondary" style="font-size: 1.75rem;font-weight: 500; line-height: 1.2; margin-bottom: 0.5rem;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>@yield('title')</span>
                                <a href="{{ route('organizations.create') }}" class="btn btn-primary btn-sm">Nueva organización</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-hover" style="width:100%">
                                <thead class="text-primary">
                                <tr>
                                    <th width="10px">ID</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Ciudad</th>
                                    <th>Creación</th>
                                    <th>Voluntarios</th>
                                    <th width="60px">Estado</th>
                                    <th width="120px">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($organizations as $organization)
                                <tr>
                                    <td>{{ $organization->id }}</td>
                                    <td>{{ $organization->name }}</td>
                                    <td>{{ $organization->type }}</td>
                                    <td>{{ $organization->email }}</td>
                                    <td>{{ $organization->phone }}</td>
                                    <td>{{ $organization->city }}</td>
                                    <td>{{ \Carbon\Carbon::parse($organization->creation_date)->format('Y-m-d') }}</td>
                                    <td>{{ $organization->membership_count }}</td>
                                    <td>
                                        @if($organization->status)
                                        <span class="badge badge-success">Activa</span>
                                        @else
                                        <span class="badge badge-secondary">Inactiva</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('organizations.edit', $organization) }}" class="btn btn-info btn-sm" title="Editar">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{ route('organizations.show', $organization) }}" class="btn btn-success btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form class="d-inline" action="{{ route('organizations.destroy', $organization) }}" method="POST"
                                              onsubmit="return confirm('¿Eliminar esta organización?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
