  @include('front.layouts.head_front')

        <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                 @include('front.layouts.menu_front')
            </div>
            <div class="content">
                <div class="title m-b-md">
                    Categorias
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

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($categorias as $categorias)
                                                <tr>
                                                    <td>
                                                        {{ $categorias->id }}
                                                    </td>
                                                    <td>
                                                        <i class="fa fa-star"></i>
                                                        {{ $categorias->nombre }}
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


    @include('front.layouts.footer_front')
