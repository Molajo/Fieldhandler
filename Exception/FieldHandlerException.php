<?php
/**
 * FieldHandlerException
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Exception;

defined('MOLAJO') or die;

use RuntimeException;
use Molajo\FieldHandler\Api\ExceptionInterface;

/**
 * FieldHandlerException Exception
 *
 * @package   Molajo
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @since     1.0
 */
class FieldHandlerException extends RuntimeException implements ExceptionInterface
{

}
