@extends('layouts.app')
@section('content')
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                @include('front.layouts.menu_front')
            </div>
<!--
            <div class="content menu-categorias">
                <div class= "row">
                    <ul>
                        @foreach($categorias as $categoria)
                            <li> <a href = "{{  url('front/categoria') }}/{{$categoria->id }}" >{{ $categoria->nombre }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>-->

            <div class="content">

                <div class="title m-b-md">
                   Productos
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
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th>Categoria</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($productos as $producto)
                                                <tr>
                                                    <td>
                                                        {{ $producto->id }}
                                                    </td>
                                                    <td>
                                                        <i class="fa fa-star"></i>
                                                        <a href = "{{  url('front/producto') }}/{{$producto->id }}" >{{ $producto->nombre }}</a>
                                                    </td>
                                                     <td>
                                                        <i class="fa fa-star"></i>
                                                        {{ $producto->descripcion }}
                                                    </td>
                                                     <td>
                                                        <i class="fa fa-star"></i>
                                                        {{ $producto->nombre_categoria }}
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
        </div>
@endsection
