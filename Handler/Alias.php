<?php
/**
 * Alias Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Handler;

use Exception\Model\FieldhandlerException;

/**
 * Alias Fieldhandler
 *
 * @package    Molajo
 * @copyright  2013 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0
 */
class Alias extends AbstractFieldhandler
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
     * @throws  \Exception\Model\FieldhandlerException
     */
    public function validate()
    {
        parent::validate();

        if ($this->getFieldValue() === null) {
            $this->setFieldValue(null);

            return $this->getFieldValue();
        }

        $this->setFieldValue($this->createAlias());

        $bad = $this->testValidate();

        if ($bad === true) {
            throw new FieldhandlerException
            ('Validate Alias: ' . FILTER_INVALID_VALUE);
        }

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
    public function escape()
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

        $test = preg_replace('/ /', '-', $test);
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
