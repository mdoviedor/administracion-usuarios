<?php

namespace Aseduis\EgresadosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresalaboraType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', 'text', array(
                    'required' => true,
                    'label' => '* Nombre:',
                    'attr' => array('class' => 'form-control')))
                ->add('direccion', 'text', array(
                    'required' => false,
                    'label' => 'Dirección:',
                    'attr' => array('class' => 'form-control')))
                ->add('telefono', 'text', array(
                    'required' => false,
                    'label' => 'Teléfono:',
                    'attr' => array('class' => 'form-control')))
                ->add('cargo', 'text', array(
                    'required' => false,
                    'label' => 'Cargo:',
                    'attr' => array('class' => 'form-control')))
//            ->add('ciudad')
//            ->add('egresado')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Aseduis\EgresadosBundle\Entity\Empresalabora'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'aseduis_egresadosbundle_empresalabora';
    }

}
