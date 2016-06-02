<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\Model;

/**
 * Description of AclFiltersModel
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class AclFiltersModel {
    
    /**
     * ACL Class ID related to filters.
     * @var Int 
     */
    protected $acl_class_id;
    
    /**
     * Int filter mask.
     * @var Int 
     */
    protected $filter_mask;
    
    /**
     * Role ID related.
     * @var Int 
     */
    protected $role_id;
    
    /**
     * Add class ID.
     * @param type $id
     * @return \Reea\SecurityFiltersBundle\Model\AclFiltersModel
     */
    public function setAclClassId($id){
        $this->acl_class_id = (int)$id;
        
        return $this;
    }
    
    /**
     * 
     * @param type $mask
     * @return \Reea\SecurityFiltersBundle\Model\AclFiltersModel
     */
    public function setFilterMask($mask){
        $this->filter_mask = (int)$mask;
        
        return $this;
    }
    
    /**
     * 
     * @param type $roleId
     * @return \Reea\SecurityFiltersBundle\Model\AclFiltersModel
     */
    public function setRoleId($roleId){
        $this->role_id = (int)$roleId;
        
        return $this;
    }
    
    /**
     * 
     * @return Int
     */
    public function getAclClassId(){
        return $this->acl_class_id;
    }
    
    /**
     * 
     * @return Int
     */
    public function getFilterMask(){
        return $this->filter_mask;
    }
    
    /**
     * 
     * @return Int
     */
    public function getRoleId(){
        return $this->role_id;
    }
    
    /**
     * Return object fields.
     * @return Array
     */
    final public static function getObjectMap(){
        return array_keys(get_object_vars(new self));
    }
    
}
