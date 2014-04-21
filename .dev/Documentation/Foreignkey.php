<?php
/**
 * Foreignkey Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use Exception;
use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\ConstraintInterface;

/**
 * Foreignkey Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Foreignkey extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->filter() === null) {
            return false;
        }

        return true;
    }

    /**
     * Filter
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function filter()
    {
        if ($this->field_value === null) {

        } else {

            $test = $this->verifyForeignKey($this->field_value);

            if ($test === $this->field_value) {
            } else {
                $this->field_value = null;
            }
        }

        return $this->field_value;
    }

    /**
     * Escape
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function escape()
    {
        return $this->filter();
    }

    /**
     * Verify Foreign Key
     *
     * @param   mixed $key_value
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function verifyForeignKey($key_value)
    {
        if ($this->database === null) {
            throw new UnexpectedValueException
            (
                'Fieldhandler Foreignkey: Database connection must be sent in as a database entry $options array.'
            );
        }

        if ($this->table === null) {
            throw new UnexpectedValueException
            (
                'Fieldhandler Foreignkey: Name of table must be sent in as a table entry in the $options array.'
            );
        }

        if ($this->key === null) {
            throw new UnexpectedValueException
            (
                'Fieldhandler Foreignkey: Name of key must be sent in as a key entry in the $options array.'
            );
        }

        $query = $this->database->getQueryObject();

        $query->select($this->key);
        $query->from($this->table);
        $query->where($this->key . ' =  ' . quote($key_value));

        try {

            return $this->database->loadResult($query->getSQL());

        } catch (Exception $e) {

            throw new UnexpectedValueException
            (
                'Fieldhandler Foreignkey: Database query failed: ' . $e->getMessage()
            );
        }
    }
}
