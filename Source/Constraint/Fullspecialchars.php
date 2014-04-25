<?php
/**
 * Fullspecialchars Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Fullspecialchars Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Fullspecialchars extends AbstractFiltervar implements ConstraintInterface
{
    /**
     * Filter Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $filter_type = FILTER_SANITIZE_FULL_SPECIAL_CHARS;

    /**
     * Constraint Flags
     *
     * @var    array
     * @since  1.0.0
     */
    protected $constraint_allowable_options = array(
        'FILTER_FLAG_NO_ENCODE_QUOTES'
    );
}
