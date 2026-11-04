@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>@yield('title')</h1>
        </div>
    </section>
    @include('layouts.partials.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-verde">
                        <div class="inner">
                            <h3>{{ $organizationsCount }}</h3>
                            <p>Organizaciones</p>
                        </div>
                        <div class="icon"><i class="fas fa-building"></i></div>
                        <a href="{{ route('organizations.index') }}" class="small-box-footer">
                            Ver lista <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="small-box bg-azul">
                        <div class="inner">
                            <h3>{{ $volunteersCount }}</h3>
                            <p>Voluntarios</p>
                        </div>
                        <div class="icon"><i class="fas fa-hands-helping"></i></div>
                        <a href="{{ route('volunteers.index') }}" class="small-box-footer">
                            Ver lista <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="small-box bg-mixto">
                        <div class="inner">
                            <h3>{{ $membershipsCount }}</h3>
                            <p>Vínculos</p>
                        </div>
                        <div class="icon"><i class="fas fa-link"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
