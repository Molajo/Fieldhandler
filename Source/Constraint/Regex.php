<?php
/**
 * Regex Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\ConstraintInterface;

/**
 * Regex Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Regex extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        if (preg_match($this->getRegex(), $this->field_value)) {
            return true;
        }

        $this->setValidateMessage(8000);

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

            if (preg_match($this->getRegex(), $this->field_value)) {
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
     * Format
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function getRegex()
    {
        $regex = '';

        if (isset($this->options['regex'])) {
        } else {
            throw new UnexpectedValueException
            (
                'Fieldhandler Regex: must provide options[regex] array values.'
            );
        }

        if (isset($this->options['regex'])) {
            $regex = $this->options['regex'];
        }

        return $regex;
    }
}
