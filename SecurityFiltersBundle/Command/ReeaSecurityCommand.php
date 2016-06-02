<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reea\SecurityFiltersBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of ReeaSecurityCommand
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */
class ReeaSecurityCommand extends ContainerAwareCommand{
    
    protected function configure(){
        $this
            ->setName('pmtool:security:dataload')
            ->setDescription('Load PMTool security data: roles, permissions and filters.');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln("Preparing...");
        $container = $this->getContainer();
        $AclRolesLoader = $container->get('reea_security.load_acl_roles');
        $output->writeln("Loading...");
        $AclRolesLoader->loadRoles();
        $output->writeln("Done!");
    }
    
}
