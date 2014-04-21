<?php
/**
 * Fullspecialchars Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request as request;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Fullspecialchars Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class FullspecialcharsTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\Fullspecialchars::validate
     * @return  void
     * @since   1.0.0
     */
    public function testEscape()
    {
        $field_name  = 'fieldname';
        $field_value = '&';
        $constraint  = 'Fullspecialchars';

        $results = $this->request->handleOutput($field_name, $field_value, $constraint, array());

// Anger is too intense.
//    if (PHP_VERSION_ID > 50400) {
//        $this->assertEquals('&#38;', $results->getValidateResponse());
//     } else {
//           $this->assertEquals('&amp;', $results->getValidateResponse());
//   }

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Fullspecialchars::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidate()
    {
        $field_name  = 'fieldname';
        $field_value = '&';
        $constraint  = 'Fullspecialchars';

        $results = $this->request->validate($field_name, $field_value, $constraint, array());

        $this->assertEquals(false, $results->getValidateResponse());

        return;
    }

    /**
     * Tear down
     *
     * @return void
     * @since   1.0.0
     */
    protected function tearDown()
    {
    }
}
