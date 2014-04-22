<?php
/**
 * Controlcharacters Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Controlcharacters Constraint
 *
 * @link       http://us1.php.net/manual/en/function.ctype-cntrl.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Controlcharacters extends AbstractConstraint implements ConstraintInterface
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
            return $this->field_value;
        }

        $allow_whitespace = false;
        if (isset($this->options['allow_whitespace'])) {
            $allow_whitespace = true;
        }

        $tested = $this->filterByCharacter('ctype_cntrl', $this->field_value, $allow_whitespace);

        if ($tested === $this->field_value) {
            return true;
        }

        $this->setValidateMessage(2000);

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
            return $this->field_value;
        }

        $allow_whitespace = false;
        if (isset($this->options['allow_whitespace'])) {
            $allow_whitespace = true;
        }
        $this->field_value = $this->filterByCharacter('ctype_cntrl', $this->field_value, $allow_whitespace);

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
        return $this->field_value;
    }
}
