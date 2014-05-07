<?php
/**
 * Defaults Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Defaults Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Defaults extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 7000;

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        $this->setDefault();

        return $this->field_value;
    }

    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if ($this->field_value === NULL) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * If needed, apply default to Field
     *
     * @return  $this
     * @since   1.0.0
     */
    protected function setDefault()
    {
        if ($this->field_value === NULL) {
            $this->field_value = $this->getOption('default');
        }

        return $this;
    }
}
