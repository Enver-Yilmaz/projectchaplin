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
class default_Form_Video_Edit extends Zend_Form
{
    private $_modelVideo;

    public function __construct(Chaplin_Model_Video $modelVideo)
    {
        $this->_modelVideo = $modelVideo;
        parent::__construct();
    }
    
    public function init()
    {
        $subform = new default_Form_Video_SubForm($this->_modelVideo);            
        $submit = new Zend_Form_Element_Submit('Save');
        $submit->setAttribs(array('style' => 'clear:both; width: 140px; height: 40px;'));
        
        $this->addSubForm($subform, 'Video');
        $this->addElement($submit);
        $this->setAttribs(array('style' => 'width: 800px; margin: 0 auto;'));
    }   
}
