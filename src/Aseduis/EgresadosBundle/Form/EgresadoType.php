<?php

namespace Aseduis\EgresadosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EgresadoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identificacion')
            ->add('primernombre')
            ->add('segundonombre')
            ->add('primerapellido')
            ->add('segundoapellido')
            ->add('direccionresidencia')
            ->add('telefonofijo')
            ->add('celular')
            ->add('egresadouis')
            ->add('noticias')
            ->add('fecharegistro')
            ->add('genero')
            ->add('ciudad')
            ->add('tipoidentificacion')
            ->add('user')
            ->add('tiposangre')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Aseduis\EgresadosBundle\Entity\Egresado'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'aseduis_egresadosbundle_egresado';
    }
}
