<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\UserExtendBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;
use Oro\Bundle\UserBundle\Entity\Role;
use Reea\SecurityFiltersBundle\SecurityProvider\RolesPriority;

/**
 * Description of AddPmToolRoles
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class AddPmToolRoles extends AbstractFixture {
    
    const ROLE_GENRAL_MANAGER   = 'ROLE_GENERAL_MANAGER';
    const ROLE_ACCOUNT_MANAGER  = 'ROLE_ACCOUNT_MANAGER';
    const ROLE_PROJECT_MANAGER  = 'ROLE_PROJECT_MANAGER';
    const ROLE_BASIC_USER       = 'ROLE_BASIC_USER';
    const ROLE_CUSTOMER_MANAGER = 'ROLE_CUSTOMER_MANAGER';
    const ROLE_CUSTOMER_USER    = 'ROLE_CUSTOMER_USER';
    
    /**
     * Load Reea PMTool roles.
     * *ROLE_GENERAL_MANAGER*
     * *ROLE_ACCOUNT_MANAGER*
     * *ROLE_PROJECT_MANAGER*
     * *ROLE_BASIC_USER*
     * *ROLE_CUSTOMER_MANAGER*
     * *ROLE_CUSTOMER_USER*
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        
        $generalManager = new Role(self::ROLE_GENRAL_MANAGER);
        $generalManager->setLabel('General Manager');
        $generalManager->setPriority(RolesPriority::ROLE_GENERAL_MANAGER);
        
        $manager->persist($generalManager);
        
        $accountManager = new Role(self::ROLE_ACCOUNT_MANAGER);
        $accountManager->setLabel('Account Manager');
        $accountManager->setPriority(RolesPriority::ROLE_ACCOUNT_MANAGER);
        
        $manager->persist($accountManager);
        
        $projectManager = new Role(self::ROLE_PROJECT_MANAGER);
        $projectManager->setLabel('Project Manager');
        $projectManager->setPriority(RolesPriority::ROLE_PROJECT_MANAGER);
        
        $manager->persist($projectManager);
        
        $basicUser = new Role(self::ROLE_BASIC_USER);
        $basicUser->setLabel('Basic User');
        $basicUser->setPriority(RolesPriority::ROLE_BASIC_USER);
        
        $manager->persist($basicUser);
        
        $customerManager = new Role(self::ROLE_CUSTOMER_MANAGER);
        $customerManager->setLabel('Customer Manager');
        $customerManager->setPriority(RolesPriority::ROLE_CUSTOMER_MANAGER);
        
        $manager->persist($customerManager);
        
        $customerUser = new Role(self::ROLE_CUSTOMER_USER);
        $customerUser->setLabel('Customer User');
        $customerUser->setPriority(RolesPriority::ROLE_CUSTOMER_USER);
        
        $manager->persist($customerUser);
        
        $manager->flush();
        
    }
    
}
