<?php

namespace Aseduis\EgresadosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Aseduis\EgresadosBundle\Form\EgresadoType;
use Aseduis\EgresadosBundle\Form\EmpresalaboraType;
use Aseduis\EgresadosBundle\Form\EgresadoProgramaacademicoType;
use Aseduis\EgresadosBundle\Entity\Egresado;
use Aseduis\EgresadosBundle\Entity\Departamento;
use Aseduis\EgresadosBundle\Entity\Ciudad;
use Aseduis\EgresadosBundle\Entity\Empresalabora;
use Aseduis\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class EgresadosController extends Controller {

    public function CrearAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $egresado = new Egresado();
        //$empresaLabora = new Empresalabora();    
        $ciudad = new Ciudad();
        $user = new User();
        $userManager = $this->get('fos_user.user_manager'); // Instancia del manejador del bundle FOSUser

        $departamento = $em->getRepository('AseduisEgresadosBundle:Departamento')->findAll();

        $formEgresado = $this->createForm(new EgresadoType(), $egresado);
        // $formEmpresaLabora = $this->createForm(new EmpresalaboraType(), $empresaLabora);

        if ($request->getMethod() == 'POST') {
            $formEgresado->handleRequest($request);
            $c = $request->request->get('listaCiudad');
            if ($formEgresado->isValid() && $c) {
                $email = $formEgresado->get('correoElectronico')->getData();
                $username = $formEgresado->get('identificacion')->getData();

                $user->setEmail($email);
                $user->setUsername($username);
                $user->setEnabled(true);
                $user->setPlainPassword($username);
                $user->r('ROLE_EGRESADO');

                $userManager->updateUser($user); //Actualizacion del contenido del manejador
                $this->getDoctrine()->getManager()->flush();

                $user = $em->getRepository('AseduisEgresadosBundle:User')->findOneBy(array('username' => $username));
                $ciudad = $em->getRepository('AseduisEgresadosBundle:Ciudad')->find($c);


                $egresado->setUser($user);
                $egresado->setCiudad($ciudad);
                $egresado->setFecharegistro(new \DateTime("now"));
                $egresado->setEgresadouis(true);

                $em->persist($egresado);
                $em->flush();
            }
        }


        return $this->render('AseduisEgresadosBundle:Egresados:Crear.html.twig', array(
                    'formEgresado' => $formEgresado->createView(),
                    'departamentos' => $departamento
        ));
    }

    public function ModificarAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $egresado = new Egresado();
        //$empresaLabora = new Empresalabora();    
        $ciudad = new Ciudad();
        $user = new User();
        $userManager = $this->get('fos_user.user_manager'); // Instancia del manejador del bundle FOSUser

        $egresado = $em->getRepository('AseduisEgresadosBundle:Egresado')->find($id);
        $user = $em->getRepository('AseduisUserBundle:User')->find($egresado->getUser()->getId());
        $departamento = $em->getRepository('AseduisEgresadosBundle:Departamento')->findAll();

        $formEgresado = $this->createForm(new EgresadoType(), $egresado);
        // $formEmpresaLabora = $this->createForm(new EmpresalaboraType(), $empresaLabora);

        if ($request->getMethod() == 'POST') {
            $formEgresado->handleRequest($request);

            if ($formEgresado->isValid()) {
                $c = $request->request->get('listaCiudad');
                $email = $formEgresado->get('correoElectronico')->getData();
                $username = $formEgresado->get('identificacion')->getData();

                $user->setEmail($email);
                $user->setUsername($username);

                $userManager->updateUser($user); //Actualizacion del contenido del manejador
                $this->getDoctrine()->getManager()->flush();

                if ($c) {
                    $ciudad = $em->getRepository('AseduisEgresadosBundle:Ciudad')->find($c);
                    $egresado->setCiudad($ciudad);
                }

                $em->persist($egresado);
                $em->flush();
            }
        }

        return $this->render('AseduisEgresadosBundle:Egresados:Modificar.html.twig', array(
                    'formEgresado' => $formEgresado->createView(),
                    'departamentos' => $departamento,
                    'egresado' => $egresado
        ));
    }

    public function EliminarAction($id) {
        return $this->render('AseduisEgresadosBundle:Egresados:Eliminar.html.twig', array(
                        // ...
        ));
    }

    public function BuscarAction() {
        return $this->render('AseduisEgresadosBundle:Egresados:Buscar.html.twig', array(
                        // ...
        ));
    }

    public function VerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $egresado = new Egresado();
        $egresado = $em->getRepository('AseduisEgresadosBundle:Egresado')->find($id);
        return $this->render('AseduisEgresadosBundle:Egresados:Ver.html.twig', array(
                    'egresado' => $egresado
        ));
    }

}
