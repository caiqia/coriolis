<?php

namespace Radius\PrepodBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserinfoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username')->add('firstname')->add('lastname')->add('email')->add('department')->add('company')->add('workphone')->add('homephone')->add('mobilephone')->add('address')->add('city')->add('state')->add('country')->add('zip')->add('notes')->add('changeuserinfo')->add('portalloginpassword')->add('enableportallogin')->add('creationdate')->add('creationby')->add('updatedate')->add('updateby');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Radius\PrepodBundle\Entity\Userinfo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'radius_prepodbundle_userinfo';
    }


}
