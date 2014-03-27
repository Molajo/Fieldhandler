<?php
/**
 * Image Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;

/**
 * Image Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class Image extends AbstractFieldhandler
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
     * @since   1.0
     */
    public function __construct(
        $method,
        $field_name,
        $field_value,
        $fieldhandler_type_chain,
        $options = array()
    ) {
        parent::__construct($method, $field_name, $field_value, $fieldhandler_type_chain, $options);
    }

    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {
        parent::validate();

        $hold = $this->getFieldValue();

        $test = $this->filter();

        if ($test == $hold) {
        } else {
            throw new UnexpectedValueException ('Validate Image: Invalid Value');
        }


        // todo: add active test checkdnsrr($this->getFieldValue());

        return $this->getFieldValue();
    }

    /**
     * Fieldhandler Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function filter()
    {
        parent::filter();

        $url = str_replace(
            array('ftp://', 'ftps://', 'http://', 'https://'),
            ''
            ,
            strtolower($this->getFieldValue())
        );

        $test = filter_var($url, FILTER_SANITIZE_URL, $this->setFlags());

        if ($test == $url) {
        } else {
            $this->setFieldValue(filter_var($url, FILTER_SANITIZE_URL));
        }

        return $this->getFieldValue();
    }

    /**
     * Escapes and formats output
     *
     * @return  mixed
     * @since   1.0
     */
    public function escape()
    {
        parent::escape();

        return $this->filter();
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
