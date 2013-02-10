<?php
/**
 * Filter Adapter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 */
namespace Molajo\Filters;

defined('MOLAJO') or die;

use Molajo\Filters\Adapter\FilterInterface;
use Molajo\Filters\Exception\FilterException;

/**
 * Filter Adapter
 *
 * @package   Molajo
 * @license   MIT
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @since     1.0
 */
Class Adapter
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
    public function validateInput($value, $filter_type, $null = 1, $default = null)
    {
        return $this->getFiltersType($filter_type)->validateInput($value, $filter_type, $null, $default);
    }

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
    public function filterInput($value, $filter_type, $null = 1, $default = null)
    {
        return $this->getFiltersType($filter_type)->filterInput($value, $filter_type, $null, $default);
    }

    /**
     * Escapes output
     *
     * @param   string   $filter_type
     * @param   mixed    $value
     *
     * @return  mixed
     * @since   1.0
     */
    public function escapeOutput($filter_type, $value)
    {
        return $this->getFiltersType($filter_type)->escapeOutput($value);
    }

    /**
     * Get the Filters Type (ex., Local, Ftp, Virtual, etc.)
     *
     * @param   string  $filter_type
     *
     * @return  object
     * @since   1.0
     * @throws  FilterException
     */
    protected function getFiltersType($filter_type)
    {
        $class = 'Molajo\\Filters\\Type\\' . $filter_type;

        if (class_exists($class)) {
        } else {
            throw new FilterException
            ('Filter Type Class ' . $class . ' does not exist.');
        }

        return new $class($filter_type);
    }

    /**
     * Get timezone
     *
     * @param   array  $options
     *
     * @return  array
     * @since   1.0
     */
    protected function getTimeZone($options)
    {
        $timezone = '';

        if (is_array($options)) {
        } else {
            $options = array();
        }

        if (isset($options['timezone'])) {
            $timezone = $options['timezone'];
        }

        if ($timezone === '') {
            if (ini_get('date.timezone')) {
                $timezone = ini_get('date.timezone');
            }
        }

        if ($timezone === '') {
            $timezone = 'UTC';
        }

        ini_set('date.timezone', $timezone);
        $options['timezone'] = $timezone;

        return $options;
    }
}
