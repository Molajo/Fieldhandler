<?php
/**
 * Ip Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Ip Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Ip extends AbstractFiltervar implements ConstraintInterface
{
    /**
     * Validate Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $validate_filter = FILTER_VALIDATE_IP;

    /**
     * Sanitize Filter
     *
     * @api
     * @var    int
     * @since  1.0.0
     */
    protected $sanitize_filter = null;

    /**
     * Constraint Flags
     *
     * @var    array
     * @since  1.0.0
     */
    protected $constraint_allowable_options
        = array(
            FILTER_FLAG_IPV4,
            FILTER_FLAG_IPV6,
            FILTER_FLAG_NO_PRIV_RANGE,
            FILTER_FLAG_NO_RES_RANGE
        );
}
