<?php
/**
 * Callback Constraint Test
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
     * @covers  Molajo\Fieldhandler\Constraint\Callback::validate
     * @return  void
     * @since   1.0.0
     */
    public function testValidateSuccess()
    {
        $field_name          = 'attention';
        $field_value         = 'DOG';
        $constraint          = 'Callback';
        $options             = array();
        $options['callback'] = 'strtolower';

        $results = $this->request->validate($field_name, $field_value, $constraint, $options);

        $this->assertEquals(TRUE, $results->getValidateResponse());

        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

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

        $results = $this->request->sanitize($field_name, $field_value, $constraint, $options);

        $this->assertEquals('DOG', $results->getFieldValue());
        $this->assertEquals(FALSE, $results->getChangeIndicator());

        return;
    }
}
