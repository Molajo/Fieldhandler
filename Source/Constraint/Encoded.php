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
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Encoded extends Abstractfiltervar implements ConstraintInterface
{
    /**
     * Constraint Flags
     *
     * @var    array
     * @since  1.0.0
     */
    protected $constraint_allowable_options = array(
        'FILTER_FLAG_STRIP_HIGH',
        'FILTER_FLAG_STRIP_LOW',
        'FILTER_FLAG_ENCODE_HIGH',
        'FILTER_FLAG_ENCODE_LOW'
    );

    /**
     * Filter Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $filter_type = FILTER_SANITIZE_ENCODED;
}
