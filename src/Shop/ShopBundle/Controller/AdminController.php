<?php

namespace Shop\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Shop\ShopBundle\Form\AdminProductSearchType;
use Shop\ShopBundle\Form\AdminEditProductType;
use Shop\ShopBundle\Form\AdminAddProductType;

class AdminController extends Controller {

    public function userListAction() {

        $em = $this->getDoctrine()
                ->getManager();

        //paginator stie query, nu entitati. Pentru sortare merge createQuery. Nu functioneaza din repository.
        $users = $em->createQuery("SELECT u FROM ShopShopBundle:User u");
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $users, $this->get('request')->query->get('page', 1)/* page number */, 3/* limit per page */);

        return $this->render('ShopShopBundle:Admin:AdminUserList.html.twig', array('users' => $pagination));
    }

    public function disableUserAction($id) {

        $em = $this->getDoctrine()
                ->getManager();

        $user = $em->getRepository('ShopShopBundle:User')->find($id);
        $user->setEnabled(false);
        $em->flush();

        return $this->redirect($this->getRequest()->headers->get("referer"));
    }

    public function enableUserAction($id) {

        $em = $this->getDoctrine()
                ->getManager();

        $user = $em->getRepository('ShopShopBundle:User')->find($id);
        $user->setEnabled(true);
        $em->flush();

        return $this->redirect($this->getRequest()->headers->get("referer"));
    }

//    public function editUserAction($id) {
//
//        $em = $this->getDoctrine()
//                ->getManager();
//
//        $user = $em->getRepository('ShopShopBundle:User')->find($id);
//
//        return $this->render('FOSUserBundle:Profile:edit_content_admin.html.twig');
//    }

    public function productListAction() {
        $em = $this->getDoctrine()
                ->getManager();

        $products = $em->createQuery("SELECT p FROM ShopShopBundle:Product p");
        $form = $this->createForm(new AdminProductSearchType());
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $products, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */);

        return $this->render('ShopShopBundle:Admin:AdminProductList.html.twig', array('products' => $pagination, 'form' => $form->createView()));
    }

    public function productSearchAction(Request $request) {
        $em = $this->getDoctrine()
                ->getManager();

        $form = $this->createForm(new AdminProductSearchType());
        $form->bind($request);
        $title = $form->getData()['title'];
        $stock = $form->getData()['stock'];
        if ($form->getData()['category'] == null) {
            $cat = null;
        } else {
            $cat = $form->getData()['category']->getId();
        }
        $searchresult = $em->getRepository('ShopShopBundle:Product')->AdminSearch($title, $stock, $cat);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $searchresult, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */);

        return $this->render('ShopShopBundle:Admin:AdminProductList.html.twig', array('products' => $pagination, 'form' => $form->createView()));
    }

    public function disableProductAction($id) {

        $em = $this->getDoctrine()
                ->getManager();

        $product = $em->getRepository('ShopShopBundle:Product')->find($id);
        $product->setActive(false);
        $em->flush();

        return $this->redirect($this->getRequest()->headers->get("referer"));
    }

    public function enableProductAction($id) {

        $em = $this->getDoctrine()
                ->getManager();

        $product = $em->getRepository('ShopShopBundle:Product')->find($id);
        $product->setActive(true);
        $em->flush();

        return $this->redirect($this->getRequest()->headers->get("referer"));
    }

    public function editProductAction($id, Request $request) {

        $em = $this->getDoctrine()
                ->getManager();
        $message = '';
        $product = $em->getRepository('ShopShopBundle:Product')->find($id);
//        $validator = $this->get('validator');
//        $errors = $validator->validate($product);
//        var_dump($errors);
//        die();

        $form = $this->createForm(new AdminEditProductType, $product);
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            if ($form->isValid()) {
                $product->setPath('/public/image/');
                if ($form->getData()->getFilename() != null) {
                    $product->setFilename($form->getData()->getFilename()->getClientOriginalName());
                    $dir = '/web/bundles/shopshop/image';
                    $form['filename']->getData()->move($dir, $form['filename']->getData()->getClientOriginalName());
                }
            }

            $em->flush();
        }
        return $this->render('ShopShopBundle:Admin:AdminEditProduct.html.twig', array('form' => $form->createView(), 'id' => $id, 'message' => $message));
    }

    public function addProductAction(Request $request) {

        $em = $this->getDoctrine()
                ->getManager();
        $product = new \Shop\ShopBundle\Entity\Product;
        $form = $this->createForm(new AdminAddProductType, $product);
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            if ($form->isValid()) {
                if ($form->getData()->getStock() > 0) {
                    $product->setActive(1);
                } else {
                    $product->setActive(0);
                }
                $product->setPath('/public/image/');
                if ($form->getData()->getFilename() != null) {
                    $product->setFilename($form->getData()->getFilename()->getClientOriginalName());
                    $dir = '/home/iivan/Sites/delta/web/bundles/shopshop/image';
                    $form['filename']->getData()->move($dir, $form['filename']->getData()->getClientOriginalName());
                }
            }
            $product->setAuthorId(1);
            $em->persist($product);
            $em->flush();
        }

        return $this->render('ShopShopBundle:Admin:AdminAddProduct.html.twig', array('form' => $form->createView()));
    }

    public function orderListAction() {
        $em = $this->getDoctrine()
                ->getManager();

        $orders = $em->getRepository('ShopShopBundle:Order')->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $orders, $this->get('request')->query->get('page', 1)/* page number */, 3/* limit per page */);

        return $this->render('ShopShopBundle:Admin:AdminProductList.html.twig', array('orders' => $pagination));
    }

}

