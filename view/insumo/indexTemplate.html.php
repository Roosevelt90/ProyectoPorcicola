<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>

<?php $id = insumoTableClass::ID ?>
<?php $nombre = insumoTableClass::NOMBRE ?>
<?php $fabricacion = insumoTableClass::FECHA_FABRICACION ?>
<?php $vencimiento = insumoTableClass::FECHA_VENCIMIENTO ?>
<?php $tipoInsumo = tipoInsumoTableClass::DESCRIPCION ?>
<?php $id_tipoInsumo = tipoInsumoTableClass::ID ?>
<?php $idTipoInsumo = insumoTableClass::TIPO_INSUMO ?>
<?php $valor = insumoTableClass::VALOR ?>
<?php  $countDetale = 1 ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-4-offset-4 titulo">
                    <h2>
                        <?php echo i18n::__('read', NULL, 'insumo') ?>
                    </h2>
                </div>
            </div>
            <div style="margin-bottom: 10px; margin-top: 30px">
                <a id="filter" href="#" data-target="#myModalFilter" data-toggle="modal" id="filter" class="btn btn-xs btn-default active"><?php echo i18n::__('filters') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                    <?php echo i18n::__('buscar', null, 'ayuda') ?>
                </div>
                <a id="deleteFilter" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteFilter') ?>" id="deleteFilter" class="btn btn-info btn-xs" ><?php echo i18n::__('deleteFilter') ?></a>
                 <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                     <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
                </div>
                 <a id="deleteMasa" href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" id="deleteMasa" class="btn btn-xs btn-default active"><?php echo i18n::__('borrar seleccion') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="deleteMasa">
                    <?php echo i18n::__('eliminarMasa', null, 'ayuda') ?>
                </div>
                <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'insert') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('register', null, 'insumo') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="new">
                    <?php echo i18n::__('registrar', null, 'ayuda') ?>
                </div>
               
                <a id="reporte" href="<?php // echo routing::getInstance()->getUrlWeb('vacunacion', 'reportVacunacion')  ?>" id="reporte" class="btn btn-info btn-xs" ><?php echo i18n::__('reporte') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="reporte">
                  <?php echo i18n::__('reporte', null, 'ayuda') ?>
                </div>
            </div>
            <?php view::includeHandlerMessage() ?>
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteSelect') ?>" method="POST">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr class="active">
                            <td><input type="checkbox" id="chkAll"></td> 
                            <th>Id</th>
                            <th>Nombre de insumo</th>
                            <th>Fecha de fabricacion</th>
                            <th>Fecha de vencimiento</th>
                            <th>Categoria</th>
                            <th>Valor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objInsumo as $key): ?>
                          <tr>
                              <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>

                              <td><?php echo $key->$id ?></td>
                              <td><?php echo $key->$nombre ?></td>
                              <td><?php echo $key->$fabricacion ?></td>
                              <td><?php echo $key->$vencimiento ?></td>
                              <td><?php echo $key->$tipoInsumo ?></td>
                              <td><?php echo $key->$valor ?></td>
                              <td>
                                  <a id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'edit', array(insumoTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'user') ?></a>
                                   <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                                      <?php echo i18n::__('modificar', null, 'ayuda') ?>
                                  </div> 
                                  <a id="eliminar<?php echo $countDetale ?>" href="#" onclick="confirmarEliminar(<?php echo $key->$id ?>)" class="btn btn-danger btn-sm"><?php echo i18n::__('delete') ?></a>
                                  <div class="mdl-tooltip mdl-tooltip--large" for="eliminar<?php echo $countDetale ?>">
                                      <?php echo i18n::__('eliminar', null, 'ayuda') ?>
                                  </div> 
                              </td>
                          </tr>
                          <?php  $countDetale++ ?>
                        <?php endforeach//close foreach  ?>
                    </tbody>
                </table>
            </form>
            <div class="text-right">
                <nav>
                    <ul class="pagination" id="slqPaginador">
                        <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('insumo', 'index') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                        <?php $count = 0 ?>
                        <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                          <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('insumo', 'index') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                          <?php $count ++ ?>        
                        <?php endfor //close for   ?>
                        <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('insumo', 'index') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
                    </ul>
                </nav>
            </div> 
            <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'delete') ?>" method="POST">
                <input type="hidden" id="idDelete" name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>">
            </form>
        </div>

    </div>
</main>


<!-- WINDOWS MODAL FILTER -->
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
            </div>
            <div class="modal-body">
                <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'index') ?>">
                    <table class="table table-bordered">
                        <tr>
                        <th>  <?php echo i18n::__('insumo', NULL, 'insumo') ?>:</th>
                        <th> <input  type="text" name="filter[nombre]" ></th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('fechaFabricacion') ?>:</th>
                        <th> <input  type="date" name="filter[fabricacionInicial]" ></th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('fechaVencimiento') ?>:</th>
                        <th> <input  type="date" name="filter[VencimientoInicial]" ></th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('tipoInsumo') ?>:</th>
                        <th>
                            <select name="filter[tipoInsumo]">
                                <option value=''>...</option>
                                <?php foreach ($objTipoInsumo as $key): ?>
                                  <option value="<?php echo $key->$id_tipoInsumo ?>"><?php echo $key->$tipoInsumo ?></option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                   
                    </table>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close', null, 'vacunacion') ?></button>
                <button type="button" class="btn btn-primary" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
            </div>
        </div>
    </div>
</div>
