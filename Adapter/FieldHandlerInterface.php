<?php
/**
 * Interface for FieldHandler Adapter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Adapter;

defined('MOLAJO') or die;

/**
 * Interface for FieldHandler Adapter
 *
 * @package   Molajo
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @since     1.0
 */
interface FieldHandlerInterface
{
    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function validate();

    /**
     * FieldHandler Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function filter();

    /**
     * Escape output
     *
     * @return  mixed
     * @since   1.0
     */
    public function escape();
}
