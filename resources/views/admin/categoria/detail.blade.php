@extends('layouts.app')
@section('content')

 
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                 @include('admin.layouts.menu_admin')
            </div>

            <div class="content">
                <div class="title m-b-md">
                    {{ $categoria->nombre }}
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
                                    <label>Categoria: {{ $categoria->nombre }} </label><br>
                                   
                                    <br>
                                    <textarea cols="30" rows="4" disabled="" >{{ $categoria->descripcion }}</textarea>
                            </div>
                        </div>
                    </div>
                     <a href="javascript:history.back()">Volver</a>
                </div>
            </div>
        </div>
@endsection
