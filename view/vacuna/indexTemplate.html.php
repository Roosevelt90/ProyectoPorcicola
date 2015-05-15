<?php

use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>

<?php $id = vacunaTableClass::ID ?>
<?php $nomVacuna = vacunaTableClass::NOMBRE_VACUNA ?>
<?php $loteVacuna = vacunaTableClass::LOTE_VACUNA ?>
<?php $fecha_fabricacion = vacunaTableClass::FECHA_FABRICACION ?>
<?php $fecha_vencimiento = vacunaTableClass::FECHA_VENCIMIENTO ?>
<?php $valor = vacunaTableClass::VALOR ?>


<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
                <?php echo i18n::__('read', NULL, 'vacuna') ?>
            </h2>
        </div>
    </div>

    <div style="margin-bottom: 10px; margin-top: 30px">

        <a href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('filters') ?></a>
        <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteFilterVacuna') ?>" class="btn btn-info btn-xs" ><?php echo i18n::__('deleteFilter') ?></a>
        <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'insertVacuna') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
        <a href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('borrar seleccion') ?></a>
        <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'reportVacuna') ?>" class="btn btn-info btn-xs" ><?php echo i18n::__('reporte') ?></a>
    </div>
    <?php view::includeHandlerMessage() ?>
    <table class="table table-bordered table-responsive">
        <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteSelectVacuna') ?>" method="POST">
            <thead>
                <tr class="active">
                    <th><input type="checkbox" id="chkAll"></th> 
                    <th><?php echo i18n::__('identification') ?></th>
                    <th><?php echo i18n::__('nameVacuna', null, 'vacuna') ?></th>
                    <th><?php echo i18n::__('lote') ?></th>
                    <th><?php echo i18n::__('fecha_fabricacion', null, 'vacuna') ?></th>
                    <th><?php echo i18n::__('fecha_vencimiento', null, 'vacuna') ?></th>
                    <th><?php echo i18n::__('valor', null, 'vacuna') ?></th>
                    <th><?php echo i18n::__('action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objVacuna as $key): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>

                        <td><?php echo $key->$id ?></td>
                        <td><?php echo $key->$nomVacuna ?></td>
                        <td><?php echo $key->$loteVacuna ?></td>
                        <td><?php echo $key->$fecha_fabricacion ?></td>
                        <td><?php echo $key->$fecha_vencimiento ?></td>
                        <td><?php echo $key->$valor ?></td>
                        <td>
                            <a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'editVacuna', array(vacunaTableClass::ID => $key->id)) ?>" class="btn btn-primary btn-xs"><?php echo i18n::__('edit', null, 'user') ?></a>
                            <a href="#" class="btn btn-sm btn-danger fa fa-trash-o" data-toggle="modal" data-target="#myModalDelete<?php echo $key->id ?>"><?php echo i18n::__('delete') ?></a>
                        </td>
                    </tr>

            </form>

            <!-- WINDOWS MODAL DELETE -->
            <div class="modal fade" id="myModalDelete<?php echo $key->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('confirmDelete') ?></h4>
                        </div>
                        <div class="modal-body">
                            <?php echo i18n::__('eliminarIndividual') ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo i18n::__('cancel') ?></button>
                            <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->id ?>, '<?php echo vacunaBaseTableClass::getNameField(vacunaTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteVacuna') ?>')"> <?php echo i18n::__('delete') ?></button>
                        </div>
                    </div>
                </div>
            </div> 
        <?php endforeach//close foreach  ?>

        </tbody>
    </table>
    <!----paginado-->
    <div class="text-right">
        <nav>
            <ul class="pagination" id="slqPaginador">
                <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacuna') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                <?php $count = 0 ?>
                <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                    <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacuna') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                    <?php $count ++ ?>        
                <?php endfor; ?>
                <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacuna') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
            </ul>
        </nav>
    </div>



    <!-- WINDOWS MODAL DELETE MASIVE -->
    <div class="modal fade" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('borrar seleccion') ?></h4>
                </div>
                <div class="modal-body">

                    <?php echo i18n::__('deleteMasive') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo i18n::__('cancel') ?></button>
                    <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- WINDOWS MODAL FILTER -->
    <div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
                </div>
                <div class="modal-body">
                    <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacuna') ?>">
                        <table class="table table-bordered">
                            <tr>
                                <th>
                                    <?php echo i18n::__('nameVacuna', NULL, 'vacuna') ?>:
                                </th>
                                <th>
                                    <input pattern="[A-Za-z0-9]{3}"  type="text" name="filter[nombre]" >
                                </th>   
                            </tr>
                            <tr>
                                <th>
                                    <?php echo i18n::__('lote', NULL, 'vacuna') ?>:
                                </th>
                                <th>
                                    <input pattern="[A-Za-z0-9]{3}"  type="text" name="filter[lote]">
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <?php echo i18n::__('fecha_fabricacion', null, 'vacuna') ?>
                                </th>
                                <th>
                                    <input type="date" name="filter[fecha_f]">

                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <?php echo i18n::__('fecha_vencimiento', null, 'vacuna') ?>
                                </th>

                                <th>
                                    <input type="date" name="filter[fecha_v]">
                            </tr>
                            <tr>
                                <th>
                                    <?php echo i18n::__('valor', NULL, 'vacuna') ?>:
                                </th>
                                <th>
                                    <input type="number" min="0" name="filter[valor]">
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
