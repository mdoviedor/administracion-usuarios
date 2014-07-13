<?php

namespace Aseduis\EgresadosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdministradorType extends AbstractType {

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
                ->add('nombres', 'text', array(
                    'label' => '* Nombres:',
                    'attr' => array('class' => 'form-control')))
                ->add('apellidos', 'text', array(
                    'label' => '* Apellidos:',
                    'attr' => array('class' => 'form-control')))
//                ->add('fecharegistro')
//                ->add('user')
                ->add('tipoidentificacion', 'entity', array(
                    'class' => 'AseduisEgresadosBundle:Tipoidentificacion',
                    'property' => 'nombre',
                    'label' => '* Tipo de Identificación:',
                    'attr' => array('class' => 'form-control')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Aseduis\EgresadosBundle\Entity\Administrador'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'aseduis_egresadosbundle_administrador';
    }

}
