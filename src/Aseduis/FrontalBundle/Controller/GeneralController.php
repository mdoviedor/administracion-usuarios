<?php

namespace Aseduis\FrontalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Aseduis\FrontalBundle\Entity\Ciudad;
use Aseduis\FrontalBundle\Entity\Programaacademico;
use Aseduis\FrontalBundle\Entity\EgresadoProgramaacademico;

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

    /*
     * Función para buscar los programas acádemicos correspondientes a un tipo. 
     * Recibe el id correspondiente al idtipoprogramaacademico del modelo Tipoprogramaacademico.
     */

    function BuscarprogramaacademicoAction($id, $funcion) {
        $programaAcademico = new Programaacademico();
        $em = $this->getDoctrine()->getManager();

        $programaAcademico = $em->getRepository('AseduisFrontalBundle:Programaacademico')->findBy(array('tipoprogramaacademico' => $id));

        return $this->render('AseduisFrontalBundle:General:Buscarprogramaacademico.html.twig', array(
                    'programaAcademico' => $programaAcademico,
                    'funcion' => $funcion
        ));
    }
    /*
     * Función para buscar los programas academicos de los egresados.
     * Recibe el id correspondiente al idegresado del modelo Egresado
     */
    
    function BuscarprogramaacademicoegresadoAction($id) {
        $egresadoProgramaAcademico = new EgresadoProgramaacademico();
        $em = $this->getDoctrine()->getManager();
        $egresadoProgramaAcademico = $em->getRepository('AseduisFrontalBundle:EgresadoProgramaacademico')->findBy(array('egresado' => $id));

        return $this->render('AseduisFrontalBundle:General:Buscarprogramaacademicoegresado.html.twig', array(
                    'programaAcademico' => $egresadoProgramaAcademico,                    
        ));
    }

}
