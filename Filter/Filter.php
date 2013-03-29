<?php
/**
 * @package   Molajo
 * @copyright 2013 Amy Stephen. All rights reserved.
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
namespace Molajo\Filter;

defined('MOLAJO') or die;

//@todo SIMPLIFY these options to what Molajo really needs.
//@todo Hook back up HTML Purifier

/**
 * Filter
 *
 * @package     Molajo
 * @subpackage  Service
 * @since       1.0
 *
 * http://docs.joomla.org/Secure_coding_guidelines
 */
class Filter
{
    /**
     * Filter
     *
     * @var    array
     * @since  1.0
     */
    protected $filter;

    /**
     * HTML Purifier
     *
     * @var    object
     * @since  1.0
     */
    protected $purifier;

    /**
     * Filter input, default value, edit
     *
     * Usage:
     * Services::Filter()->filter($value, $type, $null, $default);
     *
     * @param string $value   Value of input field
     * @param string $type    Datatype of input field
     * @param int    $null    0 or 1 - is null allowed
     * @param string $default Default value, optional
     * @param array  $values  Set of values of which the field must contain
     *
     * @return mixed
     * @since   1.0
     */
    public function filter(
        $value,
        $type = 'char',
        $null = 1,
        $default = null,
        $values = array()
    ) {

        switch (strtolower($type)) {
            case 'integer':
            case 'boolean':
            case 'float':
                return $this->filter_numeric(
                    $value,
                    $type,
                    $null,
                    $default
                );
                break;

            case 'datetime':
                return $this->filter_date(
                    $value,
                    $null,
                    $default
                );
                break;

            case 'text':
                return $value;

                return $this->filter_html(
                    $value,
                    $null,
                    $default
                );
                break;

            case 'email':
                return $this->filter_email(
                    $value,
                    $null,
                    $default
                );
                break;

            case 'alias':
                return $this->filter_alias(
                    $value,
                    $null,
                    $default
                );
                break;

            case 'url':
                return $this->filter_url(
                    $value,
                    $null,
                    $default
                );
                break;

            case 'word':
                return (string) preg_replace('/[^A-Z_]/i', '', $value);
                break;

            case 'alnum':
                return (string) preg_replace('/[^A-Z0-9]/i', '', $value);
                break;

            case 'cmd':
                $result = (string) preg_replace('/[^A-Z0-9_\.-]/i', '', $value);

                return ltrim($result, '.');
                break;

            case 'base64':
                return (string) preg_replace('/[^A-Z0-9\/+=]/i', '', $value);
                break;

            case 'filename':
                return $this->filter_filename($value);
                break;

            case 'path':
                return $this->filter_foldername($value);
                break;

            case 'username':
                return (string) preg_replace('/[\x00-\x1F\x7F<>"\'%&]/', '', $value);
                break;

            case 'header_injection_test':
                return $this->filter_header_injection_test($value);
                break;

            case 'ip_address':
                return $this->filter_char($value, $null, $default);
                break;

            default:
                return $this->filter_char(
                    $value,
                    $null,
                    $default
                );
                break;
        }
    }

    /**
     * filter_numeric
     *
     * @param string $value   Value of input field
     * @param string $type    Datatype of input field
     * @param int    $null    0 or 1 - is null allowed
     * @param string $default Default value, optional
     *
     * @return string
     * @since   1.0
     */
    public function filter_numeric(
        $value,
        $type = 'int',
        $null = 1,
        $default = null
    ) {
        if ($default == null) {
        } elseif ($value == null) {
            $value = $default;
        }

        if ($value == null) {
        } else {
            switch ($type) {

                case 'boolean':
                    $test = filter_var(
                        $value,
                        FILTER_SANITIZE_NUMBER_INT
                    );
                    if ($test == 1) {
                    } else {
                        $test = 0;
                    }
                    break;

                case 'float':
                    $test = filter_var(
                        $value,
                        FILTER_SANITIZE_NUMBER_FLOAT,
                        FILTER_FLAG_ALLOW_FRACTION
                    );
                    break;

                default:
                    $test = filter_var(
                        $value,
                        FILTER_SANITIZE_NUMBER_INT
                    );
                    break;

            }
            if ($test == $value) {
                return $test;
            } else {
                throw new Exception('FILTER_INVALID_VALUE');
            }
        }

        if ($value == null
            && $null == 0
) {
            throw new Exception('FILTER_VALUE_REQUIRED');
        }

        return $value;
    }

