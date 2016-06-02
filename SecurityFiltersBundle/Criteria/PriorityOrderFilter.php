<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\Criteria;

use Doctrine\ORM\EntityRepository;

/**
 * Description of PriorityOrderFilter
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class PriorityOrderFilter implements QueryBuilderInterface, QueryExpressionInterface{
    
    const IS_MAPPING = 'PRIORITY';
    
    /**
     * {@inheritdoc}
     */
    public function isMapping() {
        return static::IS_MAPPING;
    }
    
    /**
     * {@inheritdoc}
     */
    public function expr() {
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function queryBuilder() {
//        'query_builder' => function (EntityRepository $er) {
//                        return $er->createQueryBuilder('r')
//                            ->where('r.role <> :anon')
//                            ->setParameter('anon', User::ROLE_ANONYMOUS)
//                            ->orderBy('r.label');
//                    },
        ;
    }
    
}
