<?php
/**
 * Contains Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Contains Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Contains extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Test Contains Array
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        if ($this->testContains() === false) {
            $this->setValidateMessage(1000);

            return false;
        }

        return true;
    }

    /**
     * Test Contains
     *
     * @return  integer
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function testContains()
    {
        return mb_strpos($this->field_value, $this->getOption('contains'), 0, mb_detect_encoding($this->field_value));
    }
}
