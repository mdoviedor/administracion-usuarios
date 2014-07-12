<?php

namespace Aseduis\EgresadosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EgresadosController extends Controller
{
    public function CrearAction()
    {
        return $this->render('AseduisEgresadosBundle:Egresados:Crear.html.twig', array(
                // ...
            ));    }

    public function ModificarAction($id)
    {
        return $this->render('AseduisEgresadosBundle:Egresados:Modificar.html.twig', array(
                // ...
            ));    }

    public function EliminarAction($id)
    {
        return $this->render('AseduisEgresadosBundle:Egresados:Eliminar.html.twig', array(
                // ...
            ));    }

    public function BuscarAction()
    {
        return $this->render('AseduisEgresadosBundle:Egresados:Buscar.html.twig', array(
                // ...
            ));    }

    public function VerAction($id)
    {
        return $this->render('AseduisEgresadosBundle:Egresados:Ver.html.twig', array(
                // ...
            ));    }

}
