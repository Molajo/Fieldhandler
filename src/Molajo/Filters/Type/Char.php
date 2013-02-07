<?php
/**
 *Char Filters
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
 * Char Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 * @since     1.0
 */
class Char implements Filtersinterface
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

                $this->filesystem_type = 'Char';
                return $this;
            }
        }

        throw new FiltersException
        ('Char Filter Adapter Constructor Method can only be accessed by the Filter Adapter.');
    }

    /**
     * Filters input data
     *
     * @param   string  $value Value of input field
     * @param   string  $type        Datatype of input field
     * @param   int     $null        0 or 1 - is null allowed
     * @param   string  $default     Default value, optional
     *
     * @return  string
     * @since   1.0
     */
    public function filterInput($value, $type = 'int', $null = 1, $default = null)
    {
        if ($default == null) {
        } else {
            if ($value == null) {
                $value = $default;
            }
        }

        if ($value == null) {
        } else {
            $test = filter_var($value, FILTER_SANITIZE_STRING);
            if ($test == $value) {
                return $test;
            } else {
                throw new \Exception('FILTER_INVALID_VALUE');
            }
        }

        if ($value == null
            && $null == 0
        ) {
            throw new \Exception('FILTER_VALUE_REQUIRED');
        }

        return trim($value);
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
