<?php

namespace Aseduis\FrontalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Aseduis\FrontalBundle\Entity\Ciudad;

class GeneralController extends Controller {
    /*
     * Funcion para buscar las ciudades correspondientes a un departamento. 
     * Recibe el id correspondiente al iddepartamento del modelo Departamento.
     */

    function BuscarciudadAction($id, $funcion) {
        $ciudad = new Ciudad();
        $em = $this->getDoctrine()->getManager();

        $ciudad = $em->getRepository('AseduisFrontalBundle:Ciudad')->findBy(array('departamento' => $id));

        return $this->render('AseduisFrontalBundle:General:Buscarciudad.html.twig', array(
                    'ciudades' => $ciudad,
                    'funcion' => $funcion
        ));
    }

}
