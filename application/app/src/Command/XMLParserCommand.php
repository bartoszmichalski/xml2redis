<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Service\Handler;

class XMLParserCommand extends Command
{
    protected static $defaultName = 'app:xml-parse';

    private $handler;

    public function __construct(Handler $handler)
    {
        $this->handler = $handler;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('path', InputArgument::REQUIRED, 'path to xml file')
            ->addArgument('verify', InputArgument::OPTIONAL, 'verify');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path = $input->getArgument('path');
        if (false === is_file($path)) {
            $output->writeln('File not found');
            return 1;
        }
        $this->handler->execute($path);

        $verify = $input->getArgument('verify');

        if ($verify) {
            $output->writeln($this->handler->getAllKeys());
        };

        return 0;
    }
}
