<?php
/**
 * Raw Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Raw Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class RawTest extends PHPUnit_Framework_TestCase
{
    /**
     * Request
     *
     * @var    object  Molajo\Fieldhandler\Request
     * @since  1.0.0
     */
    protected $request;

    /**
     * Set up
     *
     * @return void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $this->request = new Request();
    }


    /**
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     * @return void
     * @since   1.0.0
     */
    public function testFormatFail()
    {
        $field_name                        = 'field1';
        $field_value                       = '&';
        $constraint                        = 'Raw';
        $options                           = array();
        $options[FILTER_FLAG_ENCODE_AMP] = true;

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        if (PHP_VERSION_ID > 50400) {
            $this->assertEquals('&', $results->getFieldValue());
        } else {
            $this->assertEquals('&amp;', $results->getFieldValue());
        }
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}
