<?php
/**
 * Image Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Image Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Image extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Validate
     *
     * @return  boolean
     * @since   1.0.0
     */
    public function validate()
    {
        $hold = $this->field_value;

        if ($this->filter() === $hold) {
            return true;
        }

        return false;
    }

    /**
     * Filter
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function filter()
    {
        $url = str_replace(
            array('ftp://', 'ftps://', 'http://', 'https://'),
            ''
            ,
            strtolower($this->field_value)
        );

        if (filter_var($url, FILTER_SANITIZE_URL, $this->setFlags()) === $url) {
        } else {
            $this->field_value = null;
        }

        return $this->field_value;
    }

    /**
     * Escape
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function escape()
    {
        return $this->filter();
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function setFlags()
    {
        $filter = '';

        if (isset($this->options['FILTER_FLAG_PATH_REQUIRED'])) {
            $filter = 'FILTER_FLAG_PATH_REQUIRED';
        }

        if (isset($this->options['FILTER_FLAG_IPV6'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_QUERY_REQUIRED';
        }

        return $filter;
    }
}
