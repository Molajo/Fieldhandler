<?php
/**
 * Defaults FieldHandler Test
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Tests;

defined('MOLAJO') or die;

use Molajo\FieldHandler\Adapter as adapter;
use PHPUnit_Framework_TestCase;

/**
 * Defaults FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class DefaultsTest extends PHPUnit_Framework_TestCase
{
    /**
     * Set up
     *
     * @return  void
     * @since   1.0
     */
    protected function setUp()
    {
        parent::setUp();

        return;
    }

    /**
     * test Validate Success
     *
     * @covers  Molajo\FieldHandler\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testValidateSuccess()
    {
        parent::setUp();

        $method                  = 'Validate';
        $field_name              = 'dog';
        $field_value             = null;
        $fieldhandler_type_chain = 'defaults';
        $options                 = array(
            'default' => 'bark'
        );

        $adapter = new adapter($method, $field_name, $field_value, $fieldhandler_type_chain, $options);

        $this->assertEquals('bark', $adapter->field_value);

        return;
    }

    /**
     * Tear down
     *
     * @return  void
     * @since   1.0
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