    /**
     * filter_date
     *
     * @param string $value   Value of input field
     * @param int    $null    0 or 1 - is null allowed
     * @param string $default Default value, optional
     *
     * @return string
     * @since   1.0
     */
    public function filter_date(
        $value = null,
        $null = 1,
        $default = null
    ) {
        if ($default == null) {
        } elseif ($value == null
            || $value == ''
            || $value == 0
) {
            $value = $default;
        }

        if ($value == null
            || $value == '0000-00-00 00:00:00'
) {

        } else {
            $dd   = substr($value, 8, 2);
            $mm   = substr($value, 5, 2);
            $ccyy = substr($value, 0, 4);

            if (checkdate((int) $mm, (int) $dd, (int) $ccyy)) {
            } else {
                throw new Exception('FILTER_INVALID_VALUE');
            }
            $test = $ccyy . '-' . $mm . '-' . $dd;

            if ($test == substr($value, 0, 10)) {
                return $value;
            } else {
                throw new Exception('FILTER_INVALID_VALUE');
            }
        }

        if ($value == null
            && $null == 0
) {
            throw new Exception('FILTER_VALUE_REQUIRED');
        }

        return $value;
    }

    /**
     * filter_char
     *
     * @param string $value   Value of input field
     * @param int    $null    0 or 1 - is null allowed
     * @param string $default Default value, optional
     *
     * @return mixed
     * @since   1.0
     */
    public function filter_char(
        $value = null,
        $null = 1,
        $default = null
    ) {
        if ($default == null) {
        } else {
            if ($value == null) {
                $value = $default;
            }
        }

        if ($value == null) {
        } else {
            $test = filter_var($value, FILTER_SANITIZE_STRING);
            if ($test == $value) {
                return $test;
            } else {
                throw new Exception('FILTER_INVALID_VALUE');
            }
        }

        if ($value == null
            && $null == 0
) {
            throw new Exception('FILTER_VALUE_REQUIRED');
        }

        return trim($value);
    }

    /**
     * filter_email
     *
     * @param string $value   Value of input field
     * @param int    $null    0 or 1 - is null allowed
     * @param string $default Default value, optional
     *
     * @return mixed
     * @since   1.0
     */
    public function filter_email(
        $value = null,
        $null = 1,
        $default = null
    ) {
        if ($default == null) {
        } else {
            $value = $default;
        }

        if ($value == null) {
        } else {
            $test = filter_var($value, FILTER_SANITIZE_EMAIL);
            if (filter_var($test, FILTER_VALIDATE_EMAIL)) {
                return $test;
            } else {
                throw new Exception('FILTER_INVALID_VALUE');
            }
        }

        if ($value == null
            && $null == 0
) {
            throw new Exception('FILTER_VALUE_REQUIRED');
        }

        return $value;
    }

    /**
     * filter_url
     *
     * @param string $value   Value of input field
     * @param int    $null    0 or 1 - is null allowed
     * @param string $default Default value, optional
     *
     * @return mixed
     * @since   1.0
     */
    public function filter_url(
        $value = null,
        $null = 1,
        $default = null
    ) {
        if ($default == null) {
        } else {
            $value = $default;
        }

        if ($value == null) {
        } else {
            $test = filter_var($value, FILTER_SANITIZE_URL);
            if (filter_var($test, FILTER_VALIDATE_URL)) {
                return $test;
            } else {
                throw new Exception('FILTER_INVALID_VALUE');
            }
        }

        if ($value == null
            && $null == 0
) {
            throw new Exception('FILTER_VALUE_REQUIRED');
        }

        return $value;
    }

    /**
     * filter_alias
     *
     * @param string $value   Value of input field
     * @param int    $null    0 or 1 - is null allowed
     * @param string $default Default value, optional
     *
     * @return mixed
     * @since   1.0
     */
    public function filter_alias(
        $value = null,
        $null = 1,
        $default = null
    ) {
        if ($default == null) {
        } else {
            $value = $default;
        }

        if ($value == null) {
            $value = $default;
        }

        if ($value == null) {
        } else {
            $test = filter_var($value, FILTER_SANITIZE_URL);

            /** Replace dashes with spaces */
            $value = str_replace('-', ' ', strtolower(trim($value)));

            /** Removes double spaces, ensures only alphanumeric characters */
            $value = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $value);

            /** Trim dashes at beginning and end */
            $value = trim($value, '-');
        }

        if ($value == null
            && $null == 0
) {
            throw new Exception('FILTER_VALUE_REQUIRED');
        }

