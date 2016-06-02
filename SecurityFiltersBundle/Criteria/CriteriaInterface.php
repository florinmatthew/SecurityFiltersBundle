<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\Criteria;

/**
 * Description of CriteriaInterface
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
interface CriteriaInterface {
    
    /**
     * @return mixed A string or array of filter consts that this object is handling.
     */
    public function isMapping();
}
