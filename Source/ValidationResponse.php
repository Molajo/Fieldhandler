<?php
/**
 * Validation Response
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use CommonApi\Model\ValidateResponseInterface;

/**
 * Validation Response
 *
 * @package    Molajo
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @since      1.0.0
 */
class ValidationResponse implements ValidateResponseInterface
{
    /**
     * Validation Response
     *
     * @var    boolean
     * @since  1.0.0
     */
    protected $validation_response;

    /**
     * Associative array of validation messages
     *
     * @var    array
     * @since  1.0.0
     */
    protected $validation_messages;

    /**
     * Constructor
     *
     * @param   string $validation_response
     * @param   array  $validation_messages
     *
     * @since   1.0.0
     */
    public function __construct(
        $validation_response,
        array $validation_messages = array()
    ) {
        $this->validation_response = $validation_response;
        $this->validation_messages = $validation_messages;
    }

    /**
     * Get Validation Response
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function getValidationResponse()
    {
        return $this->validation_response;
    }

    /**
     * Get Validation Messages
     *
     * @return  array
     * @since   1.0.0
     */
    public function getValidationMessages()
    {
        return $this->validation_messages;
    }
}
