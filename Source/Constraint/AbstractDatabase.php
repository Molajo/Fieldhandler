<?php
/**
 * AbstractDatabase Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Fieldhandler\ConstraintInterface;

/**
 * AbstractDatabase Constraint
 *
 * @package    Molajo
 * @copyright  2014-2015 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
abstract class AbstractDatabase extends AbstractConstraintTests implements ConstraintInterface
{
    /**
     * Database instance
     *
     * @var    object
     * @since  1.0.0
     */
    protected $database;

    /**
     * Database Table
     *
     * @var    string
     * @since  1.0.0
     */
    protected $table;

    /**
     * Table key
     *
     * @var    string
     * @since  1.0.0
     */
    protected $key;

    /**
     * Constructor
     *
     * @param   string $constraint
     * @param   string $method
     * @param   string $field_name
     * @param   mixed  $field_value
     * @param   array  $options
     *
     * @api
     * @since   1.0.0
     */
    public function __construct(
        $constraint,
        $method,
        $field_name,
        $field_value,
        array $options = array()
    ) {
        parent::__construct(
            $constraint,
            $method,
            $field_name,
            $field_value,
            $options
        );

        $this->processOption('database');
        $this->processOption('table');
        $this->processOption('key');
    }
}
