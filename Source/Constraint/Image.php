<?php
/**
 * Image Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Image Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Image extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Message Code
     *
     * @var    integer
     * @since  1.0.0
     */
    protected $message_code = 1000;

    /**
     * Sanitize
     *
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        $url = str_replace(
            array('ftp://', 'ftps://', 'http://', 'https://'),
            ''
            ,
            strtolower($this->field_value)
        );

        if (filter_var($url, FILTER_SANITIZE_URL, $this->setFlags()) === $url) {
        } else {
            $this->field_value = NULL;
        }

        return $this->field_value;
    }

    /**
     * Validation Test
     *
     * @return  boolean
     * @since   1.0.0
     */
    protected function validation()
    {
        $hold = $this->field_value;

        if ($this->sanitize() === $hold) {
            return TRUE;
        }

        return FALSE;
    }
}
