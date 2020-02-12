@include('admin.layouts.head_admin')
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                 @include('admin.layouts.menu_admin')
            </div>

            <div class="content">
                <div class="title m-b-md">
                    {{ $producto->nombre }}
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
                                    <h4>Categoria {{ $producto->nombre }}:</h4>
                                    <ul class="categorias">
                                    @foreach($producto->categorias as $categoria)
                                        <li> {{ $categoria['nombre'] }}</li>
                                    @endforeach
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('admin.layouts.footer_admin')
