<?php
/**
 * Mimetypes Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;
use CommonApi\Exception\UnexpectedValueException;

/**
 * Mimetypes Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Mimetypes extends AbstractConstraint implements ConstraintInterface
{
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

        if (in_array($this->field_value, $this->getMimetypes())) {
            return true;
        }

        $this->setValidateMessage(12000);

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
        if ($this->field_value === null) {
        } else {

            if (in_array($this->field_value, $this->getMimetypes())) {
            } else {
                $this->field_value = null;
            }
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
        return $this->sanitize();
    }

    /**
     * Test Array Entry Mimetypes
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function getMimetypes()
    {
        $array_valid_mimetypes = $this->getOption('array_valid_mimetypes', array());

        if (is_array($array_valid_mimetypes)
            && count($array_valid_mimetypes) > 0
        ) {

            throw new UnexpectedValueException
            (
                'Fieldhandler Maximum: must provide options[maximum] array values.'
            );
        }

        return $array_valid_mimetypes;
    }
}
