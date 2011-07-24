<?php
/**
 * Test the route matching.
 *
 * PHP version 5
 *
 * @category   Kolab
 * @package    Kolab_FreeBusy
 * @subpackage UnitTests
 * @author     Gunnar Wrobel <wrobel@pardus.de>
 * @license    http://www.fsf.org/copyleft/lgpl.html LGPL
 * @link       http://pear.horde.org/index.php?package=Kolab_FreeBusy
 */

/**
 * Prepare the test setup.
 */
require_once dirname(__FILE__) . '/../../Autoload.php';

/**
 * Test the route matching.
 *
 * Copyright 2011 The Horde Project (http://www.horde.org/)
 *
 * See the enclosed file COPYING for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @category   Kolab
 * @package    Kolab_FreeBusy
 * @subpackage UnitTests
 * @author     Gunnar Wrobel <wrobel@pardus.de>
 * @license    http://www.fsf.org/copyleft/lgpl.html LGPL
 * @link       http://pear.horde.org/index.php?package=Kolab_FreeBusy
 */
class Horde_Kolab_FreeBusy_Unit_Controller_MatchDictTest
extends Horde_Kolab_FreeBusy_TestCase
{

    /**
     * @dataProvider provideElements
     */
    public function testGetDict($key, $value)
    {
        $result = $this->getTestMatchDict()->getMatchDict();
        $this->assertEquals($value, $result[$key]);
    }

    public function provideElements()
    {
        return array(
            array('controller', 'freebusy'),
            array('action', 'fetch'),
            array('type', 'xfb'),
            array('owner', 'owner@example.org'),
        );
    }
}