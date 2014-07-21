<?php

namespace Aseduis\EgresadosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Aseduis\EgresadosBundle\Form\AdministradorType;
use Aseduis\EgresadosBundle\Form\UserType;
use Aseduis\EgresadosBundle\Entity\Administrador;
use Aseduis\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class AdministradorController extends Controller {

    public function CrearAction(Request $request) {

        try {
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

                    $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                            'notice', 'La acción se ha realizado con exito.'
                    );
                    return $this->redirect($this->generateURL('aseduis_egresados_administrador_buscar'));
                }
            }
            return $this->render('AseduisEgresadosBundle:Administrador:Crear.html.twig', array(
                        'formAdministrador' => $formAdministrador->createView()
            ));
        } catch (\Exception $exc) {
            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'error', 'La acción no se ha realizado. El usuario que esta intando registrar ya existe. Intentelo de nuevo.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_administrador_crear'));
        }
    }

    public function ModificarAction(Request $request, $id) {
        try {
            $em = $this->getDoctrine()->getManager();
            $userManager = $this->get('fos_user.user_manager'); // Instancia del manejador del bundle FOSUser
            $user = new User();
            $administrador = new Administrador();
            $administrador = $em->getRepository('AseduisEgresadosBundle:Administrador')->find($id);
            $user = $em->getRepository('AseduisUserBundle:User')->find($administrador->getUser()->getId());
            $userType = new UserType();


            $formAdministrador = $this->createForm(new AdministradorType(), $administrador);
            $formUser = $this->createForm($userType);

            if ($request->getMethod() == "POST") {
                $formAdministrador->handleRequest($request);
                $formUser->handleRequest($request);
                if ($formAdministrador->isValid() && $formUser->isValid()) {

                    $email = $formAdministrador->get('correoElectronico')->getData();
                    $username = $formAdministrador->get('identificacion')->getData();
                    $password = $formUser->get('password')->getData(); // Se obtiene el valor del campo password

                    if ($password) {
                        $user->setPlainPassword($password); // Instancia del objeto U
                    }

                    $user->setEmail($email);
                    $user->setUsername($username);

                    $userManager->updateUser($user); //Actualizacion del contenido del manejador
                    $this->getDoctrine()->getManager()->flush();


                    $em->persist($administrador);
                    $em->flush();

                    $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                            'notice', 'La acción se ha realizado con exito.'
                    );
                    return $this->redirect($this->generateURL('aseduis_egresados_administrador_buscar'));
                }
            }

            return $this->render('AseduisEgresadosBundle:Administrador:Modificar.html.twig', array(
                        'formAdministrador' => $formAdministrador->createView(),
                        'id' => $id,
                        'administrador' => $administrador,
                        'formUser' => $formUser->createView()
            ));
        } catch (\Exception $exc) {
            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'error', 'La acción no se ha realizado. El usuario que esta intando registrar ya existe. Intentelo de nuevo.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_administrador_buscar'));
        }
    }

    public function EliminarAction($id) {
        try {
            $em = $this->getDoctrine()->getManager();
            $user = new User();
            $administrador = new Administrador();
            $administrador = $em->getRepository('AseduisEgresadosBundle:Administrador')->find($id);
            $user = $em->getRepository('AseduisUserBundle:User')->find($administrador->getUser()->getId());

            $em->remove($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'notice', 'La acción se ha realizado con exito.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_administrador_buscar'));
        } catch (\Exception $exc) {
            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'error', 'La acción no se ha realizado. Intentelo de nuevo.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_administrador_buscar'));
        }
    }

    public function BuscarAction() {
        $em = $this->getDoctrine()->getManager();
        $administrador = new Administrador();
        $administrador = $em->getRepository('AseduisEgresadosBundle:Administrador')->findBy(array(), array('idadministrador' => 'DESC'));

        return $this->render('AseduisEgresadosBundle:Administrador:Buscar.html.twig', array(
                    'administrador' => $administrador
        ));
    }

}
