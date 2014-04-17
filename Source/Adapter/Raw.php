<?php
/**
 * Raw Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Adapter;

use CommonApi\Exception\UnexpectedValueException;
use CommonApi\Model\FieldhandlerAdapterInterface;

/**
 * Raw Fieldhandler
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Raw extends AbstractFieldhandler implements FieldhandlerAdapterInterface
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

            $test = filter_var($this->getFieldValue(), FILTER_UNSAFE_RAW, $this->setFlags());

            if ($test == $this->getFieldValue()) {
            } else {

                throw new UnexpectedValueException
                (
                    'Validate Raw: Invalid Value'
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
     * @throws  \CommonApi\Exception\UnexpectedValueException
     */
    public function filter()
    {
        if ($this->getFieldValue() === null) {
        } else {

            $test = filter_var($this->getFieldValue(), FILTER_UNSAFE_RAW, $this->setFlags());

            if ($test == $this->getFieldValue()) {
            } else {
                $this->setFieldValue(filter_var($this->getFieldValue(), FILTER_UNSAFE_RAW, $this->setFlags()));
            }
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
        $test = filter_var($this->getFieldValue(), FILTER_UNSAFE_RAW, $this->setFlags());

        if ($test == $this->getFieldValue()) {
        } else {
            $this->setFieldValue(filter_var($this->getFieldValue(), FILTER_UNSAFE_RAW, $this->setFlags()));
        }

        return $this->getFieldValue();
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
        if (isset($this->options['FILTER_FLAG_STRIP_LOW'])) {
            $filter = 'FILTER_FLAG_STRIP_LOW';
        }

        if (isset($this->options['FILTER_FLAG_STRIP_HIGH'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_STRIP_HIGH';
        }

        if (isset($this->options['FILTER_FLAG_ENCODE_LOW'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ENCODE_LOW';
        }

        if (isset($this->options['FILTER_FLAG_ENCODE_HIGH'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ENCODE_HIGH';
        }

        if (isset($this->options['FILTER_FLAG_ENCODE_HIGH'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ENCODE_HIGH';
        }

        if (isset($this->options['FILTER_FLAG_ENCODE_AMP'])) {
            if ($filter == '') {
            } else {
                $filter .= ', ';
            }
            $filter .= 'FILTER_FLAG_ENCODE_AMP';
        }

        return $filter;
    }
}
