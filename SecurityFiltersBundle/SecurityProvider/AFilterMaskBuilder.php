<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\SecurityProvider;

use Reea\SecurityFiltersBundle\SecurityProvider\AclBase\AclDataProvider;
/**
 * Description of AFilterMaskBuilder
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
abstract class AFilterMaskBuilder {
    
    const VIEW_PRIORITY             = 1;    //2 << 0 - 0000000000000001
    
    /**
     * Mask Pattern string initially build for 16 values.
     */
    const PATTERN_ALL_OFF = '................';
    
    /**
     * String Mask bit used 
     */
    const ON = "*";
    
    /**
     * String Mask bit off.
     */
    const OFF = ".";
    
    /**
     * @var Int Builded mask value.
     */
    protected $filter_mask;
    
    /**
     * Constructor - reset filter mask to 0;
     */
    protected function __construct() {
        $this->reset();
    }
    
    /**
     * Add new filter mask
     * 
     * @param type $filter_mask
     * @return \Reea\SecurityFiltersBundle\SecurityProvider\AMaskBuilder
     * @throws \InvalidArgumentException
     */
    public function addMask($filter_mask){
        if (is_string($filter_mask)) {
            $name = strtoupper($filter_mask);
            
            if (!defined('static::'.$name)) {
                throw new \InvalidArgumentException(sprintf('Undefined filter mask: %s.', $filter_mask));
            }
            $filter_mask = constant('static::'.$name);
        } elseif (!is_int($filter_mask)) {
            throw new \InvalidArgumentException('Filter mask must be a string or an integer.');
        }
        
        $this->filter_mask |= $filter_mask;

        return $this;
    }
    
    /**
     * Removes a filter mask from the permission
     *
     * @param int|string $filter_mask
     * @return MaskBuilder
     * @throws \InvalidArgumentException
     */
    public function remove($filter_mask) {
        if (is_string($filter_mask) && defined($name = strtoupper($filter_mask))) {
            $filter_mask = constant($name);
        } elseif (!is_int($filter_mask)) {
            throw new \InvalidArgumentException('Filter mask must be a string or an integer.');
        }

        $this->filter_mask &= ~$filter_mask;

        return $this;
    }
    
    /**
     * Resets the builder
     *
     * @return MaskBuilder
     */
    public function reset() {
        $this->filter_mask = 0;

        return $this;
    }
    
    /**
     * Get builded filter mask.
     * 
     * @return Int
     */
    public function getFilterMask(){
        return $this->filter_mask;
    }
    
    /**
     * Build bit mask sequence as an array of strings of 16.
     * Example: <code>.........*..*...</code>
     * See self::PATTERN_ALL_OFF, self::ON and self::OFF.
     * @param type $INT_MASK
     */
    public function buildMaskSequence($INT_MASK){
        $bit_mask = decbin($INT_MASK);
        $reversed = str_split(strrev($bit_mask));
        
        $sequence = str_split(self::PATTERN_ALL_OFF);
        foreach ($reversed as $i=>$c){
            if($c == 1){
                $sequence[$i] = self::ON;
            }else{
                $sequence[$i] = self::OFF;
            }
        }
        
        return implode("", $sequence);
    }
}
