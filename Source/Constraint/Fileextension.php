<?php
/**
 * Fileextension Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Fileextension Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Fileextension extends AbstractArrays implements ConstraintInterface
{
    /**
     * Array Options Entry Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $array_option_type = 'array_valid_extensions';

    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === NULL) {
            return TRUE;
        }

        if (is_file($this->field_value)) {
        } else {
            $this->setValidateMessage(9000);

            return FALSE;
        }

        $path_info = pathinfo($this->field_value);

        $this->field_value = $path_info['extension'];

        if (parent::validate()) {
            return TRUE;
        }

        $this->setValidateMessage(9000);

        return FALSE;

    }

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        $hold = $this->field_value;

        if (parent::sanitize()) {
            $this->field_value = $hold;
        } else {
            $this->field_value = NULL;
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
        return parent::format();
    }
}
