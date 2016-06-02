<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\SecurityProvider\AclBase;

use Reea\SecurityFiltersBundle\SecurityProvider\FilterMaskBuilder;
/**
 * Description of FiltersMap
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
final class FiltersMap {
    
    protected $filter_map = [
        '1'     => FilterMaskBuilder::VIEW_PRIORITY,        // 2<<0 - 1
        '2'     => FilterMaskBuilder::VIEW_PROPRITY_SELF,   // 2<<1 - 2
        '3'     => FilterMaskBuilder::CREATE_PRIORITY,      // 2<<2 - 4
        '4'     => FilterMaskBuilder::EDIT_PRIORITY,        // 2<<3 - 8
        '5'     => FilterMaskBuilder::DELETE_PRIORITY,      // 2<<4 - 16
        '6'     => FilterMaskBuilder::ASSIGN_PRIORITY,      // 2<<5 - 32
        '7'     => FilterMaskBuilder::VIEW_ASSIGNED,        // 2<<6 - 64
        '8'     => FilterMaskBuilder::CREATE_ASSIGNED,      // 2<<7 - 128
        '9'     => FilterMaskBuilder::EDIT_ASSIGNED,        // 2<<8 - 256
        '10'    => FilterMaskBuilder::DELETE_ASSIGNED,      // 2<<9 - 512
    ];
    
    /**
     * Return bit value in sequence.
     * @param type $bit_sequence
     * @return boolean
     */
    public static function getMaskValue($bit_sequence){
        if(array_keys($bit_sequence, $this->filter_map)){
            return $this->filter_map[$bit_sequence];
        }
        
        return false;
    }
    
}
