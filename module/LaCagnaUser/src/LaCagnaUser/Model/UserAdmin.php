<?php
/**
 * User admin model class
 *
 * @package Model
 */

namespace LaCagnaUser\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use LaCagnaUser\Entity\Bookmark as Favorite;

class UserAdmin implements ServiceLocatorAwareInterface
{
	protected $em;
    protected $servicelocator;

	public function getList()
	{
		$qb = $this->getEntityManager()->createQueryBuilder();
		$qb->select('u')
		    ->from('LaCagnaUser\Entity\User', 'u');

		$qb->orderBy('u.username', 'DESC');
		$query = $qb->getQuery();
		$results = $query->getResult();

		return $results;
	}

	public function getUser($userId)
	{
		$user = $this->getEntityManager()
				->getRepository('LaCagnaUser\Entity\User')->find($userId);
		return $user;
	}

	public function updateUser($aParams)
	{
		$user = null;
		if(isset($aParams['user_id']))
		{
			$user = $this->getUser($aParams['user_id']);
			if($user)
			{
				$user->setUsername($aParams['user_name']);
				$user->setEmail($aParams['user_email']);
				$user->setDisplayName($aParams['user_display_name']);
				if(@$aParams['role_id'])
				{
					$user = $this->updateRole($user,$aParams['role_id']);
				}
				//$user->setState();
				$this->getEntityManager()->persist($user);
		        $this->getEntityManager()->flush();
			}
		}
		return $user;
	}

	public function updateRole($user, $roleId)
	{
		$newrole = $this->getEntityManager()
				->getRepository('LaCagnaUser\Entity\Role')->find($roleId);
		foreach($user->getRoles() as $role)
		{
			$user->removeRole($role);
		}
		$user->addRole($newrole);
		return $user;
	}

	public function getRoles()
	{
		$roles = $this->getEntityManager()
				->getRepository('LaCagnaUser\Entity\Role')->findAll();

		//echo '<pre>';\Doctrine\Common\Util\Debug::dump($user->getRoles());die();
		return $roles;
	}

    public function getEntityManager()
    {
        if (null === $this->em)
        {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->servicelocator;
    }

}
