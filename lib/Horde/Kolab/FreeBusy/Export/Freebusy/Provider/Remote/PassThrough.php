<?php
/**
 * This provider fetches the data from a remote server by passing it through.
 *
 * PHP version 5
 *
 * @category Kolab
 * @package  Kolab_FreeBusy
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.fsf.org/copyleft/lgpl.html LGPL
 * @link     http://pear.horde.org/index.php?package=Kolab_FreeBusy
 */

/**
 * This provider fetches the data from a remote server by passing it through.
 *
 * Copyright 2011 The Horde Project (http://www.horde.org/)
 *
 * See the enclosed file COPYING for license information (LGPL). If
 * you did not receive this file, see
 * http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html.
 *
 * @category Kolab
 * @package  Kolab_FreeBusy
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.fsf.org/copyleft/lgpl.html LGPL
 * @link     http://pear.horde.org/index.php?package=Kolab_FreeBusy
 */
class Horde_Kolab_FreeBusy_Export_Freebusy_Provider_Remote_PassThrough
extends Horde_Kolab_FreeBusy_Export_Freebusy_Provider_Remote
{
    /**
     * HTTP client
     *
     * @var Horde_Http_Client
     */
    private $client;

    /**
     * Constructor
     *
     * @param Horde_Http_Client $client An HTTP client.
     */
    public function __construct($client = null)
    {
        if ($client === null) {
            $client = new Horde_Http_Client();
        }
        $this->_client = $client;
    }

    /**
     * Trigger the remote free/busy system.
     *
     * @param Horde_Controller_Response  $response The response handler.
     * @param Horde_Kolab_FreeBusy_Owner $owner    The owner of the f/b data.
     * @param Horde_Kolab_FreeBusy_User  $user     The user accessing the f/b
     *                                             data.
     * @param string                     $folder   The folder to trigger.
     * @param array                      $params   Additional parameters.
     *
     * @return NULL
     */
    public function trigger(
        Horde_Controller_Response $response,
        Horde_Kolab_FreeBusy_Owner $owner,
        Horde_Kolab_FreeBusy_User  $user,
        $folder,
        $params = array()
    )
    {
        $url = $this->getTriggerUrlWithCredentials(
            $owner, $user, $user->getPassword(), $folder, $params
        );
        $origin = $this->_client->get($url);
        if ($origin->code !== 200) { 
            $url = $this->getTriggerUrlWithCredentials(
                $owner, $user, 'XXX', $params
            );
            throw new Horde_Kolab_FreeBusy_Exception(
                sprintf('Unable to read free/busy information from %s', $url)
            );
        }
        $response->setHeader('X-Redirect-To', $url);
        $response->setBody($origin->getStream());
    }

    /**
     * Fetch free/busy data from a remote system.
     *
     * @param Horde_Controller_Response  $response The response handler.
     * @param Horde_Kolab_FreeBusy_Owner $owner    The owner of the f/b data.
     * @param Horde_Kolab_FreeBusy_User  $user     The user accessing the f/b
     *                                             data.
     * @param array                      $params   Additional parameters.
     *
     * @return NULL
     */
    public function fetch(
        Horde_Controller_Response $response,
        Horde_Kolab_FreeBusy_Owner $owner,
        Horde_Kolab_FreeBusy_User  $user,
        $params = array()
    )
    {
        $url = $this->getFetchUrlWithCredentials(
            $owner, $user, $user->getPassword(), $params
        );
        $origin = $this->_client->get($url);
        if ($origin->code !== 200) { 
            $url = $this->getFetchUrlWithCredentials(
                $owner, $user, 'XXX', $params
            );
            throw new Horde_Kolab_FreeBusy_Exception(
                sprintf('Unable to read free/busy information from %s', $url)
            );
        }
        $response->setHeader('X-Redirect-To', $url);
        $response->setBody($origin->getStream());
    }
}
