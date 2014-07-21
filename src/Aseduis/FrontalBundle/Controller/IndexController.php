<?php

namespace Aseduis\FrontalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller {
    /*
     * Al cliente, hacer la peticion de acceso al index, se redirecciona a la ruta /login.
     */

    function indexAction() {
        if ($this->get('security.context')->isGranted('ROLE_ADMINISTRADOR')) {//Existe una sesion con el usuario Rol ADMINISTRADOR
            // return $this->redirect($this->generateUrl('gs_proyectos_vistaherramientas'));
            return $this->redirect($this->generateUrl('aseduis_egresados_buscar'));
        } elseif ($this->get('security.context')->isGranted('ROLE_EGRESADO')) {

        } else {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    }

}
