<?php
/**
 * Notnull Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Notnull Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Notnull extends AbstractNull implements ConstraintInterface
{
    /**
     * Validation
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        return parent::validationNotNull();
    }
}
