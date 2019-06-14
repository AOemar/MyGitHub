<?php
/**
 * Created by PhpStorm.
 * User: K2
 * Date: 24-5-2019
 * Time: 12:11
 */

namespace AppBundle\Handler;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $router;

    protected $authorizationChecker;

    public function __construct(RouterInterface $router, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if($this->authorizationChecker->isGranted('ROLE_ADMIN'))
        {
            $response = new RedirectResponse($this->router->generate('admin'));
        }
        elseif($this->authorizationChecker->isGranted('ROLE_USER'))
        {
            $response = new RedirectResponse($this->router->generate('user'));
        }
        elseif($this->authorizationChecker->isGranted('ROLE_IJSMAKER'))
        {
            $response = new RedirectResponse($this->router->generate('ijsmaker'));
        }

        return $response;
    }
}