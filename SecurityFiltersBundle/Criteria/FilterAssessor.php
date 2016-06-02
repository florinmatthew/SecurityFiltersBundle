<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\Criteria;

//use Oro\Bundle\SecurityBundle\Acl\Persistence\AclManager;
use Oro\Bundle\SecurityBundle\Acl\Persistence\AclSidInterface,
    Oro\Bundle\UserBundle\Entity\Role;
use Reea\SecurityFiltersBundle\SecurityProvider\FilterMaskBuilder,
    Reea\SecurityFiltersBundle\SecurityProvider\AclFiltersManager;    
use Symfony\Component\Security\Acl\Domain\ObjectIdentity,
    Symfony\Component\DependencyInjection\ContainerInterface as Container;
/**
 * Description of FilterAssessor
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class FilterAssessor {

    /**
     * @var FilterMaskBuilder
     */
    protected $maskBuilder;

    /**
     * @var AclSidInterface
     */
    protected $aclManager;
    
    protected $aclFiltersManager;
    
    protected $container;
    
    function __construct(AclSidInterface $aclManager, 
            AclFiltersManager $aclFiltersManager, 
            Container $container) 
    {
        $this->aclManager = $aclManager;
        $this->aclFiltersManager = $aclFiltersManager;
        $this->maskBuilder = new FilterMaskBuilder();
        $this->container = $container;
    }

    /**
     * Check current logged user access to the specifiec entity using filter constant.
     * <code>evaluate('VIEW_PRIORITY', 'Oro\Bundle\UserBundle\Entity\Role')</code>
     * @param String $filter_const Filter const as string.
     * @param String $entity The entity NAMESPACE
     */
    public function evaluate($filter_const, $entity){

        $this->validateFilter($filter_const);

        $oId = $this->aclManager->getOid("entity:".$entity);
        $userRoles = $this->getCurrentUser()->getRoles();
        
        //User can have multiple Roles.
        foreach ($userRoles as $i=>$EntityRole){
            $this->checkFilterAssoc($filter_const, $oId, $EntityRole);
        }
        
    }

    /**
     *
     * @param type $filter_string
     * @return boolean TRUE if const exists.
     * @throws \Reea\SecurityFiltersBundle\Criteria\Exceptions\InvalidFilter
     */
    protected function validateFilter($filter_string){
        if(TRUE === $this->maskBuilder->hasMask($filter_string)){
            return $this->maskBuilder->hasMask($filter_string);
        }

        throw new \Reea\SecurityFiltersBundle\Criteria\Exceptions\InvalidFilter();
    }
    
    /**
     * Check filter applied to role against Object domain.
     * @param type $filter
     * @param ObjectIdentity $oId
     * @param Role $role
     */
    protected function checkFilterAssoc($filter, ObjectIdentity $oId, Role $role){
        
        $this->aclFiltersManager->retrieveMask($oId, $role->getId());
        
    }
    
    /**
     * Get Current user instance.
     * @return Oro\Bundle\UserBundle\Entity\User Current user instance.
     */
    protected function getCurrentUser(){
        return $this->container->get('security.token_storage')
                    ->getToken()->getUser();
    }
}
