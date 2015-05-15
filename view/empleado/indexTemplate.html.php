
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\config\configClass as config ?>
<?PHP
USE mvc\request\requestClass as request ?>

<?php $id = empleadoTableClass::ID ?>
<?php $numero_doc = empleadoTableClass::NUMERO_DOC ?>
<?php $nombre_completo = empleadoTableClass::NOMBRE ?>
<?php $tipo_doc = tipoDocumentoUsuarioTableClass::DESCRIPCION ?>
<?php $telefono = empleadoTableClass::TEL ?>
<?php $cargo_id = cargoTableClass::DESCRIPCION ?>
<?php $ciudad = ciudadTableClass::NOMBRE ?>

<?php

use mvc\i18n\i18nClass as i18n ?>

<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
                <?php echo i18n::__('read', NULL, 'empleado') ?>
            </h2>
        </div>
    </div>
    <div>
        <form id="frmTraductor" action="<?php echo routing::getInstance()->getUrlWeb('empleado', 'traductorEmpleado') ?>" method="POST">
            <select name="language" onchange="$('#frmTraductor').submit()">
                <option <?php echo(config::getDefaultCulture() == 'es') ? 'selected' : '' ?> value="es">español</option>
                <option <?php echo(config::getDefaultCulture() == 'en') ? 'selected' : '' ?> value="en">English</option>
            </select>
            <input type="hidden" name="PATH_INFO" value="<?php echo request::getInstance()->getServer('PATH_INFO') ?>">        
        </form>
    </div>
    <!-- WINDOWS MODAL FILTERS -->
    <div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Busqueda</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="filterForm" method ="POST" action="<?php echo routing::getInstance()->getUrlWeb('empleado', 'indexEmpleado') ?>">


                        <div class="form-group">
                            <label for="filterTelefono" class="col-sm-2 control-label" >telefono</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filterTelefono" name="filter[telefono]" placeholder="telefono">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="filterNombre_completo" class="col-sm-2 control-label">nombre_completo</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filterNombre_completo" name="filter[nombre_completo]" placeholder="nombre">
                            </div>
                        </div> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="$('#filterForm').submit()">Buscar</button>
                </div>
            </div>
        </div>
    </div>

    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('empleado', 'deleteSelectEmpleado') ?>" method="POST">
    <div class="row">
        <div class=" col-xs-12 text-center">
            <a href="<?php echo routing::getInstance()->getUrlWeb('empleado', 'insertEmpleado') ?>" class="btn btn-success btn-xs"> <?php echo i18n::__('new', null, 'empleado') ?></a>
            <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()"><?php echo i18n::__('borrar seleccion')?></a>
            <a href="#" class="btn btn-xs btn-default" onclick="reporte()"><?php echo i18n::__('reporte')?></a>

            <a href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('buscar')?></a>
            <a href="<?php echo routing::getInstance()->getUrlWeb('empleado', 'deleteFiltersEmpleado') ?>" class="btn btn-xs btn-primary"> <?php echo i18n::__('eliminar filtros')?></a>  
        </div>
    </div>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr class="active">
                <td><input type="checkbox" id="chkAll"></td> 
                <th><?php echo i18n::__('identification', null, 'empleado') ?></th>
                <th><?php echo i18n::__('Number of document', null, 'empleado') ?></th>
                <th><?php echo i18n::__('name', null, 'empleado') ?> </th>
                <th><?php echo i18n::__('document type', null, 'empleado') ?></th>
                <th><?php echo i18n::__('telefono', null, 'empleado') ?></th>
                <th><?php echo i18n::__('cargo', null, 'empleado') ?></th>
                <th><?php echo i18n::__('city', null, 'empleado') ?></th>
                <th><?php echo i18n::__('action', null, 'empleado') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($objEmpleado as $key): ?>
                <tr>
                    <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>
                    <td><?php echo $key->$id ?></td>
                    <td><?php echo $key->$numero_doc ?></td>
                    <td><?php echo $key->$nombre_completo ?></td>
                    <th><?php echo $key->$tipo_doc ?></th>
                    <th><?php echo $key->$telefono ?></th>
                    <th><?php echo $key->$cargo_id ?></th>
                    <th><?php echo $key->$ciudad ?></th>


                    <td>
                        <a href="#" class="btn btn-warning btn-sm "><?php echo i18n::__('view', null, 'empleado') ?> </a>
                        <a href="<?php echo routing::getInstance()->getUrlWeb('empleado', 'editEmpleado', array(empleadoTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('edit', null, 'empleado') ?></a>
                        <!--<a href="#" data-toggle="modal" data-target="#myModalDelete <?php echo $key->$id ?>" class="btn btn-danger btn-xs">Eliminar</a>-->
                        <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-sm"><?php echo i18n::__('delete', null, 'empleado') ?></a>
                    </td>
                    <!-- WINDOWS MODAL DELETE -->
            <form id="frmDelete"action="<?php echo routing::getInstance()->getUrlWeb('empleado', 'deleteEmpleado') ?>" method="POST">

                <div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm') ?></h4>
                            </div>
                            <div class="modal-body">
                                ¿<?php echo i18n::__('confirmDelete', null, 'empleado') ?>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                                <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('empleado', 'deleteEmpleado') ?>')"><?php echo i18n::__('delete') ?></button>
                            </div>
                        </div>
                    </div>
                </div>

                </tr>
            <?php endforeach ?>
            <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('empleado', 'deleteEmpleado') ?>" method="POST">
                <input type="hidden" id="myModalDelete" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>">
            </form>

            </tbody>
    </table>
</div>



<!--eliminar masivo-->
<div class="modal fade" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('deleteMasive') ?></h4>
            </div>
            <div class="modal-body">
                <?php echo i18n::__('confirmDeleteMasive') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<!--    paginado-->
<div class="text-right">
    <nav>
        <ul class="pagination" id="slqPaginador">
            <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('empleado', 'indexEmpleado') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
            <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('empleado', 'indexEmpleado') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                <?php $count ++ ?>        
            <?php endfor ?>
            <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('empleado', 'indexEmpleado') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
        </ul>
    </nav>
</div>
<form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('empleado', 'deleteEmpleado') ?>" method="POST">
    <input type="hidden" id="idDelete" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>">

    <!--reporte-->
    <div class="modal fade" id="myModalReporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('reporte') ?></h4>
                </div>
                <div class="modal-body">
                    <form id='reportForm' class="form-horizontal" methodo='POST'action="<?php echo routing::getInstance()->getUrlWeb('empleado', 'reportEmpleado') ?>">
                        <table class="table table-responsive">
                            <tr>
                                <th><input

                                </th>
                            </tr>
                        </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
