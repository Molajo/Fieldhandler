<?php
/**
 * Fieldhandler Item
 *
 * @package    Model
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use CommonApi\Model\FieldhandlerItemInterface;

/**
 * Fieldhandler Item
 *
 * @package    Fieldhandler
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @since      1.0.0
 */
class FieldhandlerItem implements FieldhandlerItemInterface
{
    /**
     * Name of Field
     *
     * @var    string
     * @since  1.0.0
     */
    protected $field_name;

    /**
     * Return Value
     *
     * @var    string
     * @since  1.0.0
     */
    protected $return_value;

    /**
     * Associative array of error messages
     *
     * @var    array
     * @since  1.0.0
     */
    protected $error_messages;

    /**
     * Constructor
     *
     * @param   string $field_name
     * @param   string $return_value
     * @param   array  $error_messages
     *
     * @since   1.0.0
     */
    public function __construct(
        $field_name,
        $return_value,
        array $error_messages = array()
    ) {
        $this->field_name     = $field_name;
        $this->return_value   = $return_value;
        $this->error_messages = $error_messages;
    }

    /**
     * Get Field Name
     *
     * @return  string
     * @since   1.0.0
     */
    public function getFieldName()
    {
        return $this->field_name;
    }

    /**
     * Get Return Value
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getReturnValue()
    {
        return $this->return_value;
    }

    /**
     * Get Error Messages
     *
     * @return  array
     * @since   1.0.0
     */
    public function getErrorMessages()
    {
        return $this->error_messages;
    }
}
