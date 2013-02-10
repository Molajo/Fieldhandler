<?php
/**
 *Boolean Filters
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
 * Boolean Filters
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   MIT
 * @since     1.0
 */
class Boolean implements FilterInterface
{
    /**
     * Filters input data
     *
     * @param   string  $value
     * @param   string  $type
     * @param   boolean $null
     * @param   string  $default
     *
     * @return  string
     * @since   1.0
     */
    public function filterInput($value, $type = 'boolean', $null = 1, $default = null)
    {
        if ($default == null) {
        } else {
            $value = $default;
        }

        if ($value == null) {
            $value = $default;
        }

        if ($value == null) {
        } else {
            $test = filter_var($value, FILTER_VALIDATE_BOOLEAN);
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
     * @param   string  $value  Value of input field
     *
     * @return  void
     * @since   1.0
     */
    public function escapeOutput($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
