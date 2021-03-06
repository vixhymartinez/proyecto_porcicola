<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\validatorFields\validatorFieldsClass as validator;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of createDetalleFacturaVentaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createDetalleFacturaVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {


                $id_venta = request::getInstance()->getPost(detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::VENTA, true));
                $animal = request::getInstance()->getPost(detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::ANIMAL, true));
//                $id = request::getInstance()->getPost(detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::ID, true));
                $valor = request::getInstance()->getPost(detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::VALOR, true));
                  $peso = request::getInstance()->getPost(detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::PESO, true));
//                $venta = request::getInstance()->getPost(detalleProcesoVentaTableClass::getNameField(detalleProcesoVentaTableClass::VENTA, true));
    //        echo $id;       
    ////                detalleProcesoVentaTableClass::validateCreate($animal, $valor);
    //exit(); 
                  $subtotal = $peso * $valor;
                          
                $data = array(
                    detalleProcesoVentaTableClass::VENTA => $id_venta,
                    detalleProcesoVentaTableClass::ANIMAL => $animal,
                    detalleProcesoVentaTableClass::VALOR => $valor,
                    detalleProcesoVentaTableClass::PESO => $peso,
//                    detalleProcesoVentaTableClass::ID => $id,
                    detalleProcesoVentaTableClass::SUBTOTAL =>  $subtotal
                );

                //Manejo de inventario
//                $fieldsAnimal = array(
//                    animalTableClass::NUMERO,
//                    animalTableClass::ID
//                );
//                $whereInventario = array(
//                    animalTableClass::ID => $animal
//                );
//                $objAnimal = animalTableClass::getAll($fieldsAnimal, true, null, null, null, null, null);
           
//        detalleProcesoVentaTableClass::validateInventario($objAnimal[0]->id);

//                $fieldsAnimalDelete = array(
//                    animalTableClass::ID => $objAnimal[0]->id
//                );
//                animalTableClass::delete($fieldsAnimalDelete, true);

                detalleProcesoVentaTableClass::insert($data);
                session::getInstance()->setSuccess(i18n::__('succesCreate1', null, 'facturaVenta'));
                log::register(i18n::__('create'), detalleProcesoVentaTableClass::getNameTable());
                routing::getInstance()->redirect('factura', 'indexFacturaVenta');
            } else {
                session::getInstance()->setError('El Detalle de Vacunación no pudo ser insertado');
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}