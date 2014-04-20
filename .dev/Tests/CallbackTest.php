<?php
/**
 * Callback Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Driver as driver;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Callback Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class CallbackTest extends PHPUnit_Framework_TestCase
{
    /**
     * Constraint
     *
     * @var    object  Molajo\Fieldhandler\Driver
     * @since  1.0.0
     */
    protected $driver;

    /**
     * Set up
     *
     * @return void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $this->driver = new Driver();
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Callback::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate1()
    {
        $field_name          = 'attention';
        $field_value         = 'DOG';
        $constraint          = 'Callback';
        $options             = array();
        $options['callback'] = 'strtolower';

        $results = $this->driver->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getReturnValue());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Callback::validate
     * @return  void
     * @since   1.0.0
     */
    public function testFilter1()
    {
        $field_name          = 'attention';
        $field_value         = 'DOG';
        $constraint          = 'Callback';
        $options             = array();
        $options['callback'] = 'strtolower';

        $results = $this->driver->filter($field_name, $field_value, $constraint, $options);

        $this->assertEquals('dog', $results->getReturnValue());

        return;
    }
}
