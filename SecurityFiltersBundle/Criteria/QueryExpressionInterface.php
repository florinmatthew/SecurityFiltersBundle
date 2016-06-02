<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\Criteria;

/**
 * Description of QueryExpressionInterface
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
interface QueryExpressionInterface extends CriteriaInterface {
    
    /**
     * Provide SQL string criteria expression to filter collection data.
     * <code>WHERE x = z</code>
     */
    public function expr();
}
