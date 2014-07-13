<?php

namespace Aseduis\EgresadosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EgresadoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('identificacion', 'repeated', array(
                    'type' => 'text',
                    'invalid_message' => 'Los campos deben coincidir.',
                    'required' => true,
                    'first_options' => array(
                        'label' => '* Identificación:',
                        'attr' => array('class' => 'form-control')),
                    'second_options' => array(
                        'label' => '* Repita Identificación:',
                        'attr' => array('class' => 'form-control'))))
                ->add('correoElectronico', 'repeated', array(
                    'mapped' => false,
                    'type' => 'email',
                    'invalid_message' => 'Los campos deben coincidir.',
                    'required' => true,
                    'first_options' => array(
                        'label' => '* Correo electrónico:',
                        'attr' => array('class' => 'form-control')),
                    'second_options' => array(
                        'label' => '* Repita Correo electrónico:',
                        'attr' => array('class' => 'form-control'))))
                ->add('primernombre', 'text', array(
                    'label' => '* Primer Nombre:',
                    'attr' => array('class' => 'form-control')))
                ->add('segundonombre', 'text', array(
                    'required' => false,
                    'label' => 'Segundo Nombre:',
                    'attr' => array('class' => 'form-control')))
                ->add('primerapellido', 'text', array(
                    'label' => '* Primer Apellido:',
                    'attr' => array('class' => 'form-control')))
                ->add('segundoapellido', 'text', array(
                    'required' => false,
                    'label' => 'Segundo Apellido:',
                    'attr' => array('class' => 'form-control')))
                ->add('direccionresidencia', 'textarea', array(
                    'required' => false,
                    'label' => 'Dirección:',
                    'attr' => array('class' => 'form-control')))
                ->add('telefonofijo', 'text', array(
                    'required' => false,
                    'label' => 'Fijo:',
                    'attr' => array('class' => 'form-control')))
                ->add('celular', 'text', array(
                    'required' => false,
                    'label' => 'Celular:',
                    'attr' => array('class' => 'form-control')))
//                ->add('egresadouis')
                ->add('noticias', 'choice', array(
                    'label' => '* Enviar noticias:', //                 
                    'choices' => array(false => 'No', true => 'Si'),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true))
//                ->add('fecharegistro')
                ->add('genero', 'entity', array(
                    'class' => 'AseduisEgresadosBundle:Genero',
                    'property' => 'nombre',
                    'label' => '* Genero:',
                    'attr' => array('class' => 'form-control')))
//                ->add('ciudad')
                ->add('tipoidentificacion', 'entity', array(
                    'class' => 'AseduisEgresadosBundle:Tipoidentificacion',
                    'property' => 'nombre',
                    'label' => '* Tipo de Identificación:',
                    'attr' => array('class' => 'form-control')))
//                ->add('user')
                ->add('tiposangre', 'entity', array(
                    'class' => 'AseduisEgresadosBundle:Tiposangre',
                    'property' => 'nombre',
                    'label' => '* Tipo de Sangre:',
                    'attr' => array('class' => 'form-control')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Aseduis\EgresadosBundle\Entity\Egresado'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'aseduis_egresadosbundle_egresado';
    }

}
