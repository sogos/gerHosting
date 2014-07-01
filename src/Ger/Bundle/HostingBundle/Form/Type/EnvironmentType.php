<?php
/**
 * Created by PhpStorm.
 * User: tcordier
 * Date: 30/06/14
 * Time: 17:42
 */

namespace Ger\Bundle\HostingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnvironmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ger\Bundle\HostingBundle\Entity\Environment'
        ));
    }

    public function getName()
    {
        return 'ger_hosting_environment';
    }
}