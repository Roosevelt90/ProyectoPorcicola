
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass  as session ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\config\configClass as config ?>
<?php $proceso_compra = procesoCompraTableClass::ID?>
<?php $idDetalle = detalleProcesoCompraTableClass::ID?>
<?php  $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">

            <br/> <br/>
          <?php echo i18n::__('fact', null, 'pCompra') ?>
            <br /> <br/>
            <div class=" table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="success">
                        <th><?php echo i18n::__('date', null, 'dpVenta') ?></th>
                        <th><?php echo i18n::__('empleado') ?></th>
                        <th><?php echo i18n::__('proveedor', null, 'proveedor') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objFacturaCompra as $key): ?>
                        <tr>
                            <td><?php echo $key->fecha_hora_compra ?></td>
                            <td><?php echo $key->nombre_completo ?></td>
                            <td><?php echo $key->nombre_completo_proveedor ?></td>
                        </tr>
                                                            
                    <?php endforeach//close foreach ?>
                </tbody>
            </table>
            </div>
            <br/> 
  <?php echo i18n::__('detalle', null, 'pCompra') ?>

            <div class="container container-fluid" style="margin-bottom: 10px">
                <!--<form id="frmDelebottom: 10px; margin-top: 30px">-->
                <br />  
                <?php if(session::getInstance()->hasCredential('admin') == 1):?>
                <a href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" id="eliminarSeleccionDetalle" class="btn btn-default btn-sm fa fa-ellipsis-v"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="eliminarSeleccionDetalle">
                    <?php echo i18n::__('inhabilitarMasaDetalle', null, 'ayuda') ?>
                </div>
                <?php endif; ?>
                <a href="#myModalFilter" id="buscarDetalle" class="btn btn-sm btn-info active fa fa-search"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="buscarDetalle">
                    <?php echo i18n::__('buscar', null, 'ayuda') ?>
                </div>
                <a class="btn btn-sm btn-primary fa fa-reply" id="eliminarBusquedaDetalle" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteFilterDetalle') ?>"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="eliminarBusquedaDetalle">
                    <?php echo i18n::__('eliBusDetalle', null, 'ayuda') ?>
                </div>
                <a href="#myModalReport" data-toggle="modal" id="buscarReporteDetalle" class="btn btn-primary active btn-sm fa fa-newspaper-o"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="buscarReporteDetalle">
                    <?php echo i18n::__('buscarReporteDet', null, 'ayuda') ?>
                </div>
                
                <!--<a href="<?php // echo routing::getInstance()->getUrlWeb('vacunacion', 'reportDetalleVacunacion')    ?>" class="btn btn-info btn-xs" ><?php echo i18n::__('report') ?></a>-->       
                
              
            </div>

            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteSelectDetalleVacunacion') ?>" method="POST">
                <div class=" table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="success">
                            <th><input type="checkbox" id="chkAll"></th>
                            <th><?php echo i18n::__('n', null, 'pCompra') ?></th>
                            <th>  <?php echo i18n::__('insumo') ?></th>
                            <th>  <?php echo i18n::__('tipoInsumo') ?></th>
                            <th>  <?php echo i18n::__('cantidad') ?></th>
                            <th>  <?php echo i18n::__('valorUni') ?></th>
                            <th><?php echo i18n::__('subt') ?></th>
                  
                            <?php if(session::getInstance()->hasCredential('admin') == 1):?>
                            <th><?php echo i18n::__('action') ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objDetalleFacturaCompra as $key): ?>
                            <tr>
                                <td><input type="checkbox" name="chk[]" value="<?php echo $key->id ?>"></td>
                                <td><?php echo $key->$proceso_compra ?></td>
                                <td><?php echo $key->nombre_insumo ?></td>
                                <td><?php echo $key->descripcion ?></td>
                                <td><?php echo $key->cantidad ?></td>
                                <td><?php echo $key->valor_unitario ?></td>
                                <td><?php echo $key->subtotal ?></td>
                                <?php if(session::getInstance()->hasCredential('admin') == 1):?>
                                <td>
                                    <a id="editarDetalle<?php echo $countDetale ?>" href="#" class="btn btn-default active btn-sm fa fa-edit" data-toggle="modal" data-target="" onclick="myModalDetailEdit(<?php echo $key->$idDetalle ?>, '<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::PROCESO_COMPRA_ID, true) ?>', <?php echo $key->$proceso_compra ?>, '<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::ID, true) ?>')"></a>
                                    <div class="mdl-tooltip mdl-tooltip--large" for="editarDetalle<?php echo $countDetale ?>">
                                      <?php echo i18n::__('editDetalle', null, 'ayuda') ?>
                                  </div>  
                                    <a id="eliminarDetalle<?php echo $countDetale ?>" href="#" class="btn btn-sm btn-default fa fa-ban" data-toggle="modal" data-target="" onclick="modalDelete(<?php echo $key->id ?>, '<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteDetalleFacturaCompra') ?>')"></a>
                                    <div class="mdl-tooltip mdl-tooltip--large" for="eliminarDetalle<?php echo $countDetale ?>">
                                      <?php echo i18n::__('inhabilitarDetalle', null, 'ayuda') ?>
                                  </div>  
                                </td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                              <th>
                                                    <!--WINDOWS MODAL FILTER--> 
        <div class="modalmask" id="myModalFilter">
            <div class="modalbox rotate">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
                    </div>
                <a href="#close" title="Close" class="close">X</a>
                    <div class="modal-body">
                        <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'viewVacunacion') ?>">
                          <input type="hidden" name="<?php echo procesoCompraTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(procesoCompraTableClass::ID) ?>">
                            <table class="table table-bordered">
                                <tr>
                                    <th><?php echo i18n::__('fecha', null, 'detalleVacunacion') ?></th>
                                    <th>
                                        <input name="filter[fecha_inicial]" type="date">
                                    </th>
                                </tr>
                                <tr>
                                    <th><?php echo i18n::__('fecha', null, 'detalleVacunacion') ?></th>
                                    <th>
                                        <input name="filter[fecha_final]" type="date">
                                    </th>
                                </tr>
                                <tr>

                                    <th><?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></th>
                                    <th>
                                        <select name="filter[vacuna]">
                                            <option value="">
                                                ...
                                            </option>
                                            <?php foreach ($objVacuna as $key): ?>
                                                <option value="<?php echo $key->id ?>">
                                                    <?php echo $key->nombre_vacuna ?>
                                                </option>
                                            <?php endforeach; //close foreach  ?>
                                        </select>
                                    </th>
                                </tr>
                                <tr>
                                    <th><?php echo i18n::__('dosis', null, 'detalleVacunacion') ?></th>
                                    <th>
                                        <input name="filter[dosis]" type="text">
                                    </th>
                                </tr>
                                <tr>
                                    <th><?php echo i18n::__('accion') ?></th>
                                    <th>
                                        <select name="filter[accion]">
                                            <option>...</option>
                                            <option><?php echo i18n::__('enfermedad') ?></option>
                                            <option><?php echo i18n::__('gestacion') ?></option>
                                            <option><?php echo i18n::__('parto') ?></option>
                                            <option><?php echo i18n::__('rutina') ?></option>
                                            <option><?php echo i18n::__('nacido') ?></option>
                                        </select>
                                    </th>
                                </tr>
                            </table>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o close2"  ><?php echo i18n::__('close', null, 'vacunacion') ?></a>
                        <button type="button" class="btn btn-info fa fa-search" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
                    </div>
                
            </div>
        </div>
                              </th>
                            </tr>
                    <?php  $countDetale++ ?>         
            <?php endforeach//close foreach  ?>
            </tbody>
            </table>
                </div>
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

                        <?php echo i18n::__('confirmDeleteMasive') ?>
                    </div>
                    <div class="modal-footer">
                        <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('close', null, 'vacunacion') ?></a>
                        <button type="button" class="btn btn-primary fa fa-ban" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
                    </div>
                </div>
            </div>
        </div>

     
    </div>
