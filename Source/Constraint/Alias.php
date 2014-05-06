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
class Alias extends AbstractConstraint implements ConstraintInterface
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

        if ($this->validateAlias() === false) {
            $this->setValidateMessage(1000);
            return false;
        }

        return true;
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
            return null;
        }

        $this->field_value = $this->sanitizeAlias($this->field_value);

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
        $this->sanitize();

        $this->field_value = $this->formatAlias($this->field_value);

        return $this->field_value;
    }

    /**
     * Validate Alias Slug
     *
     * @return  bool
     * @since   1.0.0
     */
    protected function validateAlias()
    {
        $alias = $this->field_value;
        $alias = $this->sanitizeAlias($alias);
        $alias = $this->formatAlias($alias);

        if ($this->field_value === $alias) {
        } else {
            return false;
        }

        return true;
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
        return $this->sanitizeByCharacter('ctype_alnum', str_replace('-', ' ', trim($alias)), true);
    }

    /**
     * Create Alias from Text Value
     *
     * @param   string $alias
     *
     * @return  string
     * @since   1.0.0
     */
    protected function formatAlias($alias)
    {
        $alias = str_replace('-', ' ', strtolower(trim($alias)));
        $alias = trim($alias, '-');
        $alias = str_replace('  ', ' ', strtolower(trim($alias)));
        $alias = str_replace(' ', '-', strtolower(trim($alias)));

        return $alias;
    }
}
