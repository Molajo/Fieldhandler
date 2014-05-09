<?php
/**
 * Abstract Fieldhandler for ctype data types
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Abstract Ctype Constraint
 *
 * @link       http://us1.php.net/manual/en/ref.ctype.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractCtype extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * ctype Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $ctype;

    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 2000;

    /**
     * Sanitize
     *
     * @return  null|string
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === null) {
            return $this->field_value;
        }

        $this->field_value = $this->sanitizeByCType($this->ctype, $this->field_value);

        return $this->field_value;
    }

    /**
     * Validation Test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        $temp = $this->sanitizeByCType($this->ctype, $this->field_value);

        if ($temp === $this->field_value) {
            return true;
        }

        return false;
    }

    /**
     * Common Sanitize Method for ctype
     *
     * @param   string $ctype
     * @param   mixed  $field_value
     *
     * @return  string
     * @since   1.0.0
     */
    protected function sanitizeByCType($ctype, $field_value)
    {
        return $this->sanitizeByCharacter($ctype, $field_value, $this->getOption('allow_space_character', false));
    }
}
