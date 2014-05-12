<?php
/**
 * Resource Constraint Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use Molajo\Fieldhandler\Request;
use PHPUnit_Framework_TestCase;

/**
 * Resource Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class ResourceTest extends PHPUnit_Framework_TestCase
{
    /**
     * Request
     *
     * @var    object  Molajo\Fieldhandler\Request
     * @since  1.0.0
     */
    protected $request;

    /**
     * Curl
     *
     * @var    object  Molajo\Fieldhandler\Tests\Curl
     * @since  1.0.0
     */
    protected $curl;

    /**
     * Set up
     *
     * @return void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $this->request = new Request();

        $url        = 'http://example.com/';
        $this->curl = new Curl($url);
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Resource::validate
     * @covers  Molajo\Fieldhandler\Constraint\Resource::validation
     * @covers  Molajo\Fieldhandler\Constraint\Resource::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Resource::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateTrue()
    {
        $field_name  = 'random_field';
        $field_value = $this->curl->handle;
        $constraint  = 'Resource';

        $results = $this->request->validate($field_name, $field_value, $constraint);

        $this->assertEquals(true, $results->getValidateResponse());
        $messages = $results->getValidateMessages();
        $this->assertEquals(array(), $messages);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Request::runConstraintMethod
     * @covers  Molajo\Fieldhandler\Request::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Resource::validate
     * @covers  Molajo\Fieldhandler\Constraint\Resource::validation
     * @covers  Molajo\Fieldhandler\Constraint\Resource::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\Resource::setValidateMessage
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::validate
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::getValidateMessages
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::setValidateMessage
     *
     * @return  void
     * @since   1.0.0
     */
    public function testValidateFalse()
    {
        $field_name  = 'random_field';
        $field_value = array(1, 2, 3);
        $constraint  = 'Resource';

        $results = $this->request->validate($field_name, $field_value, $constraint);

        $this->assertEquals(false, $results->getValidateResponse());

        $expected_code    = 13000;
        $expected_message = 'Field: random_field value is required, but was not provided.';
        $messages         = $results->getValidateMessages();
        $this->assertEquals($expected_code, $messages[0]->code);
        $this->assertEquals($expected_message, $messages[0]->message);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Resource::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Resource::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeByCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitizeNull
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNull()
    {
        $field_name  = 'random_field';
        $field_value = null;
        $constraint  = 'Resource';

        $results = $this->request->sanitize($field_name, $field_value, $constraint);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Resource::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Resource::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeByCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitizeNull
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeNoChange()
    {
        $field_name  = 'random_field';
        $field_value = $this->curl->handle;
        $constraint  = 'Resource';

        $results = $this->request->sanitize($field_name, $field_value, $constraint);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Resource::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\Resource::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::validation
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeByCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraintTests::sanitizeCharacter
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitize
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::sanitizeNull
     *
     * @return  void
     * @since   1.0.0
     */
    public function testSanitizeChange()
    {
        $field_name  = 'test';
        $field_value = 123;
        $constraint  = 'Resource';

        $results = $this->request->sanitize($field_name, $field_value, $constraint);

        $this->assertEquals(null, $results->getFieldValue());
        $this->assertEquals(true, $results->getChangeIndicator());

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Constraint\Resource::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractCtype::format
     * @covers  Molajo\Fieldhandler\Constraint\AbstractConstraint::format
     *
     * @return  void
     * @since   1.0.0
     */
    public function testFormat()
    {
        $field_name  = 'test';
        $field_value = '1A2b3C4d5E6f7G8';
        $constraint  = 'Resource';
        $options     = array();

        $results = $this->request->format($field_name, $field_value, $constraint, $options);

        $this->assertEquals($field_value, $results->getFieldValue());
        $this->assertEquals(false, $results->getChangeIndicator());

        return;
    }
}

class Curl
{
    public $handle;

    public function __construct($url)
    {
        $this->handle = curl_init($url);
    }

    public function exec()
    {
        return curl_exec($this->handle);
    }
}
