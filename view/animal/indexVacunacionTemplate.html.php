
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $id_registro = carneVacunasTableClass::ID ?>
<?php $fecha_vacunacion = carneVacunasTableClass::FECHA_VACUNACION ?>
<?php $veterinario = veterinarioBaseTableClass::NOMBRE ?>
<?php $dosis_vacuna = carneVacunasTableClass::DOSIS ?>
<?php $accion = carneVacunasTableClass::ACCION ?>
<?php $nombreVacuna = vacunaTableClass::NOMBRE_VACUNA ?>
<?php $numAnimal = animalTableClass::NUMERO ?>
<?php $nomVete = veterinarioTableClass::NOMBRE ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container ">

            <br/> <br/>
            <?php echo i18n::__('car', null, 'dpVenta') ?>
            <br /> <br/>
            <div class=" table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="success">
<!--                            <th><?php echo i18n::__('fechaRegistro', null, 'vacunacion') ?></th>-->
                            <th><?php echo i18n::__('animal', null, 'animal') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objCarne as $key): ?>
                            <tr>

<!--                                <td><?php echo date("Y-M-d h:m", strtotime($key->fecha_registro)) ?></td>-->
                                <td><?php echo $key->$numAnimal ?></td>
                                                  </tr>
                                                                        
                        <?php endforeach//close foreach ?>
                    </tbody>
                </table>
            </div>
            <br/> 
            <?php echo i18n::__('detailVaccination', null, 'detalleVacunacion') ?>

            <div class="container container-fluid" style="margin-bottom: 10px">
               <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insertVacunacion') ?>" class="btn btn-sm btn-info fa fa-bars"></a>
                            <div class="mdl-tooltip mdl-tooltip--large" for="new">
                                <?php echo i18n::__('insertDetalle', null, 'ayuda') ?>
                            </div>
             
                <a href="#myModalFilter" data-toggle="modal" id="buscarDetalle" class="btn btn-sm btn-info active fa fa-search"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="buscarDetalle">
                    <?php echo i18n::__('buscar', null, 'ayuda') ?>
                </div>
                <a class="btn btn-sm btn-primary fa fa-reply" id="eliminarBusquedaDetalle" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteFiltersVacunacion') ?>"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="eliminarBusquedaDetalle">
                    <?php echo i18n::__('eliBusDetalle', null, 'ayuda') ?>
                </div>
                    <a id="reportes" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportVacunacion') ?>" class="btn btn-primary active btn-sm fa fa-download" ></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="reportes">
                        <?php echo i18n::__('reporte', null, 'ayuda') ?>
                    </div>

<!--<a href="<?php // echo routing::getInstance()->getUrlWeb('vacunacion', 'reportDetalleVacunacion')        ?>" class="btn btn-info btn-xs" ><?php echo i18n::__('report') ?></a>-->       


            </div>

            <div class=" table table-responsive">
                <table class="table">
                    <thead>
                        <tr class="success">
                          

                            <th><?php echo i18n::__('item') ?></th>
                            <th><?php echo i18n::__('fecha', null, 'detalleVacunacion') ?></th>
                            <th><?php echo i18n::__('veterinario', null, 'veterinario') ?></th>
                            <th><?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></th>
                            <th><?php echo i18n::__('dosis', null, 'detalleVacunacion') ?></th>
                            <th><?php echo i18n::__('accion') ?></th>
                            <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                <th><?php echo i18n::__('action') ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objCarne as $key): ?>
                            <tr>
                   
                               <td><?php echo $key->$id_registro ?></td>
                                <td><?php echo $key->$fecha_vacunacion ?></td>
                                <td><?php echo $key->$veterinario ?></td>
                                <td><?php echo $key->$nombreVacuna ?></td>
                                <td><?php echo $key->$dosis_vacuna ?></td>
                                <td><?php echo $key->$accion ?></td>
                                <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                                    <td>
                                        <a id="editarDetalle<?php echo $countDetale ?>" href="#detailFormEdit<?php echo $key->id ?>" class="btn btn-default active btn-sm fa fa-edit" ></a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="editarDetalle<?php echo $countDetale ?>">
                                            <?php echo i18n::__('editDetalle', null, 'ayuda') ?>
                                        </div>  
                  <!--                      <a id="eliminarDetalle<?php echo $countDetale ?>" href="#myModalDelete<?php echo $key->id ?>" class="btn btn-sm btn-default fa fa-ban" ></a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="eliminarDetalle<?php echo $countDetale ?>">
                                        <?php echo i18n::__('inhabilitarDetalle', null, 'ayuda') ?>
                                        </div>  -->
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>


                                    <!-- WINDOWS MODAL UPDATE DETAIL VACCINATION -->
