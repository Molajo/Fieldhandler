<?php
/**
 * Alphanumeric Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Alphanumeric Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Alphanumeric extends AbstractFieldhandler implements FieldhandlerAdapterInterface
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
        } else {

            $test = ctype_alnum($this->getFieldValue());
            if ($test == 1) {
            } else {
                throw new UnexpectedValueException
                (
                    'Validate Alphanumeric: Invalid Value'
                );
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Fieldhandler Input
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function filter()
    {
        if ($this->getFieldValue() === null) {
        } else {

            $test = ctype_alnum($this->getFieldValue());

            if ($test == 1) {
            } else {
                $this->setFieldValue($this->filterByCharacter('ctype_alnum', $this->getFieldValue()));
            }
        }

        return $this->getFieldValue();
    }

    /**
     * Escapes and formats output
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function escape()
    {
        $this->setFieldValue($this->filterByCharacter('ctype_alnum', $this->getFieldValue()));

        return $this->getFieldValue();
    }
}
