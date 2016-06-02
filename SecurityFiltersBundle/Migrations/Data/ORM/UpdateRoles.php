<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\UserExtendBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager,
    Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Oro\Bundle\UserBundle\Entity\Role,
    Reea\SecurityFiltersBundle\SecurityProvider\RolesPriority;


/**
 * Update roles.
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class UpdateRoles extends AbstractFixture implements DependentFixtureInterface {
    /**
     * {@inheritdoc}
     */
    public function getDependencies() {
        return ['Reea\UserExtendBundle\Migrations\Data\ORM\AddPmToolRoles'];
    }

    /**
     * Load Reea PMTool roles.
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $RolesRepository = $manager->getRepository('OroUserBundle:Role');
        
        $rolesData = $RolesRepository->findAll();
        
        
        
//        $manager->flush();
    }
}

