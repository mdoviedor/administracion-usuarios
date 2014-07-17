<?php

namespace Aseduis\EgresadosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EgresadoProgramaacademicoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $ahora = \date('Y');
        $builder
                ->add('fechagrado', 'date', array(
                    'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
                    'years' => range(1960, $ahora + 2),
                    'label' => ' Fecha de grado:',
                    'required' => false,
                ))
//                ->add('programaacademico', 'entity', array(
//                    'class' => 'AseduisEgresadosBundle:Programaacademico',
//                    'property' => 'nombre',
//                    'label' => '* Programa Académico:',
//                    'attr' => array('class' => 'form-control')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Aseduis\EgresadosBundle\Entity\EgresadoProgramaacademico'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'aseduis_egresadosbundle_egresadoprogramaacademico';
    }

}
