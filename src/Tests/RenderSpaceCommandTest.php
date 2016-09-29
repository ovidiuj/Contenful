<?php
namespace Tests;


use Command\RenderSpace;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class RenderSpaceCommandTest
 * @package Tests
 */
class RenderSpaceCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    private $silexApp;

    /**
     *
     */
    public function setUp()
    {

        $this->silexApp = $this->getMock('Silex\Application');
    }

    /**
     *
     */
    public function testRenderSpace () {
        $app = new Application();
        $app->add(new RenderSpace($this->silexApp));
        $command = $app->find('render:space');

        $tester = new CommandTester($command);
        $tester->execute(array(
            'command' => $command->getName(),
            'space' => "cfexampleapi",
            'token' => "b4c0n73n7fu1"
        ));
        print_r($tester->getDisplay());
        $this->assertInstanceOf("Command\\RenderSpace", $command);
        $this->assertEquals("The templates were successfully generated.
", $tester->getDisplay());

    }

    /**
     * @expectedException RuntimeException
     */
    public function testRenderSpaceWhenMissingParams () {
        $app = new Application();
        $app->add(new RenderSpace($this->silexApp));
        $command = $app->find('render:space');

        $tester = new CommandTester($command);
        $tester->execute(array(
            'command' => $command->getName(),
            'token' => "b4c0n73n7fu1"
        ));
    }
}