<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportVacunaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (session::getInstance()->hasAttribute('vacunaFilters')) {
                $where = session::getInstance()->getAttribute('vacunaFilters');
            }//close if

            $fields = array(
                vacunaTableClass::ID,
                vacunaTableClass::NOMBRE_VACUNA,
                vacunaTableClass::LOTE_VACUNA,
                vacunaTableClass::FECHA_FABRICACION,
                vacunaTableClass::FECHA_VENCIMIENTO,
                vacunaTableClass::VALOR
            );

            $orderBy = array(
                vacunaTableClass::ID
            );

            $this->objVacuna = vacunaTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
            $this->mensaje = 'Informe de las vacunas en nuestro sistema';
            $this->defineView('index', 'vacuna', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
