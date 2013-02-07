<?php
/**
 * Request for Filters Services Class
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 */
namespace Molajo\Filters;

defined('MOLAJO') or die;

use Molajo\Filters\Adapter\FiltersInterface;
use Molajo\Filters\Exception\FiltersException;

/**
 * Request for Filters Services Class
 *
 * @package   Molajo
 * @license   MIT
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @since     1.0
 */
Class Adapter implements FiltersInterface
{
    /**
     * Filters Type
     *
     * @var     string
     * @since   1.0
     */
    public $fs;

    /**
     * Construct
     *
     * @param   string  $action
     * @param   string  $path
     * @param   string  $filesystem_type
     * @param   array   $options
     *
     * @since   1.0
     * @throws  FiltersException
     */
    public function __construct($action = '', $path = '', $filesystem_type = 'Local', $options = array())
    {
        $options = $this->getTimeZone($options);

        if ($filesystem_type == '') {
            $filesystem_type = 'Local';
        }
        $this->getFiltersType($filesystem_type);

        $this->connect($options);

        if ($path == '') {
            throw new FiltersException
            ('Filters Path is required, but was not provided.');
        }
        $this->setPath($path);

        $this->getMetadata();

        $this->doAction($action);

        $this->close();

        return $this->filter;
    }

    /**
     * Get the Filters Type (ex., Local, Ftp, Virtual, etc.)
     *
     * @param   string  $filesystem_type
     *
     * @return  void
     * @since   1.0
     * @throws  FiltersException
     */
    protected function getFiltersType($filesystem_type)
    {
        $class = 'Molajo\\Filters\\Type\\' . $filesystem_type;

        if (class_exists($class)) {
        } else {
            throw new FiltersException
            ('Filters Type Class ' . $class . ' does not exist.');
        }

        $this->filter = new $class($filesystem_type);

        return;
    }

    /**
     * Validates the input data
     *
     * @return  void
     * @since   1.0
     */
    public function validateData()
    {
        $this->filter->validateData();

        return;
    }

    /**
     * Filters input data
     *
     * @return  void
     * @since   1.0
     */
    public function filterInput()
    {
        $this->filter->filterInput();

        return;
    }

    /**
     * Escapes output
     *
     * @return  void
     * @since   1.0
     */
    public function escapeOutput()
    {
        $this->filter->escapeOutput();

        return;
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
