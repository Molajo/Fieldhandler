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

include __DIR__ . '/Library/kses.php';

/**
 * Html Constraint
 *
 * To review or override white_list, see AbstractHtml Constraint Class
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Html extends AbstractHtml implements ConstraintInterface
{
    /**
     * Validate
     *
     * Verifies that the field value contents do not contain any HTML tags or attributes
     * which are not defined in the white_list. If false, use sanitize to clean content.
     *
     * To review or override white_list, see AbstractHtml Constraint Class
     *
     * @api
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
     * Sanitizes the field value contents so that there are no HTML tags or attributes
     * which have not been defined in the white_list. Critical for security.
     *
     * To review or override white_list, see AbstractHtml Constraint Class
     *
     * @api
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
     * Escapes the field value contents for presentation on the web; critical for security
     *
     * To review or override white_list, see AbstractHtml Constraint Class
     *
     * @api
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
