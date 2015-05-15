<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">  
            <h2>
                <?php echo i18n::__('modules') ?>
            </h2>
        </div>
    </div>
    <div class="row">
        <br>
        <div class="coo-xs-10">
            <div class="table-responsive">
                <div class="btn-group btn-group-lg btn-group-justified">

                    <!--MODULO VACUNACION-->
                    <div class="menuDesplegableVacunacion">
                        <input type="checkbox" id="toggleboxVacunacion" />
                        <ul>
                            <li><a  onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>'" class="btn btn-ttc"><?php echo i18n::__('vacunacion', null, 'vacunacion') ?></a></li>
                            <li><a  onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacuna') ?>'" class="btn btn-ttc"><?php echo i18n::__('vacuna', null, 'vacuna') ?></a></li>
                            <li><label for="toggleboxVacunacion"></label></li>
                        </ul>
                        <label class="fa fa-3x" for="toggleboxVacunacion"><?php echo i18n::__('vacunacion', null, 'vacunacion') ?></label>
                    </div>
                    <!--MODULO USUARIO-->
                    <div class="menuDesplegable">
                        <input type="checkbox" id="togglebox" />
                        <ul>
                            <li><a  onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('usuario', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('user') ?></a></li>
                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('dataUser', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('dataUser') ?></a></li>
                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('credencial') ?></a></li>
                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index') ?>'" class="btn btn-ttc "><?php echo i18n::__('userCredencial') ?></a></li>
                            <li><label for="togglebox"></label></li>
                        </ul>
                        <label class="fa fa-users fa-3x" for="togglebox"><?php echo i18n::__('usuarios') ?></label>
                    </div>
                    <!--MODULO ANIMAL-->
                    <div class="menuDesplegableAnimal">
                        <input type="checkbox" id="toggleboxAnimal" />
                        <ul>
                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>'" class="btn btn-ttc"><?php echo i18n::__('animal') ?></a></li>
                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRaza') ?>'" class="btn btn-ttc"><?php echo i18n::__('raza') ?></a></li>
                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexLote') ?>'" class="btn btn-ttc"><?php echo i18n::__('lote') ?></a></li>
                            <li><label for="toggleboxAnimal"></label></li>
                        </ul>
                        <label class="fa  fa-3x fa-beer" for="toggleboxAnimal"><?php echo i18n::__('animal') ?></label>
                    </div>
                    <!--MODULO INSUMO-->
                    <div class="menuDesplegableInsumo">
                        <input type="checkbox" id="toggleboxInsumo" />
                        <ul>
                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('insumo', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('insumo') ?></a></li>
                            <li><label for="toggleboxInsumo"></label></li>
                        </ul>
                        <label class="fa  fa-3x glyphicon glyphicon-shopping-cart" for="toggleboxInsumo"><?php echo i18n::__('insumo') ?></label>
                    </div>
                    <!--MODULO LOCALIDAD-->
                    <div class="menuDesplegableLocalidad">
                        <input type="checkbox" id="toggleboxInsumoLocalidad" />
                        <ul>
                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('ciudad', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('city') ?></a></li>
                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('departamento', index) ?>'" class=" btn btn-ttc"><?php echo i18n::__('depto') ?></a></li>
                            <li><label for="toggleboxInsumoLocalidad"></label></li>
                        </ul>
                        <label class="fa  fa-3x" for="toggleboxInsumoLocalidad">Localidad</label>
                    </div>
                    <!--MODULO EMPLEADO-->
                    <div class="menuDesplegableEmpleado">
                        <input type="checkbox" id="toggleboxEmpleado" />
                        <ul>
                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('empleado', 'indexCargo') ?>'" class="btn btn-ttc"><?php echo i18n::__('cargo') ?></a></li>
                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('empleado', 'indexEmpleado') ?>'" class=" btn btn-ttc"><?php echo i18n::__('empleado') ?></a></li>
                            <li><label for="toggleboxEmpleado"></label></li>
                        </ul>
                        <label class="fa  fa-3x" for="toggleboxEmpleado"><?php echo i18n::__('empleado') ?></label>
                    </div>

                    <!--MENU DESPLEGABLE FACTURA-->
                    <div class="menuDesplegabledpVenta">
                        <input type="checkbox" id="toggleboxdpVenta" />
                        <ul>
                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('pVenta', 'index') ?>'"><?php echo i18n::__('pVenta') ?></a></li>

                            <li><a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('dpVenta', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('dpVenta') ?></a></li>
                            <li><label for="toggleboxdpVenta"></label></li>
                        </ul>
                        <label class="fa  fa-3x" for="toggleboxdpVenta"><?php echo i18n::__('factura') ?></label>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
