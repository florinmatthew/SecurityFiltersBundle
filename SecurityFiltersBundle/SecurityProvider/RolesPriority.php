<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\SecurityProvider;

/**
 * Description of RolesPriority
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
final class RolesPriority {
    /*Organizational level roles.*/
        //BAP Roles.
    const ROLE_ADMINISTRATOR    = 1;
    const ROLE_MANAGER          = 10;
        //PMTool roles.
    const ROLE_GENERAL_MANAGER  = 20;
    const ROLE_ACCOUNT_MANAGER  = 30;
    const ROLE_PROJECT_MANAGER  = 40;
    /*BUnit roles*/
    const ROLE_CUSTOMER_MANAGER = 50;
    const ROLE_CUSTOMER_USER    = 60;
    /*Basic user*/
    const ROLE_BASIC_USER       = 70;
    
    /**
     * 
     * @param String $ROLE_NAME
     * @return mixed
     */
    public static function getPriority($ROLE_NAME){
        if(defined("static::".$ROLE_NAME)){
            return constant("static::".$ROLE_NAME);
        }
        
        return false;
    }
}
