@include('front.layouts.head')
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                 @include('front.layouts.menu')
            </div>
            <div class="content menu-categorias">
                <div class= "row">
                    <ul>
                        @foreach($categorias as $categoria_listado)
                            <li> <a href = "{{  url('front/categoria') }}/{{$categoria_listado->id }}" >{{ $categoria_listado->nombre }}</a></li>
                        @endforeach
                    </ul>
                </div>
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
                                            <ul class="categorias">
                                                    {{ $categoria->decripcion }}
                                                    <p>Productos: </p>
                                                     @foreach( $categoria->productos as $producto )
                                                        <li> <a href = "{{  url('front/producto') }}/{{$producto->id }}" > {{ $producto->nombre }} </a></li>
                                                    @endforeach
                                            </ul>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>

    @include('front.layouts.footer')
