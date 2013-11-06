<?php

namespace Shop\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class AdminAddProductType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
//  protected $em;

//    public function __construct(EntityManager $em) {
//        $this->em = $em;
//    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('title', 'text', array('attr' => array('class' => "inp-form")))
                ->add('category_id', 'entity', array(
                    'required' => true,
                    'class' => 'ShopShopBundle:Category',
                    'property' => 'category_name',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('c');
                    },
                ))
                ->add('short_description', 'text', array('attr' => array('class' => "inp-form",)))
                ->add('price', 'integer', array('attr' => array('class' => "inp-form",)))
                ->add('author_id', 'integer', array('attr' => array('class' => "inp-form",)))
                ->add('isbn', 'integer', array('attr' => array('class' => "inp-form",)))
                ->add('appearance_year', 'integer', array('attr' => array('class' => "inp-form",)))
                ->add('filename', 'file', array('attr' => array('class' => "file_1",)))
                ->add('description', 'textarea', array('attr' => array('class' => "inp-form", 'max_length' => 500,)))
                ->add('stock', 'integer', array('attr' => array('class' => "inp-form",)))
                ->add('submit', 'submit', array('attr' => array('class' => "form-submit")))
                ->add('reset', 'button', array('attr' => array('class' => "form-reset")))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Shop\ShopBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'shop_shopbundle_product';
    }

}
