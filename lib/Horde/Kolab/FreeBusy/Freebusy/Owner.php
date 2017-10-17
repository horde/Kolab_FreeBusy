<?php
/**
 * This basic interface for a freebusy owner.
 *
 * PHP version 5
 *
 * @category Kolab
 * @package  Kolab_FreeBusy
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.horde.org/licenses/lgpl21 LGPL 2.1
 */

/**
 * This basic interface for a freebusy owner.
 *
 * Copyright 2010-2017 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (LGPL). If you did not
 * receive this file, see
 * http://www.horde.org/licenses/lgpl21.
 *
 * @category Kolab
 * @package  Kolab_FreeBusy
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.horde.org/licenses/lgpl21 LGPL 2.1
 */
interface Horde_Kolab_FreeBusy_Freebusy_Owner
extends Horde_Kolab_FreeBusy_Owner
{
    /**
     * Return how many days into the past the free/busy data should be
     * calculated for this owner.
     *
     * @return int The number of days.
     */
    public function getFreeBusyPast();

    /**
     * Return how many days into the future the free/busy data should be
     * calculated for this owner.
     *
     * @return int The number of days.
     */
    public function getFreeBusyFuture();
}