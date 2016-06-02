<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\SecurityProvider\AclBase;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Doctrine\ORM\EntityManager as EM;
/**
 * Description of AclDataProvider
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class AclDataProvider extends AclBaseProvider{
    
    protected $connection;
    
    function __construct(EM $EM) {
        $this->connection = $EM->getConnection();
    }
    
    /**
     * Get class id for the given OID.
     *
     * @param string $oId
     *
     * @return int Acl class ID.
     */
    public function getAclClassId(ObjectIdentity $oId) {
        $result = $this->connection->query("SELECT id FROM ".self::$ACL_CLASSES_TABLE." WHERE class_type = '".str_replace("\\", "\\\\", $oId->getType())."'")->fetch();
        $id = count($result) === 0 ? NULL : (int)$result["id"];
        
        return $id;
    }
    
    /**
     * 
     * @param type $sid
     * @return Int
     */
    public function getRoleIdBySid($sid){
        $result = $this->connection->query("SELECT id FROM ".self::$ORO_ACCESS_ROLE." WHERE role='".$sid."'")->fetch();
        $id = count($result) === 0 ? NULL : (int)$result["id"];
        
        return $id;
    }
    
    /**
     * 
     * @param   ObjectIdentity  $oId
     * @param   String          $sId
     * @return  Array           
     */
    public function getMask(ObjectIdentity $oId, $sId){
        
        $class_id = $this->getAclClassId($oId);
        $query_result = $this->connection->query("SELECT * FROM ".self::$ACL_FILTERS_TABLE." WHERE role_id='".$sId."' AND acl_class_id='".$class_id."'")->fetch();
        
        $result = ($query_result === FALSE) ? NULL : $query_result["filter_mask"];
        
        return $result;
    }
    
}
