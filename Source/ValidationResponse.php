<?php
/**
 * Fieldhandler Validation Response
 *
 * @package    Model
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler;

use CommonApi\Model\ValidateResponseInterface;

/**
 * Fieldhandler Validation Response
 *
 * @package    Fieldhandler
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
     * Associative array of error messages
     *
     * @var    array
     * @since  1.0.0
     */
    protected $error_messages;

    /**
     * Constructor
     *
     * @param   string $validation_response
     * @param   array  $error_messages
     *
     * @since   1.0.0
     */
    public function __construct(
        $validation_response,
        array $error_messages = array()
    ) {
        $this->validation_response = $validation_response;
        $this->error_messages      = $error_messages;
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
        return $this->error_messages;
    }
}
