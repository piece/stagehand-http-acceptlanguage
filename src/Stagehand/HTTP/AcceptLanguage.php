<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/**
 * PHP version 5
 *
 * Copyright (c) 2009 KUBO Atsuhiro <iteman@users.sourceforge.net>,
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    Stagehand_HTTP_AcceptLanguage
 * @copyright  2009 KUBO Atsuhiro <iteman@users.sourceforge.net>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License (revised)
 * @version    SVN: $Id: TestRunner.php 204 2009-12-22 16:44:30Z iteman $
 * @since      File available since Release 0.1.0
 */

// {{{ Stagehand_HTTP_AcceptLanguage

/**
 * @package    Stagehand_HTTP_AcceptLanguage
 * @copyright  2009 KUBO Atsuhiro <iteman@users.sourceforge.net>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License (revised)
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Stagehand_HTTP_AcceptLanguage
{

    // {{{ properties

    /**#@+
     * @access public
     */

    /**#@-*/

    /**#@+
     * @access protected
     */

    /**#@-*/

    /**#@+
     * @access private
     */

    /**#@-*/

    /**#@+
     * @access public
     */

    // }}}
    // {{{ getAcceptedLanguages()

    /**
     * @param string $acceptLanguage
     * @return array
     */
    public static function getAcceptedLanguages($acceptLanguage)
    {
        $acceptedLanguages = array();
        $i = 0;
        foreach (explode(',', str_replace(' ', '', $acceptLanguage)) as $acceptedLanguage) {
            if (strpos($acceptedLanguage, ';q=') !== false) {
                list($languageRange, $qvalue) = explode(';q=', $acceptedLanguage);
            } else {
                $languageRange = $acceptedLanguage;
                $qvalue = 1;
            }

            $acceptedLanguages[$languageRange] = array('qvalue' => $qvalue,
                                                       'originalOrder' => $i
                                                       );
            ++$i;
        }

        uasort($acceptedLanguages, array(__CLASS__, 'compareAcceptedLanguages'));
        return array_keys($acceptedLanguages);
    }

    // }}}
    // {{{ compareAcceptedLanguages()

    /**
     * @param array $a
     * @param array $b
     * @return integer
     */
    public static function compareAcceptedLanguages(array $a, array $b)
    {
        if ($a['qvalue'] == $b['qvalue']) {
            return $a['originalOrder'] > $a['originalOrder'] ? -1 : 1;
        }

        return $a['qvalue'] > $b['qvalue'] ? -1 : 1;
    }

    // }}}
    // {{{ getPreferredLanguage()

    /**
     * @param string $acceptLanguage
     * @return string
     */
    public static function getPreferredLanguage($acceptLanguage)
    {
        $acceptedLanguages = self::getAcceptedLanguages($acceptLanguage);
        if (!count($acceptedLanguages)) {
            return;
        }

        return $acceptedLanguages[0];
    }

    /**#@-*/

    /**#@+
     * @access protected
     */

    /**#@-*/

    /**#@+
     * @access private
     */

    /**#@-*/

    // }}}
}

// }}}

/*
 * Local Variables:
 * mode: php
 * coding: iso-8859-1
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * indent-tabs-mode: nil
 * End:
 */
