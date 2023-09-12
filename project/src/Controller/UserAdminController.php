<?php

namespace App\Controller;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserAdminController extends BaseAdminController
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param User $entity
     * @return void
     */
    protected function persistEntity($entity)
    {
        $this->encodeUserPassword($entity);
        parent::persistEntity($entity);
    }

    /**
     * @param User $entity
     * @return void
     */
    protected function updateEntity($entity)
    {
        $this->encodeUserPassword($entity);
        parent::updateEntity($entity);
    }

    /**
     * @param User $entity
     * @return User
     */
    private function encodeUserPassword(User $entity): User
    {
        return $entity->setPassword($this->passwordEncoder->encodePassword($entity, $entity->getPassword()));
    }

}