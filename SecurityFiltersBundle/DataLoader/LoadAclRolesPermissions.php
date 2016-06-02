<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\DataLoader;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface,
    Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\Yaml\Yaml;

use Oro\Bundle\SecurityBundle\Acl\Persistence\AclManager,
    Oro\Bundle\UserBundle\Entity\Role,
    Oro\Bundle\OrganizationBundle\Migrations\Data\ORM\LoadOrganizationAndBusinessUnitData;

/**
 * Load Acl default Roles, permissions and filters for the following:
 * - General Manager
 * - Account Manager
 * - Project Manager
 * - Customer Manager
 * - Customer User
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class LoadAclRolesPermissions{
    
    /**
     * @var Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;
    
    /**
     * The Object Manager
     * @var \Doctrine\Common\Persistence\ObjectManager 
     */
    protected $objectManager;
    
    function __construct(ObjectManager $objectManager, Container $container) {
        $this->objectManager = $objectManager;
        $this->container = $container;
    }

    /**
     * Load ACL for security roles
     */
    public function loadRoles() {
        
        $aclManager = $this->container->get('oro_security.acl.manager');
        $aclProvider = $this->container->get('security.acl.provider');
        $aclFiltersProvider = $this->container->get('reea_security.filters_manager');
        
        $fileName = $this->container
            ->get('kernel')
            ->locateResource('@ReeaSecurityFiltersBundle/DataLoader/ReeaPMToolRoles/pmtool_default_roles.yml');
        
        $fileName  = str_replace('/', DIRECTORY_SEPARATOR, $fileName);
        $rolesData = Yaml::parse($fileName);
        
        foreach ($rolesData as $roleName => $roleConfigData) {
            if (isset($roleConfigData['bap_role'])) {
                $role = $this->objectManager->getRepository('OroUserBundle:Role')
                                            ->findOneBy(['role' => $roleConfigData['bap_role']]);
            } else {
                
                $findRole = $this->objectManager->getRepository('OroUserBundle:Role')
                                            ->findOneBy(['role' => $roleName]);
                
                if(NULL === $findRole){
                    $role = new Role($roleName);
                    $role->setLabel($roleConfigData['label']);
                    $this->objectManager->persist($role);
                }else{
                    $role = $findRole;
                }
            }
            
            if ($aclManager->isAclEnabled()) {
                $sid = $aclManager->getSid($role);
                foreach ($roleConfigData['permissions'] as $permission => $access) {
                    
                    $oid     = $aclManager->getOid(str_replace('|', ':', $permission));
                    $builder = $aclManager->getMaskBuilder($oid);
                    $mask    = $builder->reset()->get();
                    
                    foreach($access as $type => $acls){
                        if(!empty($acls)){
                            if("prime" === $type){
                                foreach ($acls as $acl) {
                                    $mask = $builder->add($acl)->get();
                                    $aclManager->setPermission($sid, $oid, $mask);
                                    
                                    $aclManager->flush();
                                    $this->objectManager->flush();
                                }
                            }
                            
                            if("filter" === $type){
                                $aclFiltersProvider->setOid($oid);
                                $aclFiltersProvider->setSid($sid);
                                foreach ($acls as $filter){
                                    $aclFiltersProvider->addMask($filter , $oid, $sid);
                                }
                                $aclFiltersProvider->saveOidFilters();
                            }
                        }
                    }
                }
            }
        }
        $aclFiltersProvider->flushMasks();
    }
    
}
