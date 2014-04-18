<?php
/**
 * Foreignkey Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use Exception;
use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Foreignkey Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Foreignkey extends AbstractFieldhandler implements FieldhandlerAdapterInterface
{
    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        $this->filter();

        return $this->field_value;
    }

    /**
     * Filter Input
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function filter()
    {
        if ($this->field_value === null) {
        } else {

            $test = $this->verifyForeignKey($this->field_value);

            if ($test == $this->field_value) {
            } else {
                throw new UnexpectedValueException
                (
                    'Validate Foreignkey: Invalid Value'
                );
            }
        }

        return $this->field_value;
    }

    /**
     * Escapes and formats output
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function escape()
    {
        $this->filter();

        return $this->field_value;
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
                'Validate Foreignkey: Database connection must be sent in as a database entry $options array.'
            );
        }

        if ($this->table === null) {
            throw new UnexpectedValueException
            (
                'Validate Foreignkey: Name of table must be sent in as a table entry in the $options array.'
            );
        }

        if ($this->key === null) {
            throw new UnexpectedValueException
            (
                'Validate Foreignkey: Name of key must be sent in as a key entry in the $options array.'
            );
        }

        $query = $this->database->getQueryObject();

        $query->select(quoteName($this->key));
        $query->from(quoteName($this->table));
        $query->where(
            quoteName($this->key)
            . ' =  ' . quote($key_value)
        );

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
