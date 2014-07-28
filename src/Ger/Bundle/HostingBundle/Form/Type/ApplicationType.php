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

class ApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $entity = $builder->getData();
        if($entity instanceof Application) {
            $entity_id = $entity->getId();
        } else {
            $entity_id = null;
        }
        $builder
            ->add('name')
            ->add('depends_on_applications','entity', array(
                'class' => 'Ger\Bundle\HostingBundle\Entity\Application',
                'property' => 'name',
                'query_builder' => function(EntityRepository $er) use ($entity_id) {

                            $qb = $er->createQueryBuilder('a')
                                ->orderBy('a.name', 'ASC');
                        if($entity_id) {
                            $qb->where($qb->expr()->notIn('a.id', $entity_id));
                        }
                        return $qb;

                    },
                'multiple' => true,
                'attr' => array(
                    'class' => 'chzn-select',
                    'data-placeholder' => 'Dépend des applications...'
                )
            ))
            ->add('require_databases', 'collection', array(
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'type' => 'ger_hosting_application_database',
                'cascade_validation' => true
            ))
            ->add('caching_mechanisms', 'collection', array(
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'type' => 'ger_hosting_application_caching',
                'cascade_validation' => true
            ))
            ->add('produce_messages', 'collection', array(
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'type' => 'ger_hosting_application_produce_message',
                'cascade_validation' => true
            ))
            ->add('consume_messages', 'collection', array(
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'type' => 'ger_hosting_application_consume_message',
                'cascade_validation' => true
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ger\Bundle\HostingBundle\Entity\Application',
            'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'ger_hosting_application';
    }
}