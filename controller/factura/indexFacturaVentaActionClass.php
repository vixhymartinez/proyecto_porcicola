<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of indexFacturaVentaActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexFacturaVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;

            if (request::getInstance()->hasPost('filter')) {

                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['fecha_inicio']) and $filter['fecha_inicio'] !== null and $filter['fecha_inicio'] !== '' and isset($filter['fecha_final']) and $filter['fecha_fina'] !== null and $filter['fecha_final'] !== '') {
                    $where[procesoVentaTableClass::getNameTable() . '.' . procesoVentaTableClass::FECHA_HORA_VENTA] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_inicial'] . ' 00.00.00')),
                        date(config::getFormatTimestamp(), strtotime($filter['fecha_final'] . ' 23.59.59'))
                    );
                }//close if

                if (isset($filter['cliente']) and $filter['cliente'] !== null and $filter['cliente'] !== '') {
                    $where[procesoVentaTableClass::CLIENTE_ID] = $filter['cliente'];
                }//close if
                  if (isset($filter['empleado']) and $filter['empleado'] !== null and $filter['empleado'] !== '') {
                    $where[procesoVentaTableClass::EMPLEADO_ID] = $filter['empleado'];
                }//close if
                  if (isset($filter['animal']) and $filter['animal'] !== null and $filter['animal'] !== '') {
                    $where[procesoVentaTableClass::ANIMAL] = $filter['animal'];
                }//close if
                 if (isset($filter['peso']) and $filter['peso'] !== null and $filter['peso'] !== '') {
                    $where[procesoVentaTableClass::PESO] = $filter['peso'];
                }//close if
                
//                    if (isset($filter['fecha_fin']) and $filter['fecha_fin'] !== null and $filter['fecha_fin'] !== '' and isset($filter['fecha_inicio']) and $filter ['fecha_inicio'] !== null and $filter['fecha_inicio'] !== '') {
//
//                    $where [procesoVentaTableClass::getNameTable() . '.' . procesoVentaTableClass::FECHA_HORA_VENTA] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['fecha_inicio'] . ' 00.00.00')),
//                        date(config::getFormatTimestamp(), strtotime($filter['fecha_fin'] . ' 23.59.59'))
//                    );
//                }


                session::getInstance()->setAttribute('facturaVentaFilter', $where);
            } elseif (session::getInstance()->hasAttribute('facturaVentaFilter')) {
                $where = session::getInstance()->getAttribute('facturaVentaFilter');
            }//close if

            $fieldsEmple = array(
                empleadoTableClass::ID,
                empleadoTableClass::NOMBRE
            );

            $fieldsCli = array(
                clienteTableClass::ID,
                clienteTableClass::NOMBRE
            );
     

            $fieldsFacturaVenta = array(
                procesoVentaTableClass::ID,
                procesoVentaTableClass::FECHA_HORA_VENTA,
                procesoVentaTableClass::ACTIVA,
             
                procesoVentaTableClass::PESO,
                procesoVentaTableClass::SUBTOTAL,
                procesoVentaTableClass::VALOR
            );
            $fieldsEmpleado = array(
                empleadoTableClass::NOMBRE
            );
            $fieldsCliente = array(
                clienteTableClass::NOMBRE
            );
            $fieldsAni = array (
            animalTableClass::NUMERO  
            );
            $fieldsEmpleado2 = array(
                empleadoTableClass::NOMBRE,
                empleadoTableClass::ID
            );
            $fieldsCliente2 = array(
                clienteTableClass::NOMBRE,
                clienteTableClass::ID
            );
            $fieldsAnimal = array(
                animalTableClass::ID,
                animalTableClass::NUMERO
            );
            $fJoin1 = procesoVentaTableClass::EMPLEADO_ID;
            $fJoin2 = empleadoTableClass::ID;
            $fJoin3 = procesoVentaTableClass::CLIENTE_ID;
            $fJoin4 = clienteTableClass::ID;
            $fJoin5 = procesoVentaTableClass::ANIMAL;
            $fJoin6 = animalTableClass::ID;
            
            $orderBy = array(
                procesoVentaTableClass::FECHA_HORA_VENTA
            );



            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado2, false);
            $this->objCliente = clienteTableClass::getAll($fieldsCliente2, false);

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }//close if

            $f = array(
                procesoVentaTableClass::ID
            );
            $lines = config::getRowGrid();
            $this->cntPages = procesoVentaTableClass::getAllCount($f, true, $lines, $where);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }//close if 
            $this->objCliente = clienteTableClass::getAll($fieldsCli, true);
            $this->objEmpleado = empleadoTableClass::getAll($fieldsEmple, true);
            $this->objAnimal = animalTableClass::getAll($fieldsAnimal, FALSE);
            $this->objFacturaVenta = procesoVentaTableClass::getAllJoin($fieldsFacturaVenta, $fieldsEmpleado, $fieldsCliente, $fieldsAni, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            log::register(i18n::__('ver', null, 'facturaVenta'), procesoVentaTableClass::getNameTable());
            $this->defineView('index', 'facturaVenta', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
