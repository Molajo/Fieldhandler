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
 * Abstract Fieldhandler for ctype data types
 *
 * @link       http://us1.php.net/manual/en/function.ctype-alpha.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class AbstractCtype extends AbstractConstraint implements ConstraintInterface
{
    /**
     * ctype Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $ctype;

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

        $temp = $this->sanitizeByCType($this->ctype, $this->field_value);

        if ($temp === $this->field_value) {
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
        } else {
            $this->field_value = $this->sanitizeByCType($this->ctype, $this->field_value);
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
     * Common Sanitize Method for ctype
     *
     * @param   string $ctype
     *
     * @return  string
     * @since   1.0.0
     */
    public function sanitizeByCType($ctype, $field_value)
    {
        return $this->sanitizeByCharacter($ctype, $field_value, $this->getOption('allow_whitespace', false));
    }
}
