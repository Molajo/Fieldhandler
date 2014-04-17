<?php
/**
 * Fromto Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Fromto Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Fromto extends AbstractFieldhandler implements FieldhandlerAdapterInterface
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
        parent::validate();

        $Fromto = $this->getFromto();

        if ($this->getFieldValue() >= $Fromto[0]
            && $this->getFieldValue() <= $Fromto[1]
        ) {
        } else {

            throw new UnexpectedValueException
            (
                'Validate Value: ' . $this->getFieldValue()
                . ' is not a value From: ' . $Fromto[0] . '  To:' . $Fromto[1]
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
        parent::filter();

        $Fromto = $this->getFromto();

        if ($this->getFieldValue() > $Fromto[0]
            && $this->getFieldValue() < $Fromto[1]
        ) {
        } else {
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
        parent::escape();

        return $this->filter();
    }

    /**
     * From value and To value
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function getFromto()
    {
        $field_value_from = 0;
        $field_value_to   = 999999999999;

        if (isset($this->options['from'])) {
            $field_value_from = $this->options['from'];
        }

        if (isset($this->options['to'])) {
            $field_value_to = $this->options['to'];
        }

        return array($field_value_from, $field_value_to);
    }
}
