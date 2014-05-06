<?php
/**
 * Foreignkey Constraint
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
 * Foreignkey Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Foreignkey extends AbstractDatabase implements ConstraintInterface
{
    /**
     * Method Test
     *
     * @var    string
     * @since  1.0.0
     */
    protected $method_test = 'verifyForeignKey';

    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->sanitize() === null) {
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
        parent::sanitize();
    }

    /**
     * Format
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function format()
    {
        return parent::format();
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
    public function verifyForeignKey()
    {
        $this->verifyForeignkeyInput('database');
        $this->verifyForeignkeyInput('table');
        $this->verifyForeignkeyInput('key');

        $query = $this->verifyForeignkeyInput($this->field_value);

        return $this->executeDatabaseQuery($query);
    }

    /**
     * Verify Input has been correctly sent into class
     *
     * @param   string $type
     *
     * @return  $this
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function setForeignKeyQuery($type)
    {
        if ($this->$type === null) {
            throw new UnexpectedValueException
            (
                'Fieldhandler Foreignkey: ' . $type . ' is required input for the $options array.'
            );
        }
    }

    /**
     * Create Query
     *
     * @param   string $key_value
     *
     * @return  object
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function verifyForeignkeyInput($key_value)
    {
        $query = $this->database->getQueryObject();

        $query->select($this->key);
        $query->from($this->table);
        $query->where($this->key . ' =  ' . quote($key_value));

        return $query;
    }

    /**
     * Verify Input has been correctly sent into class
     *
     * @param   object $query
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    protected function executeDatabaseQuery($query)
    {
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
