<?php
/**
 * Cache Interface
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Service\Adapter;

defined('MOLAJO') or die;

/**
 * Cache Interface
 *
 * @package   Molajo
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @since     1.0
 */
interface FieldHandlerInterface
{

    /**
     * Determine if cache exists for this object
     *
     * @param string $type
     * @param string $key  md5 name uniquely identifying content
     *
     * @return boolean The option value.
     * @since   1.0
     */
    public function exists($type, $key);

    /**
     * Create a cache entry or set a parameter value
     *
     * @param string $type  Parameter, Page, Template, Query, Model
     * @param string $key   md5 name uniquely identifying content
     * @param mixed  $value Data to be serialized and then saved as cache
     *
     * @return bool|Cache
     * @since   1.0
     * @throws  OutOfRangeException
     */
    public function set($type, $key, $value);

    /**
     * Return cached or parameter value
     *
     * @param string $type
     * @param string $key     md5 name uniquely identifying content
     * @param null   $default
     *
     * @return bool|mixed           cache for this key that has not been serialized
     * @throws  \OutOfRangeException
     * @since   1.0
     */
    public function get($type, $key, $default = null);

    /**
     * Load cache
     *
     * @param string $type
     *
     * @return bool|Cache
     * @since   1.0
     * @throws  Exception
     */
    public function load($type);

    /**
     * Remove cache for specified $key value
     *
     * @param string $type
     * @param string $key  md5 name uniquely identifying content
     *
     * @return  object
     * @since   1.0
     */
    public function delete($type, $key);

    /**
     * Flush all cache
     *
     * @param string $type
     *
     * @return Cache
     * @since   1.0
     */
    public function flush($type = '');

}
