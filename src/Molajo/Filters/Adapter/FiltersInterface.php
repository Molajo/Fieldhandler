<?php
/**
 * Filters Interface for Adapter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 */
namespace Molajo\Filters\Adapter;

defined('MOLAJO') or die;

/**
 * Filters Interface for Adapter
 *
 * @package   Molajo
 * @license   MIT
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @since     1.0
 */
interface FiltersInterface
{
    /**
     * Filters input data
     *
     * @param   string  $value Value of input field
     * @param   string  $type        Datatype of input field
     * @param   int     $null        0 or 1 - is null allowed
     * @param   string  $default     Default value, optional
     *
     * @return  void
     * @since   1.0
     */
    public function filterInput(
        $value    ,
        $type           = 'int',
        $null           = 1,
        $default        = null
    );

    /**
     * Escapes output
     *
     * @return  void
     * @since   1.0
     */
    public function escapeOutput();
}
