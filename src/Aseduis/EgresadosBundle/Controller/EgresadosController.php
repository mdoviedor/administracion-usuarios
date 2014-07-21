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

        try {
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

                    $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                            'notice', 'La acción se ha realizado con exito.'
                    );
                    return $this->redirect($this->generateUrl('aseduis_egresados_buscar'));
                } else {

                    $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                            'error', 'La acción no se ha realizado. Intentelo de nuevo.'
                    );
                }
            }


            return $this->render('AseduisEgresadosBundle:Egresados:Crear.html.twig', array(
                        'formEgresado' => $formEgresado->createView(),
                        'departamentos' => $departamento
            ));
        } catch (\Exception $exc) {
            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'error', 'La acción no se ha realizado. El usuario que esta intando registrar ya existe. Intentelo de nuevo.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_crear'));
        }
    }

    /*
     * Recibe el id correspondiente al idegresado del Modelo Egresado
     */

    public function ModificarAction(Request $request, $id) {

        try {
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

                    $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                            'notice', 'La acción se ha realizado con exito.'
                    );
                    return $this->redirect($this->generateUrl('aseduis_egresados_buscar'));
                } else {
                    $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                            'error', 'La acción no se ha realizado. Intentelo de nuevo.'
                    );
                }
            }

            return $this->render('AseduisEgresadosBundle:Egresados:Modificar.html.twig', array(
                        'formEgresado' => $formEgresado->createView(),
                        'departamentos' => $departamento,
                        'egresado' => $egresado
            ));
        } catch (\Exception $exc) {
            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'error', 'La acción no se ha realizado. El usuario que esta intando registrar ya existe. Intentelo de nuevo.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_buscar'));
        }
    }

    /*
     * Recibe el id correspondiente al idegresado del Modelo Egresado
     */

    public function EliminarAction($id) {
        try {
            $em = $this->getDoctrine()->getManager();
            $egresado = new Egresado();
            $user = new User();
            $egresado = $em->getRepository('AseduisEgresadosBundle:Egresado')->find($id);
            $user = $em->getRepository('AseduisUserBundle:User')->find($egresado->getUser()->getId());
            $em->remove($user);
            $em->flush();
            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'notice', 'La acción se ha realizado con exito.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_buscar'));
        } catch (\Exception $exc) {
            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'error', 'La acción no se ha realizado. Intentelo de nuevo.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_buscar'));
        }
    }

    public function BuscarAction($limite, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $egresado = new Egresado();
        $programaAcademico = new Programaacademico();

        $programaAcademico = $em->getRepository('AseduisEgresadosBundle:Programaacademico')->findAll();
        $egresado = $em->getRepository('AseduisEgresadosBundle:Egresado')->findBy(array(), array('idegresado' => 'DESC'), $limite);

        return $this->render('AseduisEgresadosBundle:Egresados:Buscar.html.twig', array(
                    'egresados' => $egresado,
                    'limite' => $limite,
                    'programaAcademico' => $programaAcademico
        ));
    }

    public function BusquedafiltrosAction(Request $request, $limite) {
        $em = $this->getDoctrine()->getManager();
        $egresado = new Egresado();

        if ($request->getMethod() == "POST") {
            $primerNombre = $request->request->get('campoPrimerNombre');
            $segundoNombre = $request->request->get('campoSegundoNombre');
            $primerApellido = $request->request->get('campoPrimerApellido');
            $segundoApellido = $request->request->get('campoSegundoApellido');
            $identificacion = $request->request->get('campoNumeroDocumentoIdentidad');
            $programaAcademico = $request->request->get('listaProgramaAcademico');
            $desde = $request->request->get('campoDesde');
            $hasta = $request->request->get('campoHasta');

            if (!$primerNombre) {
                $primerNombre = "XXX";
            }

            if (!$segundoNombre) {
                $segundoNombre = "XXX";
            }

            if (!$primerApellido) {
                $primerApellido = "XXX";
            }

            if (!$segundoApellido) {
                $segundoApellido = "XXX";
            }

            if (!$identificacion) {
                $identificacion = "XXX";
            }
            if (!$desde) {
                $desde = "00/00/0000";
            }

            if (!$hasta) {
                $hasta = "00/00/0001";
            }

            if ($programaAcademico == '0') {
                $programaAcademico = "XXX";
            }
            $egresado = $em->getRepository('AseduisEgresadosBundle:Egresado')->busquedaFiltros($identificacion, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $desde, $hasta, $programaAcademico, $limite);

            return $this->render('AseduisEgresadosBundle:Egresados:Busquedafiltros.html.twig', array(
                        'egresados' => $egresado,
            ));
        }
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
                $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                        'notice', 'La acción se ha realizado con exito.'
                );
                return $this->redirect($this->generateUrl('aseduis_egresados_ver', array('id' => $id)));
            } else {
                $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                        'error', 'La acción no se ha realizado. Intentelo de nuevo.'
                );
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

        $empresaLabora = $em->getRepository('AseduisEgresadosBundle:Empresalabora')->findOneBy(array('egresado' => $id));
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

                $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                        'notice', 'La acción se ha realizado con exito.'
                );
                return $this->redirect($this->generateUrl('aseduis_egresados_ver', array('id' => $id)));
            } else {
                $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                        'error', 'La acción no se ha realizado. Intentelo de nuevo.'
                );
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
        try {
            $em = $this->getDoctrine()->getManager();
            $empresaLabora = new Empresalabora();
            $empresaLabora = $em->getRepository('AseduisEgresadosBundle:Empresalabora')->find($id);
            $idEgresado = $empresaLabora->getEgresado()->getIdegresado();

            $em->remove($empresaLabora);
            $em->flush();

            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'notice', 'La acción se ha realizado con exito.'
            );

            return $this->redirect($this->generateUrl('aseduis_egresados_ver', array('id' => $idEgresado)));
        } catch (\Exception $exc) {
            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'error', 'La acción no se ha realizado. Intentelo de nuevo.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_buscar'));
        }
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

                $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                        'notice', 'La acción se ha realizado con exito.'
                );
                return $this->redirect($this->generateUrl('aseduis_egresados_ver', array('id' => $id)));
            } else {
                $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                        'error', 'La acción no se ha realizado. Intentelo de nuevo.'
                );
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
        try {
            $em = $this->getDoctrine()->getManager();
            $egresadoProgramaAcademico = new EgresadoProgramaacademico();

            $egresadoProgramaAcademico = $em->getRepository('AseduisEgresadosBundle:EgresadoProgramaacademico')->find($id);
            $idegresado = $egresadoProgramaAcademico->getEgresado()->getIdegresado();
            $em->remove($egresadoProgramaAcademico);
            $em->flush();
            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'notice', 'La acción se ha realizado con exito.'
            );

            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'notice', 'La acción se ha realizado con exito.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_ver', array('id' => $idegresado)));
        } catch (\Exception $exc) {
            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'error', 'La acción no se ha realizado. Intentelo de nuevo.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_buscar'));
        }
    }

    /*
     * 
     * CORREO ELECTRONICO
     * 
     */


    /*
     * Recibe el id correspondiente al idegresado del modelo Egresado
     */

    public function EnviarcorreoelectronicoAction(Request $request, $id) {

        $egresado = new Egresado();
        $em = $this->getDoctrine()->getManager();
        $egresado = $em->getRepository('AseduisEgresadosBundle:Egresado')->find($id);
        $mensaje = $request->request->get('editor');
        $asunto = $request->request->get('campoAsunto');



        if ($asunto && $mensaje) {
            $mensaje = html_entity_decode($mensaje);

            $message = \Swift_Message::newInstance() //Enviar mensaje via correo electrónico
                    ->setSubject($asunto)
                    ->setFrom('webmaster@aseduis.org')
                    ->setTo($egresado->getUser()->getEmail())
                    ->setBody(
                    $this->renderView(
                            'AseduisEgresadosBundle:Egresados:email.html.twig', array('mensaje' => $mensaje)
                    ), 'text/html');
            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'notice', 'La acción se ha realizado con exito.'
            );

            return $this->redirect($this->generateUrl('aseduis_egresados_ver', array('id' => $id)));
        }


        return $this->render('AseduisEgresadosBundle:Egresados:EmailPersonal.html.twig', array(
                    'id' => $id
        ));
    }

    /*
     * 
     * CORREO MASIVO
     * 
     */

    /*
     * Pagina de selección
     */

    public function EnviarcorreoelectronicomasivoAction(Request $request) {
        try {
            $em = $this->getDoctrine()->getManager();

            $tipoProgramaAcademico = new Programaacademico();

            $tipoProgramaAcademico = $em->getRepository('AseduisEgresadosBundle:Tipoprogramaacademico')->findAll();

            if ($request->getMethod() == 'POST') {
                $id = $request->request->get('listaProgramaAcademico');
                if ($id) {
                    return $this->redirect($this->generateUrl('aseduis_egresados_enviarcorreoelectronicomasivopa', array('id' => $id)));
                }
            }

            return $this->render('AseduisEgresadosBundle:Egresados:EmailMasivo.html.twig', array(
                        'tipoProgramaAcademico' => $tipoProgramaAcademico
            ));
        } catch (\Exception $exc) {
            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'error', 'La acción no se ha realizado. Intentelo de nuevo.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_buscar'));
        }
    }

    /*
     * Recibe el id correspondiente al idprogramacademico del Modelo Programaacademico
     * 
     * Esta Acción permite enviar correos masivos por programas académicos  . 
     */

    public function EnviarcorreoelectronicomasivopaAction(Request $request, $id) {
        try {
            $em = $this->getDoctrine()->getManager();
            $egresadoProgramaAcademico = new EgresadoProgramaacademico();
            $programaAcademico = new Programaacademico();

            if ($request->getMethod() == "POST") {
                $asunto = $request->request->get('campoAsunto');
                $mensaje = $request->request->get('editor');
                if ($asunto && $mensaje) {
                    $mensaje = html_entity_decode($mensaje);
                    $egresadoProgramaAcademico = $em->getRepository('AseduisEgresadosBundle:EgresadoProgramaacademico')->findBy(array('programaacademico' => $id));

                    foreach ($egresadoProgramaAcademico as $value) {
                        if ($value->getEgresado()->getNoticias()) { // Si el usuario acepto recibir noticias
                            $para = $value->getEgresado()->getUser()->getEmail();

                            $message = \Swift_Message::newInstance() //Enviar mensaje via correo electrónico
                                    ->setSubject($asunto)
                                    ->setFrom('webmaster@aseduis.org')
                                    ->setTo($para)
                                    ->setBody(
                                    $this->renderView(
                                            'AseduisEgresadosBundle:Egresados:email.html.twig', array('mensaje' => $mensaje)
                                    ), 'text/html');
                            $this->get('mailer')->send($message);
                        }
                    }
                    $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                            'notice', 'La acción se ha realizado con exito.'
                    );
                    return $this->redirect($this->generateUrl('aseduis_egresados_enviarcorreoelectronicomasivo'));
                } else {
                    $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                            'error', 'La acción no se ha realizado.'
                    );
                }
            }



            $programaAcademico = $em->getRepository('AseduisEgresadosBundle:Programaacademico')->find($id);

            return $this->render('AseduisEgresadosBundle:Egresados:EmailMasivoPa.html.twig', array(
                        'id' => $id,
                        'programaAcademico' => $programaAcademico
            ));
        } catch (\Exception $exc) {
            $this->get('session')->getFlashBag()->add(//Mensaje flash. Notificación de exito de la operación.
                    'error', 'La acción no se ha realizado. Intentelo de nuevo.'
            );
            return $this->redirect($this->generateUrl('aseduis_egresados_crear'));
        }
    }

    public function EnviarcorreoelectronicomasivointervaloAction(Request $request) {
        
    }

}
