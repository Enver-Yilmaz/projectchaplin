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
/**
 * Interface for relevant Http_Client interfaces so we can mock Zend_Http_Client
 *
 * @package default
 * @author  Kathie Dart <chaplin@kathiedart.uk>
**/
interface Chaplin_Http_Interface
{
    /**
     * Try to use the client to get the page body
     *
     * @param  string $strURL 
     * @return string
     * @author Kathie Dart <chaplin@kathiedart.uk>
    **/
    public function getPageBody($url);
    /**
     * Use use the client to parse the page 
     *
     * @param  string $strURL 
     * @param  string $strXPath 
     * @return string
     * @author Tim Langley
    **/
    public function scrapeXPath($strURL, $strXPath);
}
