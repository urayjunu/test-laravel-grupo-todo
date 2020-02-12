  @include('admin.layouts.head_admin')

        <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                 @include('admin.layouts.menu_admin')
            </div>
            <div class="content">
                <div class="title m-b-md">
                    ABM Categorias
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
                                                <th>Edit</th>
                                                <th>Delete</th>
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
                                                    <td>
														<button type="button" class="btn btn-info " id="ajaxEdit" onclick="editCategoria({{ $categorias->id }});"><i class="fa fa-edit"></i> Edit</button>
                                                    </td>
                                                    <td>
														<button type="button" class="btn btn-danger" id="ajaxDelete" onclick="deleteCategoria({{ $categorias->id }});"><i class="fa fa-trash-o"></i> Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                         <!-- Trigger the modal with a button -->
                                         <button type="button" class="btn btn-info btn-sd" data-toggle="modal" onclick="clearCategoria();" data-target="#myModal" id="open">Add Categoria</button>

                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>

  <!-- MODDAL -->

  <div class="container">

            <form method="post" action="{{ url('admin/agregarCategoria') }} id="form">
                    @csrf
            <!-- Modal -->
            <div class="modal" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert alert-danger" style="display:none"></div>
                <div class="modal-header">

                    <h5 class="modal-title">New Categoria</h5>
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
                            <label for="Description">Decripcion:</label>
                            <input type="text" class="form-control" name="descripcion" maxlength="50" id="descripcion">
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
            }
            function deleteCategoria(id){
                if(!confirm('Are you sure you want to delete this item?'))
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
                            jQuery('.alert-danger').append('<li>'+obj.value+'</li>');

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
                                jQuery('.alert-danger').append('<li>'+obj.value+'</li>');

                            }
                            else
                            {
                                jQuery('#id').val(obj.categoria.id);
                                jQuery('#nombre').val(obj.categoria.nombre);
                                $('#myModal').modal('show');
                            }
                        }
                    });
            }

            $(document).ready(function(){
                jQuery('#ajaxSubmit').click(function(e){
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        url: jQuery('#id').val()?"{{url('/admin/actualizarCategoria')}}":"{{url('/admin/agregarCategoria')}}",
                        method: 'post',
                        data: {
                            id: jQuery('#id').val()?jQuery('#id').val():0,
                            nombre: jQuery('#nombre').val(),
                            _token: jQuery('[name="_token"]').val(),
                        },
                        success: function(result){
                            var obj = jQuery.parseJSON( result );
                            if(obj.error)
                            {
                                jQuery('.alert-danger').html('');
                                jQuery('.alert-danger').show();
                                jQuery('.alert-danger').append('<p>'+obj.value+'</p>');

                            }
                            else
                            {
                                jQuery('.alert-danger').hide();
                                $('#open').hide();
                                $('#myModal').modal('hide');
                                jQuery('#id').val();
                                jQuery('#nombre').val();
                                location.reload();
                            }
                        }
                    });
                });

            });
        </script>
    @include('admin.layouts.footer_admin')
