<?phpuse mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<main class="mdl-layout__content mdl-color--blue-300">
    <div class="mdl-grid demo-content">
<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo text-center">
            
            <h2>  
    <?php echo i18n::__('sal', NULL, 'bodega') ?>
            </h2>
            
        </div>
    </div>
</div>

<?php view::includeHandlerMessage() ?>
<?php view::includePartial('salidaBodega/form', array('objEmpleado'=>$objEmpleado)) ?>

