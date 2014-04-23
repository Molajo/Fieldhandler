<?php
/**
 * Html Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

include __DIR__ . '/Libraries/kses.php';

/**
 * Html Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Html extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === $this->sanitize()) {
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
            $this->field_value = kses($this->field_value, $this->white_list, array('http', 'https'));
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
        /**
         * $class                 = 'Zend\Escaper\Escaper';
         * $adapter               = new $class();
         * $class                 = 'Molajo\\Fieldhandler\\Escape\\Zend';
         * $adapter               = new $class($adapter);
         * $class                 = 'Molajo\\Fieldhandler\\Escape';
         * $escape_instance = new $class($adapter);
         */
        if ($this->field_value === null) {
        } else {
            // $this->field_value = $this->escape_instance->escapeHtml($this->field_value);
        }
        // $this->field_value = htmlspecialchars($this->field_value, null, 'utf-8');
        return $this->field_value;
    }
}
