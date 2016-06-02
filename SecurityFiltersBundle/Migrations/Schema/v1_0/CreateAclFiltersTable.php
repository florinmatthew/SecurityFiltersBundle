<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\Migrations\Schema\v1_0;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;

/**
 * Description of CreateAclFiltersTable
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class CreateAclFiltersTable implements Migration{
    
    /**
     * @inheritdoc
     */
    public function up(Schema $schema, QueryBag $queries) {
        $this->createAclFiltersTable($schema);
        $this->addForeignKeyConstraints($schema);
    }
    
    /**
     * Create ACL Filters table.
     * @param Schema $schema
     */
    protected function createAclFiltersTable(Schema $schema){
        
        $table = $schema->createTable('acl_filters');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('acl_class_id', 'integer', ['notnull' => false, 'unsigned' => true]);
        $table->addColumn('filter_mask', 'integer', ['notnull' => false]);
        $table->addColumn('role_id', 'integer', ['notnull' => false]);
        $table->addColumn('createdAt', 'datetime', []);
        $table->addColumn('updatedAt', 'datetime', []);
        
        $table->setPrimaryKey(['id']);
        $table->addIndex(['acl_class_id'], 'IDX_D5BB381E735ACA71', []);
        $table->addIndex(['role_id'], 'IDX_D9BB381E32C8A3EG', []);
        
    }
    
    protected function addForeignKeyConstraints(Schema $schema){
        $table = $schema->getTable('acl_filters');
        //ACL Classes relation
        $table->addForeignKeyConstraint(
            $schema->getTable('acl_classes'),
            ['acl_class_id'],
            ['id']
        );
        //Oro Access Role relation
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_access_role'),
            ['role_id'],
            ['id']
        );
    }
    
}
