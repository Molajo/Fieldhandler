<?php
/**
 * Tel Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Tel Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Tel extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Constraint Allowable Options
     *
     * @var    array
     * @since  1.0.0
     */
    protected $constraint_allowable_options = array(
        'FILTER_FLAG_NO_ENCODE_QUOTES',
        'FILTER_FLAG_STRIP_LOW',
        'FILTER_FLAG_STRIP_HIGH',
        'FILTER_FLAG_ENCODE_LOW',
        'FILTER_FLAG_ENCODE_HIGH',
        'FILTER_FLAG_ENCODE_AMP'
    );

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 8000;

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === NULL) {
        } else {
            $this->field_value = filter_var($this->field_value, FILTER_SANITIZE_STRING, $this->setFlags());
        }

        return $this->field_value;
    }

    /**
     * Format
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function format()
    {
        $this->sanitize();

        /** TODO: Apply localisation mask and remove example */

        if ($this->getOption('format_telephone', NULL) === NULL) {
        } else {

            $this->field_value = '1 (' . substr($this->field_value, 0, 3)
                . ') ' . substr($this->field_value, 0, 3)
                . '-' . substr($this->field_value, 0, 4);
        }

        return $this->field_value;
    }

    /**
     * Validation Test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if (filter_var($this->field_value, FILTER_SANITIZE_STRING, $this->setFlags())) {
            return TRUE;
        }

        return FALSE;
    }
}
