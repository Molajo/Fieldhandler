<?php
/**
 * Greaterthan Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Greaterthan Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Greaterthan extends AbstractMath implements ConstraintInterface
{
    /**
     * Method Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $method_type = 'getGreaterthan';
}
