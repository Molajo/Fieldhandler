<?php
/**
 * Lessthan Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Lessthan Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Lessthan extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Verify if the input value is less than comparison value
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        return $this->testLessthan();
    }
}
