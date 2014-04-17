<?php
/**
 * Contains Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Contains Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Contains extends AbstractFieldhandler implements FieldhandlerAdapterInterface
{
    /**
     * Validate Input
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function validate()
    {


        if ($this->getFieldValue() === null) {
            return $this->getFieldValue();
        }

        $results = $this->testContains();
        if ($results === false) {
            throw new UnexpectedValueException
            (
                'Validate Contains: Invalid Value'
            );
        }

        return $this->getFieldValue();
    }

    /**
     * Fieldhandler Input
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function filter()
    {


        if ($this->getFieldValue() === null) {
            return $this->getFieldValue();
        }

        $results = $this->testContains();
        if ($results === false) {
            $this->setFieldValue(null);
        }

        return $this->getFieldValue();
    }

    /**
     * Escapes and formats output
     *
     * @return  mixed
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function escape()
    {


        return $this->filter();
    }

    /**
     * If needed, apply default to Field
     *
     * @return  boolean
     * @since   1.0.0
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function testContains()
    {
        if ($this->getFieldValue() === null) {
            return false;
        }

        if (isset($this->options['contains'])) {
            $contains = $this->options['contains'];
        } else {
            throw new UnexpectedValueException
            (
                'Validate Contains: must send in options contains value: '
            );
        }

        $input = $this->getFieldValue();

        $x = mb_strpos($input, $contains, 0, mb_detect_encoding($input));
        if ($x === false) {
            return false;
        } else {
            return true;
        }
    }
}
