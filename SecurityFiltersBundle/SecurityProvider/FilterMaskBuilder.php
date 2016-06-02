<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\SecurityProvider;

use Reea\SecurityFiltersBundle\SecurityProvider\AFilterMaskBuilder as MaskBuilder;
/**
 * Description of FilterMaskBuilder
 * Main filter types: 1) PRIORITY, 2) ASSIGNED ;
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
final class FilterMaskBuilder extends MaskBuilder{
    
    /*Priority access filters.*/
    const VIEW_PRIORITY             = 1;    //2 << 0 - 0000000000000001
    const VIEW_PROPRITY_SELF        = 2;    //2 << 1 - 0000000000000010
    const CREATE_PRIORITY           = 4;    //2 << 2 - 0000000000000100
    const EDIT_PRIORITY             = 8;    //2 << 3 - 0000000000001000
    const DELETE_PRIORITY           = 16;   //2 << 4 - 0000000000010000
    const ASSIGN_PRIORITY           = 32;   //2 << 5 - 0000000000100000
    
//    const EDIT_OWN                  = 64; // (?)
    /*Assign access filters*/
    const VIEW_ASSIGNED             = 64;   //2 << 6 - 0000000001000000
    const CREATE_ASSIGNED           = 128;  //2 << 7 - 0000000010000000
    const EDIT_ASSIGNED             = 256;  //2 << 8 - 0000000100000000
    const DELETE_ASSIGNED           = 512;  //2 << 9 - 0000001000000000
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Verify if Mask Builder has filter.
     * @param String $MASK
     * @return boolean
     */
    public function hasMask($MASK){
        return (defined("static::".$MASK));
    }
}

