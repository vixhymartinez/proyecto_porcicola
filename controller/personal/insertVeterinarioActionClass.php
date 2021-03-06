<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;

/**
 * Description of insertVeterinarioActionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insertVeterinarioActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $fieldsTipo_doc = array(
                tipoDocumentoTableClass::ID,
                tipoDocumentoTableClass::DESCRIPCION
            );

            $fieldsCiudad = array(
                ciudadTableClass::ID,
                ciudadTableClass::NOMBRE
            );

            $this->objCiudad = ciudadTableClass::getAll($fieldsCiudad, true);

            $this->objTipo_doc = tipoDocumentoTableClass::getAll($fieldsTipo_doc, true);
            $this->defineView('insert', 'veterinario', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
