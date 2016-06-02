<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\SecurityProvider;

use Reea\SecurityFiltersBundle\SecurityProvider\FilterMaskBuilder,
    Reea\SecurityFiltersBundle\SecurityProvider\AclBase\AclDataProvider,
    Reea\SecurityFiltersBundle\SecurityProvider\AclBase\AclDbManager;

use Doctrine\ORM\EntityManager as EM;
use Reea\SecurityFiltersBundle\SecurityProvider\AclBase\AclFiltersMapper,
    Reea\SecurityFiltersBundle\Model\AclFiltersModel;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

/**
 * Description of AclFiltersManager
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class AclFiltersManager {
    
    protected $maskBuilder;
    
    protected $aclDataProvider;
    
    protected $aclDbManager;
    
    /**
     * 
     * @var Reea\SecurityFiltersBundle\SecurityProvider\AclBase\AclFiltersMapper 
     */
    protected $mapper;

    private $oId = null;
    
    private $sId = null;
    
    public function __construct(EM $EM) {
        $this->maskBuilder      = new FilterMaskBuilder();
        $this->aclDataProvider  = new AclDataProvider($EM);
        $this->aclDbManager     = new AclDbManager($EM);
        
        $this->mapper = AclFiltersMapper::init();
    }
    
    /**
     * Set object identity ID.
     * @param type $oId
     * @return \Reea\SecurityFiltersBundle\SecurityProvider\AclFiltersManager
     */
    public function setOid($oId){
        $this->oId = $oId;
        
        return $this;
    }
    
    /**
     * Set security identity ID.
     * @param type $sId
     * @return \Reea\SecurityFiltersBundle\SecurityProvider\AclFiltersManager
     */
    public function setSid(\Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity $sId){
        $this->sId = $sId->getRole();
        
        return $this;
    }

    /**
     * Add mask/Oid.
     * @param String $mask
     */
    public function addMask($mask){
        $this->maskBuilder->addMask($mask);
    }
    
    /**
     * 
     * @param type $mask
     * @return \Reea\SecurityFiltersBundle\SecurityProvider\AclFiltersManager
     */
    public function removeMask($mask){
        $this->maskBuilder->remove($mask);
        
        return $this;
    }
    
    /**
     * 
     * @return Int
     */
    protected function getEntireMask(){
        return $this->maskBuilder->getFilterMask();
    }
    
    /**
     * 
     * @param ObjectIdentity $oId
     * @param String $sId
     */
    public function retrieveMask(ObjectIdentity $oId, $sId){
        $mask_value = $this->aclDataProvider->getMask($oId, $sId);
        //Build mask sequence as string.
        $mask_bit_sequence = $this->maskBuilder->buildMaskSequence($mask_value);
        echo "<pre>";
        var_dump($mask_bit_sequence);
        echo "</pre>";
        die(__LINE__ . __FILE__);
    }

        /**
     * Save filters for the current OID.
     */
    public function saveOidFilters(){
        $filter = new AclFiltersModel();
        $filter->setAclClassId($this->aclDataProvider->getAclClassId($this->oId));
        $filter->setFilterMask($this->getEntireMask());
        $filter->setRoleId($this->aclDataProvider->getRoleIdBySid($this->sId));
        //Add filter to mapper
        $this->mapper->put($filter);
        //Reset
        $this->oId = $this->sId = null;
        $this->maskBuilder->reset();
    }
    
    /**
     * 
     * @return boolean
     */
    public function flushMasks(){
        $this->aclDbManager->saveFilters($this->mapper->getAllFilters());
        $this->mapper->reset();
        
        return true;
    }
    
}
