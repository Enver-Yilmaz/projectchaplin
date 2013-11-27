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
 * @package    Project Chaplin
 * @author     Dan Dart
 * @copyright  2012-2013 Project Chaplin
 * @license    http://www.gnu.org/licenses/agpl-3.0.html GNU AGPL 3.0
 * @version    git
 * @link       https://github.com/dandart/projectchaplin
**/
class Chaplin_Dao_Sql_Playlist
	extends Chaplin_Dao_Sql_Abstract
	implements Chaplin_Dao_Interface_Playlist
{
	const TABLE = 'Playlists';
	
	const PK = 'PlaylistId';

	protected function _getTable()
	{
		return self::TABLE;
	}

	protected function _getPrimaryKey()
	{
		return self::PK;
	}

	public function getAllPlaylists()
	{
		$strSql = 'SELECT * FROM %s';
        $arrRows = $this->_getAdapter()->fetchAll(sprintf($strSql, self::TABLE));
        return new Chaplin_Iterator_Dao_Sql_Rows($arrRows, $this);
	}
    
    public function getByPlaylistId($strPlaylistId)
    {
    	$strSql = 'SELECT * FROM %s WHERE %s = ?';

        $arrRow = $this->_getAdapter()->fetchRow(
        	sprintf(
        		$strSql, 
        		self::TABLE,
        		self::PK
        	)
        , $strPlaylistId);

        if(empty($arrRow)) {
            throw new Exception('No Playlist named '.$strPlaylistId);
        }

        return $this->convertToModel($arrRow);
    }
    
    public function delete(Chaplin_Model_Playlist $modelPlaylist)
    {
    	return $this->_delete($modelPlaylist);
    }

    public function deleteById($strId)
    {
        return $this->_deleteById($strId);
    }

    public function save(Chaplin_Model_Playlist $modelPlaylist)
    {
    	return $this->_save($modelPlaylist);
    }

    public function convertToModel($arrData)
    {
        return Chaplin_Model_Playlist::createFromData($this, $this->_sqlToModel($arrData));
    }
}