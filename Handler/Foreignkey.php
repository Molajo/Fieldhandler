<?php
/**
 * Foreignkey Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Handler;

use Exception;
use Exception\Model\FieldhandlerException;

/**
 * Foreignkey Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class Foreignkey extends AbstractFieldhandler
{
    /**
     * Constructor
     *
     * @param   string $method
     * @param   string $field_name
     * @param   mixed  $field_value
     * @param   array  $fieldhandler_type_chain
     * @param   array  $options
     *
     * @return  mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $field_name,
        $field_value,
        $fieldhandler_type_chain,
        $options = array()
    ) {
        parent::__construct($method, $field_name, $field_value, $fieldhandler_type_chain, $options);
    }

    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0
     * @throws  FieldhandlerException
     */
    public function validate()
    {
        parent::validate();

        $this->filter();

        return $this->getFieldValue();
    }

    /**
     * Fieldhandler Input
     *
     * @return  mixed
     * @since   1.0
     * @throws  FieldhandlerException
     */
    public function filter()
    {
        parent::filter();

        if ($this->getFieldValue() === null) {
        } else {

            $test = $this->verifyForeignKey($this->getFieldValue());

            if ($test == $this->getFieldValue()) {
            } else {
                throw new FieldhandlerException
                ('Validate Foreignkey: ' . FILTER_INVALID_VALUE);
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Escapes and formats output
     *
     * @return  mixed
     * @since   1.0
     */
    public function escape()
    {
        parent::escape();

        $this->filter();

        return $this->getFieldValue();
    }

    /**
     * Verify Foreign Key
     *
     * @param   mixed $key_value
     *
     * @return  mixed
     * @since   1.0
     * @throws  FieldhandlerException
     */
    public function verifyForeignKey($key_value)
    {
        if ($this->database === null) {
            throw new FieldhandlerException
            ('Validate Foreignkey: Database connection must be sent in as a database entry $options array.');
        }

        if ($this->table === null) {
            throw new FieldhandlerException
            ('Validate Foreignkey: Name of table must be sent in as a table entry in the $options array.');
        }

        if ($this->key === null) {
            throw new FieldhandlerException
            ('Validate Foreignkey: Name of key must be sent in as a key entry in the $options array.');
        }

        $query = $this->database->getQueryObject();

        $query->select($this->database->quoteName($this->key));
        $query->from($this->database->quoteName($this->table));
        $query->where(
            $this->database->quoteName($this->key)
            . ' =  ' . $this->database->quote($key_value)
        );

        try {

            return $this->database->loadResult();
        } catch (Exception $e) {

            throw new FieldhandlerException
            ('Fieldhandler Foreignkey: Database query failed: ' . $e->getMessage());
        }
    }
}
