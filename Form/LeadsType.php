<?php

namespace Emtags\Bundle\NewsletterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LeadsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('lastDispatch')
            ->add('enable')
            ->add('tag')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emtags\Bundle\NewsletterBundle\Entity\Leads'
        ));
    }

    public function getName()
    {
        return 'emtags_bundle_newsletterbundle_leadstype';
    }
}