</main>
  <!-- WINDOWS MODAL DELETE -->
                        <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDelete') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo i18n::__('eliminarIndividual') ?>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o" ><?php echo i18n::__('cancel') ?></a>
                                        <button type="button" id="delete" name="delete" class="btn btn-primary fa fa-ban" onclick="eliminar(<?php echo $key->id ?>, '<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteDetalleFacturaCompra') ?>')"><?php echo i18n::__('delete') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>      
                </form>

                



<!--         WINDOWS MODAL REPORT -->
        <div class="modalmask" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modalbox rotate">
        
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
                    </div>
                <a href="#close" title="Close" class="close">X</a>
                    <div class="modal-body">
                        <form id="reportForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'reportDetalleVacunacion') ?>">
                            <input type="hidden" name="<?php echo vacunacionTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(vacunacionTableClass::ID) ?>">
                            <table class="table table-bordered">
                                <tr>
                                    <th><?php echo i18n::__('fecha', null, 'detalleVacunacion') ?></th>
                                    <th>
                                        <input name="filter[fecha]" type="datetime-local">
                                    </th>
                                </tr>
                                <tr>

                                    <th><?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></th>
                                    <th>
                                        <select name="filter[vacuna]">
                                            <option value="">
                                                ...
                                            </option>
                                            <?php foreach ($objVacuna as $key): ?>
                                                <option value="<?php echo $key->id ?>">
                                                    <?php echo $key->nombre_vacuna ?>
                                                </option>
                                            <?php endforeach; //close foreach  ?>
                                        </select>
                                    </th>
                                </tr>
                                <tr>
                                    <th><?php echo i18n::__('dosis', null, 'detalleVacunacion') ?></th>
                                    <th>
                                        <input name="filter[dosis]" type="text">
                                    </th>
                                </tr>
                                <tr>
                                    <th><?php echo i18n::__('accion') ?></th>
                                    <th>
                                        <select name="filter[accion]">
                                            <option value=''>...</option>
                                            <option value=""><?php echo i18n::__('enfermedad') ?></option>
                                            <option value=""><?php echo i18n::__('gestacion') ?></option>
                                            <option value=""><?php echo i18n::__('parto') ?></option>
                                            <option value=""><?php echo i18n::__('rutina') ?></option>
                                            <option value=""><?php echo i18n::__('nacido') ?></option>
                                        </select>
                                    </th>
                                </tr>
                            </table>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o close2"  ><?php echo i18n::__('close', null, 'vacunacion') ?></a>
                        <button type="button" class="btn btn-info fa fa-search" onclick="$('#reportForm').submit()"><?php echo i18n::__('buscar') ?></button>
                    </div>
            
         </div>
        </div>


