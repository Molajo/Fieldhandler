<?php
namespace Testcase1;

use Molajo\Filters\Adapter as fsAdapter;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-26 at 06:27:20.
 */
class Testcase1Test extends Data
{
    private $class;

    /**
     * Initialises Adapter
     */
    protected function setUp()
    {
        parent::setUp();

        /** initialise call */
        $this->filesystem_type = 'Testcase1';
        $this->action  = 'Copy';

        return;
    }

    /**
     * Should default target directory to $this->path
     *
     * @covers Molajo\Filters\Type\Testcase1::copyOrMove
     */
    public function testFilter()
    {
        $this->assertEquals(1, 1);

        return;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
