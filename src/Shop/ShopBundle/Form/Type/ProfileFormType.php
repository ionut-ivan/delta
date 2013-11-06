<?php

// src/Shop/ShopBundle/Form/Type/RegistrationFormType.php

namespace Shop\ShopBundle\Form\Type;

use Shop\ShopBundle\Entity\User;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType {

    public function __construct() {
        $this->class = "shop_shop_edituser";
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $user = new User();
        
        // add your custom field
        $builder->add('firstName');
        $builder->add('lastName');
        $builder->add('mobile');
        $builder->add('gender', 'choice', array(
            'choices' => array("Male", "Female"),
            'expanded' => true,
            'multiple' => false,
            'required' => true,
            'data' => '0'
        ));
        $builder->add('roles', 'choice', array(
//            'choices'=> array('choice'=>$user->getRoles()),
            'choices' => array('Admin', 'User'),
            'expanded' => true,
            'multiple' => false,
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Shop\ShopBundle\Entity\User'
//            'data_class' => null
        ));
    }

    public function getName() {
        return 'shop_user_profile';
    }

}

