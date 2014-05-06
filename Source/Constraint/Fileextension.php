<?php
/**
 * Fileextension Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Exception\UnexpectedValueException;
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
        if ($this->field_value === null) {
            return true;
        }

        if (is_file($this->field_value)) {
        } else {
            $this->setValidateMessage(9000);
            return false;
        }

        $path_info = pathinfo($this->field_value);

        $hold = $this->field_value;
        $this->field_value = $path_info['extension'];

        if (parent::validate()) {
            return true;
        }

        $this->setValidateMessage(9000);

        return false;

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
            $this->field_value = null;
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

    /**
     * Get File Extensions
     *
     * @return  array
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getExtensions()
    {
        $array_valid_extensions = $this->getOption('array_valid_extensions', null);

        if (is_array($array_valid_extensions)
            && count($array_valid_extensions) > 0
        ) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Contains: must provide options[contains] array values.'
            );
        }

        return $array_valid_extensions;
    }
}
