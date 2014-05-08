<?php
/**
 * Alias Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Alias Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Alias extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Format
     *
     * @return  string
     * @since   1.0.0
     */
    public function format()
    {
        if ($this->field_value === null) {
            return null;
        }

        return $this->sanitizeAlias($this->field_value);
    }

    /**
     * Validation test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        $alias = $this->field_value;
        $alias = $this->sanitizeAlias($alias);

        if ($this->field_value === $alias) {
            return true;
        }

        return false;
    }

    /**
     * Sanitize Alias Slug
     *
     * @param   string $alias
     *
     * @return  string
     * @since   1.0.0
     */
    protected function sanitizeAlias($alias)
    {
        $alias = str_replace('-', ' ', strtolower(trim($alias)));
        $alias = trim($alias, '-');
        $alias = str_replace('  ', ' ', strtolower(trim($alias)));
        $alias = $this->sanitizeByCharacter('ctype_alnum', $alias, true);
        $alias = str_replace(' ', '-', $alias);

        return $alias;
    }
}
