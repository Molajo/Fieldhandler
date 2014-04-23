<?php
/**
 * Float Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Float Constraint
 *
 * @link       http://php.net/manual/en/function.is-float.php
 * @link       http://php.net/manual/en/function.is-double.php
 * @link       http://php.net/manual/en/function.is-real.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Float extends Abstractfiltervar implements ConstraintInterface
{
    /**
     * Filter Type
     *
     * @var    string
     * @since  1.0.0
     */
    protected $filter_type = FILTER_VALIDATE_FLOAT;
}
