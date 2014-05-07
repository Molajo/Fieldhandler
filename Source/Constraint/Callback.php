<?php
/**
 * Callback Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Callback Constraint
 *
 * @link       http://us3.php.net/callback
 * @link       http://us3.php.net/manual/en/language.types.callable.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Callback extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Filter Type
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $filter_type = FILTER_CALLBACK;

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Used by Constraint Classes to customize option values needed for Field handling
     *
     * @return  array
     * @since   1.0.0
     */
    public function setOptions()
    {
        $return            = array();
        $return['options'] = $this->getOption('callback');

        return $return;
    }

    /**
     * Validation
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validation()
    {
        if (filter_var($this->field_value, $this->filter_type, $this->setOptions()) === FALSE) {
            return FALSE;
        }

        return TRUE;
    }
}
