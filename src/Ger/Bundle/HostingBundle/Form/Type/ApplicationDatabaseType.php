<?php
/**
 * Created by PhpStorm.
 * User: tcordier
 * Date: 30/06/14
 * Time: 17:42
 */

namespace Ger\Bundle\HostingBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Ger\Bundle\HostingBundle\Entity\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ApplicationDatabaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name')
            ->add('description')
            ->add('type','entity', array(
                'class' => 'Ger\Bundle\HostingBundle\Entity\DatabaseType',
                'property' => 'name',
                'attr' => array(
                    'class' => 'chzn-select',
                    'data-placeholder' => 'Sélectionner un Type de Bdd'
                )
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ger\Bundle\HostingBundle\Entity\ApplicationDatabase'
        ));
    }

    public function getName()
    {
        return 'ger_hosting_application_database';
    }
}