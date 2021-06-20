<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Security\Core\Security;


Class GetUser
{



    public function __construct(Security $secuirty)
    {
        $this->security = $secuirty;
    }


    public function getUser()
    {

       // $user = $this->security->getUser()->getUsername();
       $user = $this->security->getUser()->getUsername();
       $userId = $this->security->getUser()->getId();
       $userEmail = $this->security->getUser()->getEmail();

    
        return $userEmail;
    }

   
}