<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAE</title>

    <!-- Boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Css -->
    <link rel="stylesheet" href="{{asset('css/frontend.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/toast/css/iziToast.min.css')}}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>
    <div>
        <div class="nav shadow-sm text-center">
            Sistema de Administración de Empresas
        </div>

        <div class="container">
            <div class="row p-4">
                <div class="col text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modelAgregar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Agregar">Agregar empresa</button>
                </div>
            </div>
        </div>

        <!-- Alert -->
        @if(Session::has('alert'))
        <div class="container">
            <div class="alert alert-{{session('alert.type')}} alert-dismissible fade show mt-3" role="alert">
                <small>{{session('alert.msg')}}</small>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        <!-- End alert -->

        <div class="container">
            <div class="card">
                @if($empresas != '[]')
                <div class="card-header bold">
                    Empresas
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table align-middle">
                        <thead>
                            <tr>
                                <th scope="col-4">Nombre</th>
                                <th scope="col-2">Tipo de empresa</th>
                                <th scope="col-2">Fecha de constitución</th>
                                <th scope="col-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach($empresas as $empresa)
                            <tr>
                                <th scope="row">{{$empresa->nombre}}</th>
                                <td>{{$empresa->tipo_empresa}}</td>
                                <td>{{$empresa->fecha_constitucion}}</td>
                                <td><button class="btn btn-info btn-accion blanco editar" data-bs-toggle="modal" data-bs-target="#modeleditar" data-id="{{$empresa->id}}"><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar"><i class="fa-solid fa-pen-to-square"></span></i></button>
                                    <button class="btn btn-danger btn-accion blanco eliminar" data-id="{{$empresa->id}}" ><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar"><i class="fa-solid fa-trash"></i></span></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="card-body">
                    Sin empresas…
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal agregar empresa -->

    <div class="modal fade" id="modelAgregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 bold">Agregar Empresa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAgregar" action="{{url('agregar')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="nombre" class="form-label">*Nombre</label>
                                <input type="text" data-parsley-maxlength="255" class="form-control" id="nombre" name="nombre" required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="fechaConstitucion" class="form-label">*Fecha de constitución</label>
                                <input type="date" class="form-control" id="fechaConstitucion" name="fechaConstitucion" required>
                            </div>
                            <div class="col-6">
                                <label for="tipoEmpresa" class="form-label">*Tipo de empresa</label>
                                <select name="tipoEmpresa" id="tipoEmpresa" class="form-select" required>
                                    <option value="">Seleccione un asunto</option>
                                    <option value="Distribuidor">Distribuidor</option>
                                    <option value="Mayorista">Mayorista</option>
                                    <option value="Usuario final">Usuario final</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="comentarios" class="form-label">Comentario</label>
                                <textarea type="text" data-parsley-maxlength="1020" name="comentarios" class="form" cols="80" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal agregar empresa -->

    <!-- Modal editar empresa -->

    <div class="modal fade" id="modeleditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 bold">Editar Empresa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditar" action="{{url('editar')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="nombre" class="form-label">*Nombre</label>
                                <input type="text" data-parsley-maxlength="255" class="form-control" id="nombreEdit" name="nombre" required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <label for="fechaConstitucion" class="form-label">*Fecha de constitución</label>
                                <input type="date" class="form-control" id="fechaConstitucionEdit" name="fechaConstitucion" required>
                            </div>
                            <div class="col-6">
                                <label for="tipoEmpresa" class="form-label">*Tipo de empresa</label>
                                <select name="tipoEmpresa" id="tipoEmpresaEdit" class="form-select" required>
                                    <option value="">Seleccione un asunto</option>
                                    <option value="Distribuidor">Distribuidor</option>
                                    <option value="Mayorista">Mayorista</option>
                                    <option value="Usuario final">Usuario final</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="comentarios" class="form-label">Comentario</label>
                                <textarea type="text" data-parsley-maxlength="1020" name="comentarios" id="comentariosEdit" class="form" cols="80" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="" name="id" id="idEdit">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Editar empresa -->
</body>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/2f85d4c6c6.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
<script src="{{asset('vendors/popper.js/popper.js')}}"></script>
<script src="{{asset('vendors/toast/js/iziToast.min.js')}}"></script>
<script src="{{asset('vendors/parsley/parsley.min.js')}}"></script>
<script src="{{asset('vendors/parsley/es.js')}}"></script>
<script>
    $(document).ready(function() {

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        /*
         * Validación de formularios
         */
        $('#formAgregar').parsley();
        $('#formEditar').parsley();
        /* End Validación de formularios  */

        /*
         * Editar empresa
         */
        $('.editar').click(async function() {
            var id = $(this).attr('data-id');

            $.ajax({
                url: "{{url('get_by_id')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                type: 'get',
                dataType: "json",
                success: function(response) {

                    $("#nombreEdit").val(response[0].nombre);
                    $("#fechaConstitucionEdit").val(response[0].fecha_constitucion);
                    $("#tipoEmpresaEdit").val(response[0].tipo_empresa);
                    $("#comentariosEdit").val(response[0].comentarios);
                    $("#idEdit").val(response[0].id);

                }

            });

        });
        /* End Editar empresa */

        /*
         * Eliminar empresa
         */
        $('.eliminar').click(function() {
            var id = $(this).attr('data-id');

            iziToast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: id,
                zindex: 999,
                message: '¿Desea continuar con la solicitud?',
                position: 'center',
                buttons: [
                    ['<button><b>Aceptar<b></button>', async function(instance, toast) {

                        $.ajax({
                            url: "{{url('eliminar')}}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id
                            },
                            type: 'post',
                            dataType: "json",

                        });
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');
                        window.location.href = '{{url("/")}}';

                    }],
                    [`<button>Cancelar</button>`, function(instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }, true]
                ]
            });
        });
        /* End Eliminar empresa */
    })
</script>

</html>