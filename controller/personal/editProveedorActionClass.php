<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editProveedorActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {

        try {
            if (request::getInstance()->hasRequest(proveedorTableClass::ID)) {
                $fields = array(
                    proveedorTableClass::ID,
                    proveedorTableClass::NUMERO_DOC,
                    proveedorTableClass::NOMBRE,
                    proveedorTableClass::TEL,
                    proveedorTableClass::CIUDAD,
                    proveedorTableClass::DIRECCION,
                    proveedorTableClass::TIPO_DOC
                );

                $where = array(
                    proveedorTableClass::ID => request::getInstance()->getRequest(proveedorTableClass::ID)
                );
                $fieldsCiudad = array(
                    ciudadTableClass::ID,
                    ciudadTableClass::NOMBRE
                );
                $fieldsTipo_doc = array(
                    tipoDocumentoTableClass::ID,
                    tipoDocumentoTableClass::DESCRIPCION
                );

                $this->objCiudad = ciudadTableClass::getAll($fieldsCiudad, true);

                $this->objTipo_documento = tipoDocumentoTableClass::getAll($fieldsTipo_doc, true);

                $this->objProveedor = proveedorTableClass::getAll($fields, true, null, null, null, null, $where);
                $this->defineView('edit', 'proveedor', session::getInstance()->getFormatOutput());
            } else {

                routing::getInstance()->redirect('personal', 'indexProveedor');
          }
         
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
  }

}
