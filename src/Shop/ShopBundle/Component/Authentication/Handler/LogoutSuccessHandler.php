<?php

namespace Shop\ShopBundle\Component\Authentication\Handler;
 
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\Router;
 
class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
    
    protected $router;
    
    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    
    public function onLogoutSuccess(Request $request)
    {
        // redirect the user to where they were before the login process begun.
        $response = new RedirectResponse($this->router->generate('shop_shop_homepage'));
                    
//        $response = new RedirectResponse($referer_url);        
        return $response;
    }
    
}