<?php
/**
 * All tests for the Kolab_FreeBusy:: package.
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
 * Define the main method 
 */
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Horde_Kolab_FreeBusy_AllTests::main');
}

require_once 'PHPUnit/Framework/TestSuite.php';
require_once 'PHPUnit/TextUI/TestRunner.php';

/**
 * Combine the tests for this package.
 *
 * Copyright 2007-2009 The Horde Project (http://www.horde.org/)
 *
 * See the enclosed file COPYING for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @category Kolab
 * @package  Kolab_FreeBusy
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.fsf.org/copyleft/lgpl.html LGPL
 * @link     http://pear.horde.org/index.php?package=Kolab_FreeBusy
 */
class Horde_Kolab_FreeBusy_AllTests
{

    /**
     * Main entry point for running the suite.
     *
     * @return NULL
     */
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    /**
     * Collect the unit tests of this directory into a new suite.
     *
     * @return PHPUnit_Framework_TestSuite The test suite.
     */
    public static function suite()
    {
        // Catch strict standards
        // FIXME: This does not work yet, as we still have a number of
        //        static methods in basic Horde libraries that are not
        //        declared as such.
        //error_reporting(E_ALL | E_STRICT);

        $suite = new PHPUnit_Framework_TestSuite('Horde Framework - Horde_Kolab_FreeBusy');

        $basedir    = dirname(__FILE__);
        $baseregexp = preg_quote($basedir . DIRECTORY_SEPARATOR, '/');

        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($basedir)) as $file) {
            if ($file->isFile() && preg_match('/Test.php$/', $file->getFilename())) {
                $pathname = $file->getPathname();
                require $pathname;

                $class = str_replace(DIRECTORY_SEPARATOR, '_',
                                     preg_replace("/^$baseregexp(.*)\.php/", '\\1', $pathname));
                $suite->addTestSuite('Horde_Kolab_FreeBusy_' . $class);
            }
        }

        return $suite;
    }

}

if (PHPUnit_MAIN_METHOD == 'Horde_Kolab_FreeBusy_AllTests::main') {
    Horde_Kolab_FreeBusy_AllTests::main();
}