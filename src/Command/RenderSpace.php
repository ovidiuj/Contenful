<?php
namespace  Command;
use Knp\Command\Command;
use Services\ContentfulService;
use Silex\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RenderSpace
 * @package Command
 */
class RenderSpace extends Command
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * RenderSpace constructor.
     * @param Application $app
     * @param null $name
     */
    public function __construct(Application $app, $name = null) {
        parent::__construct($name);
        $this->app = $app;
    }

    /**
     * 
     */
    protected function configure() {
        $this
            ->setName("render:space")
            ->setDescription("command line tool that will use the Contentful Sync API to render a collection of HTML files using provided templates")
            ->addArgument(
                'space',
                InputArgument::REQUIRED,
                'Space'
            )
            ->addArgument(
                'token',
                InputArgument::REQUIRED,
                'Space'
            )
            ->addOption(
                'debug',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will run in debug mode'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->app['space'] = $input->getArgument('space');
        $this->app['token'] = $input->getArgument('token');

        $service = new ContentfulService($this->app);
        $response = $service->run();

        if($response) {
            $output->writeln("The templates were successfully generated.");
        }
    }
}