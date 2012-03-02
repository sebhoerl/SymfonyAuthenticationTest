<?php

namespace Test\AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    /**
     * @Route("/auth/{req_name}/{req_password}", name="auth")
     */
    public function authAction($req_name, $req_password)
    {
        $users = array(
			'user1' => 'password1',
			'user2' => 'password2',
			'user3' => 'password3',
		);

		foreach($users as $name => $password) {
			if ($name === $req_name && $password === $req_password) {
				return new Response("AUHENTICATION_SUCCESS");
			}
		}

		return new Response("AUHENTICATION_FAIL");
    }

    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction()
    {
    	return array();
    }

    /**
     * @Route("/secured", name="secured")
     * @Template()
     */
    public function securedAction()
    {
        return array();
    }

    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction()
    {
        $error = $this->getRequest()->attributes->has(SecurityContext::AUTHENTICATION_ERROR);
    	return array('error' => $error);
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {}

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutCheckAction()
    {}
}
