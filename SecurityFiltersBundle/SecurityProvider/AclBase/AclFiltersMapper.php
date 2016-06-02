<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\SecurityProvider\AclBase;

use Reea\SecurityFiltersBundle\Model\AclFiltersModel;
/**
 * Description of AclFiltersMapper
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class AclFiltersMapper {
    
    private static $instance;
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection 
     */
    private $acl_filters_map;
    
    private function __construct() { 
        $this->acl_filters_map = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public static function init(){
        if ( empty( self::$instance ) ) {
            self::$instance = new AclFiltersMapper();
        }
        
        return self::$instance;
    }
    
    /**
     * 
     * @param AclFiltersModel $aclFilter
     */
    public function put(AclFiltersModel $aclFilter){
        $this->acl_filters_map->add($aclFilter);
    }
    
    /**
     * Return all filter Objects <br />
     * <code>Reea\SecurityFiltersBundle\Model\AclFiltersModel</code>
     * @return ArrayCollection
     */
    public function getAllFilters(){
        return $this->acl_filters_map;
    }
    
    /**
     * 
     * @return boolean
     */
    public function reset(){
        $this->acl_filters_map->clear();
        
        return true;
    }
    
}
