<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\Criteria\Registry;

/**
 * Description of CriteriaFilterMap
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
final class CriteriaFilterMap {
    
    /**
     * Array containing mapped criteria objects by filter type.
     * <code>[PRIME_ACCESS_CONST]_[FILTER_TYPE]_[]</code>
     * @var Array FILTER_TYPE => Criteria class FQCN
     */
    private static $FILTERS_MAP = [
        'PRIORITY'  => '\\Reea\\SecurityFiltersBundle\\Criteria\\PriorityOrderFilter',
        'ASSIGNED'  => ''
    ];
    
    /**
     * Build criteria object.
     * @param String $FILTER_TYPE
     * @return \Reea\SecurityFiltersBundle\Criteria\CriteriaInterface
     * @throws \Reea\SecurityFiltersBundle\Criteria\Exceptions\InvalidCriteria
     */
    public static function buildCriteria($FILTER_TYPE){
        if(!array_key_exists($FILTER_TYPE, self::$FILTERS_MAP)){
            throw new \Reea\SecurityFiltersBundle\Criteria\Exceptions\InvalidCriteria();
        }
        
        $name = self::$FILTERS_MAP[$FILTER_TYPE];
        return new $name();
    }
}
