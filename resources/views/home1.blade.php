<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/adminAssets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/adminAssets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/adminAssets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/adminAssets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

        <link href="{{ url('/') }}/adminAssets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/adminAssets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/adminAssets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/adminAssets/global/plugins/jquery-nestable/jquery.nestable.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

        <link href="{{ url('/') }}/adminAssets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ url('/') }}/adminAssets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />

        <link href="{{ url('/') }}/adminAssets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/adminAssets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ url('/') }}/adminAssets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />

        <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

        <link rel="shortcut icon" href="favicon.ico" />
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner ">

            <div class="page-logo">
                <a href="{{ url('/') }}/home">
                     <img src="https://www.guiastodo.com.ar/minisitios/001401/logo.png" alt="Logo" class="logo-default" style="max-height: 30px" />
                </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>

            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
            </a>

            <div class="page-logo">
                <img src="{{ url('/') }}/img/admin/logo.png" alt="Logo" class="logo-default" style="max-width: 150px;" />
            </div>

            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> User </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"> </div>
    <div class="page-container">
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                    <li class="sidebar-toggler-wrapper hide">
                        <div class="sidebar-toggler">
                            <span></span>
                        </div>
                    </li>
                    <li class="sidebar-search-wrapper">

                    </li>
                    <li class="heading">
                        <h3 class="uppercase">GENERAL</h3>
                    </li>

                    <li class="nav-item  active open ">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-vector"></i>
                            <span class="title">Categorias</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">

                            <li class="nav-item">
                                <a href="{{ url('/') }}/categorias" class="nav-link ">
                                    <i class="icon-pencil"></i>
                                    <span class="title">Ver categorías</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item  active open">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-social-dropbox"></i>
                            <span class="title">Productos</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">

                            <li class="nav-item">
                                <a href="{{ url('/') }}/productos" class="nav-link ">
                                    <i class="icon-pencil"></i>
                                    <span class="title">Ver productos</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <a href="mailto:info@grupotodo.com.ar">
                    <button class="btn btn-primary col-xs-12 margin-top-40">CONTACTAR A GRUPO TODO</button>
                </a>
            </div>
        </div>
        <div class="page-content-wrapper">
            <div class="page-content">

                <!-- *********************************** -->
                <!-- PANEL DE CONTROL DEL THEME -->
                <!-- *********************************** -->

                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="{{ url('/') }}admin">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Crear Categoria</span>
                        </li>
                    </ul>


                </div>

    <h1 class="page-title">Crear Categoría</h1>

    <div class="row">
        <div class="col-md-12">









            <!-- div class="portlet light bordered">
                <div class="portlet-body form">

                    <form method="POST" action="{{ url('/') }}/categorias/crear" accept-charset="UTF-8" class="form" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="W6xvQCWTunY1PatrC9HXxnKdwB7sdc1YFjsDkx1i">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="imagen">Imagen (jpg, jpeg, png)</label>
                            <input class="form-control-file" required="required" name="imagen" type="file" id="imagen">
                        </div>
                        <div class="form-group">
                            <label for="padre">Categoria padre</label>
                            <select class="form-control" id="padre" name="padre"><option selected="selected" value="">Seleccionar categoría padre</option><option value="1">Audio</option><option value="2">Jardinería</option><option value="3">Auriculares</option><option value="4">Parlantes</option><option value="5">Parlante2</option></select>

                            <div class="alert alert-warning alerta-subcategoria" style="display:none">
                                <span class="fa fa-warning"></span> Atención, no te olvides de mover los productos que ya tengas cargados a las nuevas subcategorías creadas, caso contrario no se visualizarán correctamente en tu catálogo
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input class="form-control" required="required" name="nombre" type="text" id="nombre">
                        </div>


                        <div class="form-actions">
                            <input class="btn blue float-right" type="submit" value="Crear">
                        </div>
                    </div>

                    </form>

                </div>
            </div -->



        </div>
    </div>
            </div>
        </div>

        <!-- ********************************** -->
        <!-- SIDEBAR -->
        <!-- ********************************** -->

    </div>

    <div class="page-footer">
        <div class="page-footer-inner"> 2020 &copy; Administrador &nbsp;|&nbsp;
            <a href="http://www.grupotodo.com.ar" target="_blank">Grupo Todo</a>
        </div>

        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>

</div>

<!-- *********************** -->
<!-- QUICK NAV TAB -->
<!-- *********************** -->



<!--[if lt IE 9]>
<script src="{{ url('/') }}/adminAssets/global/plugins/respond.min.js"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/excanvas.min.js"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->

<script src="{{ url('/') }}/adminAssets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<script src="{{ url('/') }}/adminAssets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>

<script src="{{ url('/') }}/adminAssets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script src="{{ url('/') }}/adminAssets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="{{ url('/') }}/adminAssets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>

<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function()
    {
        $('#clickmewow').click(function()
        {
            $('#radio1003').attr('checked', 'checked');
        });

        $('table').each((iTabla, tabla) => {

            if(!$(tabla).hasClass('phpdebugbar-widgets-params')) {
                $(tabla).DataTable({
                    ordering: false,
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    },
                });
            }
        });


    })


</script>

<script>
$(document).on('change', '#padre', function(){
    if($(this).children('option:selected').val() != ''){
        $('.alerta-subcategoria').fadeIn();
    } else {
        $('.alerta-subcategoria').fadeOut();
    }
})
</script>
<script type="text/javascript">jQuery.noConflict(true);</script>
</body>
</html>