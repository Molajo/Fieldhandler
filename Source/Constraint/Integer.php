<?php
/**
 * Integer Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Integer Constraint
 *
 * @link       http://php.net/manual/en/function.is-int.php
 *             http://php.net/manual/en/function.is-long.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Integer extends Abstractfiltervar implements ConstraintInterface
{
    /**
     * Filter Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $filter_type = FILTER_VALIDATE_INT;
}
