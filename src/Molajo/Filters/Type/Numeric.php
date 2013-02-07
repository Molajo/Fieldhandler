<?php
/**
 * Local Adapter for Filters
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
 * Numeric Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 * @since     1.0
 */
class Numeric implements Filtersinterface
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

                $this->filesystem_type = 'Numeric';
                return $this;
            }
        }

        throw new FiltersException
        ('Numeric Filter Adapter Constructor Method can only be accessed by the Filter Adapter.');
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
        } elseif ($field_value == null) {
            $field_value = $default;
        }

        if ($field_value == null) {
        } else {
            switch ($type) {

                case 'boolean':
                    $test = filter_var(
                        $field_value,
                        FILTER_SANITIZE_NUMBER_INT
                    );
                    if ($test == 1) {
                    } else {
                        $test = 0;
                    }
                    break;

                case 'float':
                    $test = filter_var(
                        $field_value,
                        FILTER_SANITIZE_NUMBER_FLOAT,
                        FILTER_FLAG_ALLOW_FRACTION
                    );
                    break;

                default:
                    $test = filter_var(
                        $field_value,
                        FILTER_SANITIZE_NUMBER_INT
                    );
                    break;

            }
            if ($test == $field_value) {
                return $test;
            } else {
                throw new \Exception('FILTER_INVALID_VALUE');
            }
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
