  @include('admin.layouts.head')
    <body>
        <div class="flex-center position-ref full-height">

            <div class="top-right links">
                @include('admin.layouts.menu')
            </div>
            <div class="content">
                <div class="title m-b-md">
                   ABM Productos
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
                                                <th></th>
                                                <th></th>
                                                <th></th>
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
                                                        {{ $producto->nombre }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('admin/producto/'.$producto->id) }}" class="btn btn-info ">
                                                            <i class="fa fa-edit"></i> Detalle </a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info " id="ajaxEdit" onclick="editProducto({{ $producto->id }});"><i class="fa fa-edit"></i> Edit</button>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" id="ajaxDelete" onclick="deleteProducto({{ $producto->id }});"><i class="fa fa-trash-o"></i> Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>
                                        <!-- Trigger the modal with a button -->
                                        <button type="button" class="btn btn-info btn-sd" data-toggle="modal" onclick="clearProducto();" data-target="#myModal" id="open">Add Producto</button>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>

        <!-- MODDAL -->

        <div class="container">
            <form method="post" action="{{ url('agregarProducto') }} id="form">
                    @csrf
            <!-- Modal -->
            <div class="modal" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert alert-danger" style="display:none"></div>
                <div class="modal-header">

                    <h5 class="modal-title">Nuevo Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-10">
                        <label for="Name">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" required>
                        <input type="hidden" class="form-control" name="id" id="id" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label for="Description">Descripcion:</label>
                            <input type="text" class="form-control" name="descripcion" maxlength="150" id="descripcion">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label for="Categorias">Categorias:</label>
                            <select class="form-control" name="categorias" id="categorias"  multiple required>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" >{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button  class="btn btn-success" id="ajaxSubmit">Save changes</button>
                    </div>
                </div>
            </div>
            </div>
            </form>
        </div>
        <!-- /Attachment Modal -->
        <script>
            function clearProducto(){
                    jQuery('#id').val("");
                    jQuery('#nombre').val("");
                    jQuery('#descripcion').val("");
                    jQuery('#categorias').val("");
            }
            function deleteProducto(id){
                if(!confirm('Are you sure you want to delete this item?'))
                    return false;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/admin/eliminarProducto') }}/" + id,
                    method: 'delete',
                    data: {
                        id: id,
                        _token: jQuery('[name="_token"]').val(),
                    },
                    success: function(result){

                        var obj = jQuery.parseJSON( result );
                        if(obj.error == 1)
                        {
                            jQuery('.alert-danger').html('');
                            jQuery('.alert-danger').show();
                            jQuery('.alert-danger').append('<p>'+obj.msg+'</p>');

                        }
                        else
                        {
                            jQuery('.alert-danger').hide();
                            $('#open').hide();
                            $('#myModal').modal('hide');
                            location.reload();
                        }
                }});
            }
            function editProducto(id){
                jQuery.ajax({
                        url: "{{ url('/admin/productoPorId') }}/"+id,
                        method: 'get',
                        data: {
                            id: id,
                            _token: jQuery('[name="_token"]').val(),
                        },
                        success: function(result){

                            var obj = jQuery.parseJSON( result );

                            if(obj.error == 1)
                            {
                                jQuery('.alert-danger').html('');
                                jQuery('.alert-danger').show();
                                jQuery('.alert-danger').append('<p>'+obj.msg+'</p>');

                            }
                            else
                            {

                                jQuery('#id').val(obj.producto.id);
                                jQuery('#nombre').val(obj.producto.nombre);
                                jQuery('#descripcion').val(obj.producto.descripcion);
                                jQuery('#categorias').val(obj.producto.categorias);
                                $('#myModal').modal('show');
                            }
                        }
                    });
            }

            $(document).ready(function(){
                jQuery('#ajaxSubmit').click(function(e){

                     var nombre =  jQuery('#nombre').val();
                     var descripcion = jQuery('#descripcion').val();
                     var categorias = jQuery('#categorias').val();

                    jQuery('.alert-danger').html('');

                    if(nombre == null  ||  categorias == null ){
                            retrurn;
                    }

                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: jQuery('#id').val()?"{{ url('/admin/actualizarProducto') }}":"{{ url('/admin/agregarProducto') }}",
                        method: 'post',
                        data: {
                            id: jQuery('#id').val(),
                            nombre: jQuery('#nombre').val(),
                            descripcion: jQuery('#descripcion').val(),
                            categorias: jQuery('#categorias').val(),
                            _token: jQuery('[name="_token"]').val(),
                        },
                        success: function(result){

                            var obj = jQuery.parseJSON( result );

                            if(obj.error == 1)
                            {
                                jQuery('.alert-danger').html('');
                                jQuery('.alert-danger').show();
                                jQuery('.alert-danger').append('<li>'+obj.msg+'</li>');

                            }
                            else
                            {
                                jQuery('.alert-danger').hide();
                                $('#open').hide();
                                $('#myModal').modal('hide');
                                jQuery('#id').val();
                                jQuery('#nombre').val();
                                jQuery('#descripcion').val();
                                jQuery('#categorias').val();
                                location.reload();
                            }
                        }
                    });
                });
            });
        </script>

    @include('admin.layouts.footer')
