<?php
/**
 * Defaults Filter Test
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Tests;

defined('MOLAJO') or die;

use Molajo\Filters\Adapter as filterAdapter;
use PHPUnit_Framework_TestCase;

/**
 * Defaults Filter
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
     * @covers  Molajo\Filters\Type\Default::validate
     * @return  void
     * @since   1.0
     */
    public function testValidateSuccess()
    {
        parent::setUp();

        $method            = 'Validate';
        $field_name        = 'dog';
        $field_value       = null;
        $filter_type_chain = 'defaults';
        $options           = array(
            'default' => 'bark'
        );

        $adapter = new filterAdapter($method, $field_name, $field_value, $filter_type_chain, $options);

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
