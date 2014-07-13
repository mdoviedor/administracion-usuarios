<?php

namespace Aseduis\EgresadosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Aseduis\EgresadosBundle\Form\AdministradorType;
use Aseduis\EgresadosBundle\Entity\Administrador;
use Aseduis\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class AdministradorController extends Controller {

    public function CrearAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $userManager = $this->get('fos_user.user_manager'); // Instancia del manejador del bundle FOSUser
        $administrador = new Administrador();

        $formAdministrador = $this->createForm(new AdministradorType(), $administrador);
        if ($request->getMethod() == "POST") {
            $formAdministrador->handleRequest($request);
            if ($formAdministrador->isValid()) {

                $email = $formAdministrador->get('correoElectronico')->getData();
                $username = $formAdministrador->get('identificacion')->getData();

                $user->setEmail($email);
                $user->setUsername($username);
                $user->setEnabled(true);
                $user->setPlainPassword($username);
                $user->r('ROLE_ADMINISTRADOR');

                $userManager->updateUser($user); //Actualizacion del contenido del manejador
                $this->getDoctrine()->getManager()->flush();

                $user = $em->getRepository('AseduisEgresadosBundle:User')->findOneBy(array('username' => $username));
                $administrador->setUser($user);
                $fechaRegistro = new \DateTime("now");
                $administrador->setFecharegistro($fechaRegistro);

                $em->persist($administrador);
                $em->flush();
            }
        }
        return $this->render('AseduisEgresadosBundle:Administrador:Crear.html.twig', array(
                    'formAdministrador' => $formAdministrador->createView()
        ));
    }

    public function ModificarAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $userManager = $this->get('fos_user.user_manager'); // Instancia del manejador del bundle FOSUser
        $user = new User();
        $administrador = new Administrador();
        $administrador = $em->getRepository('AseduisEgresadosBundle:Administrador')->find($id);
        $user = $em->getRepository('AseduisUserBundle:User')->find($administrador->getUser()->getId());



        $formAdministrador = $this->createForm(new AdministradorType(), $administrador);
        if ($request->getMethod() == "POST") {
            $formAdministrador->handleRequest($request);
            if ($formAdministrador->isValid()) {

                $email = $formAdministrador->get('correoElectronico')->getData();
                $username = $formAdministrador->get('identificacion')->getData();

                $user->setEmail($email);
                $user->setUsername($username);

                $userManager->updateUser($user); //Actualizacion del contenido del manejador
                $this->getDoctrine()->getManager()->flush();


                $em->persist($administrador);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Your changes were saved!');
                return $this->redirect($this->generateURL('aseduis_egresados_administrador_crear'));
            }
        }

        return $this->render('AseduisEgresadosBundle:Administrador:Modificar.html.twig', array(
                    'formAdministrador' => $formAdministrador->createView(),
                    'id' => $id,
                    'administrador' => $administrador
        ));
    }

    public function EliminarAction($id) {

        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $administrador = new Administrador();
        $administrador = $em->getRepository('AseduisEgresadosBundle:Administrador')->find($id);
        $user = $em->getRepository('AseduisUserBundle:User')->find($administrador->getUser()->getId());

        $em->remove($user);
        $em->flush();

        return $this->render('AseduisEgresadosBundle:Administrador:Eliminar.html.twig', array(
                        // ...
        ));
    }

    public function BuscarAction() {
        return $this->render('AseduisEgresadosBundle:Administrador:Buscar.html.twig', array(
                        // ...
        ));
    }

}
