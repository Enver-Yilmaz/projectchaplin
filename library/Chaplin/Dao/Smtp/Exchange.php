<?php
/**
 * This file is part of Project Chaplin.
 *
 * Project Chaplin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Project Chaplin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Project Chaplin. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package   ProjectChaplin
 * @author    Kathie Dart <chaplin@kathiedart.uk>
 * @copyright 2012-2017 Project Chaplin
 * @license   http://www.gnu.org/licenses/agpl-3.0.html GNU AGPL 3.0
 * @version   GIT: $Id$
 * @link      https://github.com/kathiedart/projectchaplin
**/
class Chaplin_Dao_Smtp_Exchange
    implements Chaplin_Dao_Interface
{
    public function email(
        Chaplin_Model_User $modelUser,
        $strSubject,
        $strTemplate,
        $arrParams
    ) 
    { 
    
        $strVhost = Chaplin_Config_Servers::getInstance()->getVhost();
        
        $mail = new Zend_Mail();
        $mail->addTo($modelUser->getEmail(), $modelUser->getNick());
        $mail->setFrom('info@'.$strVhost, 'Project Chaplin');
        $mail->setSubject($strSubject);
        $strFilenameTemplateHTML = APPLICATION_PATH.
         '/../mustache/en_GB/mail/html/'.$strTemplate.'.mustache';
        $strFilenameTemplateText = APPLICATION_PATH.
         '/../mustache/en_GB/mail/text/'.$strTemplate.'.mustache';
        $strTemplateHTML = file_get_contents($strFilenameTemplateHTML);
        $strTemplateText = file_get_contents($strFilenameTemplateText);
        $m = new Mustache_Engine();
        $strHTML = $m->render($strTemplateHTML, $arrParams);
        $strText = $m->render($strTemplateText, $arrParams);
        $mail->setBodyText($strText);
        $mail->setBodyHTML($strHTML);
        $mail->send();
    }
}
