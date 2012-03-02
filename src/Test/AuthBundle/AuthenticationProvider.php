<?php

namespace Test\AuthBundle;

use Symfony\Component\Security\Core\Authentication\Provider\UserAuthenticationProvider;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\RouterInterface;
use RuntimeException;

class AuthenticationProvider extends UserAuthenticationProvider
{
	protected $router;

	public function setRouter(RouterInterface $router)
	{
		$this->router = $router;
	}

    protected function retrieveUser($username, UsernamePasswordToken $token)
    {
        if ($this->router) {
        	$url = $this->router->generate('auth', array(
        		'req_name' => $username, 
        		'req_password' => $token->getCredentials()
        	), true);

        	$response = @file_get_contents($url);
        	if (strpos($response, 'AUHENTICATION_SUCCESS' ) !== false) {
        		return new TestUser($username);
        	}

        	throw new UsernameNotFoundException('Username invalid or password incorrect.');
        }

        throw new RuntimeException("No router has been set");
    }

    protected function checkAuthentication(UserInterface $user, UsernamePasswordToken $token)
    {}
}
