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
use Aseduis\EgresadosBundle\Entity\Tipoprogramaacademico;
use Aseduis\EgresadosBundle\Entity\EgresadoProgramaacademico;
use Aseduis\EgresadosBundle\Entity\Programaacademico;
use Aseduis\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class EgresadosController extends Controller {

    public function CrearAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $egresado = new Egresado();
        $ciudad = new Ciudad();
        $departamento = new Departamento();
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

    /*
     * Recibe el id correspondiente al idegresado del Modelo Egresado
     */

    public function ModificarAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $egresado = new Egresado();
        //$empresaLabora = new Empresalabora();    
        $ciudad = new Ciudad();
        $departamento = new Departamento();
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
        $empresaLabora = new Empresalabora();
        $egresadoProgramaAcademico = new EgresadoProgramaacademico();
        $egresado = $em->getRepository('AseduisEgresadosBundle:Egresado')->find($id);
        $empresaLabora = $em->getRepository('AseduisEgresadosBundle:Empresalabora')->findOneBy(array('egresado' => $id));
        $egresadoProgramaAcademico = $em->getRepository('AseduisEgresadosBundle:EgresadoProgramaacademico')->findBy(array('egresado' => $id));
        return $this->render('AseduisEgresadosBundle:Egresados:Ver.html.twig', array(
                    'egresado' => $egresado,
                    'empresaLabora' => $empresaLabora,
                    'egresadoProgramaAcademico' => $egresadoProgramaAcademico
        ));
    }

    /*
     * 
     * EMPRESA EGRESADO
     * 
     */

    /*
     * Recibe el id corrempondiente al idegresado del modelo Egresado
     */

    public function AgregarempresaAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $empresaLabora = new Empresalabora();
        $egresado = new Egresado();
        $departamento = new Departamento();
        $ciudad = new Ciudad();

        $departamento = $em->getRepository('AseduisEgresadosBundle:Departamento')->findAll();

        $formEmpresaLabora = $this->createForm(new EmpresalaboraType, $empresaLabora);

        if ($request->getMethod() == 'POST') {
            $formEmpresaLabora->handleRequest($request);
            $c = $request->request->get('listaCiudadEmpresa');
            if ($formEmpresaLabora->isValid() && $c) {
                $egresado = $em->getRepository('AseduisEgresadosBundle:Egresado')->find($id);
                $ciudad = $em->getRepository('AseduisEgresadosBundle:Ciudad')->find($c);
                $empresaLabora->setEgresado($egresado);
                $empresaLabora->setCiudad($ciudad);
                $em->persist($empresaLabora);
                $em->flush();
                return $this->redirect($this->generateUrl('aseduis_egresados_ver', array('id' => $id)));
            }
        }

        //$empresaLabora = $em->getRepository('AseduisEgresadosBundle:Empresalabora')->findOneBy(array('egresado' => $id));
        return $this->render('AseduisEgresadosBundle:Egresados:AgregarEmpresa.html.twig', array(
                    'formEmpresaLabora' => $formEmpresaLabora->createView(),
                    'id' => $id,
                    'departamentos' => $departamento
        ));
    }

    /*
     * Recibe el id corrempondiente al idegresado del modelo Egresado
     */

    public function ModificarempresaAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $empresaLabora = new Empresalabora();
        $egresado = new Egresado();
        $departamento = new Departamento();
        $ciudad = new Ciudad();

        $departamento = $em->getRepository('AseduisEgresadosBundle:Departamento')->findAll();

        $empresaLabora = $em->getRepository('AseduisEgresadosBundle:Empresalabora')->find($id);
        $formEmpresaLabora = $this->createForm(new EmpresalaboraType, $empresaLabora);

        if ($request->getMethod() == 'POST') {
            $formEmpresaLabora->handleRequest($request);

            if ($formEmpresaLabora->isValid()) {
                $c = $request->request->get('listaCiudadEmpresa');
                if ($c) {
                    $ciudad = $em->getRepository('AseduisEgresadosBundle:Ciudad')->find($c);
                    $empresaLabora->setCiudad($ciudad);
                }
                $em->persist($empresaLabora);
                $em->flush();
                return $this->redirect($this->generateUrl('aseduis_egresados_ver', array('id' => $id)));
            }
        }

        //$empresaLabora = $em->getRepository('AseduisEgresadosBundle:Empresalabora')->findOneBy(array('egresado' => $id));
        return $this->render('AseduisEgresadosBundle:Egresados:ModificarEmpresa.html.twig', array(
                    'formEmpresaLabora' => $formEmpresaLabora->createView(),
                    'id' => $id,
                    'empresaLabora' => $empresaLabora,
                    'departamentos' => $departamento
        ));
    }

    /*
     * Recibe el id correspondiente al idempresalabora del modelo Empresalabora
     */

    public function EliminarempresaAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $empresaLabora = new Empresalabora();
        $empresaLabora = $em->getRepository('AseduisEgresadosBundle:Empresalabora')->find($id);
        $idEgresado = $empresaLabora->getEgresado()->getIdegresado();

        $em->remove($empresaLabora);
        $em->flush();

        return $this->redirect($this->generateUrl('aseduis_egresados_ver', array('id' => $idEgresado)));
    }

    /*
     * 
     * PROGRAMA ACÁDEMICO EGRESADO
     * 
     */


    /*
     * Recibe el id correspondiente al idegresado del modelo Egresado
     */

    public function AgregarprogramaacademicoAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $egresadoProgramaAcademico = new EgresadoProgramaacademico();
        $tipoProgramaAcademico = new Tipoprogramaacademico();
        $programaAcademico = new Programaacademico();
        $egresado = new Egresado();

        $tipoProgramaAcademico = $em->getRepository('AseduisEgresadosBundle:Tipoprogramaacademico')->findAll();

        $formEgresadoProgramaAcademico = $this->createForm(new EgresadoProgramaacademicoType, $egresadoProgramaAcademico);

        if ($request->getMethod() == "POST") {
            $formEgresadoProgramaAcademico->handleRequest($request);
            $pa = $request->request->get('listaProgramaAcademico');
            if ($formEgresadoProgramaAcademico->isValid() && $pa) {
                $programaAcademico = $em->getRepository('AseduisEgresadosBundle:Programaacademico')->find($pa);
                $egresado = $em->getRepository('AseduisEgresadosBundle:Egresado')->find($id);
                $egresadoProgramaAcademico->setEgresado($egresado);
                $egresadoProgramaAcademico->setProgramaacademico($programaAcademico);

                $em->persist($egresadoProgramaAcademico);
                $em->flush();

                return $this->redirect($this->generateUrl('aseduis_egresados_ver', array('id' => $id)));
            }
        }

        return $this->render('AseduisEgresadosBundle:Egresados:AgregarProgramaAcademico.html.twig', array(
                    'formEgresadoProgramaAcademico' => $formEgresadoProgramaAcademico->createView(),
                    'id' => $id,
                    'tipoProgramaAcademico' => $tipoProgramaAcademico
        ));
    }

    /*
     * Recibe el id correspondiente al idegresadoProgramaacademico del modelo EgresadoProgramaacademico
     */

    public function EliminarprogramaacademicoAction($id) {
        $em = $this->getDoctrine()->getManager();
        $egresadoProgramaAcademico = new EgresadoProgramaacademico();

        $egresadoProgramaAcademico = $em->getRepository('AseduisEgresadosBundle:EgresadoProgramaacademico')->find($id);
        $idegresado = $egresadoProgramaAcademico->getEgresado()->getIdegresado();
        $em->remove($egresadoProgramaAcademico);
        $em->flush();
        return $this->redirect($this->generateUrl('aseduis_egresados_ver', array('id' => $idegresado)));
    }

}
