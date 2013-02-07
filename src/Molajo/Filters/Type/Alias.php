<?php
/**
 *Alias Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 */
namespace Molajo\Filters\Type;

defined('MOLAJO') or die;

use Exception;
use RuntimeException;

use Molajo\Filters\Adapter as filterAdapter;
use Molajo\Filters\Adapter\FiltersInterface;
use Molajo\Filters\Exception\FiltersException;

/**
 * Alias Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 * @since     1.0
 */
class Alias implements Filtersinterface
{
    /**
     * Class constructor
     *
     * @since   1.0
     * @throws  FiltersException
     */
    public function __construct()
    {
        /** minimize memory http://php.net/manual/en/function.debug-backtrace.php */
        if (phpversion() < 50306) {
            $trace = debug_backtrace(1); // does not return objects
        }
        if (phpversion() > 50305) {
            $trace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS);
        }
        if (phpversion() > 50399) {
            $trace = debug_backtrace(1, 1); // limit objects and arguments retrieved
        }

        if (isset($trace[1])) {
            if ($trace[1]['class'] == 'Molajo\\Filters\\Adapter') {

                $this->Aliassystem_type = 'Alias';
                return $this;
            }
        }

        throw new FiltersException
        ('Alias Filter Adapter Constructor Method can only be accessed by the Filter Adapter.');
    }

    /**
     * Filters input data
     *
     * @param   string  $field_value Value of input field
     * @param   string  $type        Datatype of input field
     * @param   int     $null        0 or 1 - is null allowed
     * @param   string  $default     Default value, optional
     *
     * @return  string
     * @since   1.0
     */
    public function filterInput($field_value, $type = 'int', $null = 1, $default = null)
    {
        if ($default == null) {
        } else {
            $field_value = $default;
        }

        if ($field_value == null) {
            $field_value = $default;
        }

        if ($field_value == null) {
        } else {
            $test = filter_var($field_value, FILTER_SANITIZE_URL);

            /** Replace dashes with spaces */
            $field_value = str_replace('-', ' ', strtolower(trim($field_value)));

            /** Removes double spaces, ensures only alphanumeric characters */
            $field_value = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $field_value);

            /** Trim dashes at beginning and end */
            $field_value = trim($field_value, '-');
        }

        if ($field_value == null
            && $null == 0
        ) {
            throw new \Exception('FILTER_VALUE_REQUIRED');
        }

        return $field_value;
    }

    /**
     * Escapes output
     *
     * @return  void
     * @since   1.0
     */
    public function escapeOutput()
    {

    }
}
