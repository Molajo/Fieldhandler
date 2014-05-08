<?php
/**
 * Minimum Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Minimum Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class MinimumTest extends PHPUnit_Framework_TestCase
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
     * @covers  Molajo\Fieldhandler\Constraint\AbstractMath::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccess()
    {
        $field_name         = 'fieldname';
        $field_value        = 5;
        $constraint         = 'Minimum';
        $options            = array();
        $options['minimum'] = 10;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\AbstractMath::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateAlpha()
    {
        $field_name         = 'fieldname';
        $field_value        = 'a';
        $constraint         = 'Minimum';
        $options            = array();
        $options['minimum'] = 'z';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(true, $results->getValidateResponse());
        $this->assertEquals(array(), $results->getValidateMessages());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\AbstractMath::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFail()
    {
        $field_name         = 'fieldname';
        $field_value        = 500;
        $constraint         = 'Minimum';
        $options            = array();
        $options['minimum'] = 10;

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

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
