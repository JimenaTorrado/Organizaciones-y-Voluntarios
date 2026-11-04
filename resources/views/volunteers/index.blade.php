@extends('layouts.admin')

@section('title', 'Lista de voluntarios')

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
                                <a href="{{ route('volunteers.create') }}" class="btn btn-primary btn-sm">Nuevo voluntario</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-bordered table-hover" style="width:100%">
                                <thead class="text-primary">
                                <tr>
                                    <th width="10px">ID</th>
                                    <th width="50px">Foto</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Ciudad</th>
                                    <th>Organizaciones</th>
                                    <th width="60px">Estado</th>
                                    <th width="120px">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($volunteers as $volunteer)
                                <tr>
                                    <td>{{ $volunteer->id }}</td>
                                    <td>
                                        @if($volunteer->image)
                                        <img src="{{ asset('storage/' . $volunteer->image) }}" alt="Foto"
                                             class="img-circle" style="width:36px;height:36px;object-fit:cover;">
                                        @endif
                                    </td>
                                    <td>{{ $volunteer->first_name }}</td>
                                    <td>{{ $volunteer->last_name }}</td>
                                    <td>{{ $volunteer->email }}</td>
                                    <td>{{ $volunteer->phone }}</td>
                                    <td>{{ $volunteer->city }}</td>
                                    <td>{{ $volunteer->membership_count }}</td>
                                    <td>
                                        @if($volunteer->status)
                                        <span class="badge badge-success">Activo</span>
                                        @else
                                        <span class="badge badge-secondary">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('volunteers.edit', $volunteer) }}" class="btn btn-info btn-sm" title="Editar">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{ route('volunteers.show', $volunteer) }}" class="btn btn-success btn-sm" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form class="d-inline" action="{{ route('volunteers.destroy', $volunteer) }}" method="POST"
                                              onsubmit="return confirm('¿Eliminar este voluntario?')">
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
