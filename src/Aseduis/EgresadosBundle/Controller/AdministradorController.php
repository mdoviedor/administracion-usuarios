<?php

namespace Aseduis\EgresadosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministradorController extends Controller
{
    public function CrearAction()
    {
        return $this->render('AseduisEgresadosBundle:Administrador:Crear.html.twig', array(
                // ...
            ));    }

    public function ModificarAction($id)
    {
        return $this->render('AseduisEgresadosBundle:Administrador:Modificar.html.twig', array(
                // ...
            ));    }

    public function EliminarAction($id)
    {
        return $this->render('AseduisEgresadosBundle:Administrador:Eliminar.html.twig', array(
                // ...
            ));    }

    public function BuscarAction()
    {
        return $this->render('AseduisEgresadosBundle:Administrador:Buscar.html.twig', array(
                // ...
            ));    }

}
