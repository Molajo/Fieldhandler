<?php
/**
 *Date Filters
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
use Molajo\Filters\Adapter\FilterInterface;
use Molajo\Filters\Exception\FilterException;

/**
 * Date Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 * @since     1.0
 */
class Date implements Filtersinterface
{
    /**
     * Class constructor
     *
     * @since   1.0
     * @throws  FilterException
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

                $this->filesystem_type = 'Date';
                return $this;
            }
        }

        throw new FilterException
        ('Date Filter Adapter Constructor Method can only be accessed by the Filter Adapter.');
    }

    /**
     * Filters Date data
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
        } elseif ($value == null
            || $value == ''
            || $value == 0
        ) {
            $value = $default;
        }

        if ($value == null
            || $value == '0000-00-00 00:00:00'
        ) {

        } else {
            $dd   = substr($value, 8, 2);
            $mm   = substr($value, 5, 2);
            $ccyy = substr($value, 0, 4);

            if (checkdate((int)$mm, (int)$dd, (int)$ccyy)) {
            } else {
                throw new \Exception('FILTER_INVALID_VALUE');
            }
            $test = $ccyy . '-' . $mm . '-' . $dd;

            if ($test == substr($value, 0, 10)) {
                return $value;
            } else {
                throw new \Exception('FILTER_INVALID_VALUE');
            }
        }

        if ($value == null
            && $null == 0
        ) {
            throw new \Exception('FILTER_VALUE_REQUIRED');
        }

        return $value;
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
