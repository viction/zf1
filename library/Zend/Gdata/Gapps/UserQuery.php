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
 * @subpackage Gapps
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Gdata_Gapps_Query
 */
require_once('Zend/Gdata/Gapps/Query.php');

/**
 * Assists in constructing queries for Google Apps user entries.
 * Instances of this class can be provided in many places where a URL is
 * required.
 *
 * For information on submitting queries to a server, see the Google Apps
 * service class, Zend_Gdata_Gapps.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage Gapps
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Gdata_Gapps_UserQuery extends Zend_Gdata_Gapps_Query
{

    /**
     * If not null, specifies the username of the user who should be
     * retrieved by this query.
     *
     * @var string
     */
    protected $_username = null;

    /**
     * Create a new instance.
     *
     * @param string $domain (optional) The Google Apps-hosted domain to use
     *          when constructing query URIs.
     * @param string $username (optional) Value for the username
     *          property.
     * @param string $startUsername (optional) Value for the
     *          startUsername property.
     */
    public function __construct($domain = null, $username = null,
            $startUsername = null)
    {
        parent::__construct($domain);
        $this->setUsername($username);
        $this->setStartUsername($startUsername);
    }

    /**
     * Set the username to query for. When set, only users with a username
     * matching this value will be returned in search results. Set to
     * null to disable filtering by username.
     *
     * @see getUsername
     * @param string $value The username to filter search results by, or null to
     *              disable.
     */
    public function setUsername($value)
    {
        $this->_username = $value;
    }

    /**
     * Get the username to query for. If no username is set, null will be
     * returned.
     *
     * @param string $value The username to filter search results by, or
     *          null if disabled.
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * Set the first username which should be displayed when retrieving
     * a list of users.
     *
     * @param string $value The first username to be returned, or null to
     *          disable.
     */
    public function setStartUsername($value)
    {
        if ($value !== null) {
            $this->_params['startUsername'] = $value;
        } else {
            unset($this->_params['startUsername']);
        }
    }

    /**
     * Get the first username which should be displayed when retrieving
     * a list of users.
     *
     * @see setStartUsername
     * @return string The first username to be returned, or null if
     *          disabled.
     */
    public function getStartUsername()
    {
        if (isset($this->_params['startUsername'])) {
            return $this->_params['startUsername'];
        } else {
            return null;
        }
    }

    /**
     * Returns the query URL generated by this query instance.
     *
     * @return string The query URL for this instance.
     */
    public function getQueryUrl()
    {
        $uri = $this->getBaseUrl();
        $uri .= Zend_Gdata_Gapps::APPS_USER_PATH;
        if ($this->_username !== null) {
            $uri .= '/' . $this->_username;
        }
        $uri .= $this->getQueryString();
        return $uri;
    }

}
