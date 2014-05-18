<?php
namespace ElleOL\ApiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Application;

class UpdateSalesCountCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('elleol:update')
            ->setDescription('Check Etsy for the latest ElleOL sales count');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('etsy_helper')->updateSalesCount();
    }
}