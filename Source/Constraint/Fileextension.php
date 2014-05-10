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
    protected $compare_to_array_option_name = 'array_valid_extensions';

    /**
     * Validation Test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if (is_file($this->field_value)) {
        } else {
            return false;
        }

        $path_info = pathinfo($this->field_value);

        $this->field_value = $path_info['extension'];

        return parent::validation();
    }
}