<!--                 WINDOWS MODAL UPDATE DETAIL VACCINATION 
                <div class="modal fade" id="detailFormEdit" name="detailFormEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('editDetailVaccination', null, 'detalleVacunacion') ?>:</h4>
                            </div>
                            <div class="modal-body">

                                <form id="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'updateDetalleVacunacion') ?>">
                                    <input type="hidden" value="<?php echo request::getInstance()->getServer('PATH_INFO') ?>" name="PATH_INFO">

                                    <input type="hidden" value="" id="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::PROCESO_COMPRA_ID, true) ?>" name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::PROCESO_COMPRA_ID, true) ?>">
                                    <input type="hidden" id="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::ID, true) ?>" value="" name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::ID, true) ?>">

                                    <h3> <?php echo i18n::__('fecha', null, 'detalleVacunacion') ?></h3>
                                    <input type="datetime-local" name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::TIPO_INSUMO, true) ?>">
                                    <h3> <?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></h3>
                                    <select name="<?php // echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true) ?>">
                                        <option value="">...</option>
                                        <?php // foreach ($objVacuna as $key): ?>
                                            <option value="<?php// echo $key->id ?>"><?php// echo $key->nombre_vacuna ?></option>
                                        <?php //endforeach; //close foreach  ?>
                                    </select>
                                    <h3> <?php echo i18n::__('dosis', null, 'detalleVacunacion') ?></h3>
                                    <input type="text" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true) ?>">
                                    <h3><?php echo i18n::__('accion') ?></h3>
                                    <select name="<?php// echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true) ?>">
                                        <option>...</option>
                                        <option><?php echo i18n::__('enfermedad') ?></option>
                                        <option><?php echo i18n::__('gestacion') ?></option>
                                        <option><?php echo i18n::__('parto') ?></option>
                                        <option><?php echo i18n::__('rutina') ?></option>
                                        <option><?php echo i18n::__('nacido') ?></option>
                                    </select>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></button>
                                <button type="button"  onclick="$('#detailForm').submit()">Insertar</button>
                                <input type="submit" class="btn btn-primary" value=<?php echo i18n::__('edit', null, 'user') ?>> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  -->