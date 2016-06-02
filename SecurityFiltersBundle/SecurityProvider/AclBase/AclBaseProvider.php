<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\SecurityProvider\AclBase;

use Doctrine\ORM\EntityManager as EM;
/**
 * Description of AclDataProvider
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
abstract class AclBaseProvider {
    
    protected static $ACL_CLASSES_TABLE     = 'acl_classes';
    
    protected static $ACL_FILTERS_TABLE     = 'acl_filters';
    
    protected static $ORO_ACCESS_ROLE       = 'oro_access_role'; 
    
    protected $connection = NULL;
}
