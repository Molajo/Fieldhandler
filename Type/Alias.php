<?php
/**
 * Alias Filter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filters\Type;

defined('MOLAJO') or die;

/**
 * Alias Filter
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Alias extends AbstractFilter
{
    /**
     * Constructor
     *
     * @param   string   $method
     * @param   string   $field_name
     * @param   mixed    $field_value
     * @param   array    $filter_type_chain
     * @param   array    $options
     *
     * @return  mixed
     * @since   1.0
     */
    public function __construct(
        $method,
        $field_name,
        $field_value,
        $filter_type_chain,
        $options = array()
    ) {
        return parent::__construct($method, $field_name, $field_value, $filter_type_chain, $options);
    }

    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function validate()
    {
        parent::validate();

        if ($this->getFieldValue() === null) {
        } else {
            $test = $this->createAlias();
            if ($test == $this->getFieldValue()) {
            } else {
                throw new FilterException
                ('Validate Alias: ' . FILTER_INVALID_VALUE);
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Filter Input
     *
     * @return  mixed
     * @since   1.0
     */
    public function filter()
    {
        parent::filter();

        if ($this->getFieldValue() === null) {
        } else {
            $this->setFieldValue($this->createAlias());
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

        return $this->createAlias();
    }

    /**
     * Create Alias from Text Value
     *
     * @return mixed
     * @since  1.0
     */
    public function createAlias()
    {
        if ($this->getFieldValue() === null) {
        } else {

            $alias = filter_var($this->getFieldValue(), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            /** Replace dashes with spaces */
            $alias = str_replace('-', ' ', strtolower(trim($alias)));

            /** Removes double spaces, ensures only alphanumeric characters */
            $alias = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $alias);

            /** Trim dashes at beginning and end */
            $alias = trim($alias, '-');

            /** Replace spaces with underscores */
            $alias = str_replace(' ', '_', strtolower(trim($alias)));

            $this->setFieldValue($alias);
        }

        return $this->getFieldValue();
    }
}
