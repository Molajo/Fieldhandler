<?php
/**
 * Validate Response
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use CommonApi\Model\ValidateResponseInterface;

/**
 * Validate Response
 *
 * @package    Molajo
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @since      1.0.0
 */
class ValidateResponse implements ValidateResponseInterface
{
    /**
     * Validate Response
     *
     * @var    boolean
     * @since  1.0.0
     */
    protected $validate_response;

    /**
     * Validation messages
     *
     * @var    array
     * @since  1.0.0
     */
    protected $validate_messages;

    /**
     * Constructor
     *
     * @param   string $validate_response
     * @param   array  $validate_messages
     *
     * @since   1.0.0
     */
    public function __construct(
        $validate_response,
        array $validate_messages = array()
    ) {
        $this->validate_response = $validate_response;
        $this->validate_messages = $validate_messages;
    }

    /**
     * Get Validation Response
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function getValidateResponse()
    {
        return $this->validate_response;
    }

    /**
     * Get Validation Messages
     *
     * @return  array
     * @since   1.0.0
     */
    public function getValidateMessages()
    {
        return $this->validate_messages;
    }
}
