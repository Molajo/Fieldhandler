<?php
/**
 * Interface for Filters Adapter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Adapter;

defined('MOLAJO') or die;

/**
 * Interface for Filters Adapter
 *
 * @package   Molajo
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @since     1.0
 */
interface FilterInterface
{
    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function validate();

    /**
     * Filter Input
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
