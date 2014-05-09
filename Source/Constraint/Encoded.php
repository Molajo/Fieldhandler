<?php
/**
 * Encoded Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Encoded Constraint
 *
 * URL-encode string, optionally strip or encode special characters.
 *
 * Uses PHP Sanitize Filters http://www.php.net/manual/en/filter.filters.sanitize.php and FILTER_SANITIZE_ENCODED
 * to URL-encode string and can accept the following flags:
 *
 *  FILTER_FLAG_STRIP_LOW
 *  FILTER_FLAG_STRIP_HIGH
 *  FILTER_FLAG_ENCODE_LOW
 *  FILTER_FLAG_ENCODE_HIGH
 *
 * @link       http://www.php.net/manual/en/filter.filters.sanitize.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Encoded extends AbstractFiltervar implements ConstraintInterface
{
    /**
     * Validate Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $validate_filter = null;

    /**
     * Sanitize Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $sanitize_filter = FILTER_SANITIZE_ENCODED;

    /**
     * Constraint Flags
     *
     * To enable flags for use with the request, add the flags to the options array
     *
     * @api
     * @var    array
     * @since  1.0.0
     */
    protected $constraint_allowable_options = array(
        FILTER_FLAG_STRIP_HIGH,
        FILTER_FLAG_STRIP_LOW,
        FILTER_FLAG_ENCODE_HIGH,
        FILTER_FLAG_ENCODE_LOW
    );

    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        return $this->validateCompare();
    }
}
