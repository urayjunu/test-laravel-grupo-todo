@extends('layouts.app')
@section('content')

        <div class="flex-center position-ref full-height">
            
            <div class="top-right links">
                @include('admin.layouts.menu_admin')
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
                                            @foreach($categorias_ as $categ)
                                                <tr>
                                                    <td>
                                                        {{ $categ->id }}
                                                    </td>
                                                    <td>
                                                        <i class="fa fa-star"></i>
                                                        {{ $categ->nombre }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('admin/categoria/'.$categ->id) }}" class="btn btn-info ">
                                                            <i class="fa fa-edit"></i> Detalle </a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info " id="ajaxEdit" onclick="editCategoria({{ $categ->id }});"><i class="fa fa-edit"></i> Edit</button>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" id="ajaxDelete" onclick="deleteCategoria({{ $categ->id }});"><i class="fa fa-trash-o"></i> Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>
                                        <!-- Trigger the modal with a button -->
                                        <button type="button" class="btn btn-info btn-sd" data-toggle="modal" onclick="agregarCategoria();" data-target="#myModal" id="open">Add Categoria</button>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>

        <!-- MODDAL -->

        <div class="container">
            <form method="post" action="" id="form">
                    @csrf
            <!-- Modal -->
            <div class="modal" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert alert-danger" style="display:none"></div>
                <div class="modal-header">
                    <label id="titlea" class="modal-title"></label>
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
                            <select class="selectpicker form-control" name="categ" id="categ">
                                <option value="0" selected>Ninguno</option>
                                @foreach($menuCate as $categoria)
                                    @if($categoria['subcategoria_id'] >= 0 )   
                                    <optgroup label="{{ $categoria['ruta'] }}" >
                                        @if($categoria['subcategoria_id'] >= 0 )
                                        <option  value="{{ $categoria['id'] }}" >{{ $categoria['nombre'] }}</option>
                                        @endif
                                    @endif
                                    @if($categoria['subcategoria_id'] >= 0)   
                                    </optgroup>
                                    @endif
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

            function clearCategoria(){
                jQuery('#id').val("");
                jQuery('#nombre').val("");
                jQuery('#descripcion').val("");
                jQuery('#categorias').val("");
                jQuery('#titlea').text("");
                $('#form').attr('action', "");
                $("#categ").val("");
            }
            function deleteCategoria(id){
                if(!confirm('Esta seguro de eliminar la categoria?'))
                    return false;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/admin/eliminarCategoria') }}/" + id,
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
                        location.reload();
                }});
            }
            function editCategoria(id){
                
                jQuery.ajax({
                        url: "{{ url('/admin/categoriaPorId') }}/"+id,
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
                                $("#categ").val(id);
                                jQuery('#id').val(obj.categoria.id);
                                jQuery('#nombre').val(obj.categoria.nombre);
                                jQuery('#descripcion').val(obj.categoria.descripcion);
                                jQuery('#categorias').val(obj.categoria.categorias);
                                $('#form').attr('action', "{{ url('/admin/actualizarCategoria') }}");
                                jQuery('#titlea').text('Modificar');
                                $('#myModal').modal('show');
                            }
                        }
                    });
            }

            function agregarCategoria(){
                clearCategoria();
                jQuery('#titlea').text("Nuevo");
                $('#form').attr('action', "{{ url('/admin/agregarCategoria') }}");

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
                        url: jQuery('#id').val()?"{{ url('/admin/actualizarCategoria') }}":"{{ url('/admin/agregarCategoria') }}",
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
            }
        </script>
@endsection