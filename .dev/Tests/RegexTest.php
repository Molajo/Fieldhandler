<?php
/**
 * Regex Fieldhandler Test
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Adapter as adapter;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Regex Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class RegexTest extends PHPUnit_Framework_TestCase
{
    /**
     * Adapter
     *
     * @var    object  Molajo/Molajo/Adapter
     * @since  1.0
     */
    protected $adapter;

    /**
     * Set up
     *
     * @return void
     * @since   1.0
     */
    protected function setUp()
    {
        $this->adapter = new adapter();
    }

    /**
     * @covers  Molajo\Fieldhandler\Handler\Regex::validate
     * @return  void
     * @since   1.0
     */
    public function testValidate1()
    {
        $field_name              = 'number';
        $field_value             = '54321';
        $fieldhandler_type_chain = 'Regex';
        $options                 = array();
        $options['regex']        = "/[0-9]/";

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Handler\Regex::validate
     * @return void
     * @since   1.0
     */
    public function testValidateFail()
    {
        $field_name              = 'number';
        $field_value             = 'NOT54321';
        $fieldhandler_type_chain = 'Regex';
        $options                 = array();
        $options['regex']        = "/[0-9]/";

        $results = $this->adapter->validate($field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals($field_value, $results);

        return;
    }

    /**
     * Tear down
     *
     * @return void
     * @since   1.0
     */
    protected function tearDown()
    {
    }
}
