<?php

namespace Test\AuthBundle;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class TestUserProvider implements UserProviderInterface
{
	public function loadUserByUsername($username)
	{
		return new TestUser($username);
	}

	public function refreshUser(UserInterface $user)
	{
		if ($this->supportsClass(get_class($user)))
		{
			return $this->loadUserByUsername($user->getUsername());
		}

		return new UnsupportedUserException();
	}

	public function supportsClass($class)
	{
		return 'Test\\AuthBundle\\TestUser' === $class;
	}
}
