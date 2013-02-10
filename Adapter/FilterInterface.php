<?php
/**
 * Interface for Filters Adapter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 */
namespace Molajo\Filters\Adapter;

defined('MOLAJO') or die;

/**
 * Interface for Filters Adapter
 *
 * @package   Molajo
 * @license   MIT
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @since     1.0
 */
interface FilterInterface
{
    /**
     * Validate Input
     *
     * @param   string   $filter_type
     * @param   mixed    $value
     * @param   int      $null
     * @param   null     $default
     *
     * @return  mixed
     * @since   1.0
     */
    public function validateInput($filter_type, $value, $null = 1, $default = null);

    /**
     * Filter Input
     *
     * @param   string   $filter_type
     * @param   mixed    $value
     * @param   int      $null
     * @param   null     $default
     *
     * @return  mixed
     * @since   1.0
     */
    public function filterInput($filter_type, $value, $null = 1, $default = null);

    /**
     * Escape output
     *
     * @param   string  $filter_type
     * @param   mixed   $value
     *
     * @return  void
     * @since   1.0
     */
    public function escapeOutput($filter_type, $value);
}