        return $value;
    }

    /**
     * filter_html
     *
     * @param string $value   Value of input field
     * @param int    $null    0 or 1 - is null allowed
     * @param string $default Default value, optional
     *
     * @return mixed
     * @since   1.0
     */
    public function filter_html(
        $value = null,
        $null = 0,
        $default = null
    ) {

        //@todo get html filters back on
        return true;

        if ($default == null) {
        } elseif ($value == null) {
            $value = $default;
        }

        if ($value == null) {
        } else {
            $value = $this->purifier->purify($value);
        }

        if ($value == null
            && $null == 0
) {
            throw new Exception('FILTER_VALUE_REQUIRED');
        }

        return $value;
    }

    /**
     * filter_filename
     *
     * Filters the filename so that it is safe to use
     *
     * @param string $file The name of the file [not full path]
     *
     * @return string The sanitised string
     * @since   1.0
     */
    public function filter_filename($file)
    {
        $regex = array('#(\.){2,}#', '#[^A-Za-z0-9\.\_\- ]#', '#^\.#');

        return preg_replace($regex, '', $file);
    }

    /**
     * filter_foldername
     *
     * Filters the foldername so that it is safe to use
     *
     * @param string $path The full path to sanitise.
     *
     * @return string The sanitised string.
     * @since   1.0
     */
    public function filter_foldername($path)
    {
        $regex = array('#[^A-Za-z0-9:_\\\/-]#');

        return preg_replace($regex, '', $path);
    }

    /**
     * filter_header_injection_test
     *
     * Looks for unauthorized header information
     *
     * @param string $content The content to test.
     *
     * @return mixed
     * @throws  Exception
     */
    public function filter_header_injection_test($content)
    {
        $headers = array(
            'Content-Type:',
            'MIME-Version:',
            'Content-Transfer-Encoding:',
            'bcc:',
            'cc:'
        );

        foreach ($headers as $header) {
            if (strpos($content, $header) !== false) {
                throw new Exception('FILTER_INVALID_VALUE');
            }
        }

        return $content;
    }

    /**
     * encode_link
     *
     * @param object $option_Link
     * $url = ConfigurationURL::encode_link ($option_Link);
     */
    public function encode_link($option_Link)
    {
        return urlencode($option_Link);
    }

    /**
     * encode_link_text
     *
     * @param object $option_Text
     * $url = ConfigurationURL::encode_link_text ($option_Text);
     */
    public function encode_link_text($option_Text)
    {
        return htmlentities($option_Text, ENT_QUOTES, 'UTF-8');
    }

    /**
     * escape_html
     *
     * @param string $text
     *
     * @return string
     * @since   1.0
     */
    public function escape_html($htmlText)
    {

    }

    /**
     * escape_integer
     *
     * @param string $integer
     *
     * @return string
     * @since   1.0
     */
    public function escape_integer($integer)
    {
        return (int) $integer;
    }

    /**
     * escape_text
     *
     * @param string $text
     *
     * @return string
     * @since   1.0
     */
    public function escape_text($text)
    {
        return htmlspecialchars($text, ENT_COMPAT, 'utf-8');
    }

    /**
     * escape_url
     *
     * @param string $url
     *
     * @return string
     * @since  1.0
     */
    public function escape_url($url)
    {
        if ($this->application_instance->get('url_unicode_slugs') == 1) {
//            return FilterOutput::stringURLUnicodeSlug($url);
        } else {
//            return FilterOutput::stringURLSafe($url);
        }
    }

    /**
     * initialise
     *
     * HTMLPurifier can be configured by:
     *
     * 1. defining options in applications/Configuration/htmlpurifier.xml
     * 2. creating custom filters in applications/filters
     * 3. setting criteria_html_display_filter parameter false (default = true)
     *
     * HTML 5 is not supported by HTMLPurifier although they are
     *  working on it. http://htmlpurifier.org/doxygen/html/classHTML5.html
     *
     */
    public function initialise()
    {
        return;

        $config = HTMLPurifier\HTMLPurifier_Config::createDefault();
        //var_dump($config);

        if ((int) Services::Registry()->get('parameters', 'application_html5', 1) == 1) {
            $config->set('HTML.Doctype', 'HTML 4.01 Transitional');
            //not supported $config->set('HTML.Doctype', 'HTML5');
        } else {
            $config->set('HTML.Doctype', 'HTML 4.01 Transitional');
        }
        $config->set('URI.Host', BASE_URL);

        /** Custom Filters */
        $files = Services::Filesystem()->folderFiles(HTMPURIFIER_FILTERS, '\.php$', false, false);
        foreach ($files as $file) {
            $class = 'HTMLPurifier\\filters\\';
            $class .= substr($file, 0, strpos($file, '.'));
            $config->set('Filter.Custom', array(new $class()));
        }

        /** Configured Options */
        $options = Services::Configuration()->getFile('Application', 'htmlpurifier');
        $options = array();
        if (count($options) > 0) {
            foreach ($options->option as $o) {
                $key   = (string) $o['key'];
                $value = (string) $o['value'];
                $config->set($key, $value);
            }
        }
        $this->purifier = new HTMLPurifier($config);
    }
}
