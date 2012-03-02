<?php

namespace Test\AuthBundle;

use Symfony\Component\Security\Core\User\UserInterface;
use Serializable;

class TestUser implements UserInterface
{
	private $name;

	public function __construct($name)
	{
		$this->name = $name;
	}

    public function getRoles()
    {
    	return array('ROLE_IS_TEST_AUTHED');
    }


    public function getPassword()
    {}

    public function getSalt()
    {}

    public function getUsername()
    {
    	return $this->name;
    }

    public function eraseCredentials()
    {}

    public function equals(UserInterface $user)
    {
    	return $user instanceof TestUser && $user->getUsername() == $this->name;
    }
}