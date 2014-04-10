<?php
/**
 * Alias Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldHandlerAdapterInterface;

/**
 * Alias Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Alias extends AbstractFieldhandler implements FieldhandlerAdapterInterface
{
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

        if ($this->getFieldValue() === null) {
            $this->setFieldValue(null);

            return $this->getFieldValue();
        }

        $bad = $this->testValidate();

        if ($bad === true) {
            throw new UnexpectedValueException
            (
                'Validate Alias: Invalid Value'
            );
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

        if ($this->getFieldValue() === $test) {
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
