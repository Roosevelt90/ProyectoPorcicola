<?phpuse mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<br>
<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <br>
            <h2>  <?php echo i18n::__('new',  NULL, 'animal') ?>
            </h2>
        </div>
    </div>
</div>
<br>
<?php view::includeHandlerMessage() ?>
<?php view::includePartial('animal/formAnimal', array('objRaza'=> $objRaza, 'objGenero'=> $objGenero, 'objLote'=> $objLote)) ?>

