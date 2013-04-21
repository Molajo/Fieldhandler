<?php
/**
 * Alias FieldHandler
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
 * Alias FieldHandler
 *
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @since     1.0
 */
class Alias extends AbstractFieldHandler
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
            $this->setFieldValue(null);

            return $this->getFieldValue();
        }

        $this->setFieldValue($this->createAlias());

        $bad = $this->testValidate();

        if ($bad === true) {
            throw new FieldHandlerException
            ('Validate Alias: ' . FILTER_INVALID_VALUE);
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

        $bad = false;

        if ($this->getFieldValue() === null) {
            $bad = true;
        } else {
            $bad = $this->testValidate();
        }

        if ($bad === true) {
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
    protected function escape()
    {
        parent::escape();

        return $this->filter();
    }

    /**
     * Create Alias from Text Value
     *
     * @return  mixed
     * @since   1.0
     */
    public function createAlias()
    {
        $alias = $this->getFieldValue();

        if ($alias === null) {
        } else {

            /** Replace dashes with spaces */
            $alias = str_replace('-', ' ', strtolower(trim($alias)));

            /** Removes double spaces, ensures only alphanumeric characters */
            $alias = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $alias);

            /** Trim dashes at beginning and end */
            $alias = trim($alias, '-');

            /** Replace spaces with underscores */
            $alias = str_replace(' ', '_', strtolower(trim($alias)));

            /** Sanitize */
            $alias = filter_var($alias, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $this->setFieldValue($alias);
        }

        return $this->getFieldValue();
    }

    /**
     * Test the Alias validity
     *
     * @return bool
     * @since   1.0
     */
    public function testValidate()
    {
        $test = $this->getFieldValue();

        $bad = false;

        $test = strpos($test, ' ');
        if ($this->getFieldValue() == $test) {
        } else {
            $bad = true;
        }

        $test = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $test);
        if ($this->getFieldValue() == $test) {
        } else {
            $bad = true;
        }

        $test = filter_var($test, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($this->getFieldValue() == $test) {
        } else {
            $bad = true;
        }

        return $bad;
    }
}
