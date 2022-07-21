@extends('layouts.app')
@section('content')
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                 @include('front.layouts.menu_front')
            </div>
            <div class="content">
                <div class="title m-b-md">
                  --  {{ $producto->nombre }} --
                </div>
                <div class="links">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(isset($success))
                                <div class="alert alert-success">
                                    {{ $success }}
                                </div>
                            @endif
                            <div class="portlet box blue">
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                                <p>descripción: {{ $producto->descripcion }}</p>
                                                <p>categorias:{{ $producto->nombre_categoria }}
                                                </p>
                                    </div>
                                </div>
                            </div>
                           <a href="javascript:history.back()">Volve a listado de productos</a>
                </div>
            </div>
        </div>

    @endsection
