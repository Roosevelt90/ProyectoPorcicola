
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
<?php $tipo_doc = tipoDocumentoTableClass::DESCRIPCION ?>
<?php $telefono = empleadoTableClass::TEL ?>
<?php $cargo_id = cargoTableClass::DESCRIPCION ?>
<?php $direccion = empleadoTableClass::DIRECCION ?>
<?php $ciudad = ciudadTableClass::NOMBRE ?>

<?php

use mvc\i18n\i18nClass as i18n ?>

<?php $countDetale = 1 ?>
<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-4-offset-4 titulo">
                    <h2>
                        <?php echo i18n::__('empleado') ?>
                    </h2>
                </div>
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
                            <form class="form-horizontal" id="filterForm" method ="POST" action="<?php echo routing::getInstance()->getUrlWeb('personal', 'indexEmpleado') ?>">


                                <table class="table table-responsive ">    
                                    <tr>
                                        <th>  <?php echo i18n::__('name', NULL, 'empleado') ?>:</th>
                                        <th> 
                                            <input placeholder="<?php echo i18n::__('name', NULL, 'empleado') ?>" type="text" name="filter[nombre_completo]" >
                                        </th>   
                                    </tr>
                                    <tr>
                                        <th>
                                            <?php echo i18n::__('telefono', null, 'empleado') ?>:
                                        </th>
                                        <th>
                                            <input placeholder="<?php echo i18n::__('telefono', NULL, 'empleado') ?>" type="text" name="filter[telefono]" >
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <?php echo i18n::__('cargo', null, 'cargo') ?>:
                                        </th>
                                        <th>
                                            <select name="filter[cargo]"> 
                                                <option>...</option>
                                                <?php foreach ($objCargo as $key): ?>
                                                  <option value="<?php echo $key->id ?>">
                                                      <?php echo $key->descripcion_cargo ?>
                                                  </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <?php echo i18n::__('document type', null, 'empleado') ?>:
                                        </th>
                                        <th>
                                            <select name="filter[tipo_doc]"> 
                                                <option>...</option>
                                                <?php foreach ($objtipoDoc as $key): ?>
                                                  <option value="<?php echo $key->id ?>">
                                                      <?php echo $key->descripcion ?>
                                                  </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </th>
                                    </tr>

                                </table>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
                            <button type="button" class="btn btn-primary" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
                        </div>
                    </div>
                </div>
            </div>

            <form>
                <div class="row">
                    <div class=" col-xs-12 text-center">
                        <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('personal', 'insertEmpleado') ?>" class="btn btn-success btn-xs"> <?php echo i18n::__('new', null, 'empleado') ?></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="new">
                            <?php echo i18n::__('registrar', null, 'ayuda') ?>
                        </div>
                        <a id="reporte" href="<?php echo routing::getInstance()->getUrlWeb('personal', 'reportEmpleado') ?>" class="btn btn-default btn-xs"><?php echo i18n::__('reporte') ?></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="reporte">
                            <?php echo i18n::__('reporte', null, 'ayuda') ?>
                        </div>
                        <a id="filter" href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('buscar') ?></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                            <?php echo i18n::__('buscar', null, 'ayuda') ?>
                        </div>
                        <a id="deleteFilter" href="<?php echo routing::getInstance()->getUrlWeb('personal', 'deleteFiltersEmpleado') ?>" class="btn btn-xs btn-primary">ELiminar filtros</a>  
                        <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                            <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr class="active">  <tr class="active">
                        <td><input type="checkbox" id="chkAll"></td> 
                        <th><?php echo i18n::__('identification', null, 'empleado') ?></th>
                        <th><?php echo i18n::__('Number of document', null, 'empleado') ?></th>
                        <th><?php echo i18n::__('name', null, 'empleado') ?> </th>
                        <th><?php echo i18n::__('document type', null, 'empleado') ?></th>
                        <th><?php echo i18n::__('telefono', null, 'empleado') ?></th>
                        <th><?php echo i18n::__('cargo', null, 'empleado') ?></th>
                        <th><?php echo i18n::__('city', null, 'empleado') ?></th>
                        <th><?php echo i18n::__('direccion') ?></th>
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
                          <th><?php echo $key->$direccion ?></th>


                          <td>
                              <a id="insert<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('personal', 'editEmpleado', array(empleadoTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('edit', null, 'empleado') ?></a>
                              <div class="mdl-tooltip mdl-tooltip--large" for="insert<?php echo $countDetale ?>">

                              </div> 

                              <a id="delete<?php echo $countDetale ?>" href="#" class="btn btn-sm btn-danger fa fa-trash-o" data-toggle="modal" data-target="#myModalDelete<?php echo $key->id ?>"><?php echo i18n::__('delete') ?></a>
                              <div class="mdl-tooltip mdl-tooltip--large" for="delete<?php echo $countDetale ?>">

                              </div> 

                              <!-- WINDOWS MODAL DELETE -->
                              <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('personal', 'deleteEmpleado') ?>" method="POST">

                                  <div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDelete') ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  desea eliminar ?
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                  <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('personal', 'deleteEmpleado') ?>')">Eliminar</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                              <?php $countDetale++ ?>
                            <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <!--    paginado-->
        <div class="text-right">
            <nav>
                <ul class="pagination" id="slqPaginador">
                    <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexEmpleado') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                    <?php $count = 0 ?>
                    <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                      <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexEmpleado') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                      <?php $count ++ ?>        
                    <?php endfor ?>
                    <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexEmpleado') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
                </ul>
            </nav>
            <!--reporte-->
            <div class="modal fade" id="myModalReporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('reporte') ?></h4>
                        </div>
                        <div class="modal-body">
                            <form id='reportForm' class="form-horizontal" methodo='POST'action="<?php echo routing::getInstance()->getUrlWeb('personal', 'reportEmpleado') ?>">
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
        </div>
</main>