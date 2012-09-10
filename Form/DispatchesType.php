<?php

namespace Emtags\Bundle\NewsletterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DispatchesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('date')
            ->add('campaign')
            ->add('lead')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emtags\Bundle\NewsletterBundle\Entity\Dispatches'
        ));
    }

    public function getName()
    {
        return 'emtags_bundle_newsletterbundle_dispatchestype';
    }
}
