<?php

namespace App\Command;

use App\Entity\PostFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:add-post',
    description: 'Add a short description for your command',
)]
class AddPostCommand extends Command
{
    public function __construct(private EntityManagerInterface $manager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
        ->addArgument('title', InputArgument::REQUIRED, 'Title of the post')
        ->addArgument('content', InputArgument::REQUIRED, 'Content of the post')
        //->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $title = $input->getArgument('title');

        if ($title) {
            $io->note(sprintf('You passed an argument: %s', $title));
        }

        $content = $input->getArgument('content');

        if ($content) {
            $io->note(sprintf('You passed an argument: %s', $content));
        }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        $entity = PostFactory::create($title, $content);
        $this ->manager->persist($entity);
        $this ->manager->flush();

        $io->success('Post is saved: '.$entity);

        return Command::SUCCESS;
    }
}
