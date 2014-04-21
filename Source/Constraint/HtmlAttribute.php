<?php
/**
 * HtmlAttribute Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

include __DIR__ . '/Libraries/kses.php';

/**
 * HtmlAttribute Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class HtmlAttribute extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === $this->handleInput()) {
            return true;
        }

        $this->setValidateMessage(8000);

        return false;
    }

    /**
     * Handle Input
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function handleInput()
    {
        if ($this->field_value === null) {
        } else {
            $this->field_value = kses($this->field_value, $this->white_list, array('http', 'https'));
        }

        return $this->field_value;
    }

    /**
     * Handle Output
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function handleOutput()
    {
        return $this->handleInput();
    }
}
