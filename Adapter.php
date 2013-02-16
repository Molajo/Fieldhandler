<?php
/**
 * Filter Adapter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters;

defined('MOLAJO') or die;

use Exception;
use Molajo\Filters\Exception\FilterException;

/**
 * Filter Adapter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
Class Adapter
{
    /**
     * Filter Type
     *
     * @var    string
     * @since  1.0
     */
    protected $filter_type;

    /**
     * Filter Type Object
     *
     * @var    object   FilterInterface
     * @since  1.0
     */
    protected $ft;

    /**
     * Method (validate, filter, escape)
     *
     * @var    string
     * @since  1.0
     */
    protected $method;

    /**
     * Constructor
     *
     * @param   string   $method (validate, filter, escape)
     * @param   string   $filter_type
     *
     * @param   mixed    $value
     * @param   null     $default
     * @param   bool     $required
     * @param   null     $min
     * @param   null     $max
     * @param   array    $values
     * @param   string   $regex
     * @param   object   $callback
     * @param   array    $options
     *
     * @return  mixed
     * @since   1.0          Molajo/Filters/Adapter(Validate, 'Int', 888, 777, false, null, null);
     */
    public function __construct(
        $method,
        $filter_type,
        $value,
        $default = null,
        $required = true,
        $min = null,
        $max = null,
        $values = array(),
        $regex = null,
        $callback = null,
        $options = array()
    ) {
        if (defined('FILTER_VALUE_REQUIRED')) {
        } else {
            $this->defines();
        }

        $class = $this->getType($filter_type);

        try {

            $this->ft = new $class ($method,
                $filter_type,
                $value,
                $default,
                $required,
                $min,
                $max,
                $values,
                $regex,
                $callback,
                $options);

        } catch (Exception $e) {

            throw new FilterException
            ('Filters: Could not instantiate Filter Type: ' . $filter_type
                . ' Class: ' . $class);
        }

        return $this->ft->$method();
    }

    /**
     * Instantiates Filter Class
     *
     * @param   string  $filter_type
     *
     * @return  object
     * @since   1.0
     * @throws  FilterException
     */
    protected function getType($filter_type)
    {
        $class = 'Molajo\\Filters\\Type\\' . $filter_type;

        if (class_exists($class)) {
        } else {
            throw new FilterException
            ('Filter Type Class ' . $class . ' does not exist.');
        }

        return $class;
    }

    /**
     * Define Contacts
     *
     * @return  object
     * @since   1.0
     * @throws  FilterException
     */
    protected function defines()
    {
        if (defined('FILTER_VALUE_REQUIRED')) {
        } else {
            define('FILTER_VALUE_REQUIRED', ' Value required.');
        }

        if (defined('FILTER_INVALID_VALUE')) {
        } else {
            define('FILTER_INVALID_VALUE', ' Invalid value.');
        }

        return;
    }
}
