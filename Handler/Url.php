<?php
/**
 * Url FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\FieldHandler\Handler;

defined('MOLAJO') or die;

use Molajo\FieldHandler\Exception\FieldHandlerException;

use Molajo\FieldHandler\Api\FieldHandlerInterface;

/**
 * Url FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Url extends AbstractFieldHandler
{
    /**
     * Constructor
     *
     * @param   string $method
     * @param   string $field_name
     * @param   mixed  $field_value
     * @param   array  $fieldhandler_type_chain
     * @param   array  $options
     *
     * @return  mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $field_name,
        $field_value,
        $fieldhandler_type_chain,
        $options = array()
    ) {
        return parent::__construct($method, $field_name, $field_value, $fieldhandler_type_chain, $options);
    }

    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0
     */
    protected function validate()
    {
        parent::validate();

        if ($this->getFieldValue() === null) {
        } else {

            $url = str_replace(
                array('ftp://', 'ftps://', 'http://', 'https://'),
                ''
                ,
                strtolower($this->getFieldValue())
            );

            $test = filter_var($url, FILTER_VALIDATE_URL, $this->setFlags());

            if ($test == true) {
            } else {
                throw new FieldHandlerException
                ('Validate Url: ' . FILTER_INVALID_VALUE);
            }
        }

        return $this->getFieldValue();
    }

    /**
     * FieldHandler Input
     *
     * @return  mixed
     * @since   1.0
     */
    protected function filter()
    {
        parent::filter();

        if ($this->getFieldValue() === null) {
        } else {

            $url = str_replace(
                array('ftp://', 'ftps://', 'http://', 'https://'),
                ''
                ,
                strtolower($this->getFieldValue())
            );

            $test = filter_var($url, FILTER_SANITIZE_URL, $this->setFlags());

            if ($test == true) {
            } else {
                $this->setFieldValue(filter_var($url, FILTER_SANITIZE_URL));
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Escapes and formats output
     *
     * @return  mixed
     * @since   1.0
     */
    protected function escape()
    {
        parent::escape();

        $url = str_replace(
            array('ftp://', 'ftps://', 'http://', 'https://'),
            ''
            ,
            strtolower($this->getFieldValue())
        );

        $test = filter_var($url, FILTER_SANITIZE_URL, $this->setFlags());

        if ($test == true) {
        } else {
            $this->setFieldValue(filter_var($url, FILTER_SANITIZE_URL));
        }

        return $this->getFieldValue();
    }

    /**
     * Flags can be set in options array
     *
     * @return  mixed
     * @since   1.0
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
