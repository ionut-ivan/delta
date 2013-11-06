<?php

namespace Shop\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\ProfileController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Shop\ShopBundle\Form\Type\ProfileFormType;

class AdminEditUserController extends Controller {

    public function editUserAction(Request $request, $id) {



        $em = $this->getDoctrine()
                ->getManager();

        $user = $em->getRepository('ShopShopBundle:User')->find($id);
        $form = $this->createForm(new ProfileFormType(), $user);
        if ('POST' === $request->getMethod()) {
//            var_dump($request->request->get())
            $form->bind($request);
            
            if ($form->getData()->getRoles()[0] == 'ROLE_ADMIN'){
                $user->addRole('ROLE_ADMIN');
            }else{
                $user->removeRole('ROLE_ADMIN');
                $user->removeRole('ROLE_USER');
            }
//            $em->flush();
            var_dump($user->getRoles());die();
        }


        return $this->render('FOSUserBundle:Profile:edit_content_admin.html.twig', array('id' => $id, 'form' => $form->createView()));
    }

}
