<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\Criteria;

/**
 * Description of QueryBuilderInterface
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
interface QueryBuilderInterface extends CriteriaInterface {
    
    /**
     * Provide a query builder function
     * Example: <code>function (EntityRepository $er) { ... }</code>
     */
    public function queryBuilder();
    
}
