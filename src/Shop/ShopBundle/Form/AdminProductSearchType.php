<?php

namespace Shop\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class AdminProductSearchType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('title', 'search', array('required'=>false))
                ->add('category', 'entity', array(
                    'empty_value' => 'All',
                    'required'=>false,
                    'class' => 'ShopShopBundle:Category',
                    'property' => 'category_name',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('c');
                    },
                ))
                ->add('stock', 'checkbox', array('label' => 'stock', 'required'=>false))
                ->add('submit', 'submit', array('attr' => array('class' => "form-submit")))
//            ->add('reset', 'button', array('attr' => array('class'=>"form-reset")))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
//            'data_class' => 'Shop\ShopBundle\Entity\Category'
            'data_class' => null
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'shop_shopbundle_product';
    }

}
