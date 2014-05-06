<?php
/**
 * AbstractHtml Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * AbstractHtml Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractHtml extends AbstractConstraint implements ConstraintInterface
{
    /**
     * White list
     *
     * Override in the Request using $options['white_list'] entry.
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $white_list = array(
        'a'          => array(
            'href'  => array('minlen' => 3, 'maxlen' => 50),
            'title' => array('valueless' => 'n')
        ),
        'address'    => array(),
        'article'    => array(),
        'aside'      => array(),
        'b'          => array(),
        'blockquote' => array(),
        'body'       => array(),
        'br'         => array(),
        'colgroup'   => array(),
        'dd'         => array(),
        'datagrid'   => array(),
        'dialog'     => array(),
        'dir'        => array(),
        'div'        => array(),
        'd1'         => array(),
        'fieldset'   => array(),
        'footer'     => array(),
        'font'       => array(
            'size' =>
                array('minval' => 4, 'maxval' => 20)
        ),
        'form'       => array(),
        'h1'         => array(),
        'h2'         => array(),
        'h3'         => array(),
        'h4'         => array(),
        'h5'         => array(),
        'h6'         => array(),
        'head'       => array(),
        'header'     => array(),
        'hr'         => array(),
        'html'       => array(),
        'i'          => array(),
        'img'        => array('src' => 1),
        'menu'       => array(),
        'nav'        => array(),
        'option'     => array(),
        'optgroup'   => array(),
        'ol'         => array(),
        'p'          => array(
            'align' => 1,
            'dummy' => array('valueless' => 'y')
        ),
        'pre'        => array(),
        'section'    => array(),
        'table'      => array(),
        'td'         => array(),
        'th'         => array(),
        'thead'      => array(),
        'tbody'      => array(),
        'tfoot'      => array(),
        'tr'         => array(),
        'ul'         => array()
    );

    /**
     * HTML Entities
     *
     * Override in the Request using $options['html_entities'] entry.
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $html_entities = array(
        34 => 'quot',
        38 => 'amp',
        60 => 'lt',
        62 => 'gt',
    );

    /**
     * Encoding
     *
     * Override in the Request using $options['encoding'] entry.
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $encoding = 'utf-8';

    /**
     * Constructor
     *
     * @param   string $constraint
     * @param   string $method
     * @param   string $field_name
     * @param   mixed  $field_value
     * @param   array  $options
     *
     * @api
     * @since   1.0.0
     */
    public function __construct(
        $constraint,
        $method,
        $field_name,
        $field_value,
        array $options = array()
    ) {
        $options = $this->setPropertyKeyWithOptionKey($options, 'white_list');
        $options = $this->setPropertyKeyWithOptionKey($options, 'html_entities');
        $options = $this->setPropertyKeyWithOptionKey($options, 'encoding');

        parent::__construct(
            $constraint,
            $method,
            $field_name,
            $field_value,
            $options
        );
    }

    /**
     * Validate
     *
     * Verifies that the field value contents do not contain any HTML tags or attributes
     * which are not defined in the white_list. If false, use sanitize to clean content.
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === $this->sanitize()) {
            return true;
        }

        $this->setValidateMessage(8000);

        return false;
    }

    /**
     * Sanitize
     *
     * Sanitizes the field value contents so that there are no HTML tags or attributes
     * which have not been defined in the white_list. Critical for security.
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === null) {
        } else {
            $this->field_value = kses($this->field_value, $this->white_list, array('http', 'https'));
        }

        return $this->field_value;
    }

    /**
     * Format
     *
     * Escapes the field value contents for presentation on the web; critical for security
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function format()
    {
        /**
         * $class                 = 'Zend\Escaper\Escaper';
         * $adapter               = new $class();
         * $class                 = 'Molajo\\Fieldhandler\\Escape\\Zend';
         * $adapter               = new $class($adapter);
         * $class                 = 'Molajo\\Fieldhandler\\Escape';
         * $escape_instance = new $class($adapter);
         */
        if ($this->field_value === null) {
        } else {
            // $this->field_value = $this->escape_instance->escapeHtml($this->field_value);
        }
        // $this->field_value = htmlspecialchars($this->field_value, null, 'utf-8');
        return $this->field_value;
    }
}
