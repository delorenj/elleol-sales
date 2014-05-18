<?php
namespace ElleOL\ApiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Application;

class TestImpCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('elleol:test:imp')
            ->setDescription('Test Electric imp by turning LED on for X seconds')
            ->addArgument(
                'time',
                InputArgument::OPTIONAL,
                'How long should the LED stay lit?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $time = $input->getArgument("time");
        if(!$time) {
            $time = 5; //seconds
        }

        $this->getContainer()->get('etsy_helper')->testImp($time);

    }
}