<!--
                        <div class="modalmask" id="detailFormEdit<?php echo $key->id ?>">
                            <div class="modalbox rotate">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('editDetailVaccination', null, 'detalleVacunacion') ?>:</h4>
                                <form id="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'updateDetalleVacunacion') ?>">
                                    <a href="#close" title="Close" class="close">X</a>
                                    <div class="modal-body">
                                        <input type="hidden" value="<?php echo request::getInstance()->getServer('PATH_INFO') ?>" name="PATH_INFO">
                                        <input type="hidden" value="<?php echo $key->$idDetalle ?>" id="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true) ?>" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID_REGISTRO, true) ?>">
                                        <input type="hidden" id="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID, true) ?>" value="<?php echo $key->id ?>" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ID, true) ?>">
                                        <?php echo i18n::__('fecha', null, 'detalleVacunacion') ?>
                                        <input type="datetime-local" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::FECHA, true) ?>">
                                        <br/>         
                                        <?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?>
                                        <select name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::VACUNA, true) ?>">
                                            <option value="">...</option>
                                            <?php foreach ($objVacuna as $key): ?>
                                                <option value="<?php echo $key->id ?>"><?php echo $key->nombre_vacuna ?></option>
                                            <?php endforeach; //close foreach   ?>
                                        </select>
                                        <br/>
                                        <?php echo i18n::__('dosis', null, 'detalleVacunacion') ?>
                                        <input type="text" name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::DOSIS, true) ?>">
                                        <br/>  
                                        <?php if (!isset($objDetalleVacunacion)): ?>
                                            <?php echo i18n::__('accion') ?>
                                            <select name="<?php echo detalleVacunacionTableClass::getNameField(detalleVacunacionTableClass::ACCION, true) ?>">
                                                <option>...</option>
                                                <option><?php echo i18n::__('enfermedad') ?></option>
                                                <option><?php echo i18n::__('gestacion') ?></option>
                                                <option><?php echo i18n::__('parto') ?></option>
                                                <option><?php echo i18n::__('rutina') ?></option>
                                                <option><?php echo i18n::__('nacido') ?></option>
                                            </select>
                                        <?php endif; ?>
                                        <br/>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#close2" title="Close" type="button" class="btn btn-default close2" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></a>
                                        <input type="submit" class="btn btn-primary" value=<?php echo i18n::__('edit', null, 'user') ?>> 
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                </th>
                </tr>
                <?php $countDetale++ ?>         
            <?php endforeach//close foreach   ?>
            </tbody>
            </table>
        </div>
    </div>
   
</div>


<!--</div>-->
</main>



<!-- WINDOWS MODAL FILTER -->
<div class="modalmask" id="myModalFilter">
    <div class="modalbox rotate">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
        </div>
        <a href="#close" title="Close" class="close">X</a>
        <div class="modal-body">
            <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexVacunacion') ?>">
                <input type="hidden" name="<?php echo carneVacunasTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(carneVacunasTableClass::ID) ?>">
                <table class="table table-bordered">
                    <tr>
                        <th><?php echo i18n::__('fechaIni', null, 'detalleVacunacion') ?></th>
                        <th>
                            <input name="filter[fecha_inicio]" type="date">
                        </th>
                    </tr>
                    <tr>
                        <th><?php echo i18n::__('fechaFin', null, 'detalleVacunacion') ?></th>
                        <th>
                            <input name="filter[fecha_fin]" type="date">
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
                                <?php endforeach; //close foreach   ?>
                            </select>
                        </th>
                    </tr>
                            <tr>

                        <th><?php echo i18n::__('veterinario', null, 'veterinario') ?></th>
                        <th>
                            <select name="filter[veterinario]">
                                <option value="">
                                    ...
                                </option>
                                <?php foreach ($objVeterinario as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->nombre_vacuna ?>
                                    </option>
                                <?php endforeach; //close foreach   ?>
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

                                    <!-- WINDOWS MODAL DETAIL VACCINATION -->
                        <div class="modalmask" id="myModalDetail<?php echo $key->id ?>">
                            <div class="modalbox rotate">
                                <form id="detailForm" name="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'createVacunacion') ?>">

                                    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('newDetailVaccination', null, 'detalleVacunacion') ?>:</h4>
                                    </div>
                                    <a href="#close" title="Close" class="close">X</a>
                                    <div class="modal-body">


                                        <input type="hidden" value="<?php echo $key->id ?>" name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::ID, true) ?>" id="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::ID, true) ?>">
                                        <?php echo i18n::__('fecha', null, 'detalleVacunacion') ?>
                                        <input type="datetime-local" name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::FECHA_VACUNACION, true) ?>">    
                                        <br/>
                                        <?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?>
                                        <select name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::VACUNA, true) ?>">
                                            <option value="">...</option>
                                            <?php foreach ($objVacuna as $key): ?> 

                                                <option value="<?php echo $key->id ?>"><?php echo $key->nombre_vacuna ?></option>
                                            <?php endforeach; //close foreach   ?>
                                        </select>
                                                                                <br/>
                                        <?php echo i18n::__('veterinario', null, 'veterinario') ?>
                                        <select name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::VETERINARIO, true) ?>">
                                            <option value="">...</option>
                                            <?php foreach ($objVeterinario as $key): ?> 

                                                <option value="<?php echo $key->id ?>"><?php echo $key->nombre_completo ?></option>
                                            <?php endforeach; //close foreach   ?>
                                        </select>
                                        <br/>
                                        <?php echo i18n::__('dosis', null, 'detalleVacunacion') ?>
                                        <input type="number" name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::DOSIS, true) ?>">
                                        <br/>
                                        <?php echo i18n::__('accion') ?>
                                        <select name="<?php echo carneVacunasTableClass::getNameField(carneVacunasTableClass::ACCION, true) ?>">
                                            <option value="">...</option>
                                            <option><?php echo i18n::__('enfermedad') ?></option>
                                            <option><?php echo i18n::__('gestacion') ?></option>
                                            <option><?php echo i18n::__('parto') ?></option>
                                            <option><?php echo i18n::__('rutina') ?></option>
                                            <option><?php echo i18n::__('nacido') ?></option>
                                        </select>
                                       </div>
                                    <div class="modal-footer">
                <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></a>
                                        <button type="submit" class="btn btn-info active fa fa-plus-square" ><?php echo i18n::__('insert', null, 'dpVenta') ?></button>

                                    </div>
                                </form>
                            </div>
                        </div>