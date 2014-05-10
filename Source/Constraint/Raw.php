<?php
/**
 * Raw Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Raw Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Raw extends AbstractFiltervar implements ConstraintInterface
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
    protected $sanitize_filter = FILTER_UNSAFE_RAW;

    /**
     * Constraint Allowable Options
     *
     * @var    array
     * @since  1.0.0
     */
    protected $constraint_allowable_options
        = array(
            FILTER_FLAG_STRIP_HIGH,
            FILTER_FLAG_STRIP_LOW,
            FILTER_FLAG_ENCODE_HIGH,
            FILTER_FLAG_ENCODE_LOW,
            FILTER_FLAG_ENCODE_AMP
        );
}
