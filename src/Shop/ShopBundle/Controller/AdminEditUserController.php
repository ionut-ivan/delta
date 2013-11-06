<?php

namespace Shop\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Shop\ShopBundle\Form\Type\ProfileFormType;
//use FOS\UserBundle\Model\UserManagerInterface;

////use Symfony\Component\Console\Application;
//use Symfony\Bundle\FrameworkBundle\Console\Application;
//use FOS\UserBundle\Command\PromoteUserCommand;
//
//use Symfony\Component\Console\Input\InputArgument;
//use Symfony\Component\Console\Input\InputInterface;
//use Symfony\Component\Console\Input\InputOption;
//use Symfony\Component\Console\Output\OutputInterface;

class AdminEditUserController extends Controller {

//    private $userManager;
//
//    public function __construct(UserManagerInterface $userManager) {
//        $this->userManager = $userManager;
//    }

    public function editUserAction(Request $request, $id) {



        $em = $this->getDoctrine()
                ->getManager();
        $message='';
        $user = $em->getRepository('ShopShopBundle:User')->find($id);
//        var_dump($user);die();
        $form = $this->createForm(new ProfileFormType(), $user);
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
//            if ($form->isValid()) {
                if ($request->request->get('role_choice') == 'admin') {
                    if ($user->hasRole('ROLE_ADMIN')){
                        $message='alreadythere';
//                        var_dump($message);die();
                        return $this->render('FOSUserBundle:Profile:edit_content_admin.html.twig', array('id' => $id, 'form' => $form->createView(),'user'=> $user));
                    }
                    else{
                        $user->addRole('ROLE_ADMIN');
                         $message='promoted';
//                        var_dump($message,$user);die();
//                        $this->userManager->updateUser($user);
                        $em->flush();
                        return $this->render('FOSUserBundle:Profile:edit_content_admin.html.twig', array('id' => $id, 'form' => $form->createView(),'user'=> $user));
                    }
                }
                if ($request->request->get('role_choice') == 'user') {
                   if ($user->hasRole('ROLE_ADMIN')){
                        $message='demoted';
                        $user->removeRole('ROLE_ADMIN');
//                         var_dump($message,$user);die();
//                        $this->userManager->updateUser($user);
                         $em->flush();
                        return $this->render('FOSUserBundle:Profile:edit_content_admin.html.twig', array('id' => $id, 'form' => $form->createView(),'user'=> $user));
                    }
                    else{ 
                        $message='not admin';
//                        var_dump($message);die();
                        return $this->render('FOSUserBundle:Profile:edit_content_admin.html.twig', array('id' => $id, 'form' => $form->createView(),'user'=> $user));
                       
                    }
                }
//            }
        }
        

//var_dump('wtF?');die();
        return $this->render('FOSUserBundle:Profile:edit_content_admin.html.twig', array('id' => $id, 'form' => $form->createView(),'user'=> $user));
    }

}
