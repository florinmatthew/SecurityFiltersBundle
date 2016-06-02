<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\SecurityProvider\AclBase;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager as EM;
use Reea\SecurityFiltersBundle\Model\AclFiltersModel;

/**
 * Description of AclDbManager
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class AclDbManager extends AclBaseProvider{
    
    protected $connection;
    
    function __construct(EM $EM) {
        $this->connection = $EM->getConnection();
    }
    
    /**
     * 
     * @param type $roleId
     * @param type $oId
     * @param type $mask
     */
    public function saveFilters(ArrayCollection $data){
        
        $model = "`id`, ";
        $iterator = $data->getIterator();
        $values = '';
         
        foreach (AclFiltersModel::getObjectMap() as $i=>$name){
            $model .= "`".$name."`";
            if($i < (count(AclFiltersModel::getObjectMap()))){
                $model .= ", ";
            }
        }
        
        $model .= " `createdAt`, `updatedAt`";
        
        foreach ($iterator as $i=>$filtersModel){
            $values .= "(NULL,'".$filtersModel->getAclClassId()."','".$filtersModel->getFilterMask()."','".$filtersModel->getRoleId()."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
            if($i < ($iterator->count()-1)){
                $values .= ", ";
            }
        }
        
        $this->connection->query("INSERT INTO `".self::$ACL_FILTERS_TABLE."` (".$model.") VALUES ".$values);
        
    }
}
