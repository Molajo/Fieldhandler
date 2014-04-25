<?php
/**
 * Callback Constraint
 *
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Fieldhandler\Constraint;

use CommonApi\Model\ConstraintInterface;

/**
 * Callback Constraint
 *
 * @link       http://us3.php.net/callback
 * @link       http://us3.php.net/manual/en/language.types.callable.php
 * @package    Molajo
 * @copyright  2014 Amy Stephen. All rights reserved.
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @since      1.0.0
 */
class Callback extends AbstractConstraint implements ConstraintInterface
{
    /**
     * Filter Type
     *
     * @api
     * @var    string
     * @since  1.0.0
     */
    protected $filter_type = FILTER_CALLBACK;

    /**
     * Used by Constraint Classes to customize option values needed for Field handling
     *
     * @return  array
     * @since   1.0.0
     */
    public function setOptions()
    {
        $return            = array();
        $return['options'] = $this->getOption('callback', null);

        return $return;
    }

    /**
     * Validate
     *
     * Tests a value using the callback value responding with true or false and messages
     *
     * @code
     *
     *  ```php
     *
     *  $request = new Molajo\Fieldhandler\Request();
     *
     *  $options = array();
     *  $options['callback'] = $callback;
     *  $results = $request->validate('Field name', $field_value, 'Callback', $options);
     *
     *  if ($results->getValidateResponse() === true) {
     *      // all is good
     *  } else {
     *      foreach ($results->getValidateMessages() as $error) {
     *          echo  'Validation error: ' . $error->code . ': ' . $error->message . '\n';
     *      }
     *  }
     *
     *  ```
     *
     * @api
     * @link    http://www.php.net/manual/en/filter.filters.sanitize.php
     * @return  mixed
     * @since   1.0.0
     */
    public function validate()
    {
        if ($this->field_value === null) {
            return true;
        }

        if (filter_var($this->field_value, $this->filter_type, $this->setOptions()) === false) {

            $this->setValidateMessage(1000);

            return false;
        }

        return true;
    }

    /**
     * Sanitize
     *
     * Sanitizes the field value according to the callback
     *
     * @code
     *
     * ```php
     *
     *  $request = new Molajo\Fieldhandler\Request();
     *
     *  $options = array();
     *  $options['callback'] = $callback;
     *  $response = $request->sanitize($field_name, $field_value, 'Callback', $options);
     *
     *  // Replace the existing value if it was changed by filtering
     *
     *  if ($response->getChangeIndicator() === true) {
     *     $field_value = $response->getFieldValue();
     *  }
     *
     * ```
     *
     * @api
     * @link    http://www.php.net/manual/en/filter.filters.sanitize.php
     * @return  mixed
     * @since   1.0.0
     */
    public function sanitize()
    {
        if ($this->field_value === null) {
            return $this->field_value;
        }

        if (filter_var($this->field_value, $this->filter_type, $this->setOptions())) {
            return $this->field_value;
        }

        $this->field_value = null;

        return $this->field_value;
    }
    /**
     * Format
     *
     * Not used with Float, simply returns the field value sent in
     *
     * @api
     * @return  mixed
     * @since   1.0.0
     */
    public function format()
    {
        return $this->field_value;
    }
}
