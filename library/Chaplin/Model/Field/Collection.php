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
class Chaplin_Model_Field_Collection
    implements Iterator, Countable
{
    private $_intIndex = 0;
    private $_strHashType = null;
    private $_bIsDirty = false;
    private $_collHashes = array();

    public function __construct($strHashType)
    {
        $this->_strHashType = $strHashType;        
    }

    public function bIsDirty()
    {
        return $this->_bIsDirty;
    }

    public function addHash(Chaplin_Model_Field_Hash $hash)
    {
        $this->_collHashes[] = $hash;
        $this->_bIsDirty = true;
    }

    public function valid()
    {
        return isset($this->_collHashes[$this->_intIndex]);
    }

    public function current()
    {
        return $this->_collHashes[$this->_intIndex];
    }

    public function next()
    {
        $this->_intIndex++;
    }

    public function rewind()
    {
        $this->_intIndex = 0;
    }

    public function count()
    {
        return count($this->_collHashes);
    }

    public function key()
    {
        return $this->_intIndex;
    }

    public function seek($strId)
    {
        foreach($thos->_collHashes as $hash) {
            if ($hash->getId() == $strId) {
                return $hash;
            }
        }
        throw new OutOfBoundsException($strId);
    }

    public function setFromData($mixedValue)
    {
        if (!is_array($mixedValue)) {
            throw new Exception('Not Array');
        }

        $strHashType = $this->_strHashType;

        foreach($mixedValue as $strId => $arrData) {
            $strHashType::createFromIterator($this, $arrData);
            $this->_collHashes[] = $strHashType::createFromIterator($this, $arrData);
        }
        return $this;
    }       
    
    public function setValue($mixedValue)
    {
        throw new Exception("Can't do this!");
    }
        
    public function getValue($mixedDefault)
    {
        return $this;
    }
}