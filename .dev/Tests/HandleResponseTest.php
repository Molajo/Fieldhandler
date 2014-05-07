<?php
/**
 * HandleResponse Test
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Tests;

use CommonApi\Model\EscapeInterface;
use Molajo\Fieldhandler\Escape;
use PHPUnit_Framework_TestCase;

/**
 * HandleResponse Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class HandleResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * Escape
     *
     * @var    object  Molajo\Fieldhandler\Escape
     * @since  1.0.0
     */
    protected $escape;

    /**
     * Set up
     *
     * @return  void
     * @since   1.0.0
     */
    protected function setUp()
    {
        $adapter      = new EscapeMock();
        $this->escape = new Escape($adapter);
    }

    /**
     * @covers  Molajo\Fieldhandler\Escape::escapeHtml
     * @return  void
     * @since   1.0.0
     */
    public function testEscapeHtml()
    {
        $string  = '<script>alert("molajo")</script>';
        $results = $this->escape->escapeHtml($string);

        $this->assertEquals($results, $string);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Escape::escapeHtmlAttributes
     * @return  void
     * @since   1.0.0
     */
    public function testEscapeHtmlAttributes()
    {
        $string  = 'title="mytitle" onmouseover=alert(/molajo!/)';
        $results = $this->escape->escapeHtmlAttributes($string);

        $this->assertEquals($results, $string);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Escape::escapeJs
     * @return  void
     * @since   1.0.0
     */
    public function testEscapeJs()
    {
        $string = 'bar&quot;; alert(&quot;Meow!&quot;); var xss=&quot;true';

        $results = $this->escape->escapeJs($string);

        $this->assertEquals($results, $string);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Escape::escapeCss
     * @return  void
     * @since   1.0.0
     */
    public function testEscapeCss()
    {
        $string  = "body {
            background-image: url('http://example.com/foo.jpg?</style><script>alert(1)</script>');
            }";
        $results = $this->escape->escapeCss($string);

        $this->assertEquals($results, $string);

        return;
    }

    /**
     * @covers  Molajo\Fieldhandler\Escape::escapeUrl
     * @return  void
     * @since   1.0.0
     */
    public function testEscapeUrl()
    {
        $string  = ' onmouseover="alert(\'molajo\')';
        $results = $this->escape->escapeUrl($string);

        $this->assertEquals($results, $string);

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

class EscapeMock implements EscapeInterface
{
    /**
     * Escape Html
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeHtml($string)
    {
        return $string;
    }

    /**
     * Escape Html Attributes
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeHtmlAttributes($string)
    {
        return $string;
    }

    /**
     * Escape Js
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeJs($string)
    {
        return $string;
    }

    /**
     * Escape Css
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeCss($string)
    {
        return $string;
    }

    /**
     * Escape Url
     *
     * @param   $string
     *
     * @return  string
     * @since   1.0.0
     */
    public function escapeUrl($string)
    {
        return $string;
    }
}
