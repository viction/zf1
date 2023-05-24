<?php

/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage Gdata
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_Gdata_App_Util
 */
require_once 'Zend/Gdata/App/Util.php';

/**
 * Provides a mechanism to build a query URL for Gdata services.
 * Queries are not defined for APP, but are provided by Gdata services
 * as an extension.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage Gdata
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Gdata_Query
{

    /**
     * Query parameters.
     *
     * @var array
     */
    protected $_params = array();

    /**
     * Default URL
     *
     * @var string
     */
    protected $_defaultFeedUri = null;

    /**
     * Base URL
     * TODO: Add setters and getters
     *
     * @var string
     */
    protected $_url = null;

    /**
     * Category for the query
     *
     * @var string
     */
    protected $_category = null;

    /**
     * Create Gdata_Query object
     */
    public function __construct($url = null)
    {
        $this->_url = $url;
    }

    /**
     * @return string querystring
     */
    public function getQueryString()
    {
        $queryArray = array();
        foreach ($this->_params as $name => $value) {
            if (substr($name, 0, 1) == '_') {
                continue;
            }
            $queryArray[] = urlencode($name) . '=' . urlencode($value);
        }
        if (count($queryArray) > 0) {
            return '?' . implode('&', $queryArray);
        } else {
            return '';
        }
    }

    /**
     *
     */
    public function resetParameters()
    {
        $this->_params = array();
    }

    /**
     * @return string url
     */
    public function getQueryUrl()
    {
        if ($this->_url == null) {
            $url = $this->_defaultFeedUri;
        } else {
            $url = $this->_url;
        }
        if ($this->getCategory() !== null) {
            $url .= '/-/' . $this->getCategory();
        }
        $url .= $this->getQueryString();
        return $url;
    }

    /**
     * @param string $name
     * @param string $value
     * @return Zend_Gdata_Query Provides a fluent interface
     */
    public function setParam($name, $value)
    {
        $this->_params[$name] = $value;
        return $this;
    }

    /**
     * @param string $name
     */
    public function getParam($name)
    {
        return $this->_params[$name];
    }

    /**
     * @param string $value
     * @return Zend_Gdata_Query Provides a fluent interface
     */
    public function setAlt($value)
    {
        if ($value != null) {
            $this->_params['alt'] = $value;
        } else {
            unset($this->_params['alt']);
        }
        return $this;
    }

    /**
     * @param int $value
     * @return Zend_Gdata_Query Provides a fluent interface
     */
    public function setMaxResults($value)
    {
        if ($value != null) {
            $this->_params['max-results'] = $value;
        } else {
            unset($this->_params['max-results']);
        }
        return $this;
    }

    /**
     * @param string $value
     * @return Zend_Gdata_Query Provides a fluent interface
     */
    public function setQuery($value)
    {
        if ($value != null) {
            $this->_params['q'] = $value;
        } else {
            unset($this->_params['q']);
        }
        return $this;
    }

    /**
     * @param int $value
     * @return Zend_Gdata_Query Provides a fluent interface
     */
    public function setStartIndex($value)
    {
        if ($value != null) {
            $this->_params['start-index'] = $value;
        } else {
            unset($this->_params['start-index']);
        }
        return $this;
    }

    /**
     * @param string $value
     * @return Zend_Gdata_Query Provides a fluent interface
     */
    public function setUpdatedMax($value)
    {
        if ($value != null) {
            $this->_params['updated-max'] = Zend_Gdata_App_Util::formatTimestamp($value);
        } else {
            unset($this->_params['updated-max']);
        }
        return $this;
    }

    /**
     * @param string $value
     * @return Zend_Gdata_Query Provides a fluent interface
     */
    public function setUpdatedMin($value)
    {
        if ($value != null) {
            $this->_params['updated-min'] = Zend_Gdata_App_Util::formatTimestamp($value);
        } else {
            unset($this->_params['updated-min']);
        }
        return $this;
    }

    /**
     * @param string $value
     * @return Zend_Gdata_Query Provides a fluent interface
     */
    public function setPublishedMax($value)
    {
        if ($value !== null) {
            $this->_params['published-max'] = Zend_Gdata_App_Util::formatTimestamp($value);
        } else {
            unset($this->_params['published-max']);
        }
        return $this;
    }

    /**
     * @param string $value
     * @return Zend_Gdata_Query Provides a fluent interface
     */
    public function setPublishedMin($value)
    {
        if ($value != null) {
            $this->_params['published-min'] = Zend_Gdata_App_Util::formatTimestamp($value);
        } else {
            unset($this->_params['published-min']);
        }
        return $this;
    }

    /**
     * @param string $value
     * @return Zend_Gdata_Query Provides a fluent interface
     */
    public function setAuthor($value)
    {
        if ($value != null) {
            $this->_params['author'] = $value;
        } else {
            unset($this->_params['author']);
        }
        return $this;
    }

    /**
     * @return string rss or atom
     */
    public function getAlt()
    {
        if (isset($this->_params['alt'])) {
            return $this->_params['alt'];
        } else {
            return null;
        }
    }

    /**
     * @return int maxResults
     */
    public function getMaxResults()
    {
        if (isset($this->_params['max-results'])) {
            return intval($this->_params['max-results']);
        } else {
            return null;
        }
    }

    /**
     * @return string query
     */
    public function getQuery()
    {
        if (isset($this->_params['q'])) {
            return $this->_params['q'];
        } else {
            return null;
        }
    }

    /**
     * @return int startIndex
     */
    public function getStartIndex()
    {
        if (isset($this->_params['start-index'])) {
            return intval($this->_params['start-index']);
        } else {
            return null;
        }
    }

    /**
     * @return string updatedMax
     */
    public function getUpdatedMax()
    {
        if (isset($this->_params['updated-max'])) {
            return $this->_params['updated-max'];
        } else {
            return null;
        }
    }

    /**
     * @return string updatedMin
     */
    public function getUpdatedMin()
    {
        if (isset($this->_params['updated-min'])) {
            return $this->_params['updated-min'];
        } else {
            return null;
        }
    }

    /**
     * @return string publishedMax
     */
    public function getPublishedMax()
    {
        if (isset($this->_params['published-max'])) {
            return $this->_params['published-max'];
        } else {
            return null;
        }
    }

    /**
     * @return string publishedMin
     */
    public function getPublishedMin()
    {
        if (isset($this->_params['published-min'])) {
            return $this->_params['published-min'];
        } else {
            return null;
        }
    }

    /**
     * @return string author
     */
    public function getAuthor()
    {
        if (isset($this->_params['author'])) {
            return $this->_params['author'];
        } else {
            return null;
        }
    }

    /**
     * @param string $value
     * @return Zend_Gdata_Query Provides a fluent interface
     */
    public function setCategory($value)
    {
        $this->_category = $value;
        return $this;
    }

    /*
     * @return string id
     */
    public function getCategory()
    {
        return $this->_category;
    }


    public function __get($name)
    {
        $method = 'get'.ucfirst($name);
        if (method_exists($this, $method)) {
            return call_user_func(array(&$this, $method));
        } else {
            require_once 'Zend/Gdata/App/Exception.php';
            throw new Zend_Gdata_App_Exception('Property ' . $name . '  does not exist');
        }
    }

    public function __set($name, $val)
    {
        $method = 'set'.ucfirst($name);
        if (method_exists($this, $method)) {
            return call_user_func(array(&$this, $method), $val);
        } else {
            require_once 'Zend/Gdata/App/Exception.php';
            throw new Zend_Gdata_App_Exception('Property ' . $name . '  does not exist');
        }
    }

}
