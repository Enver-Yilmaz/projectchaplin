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
class Admin_SetupController extends Zend_Controller_Action
{
    public function init()
    {
    	parent::init();
        if (file_exists(APPLICATION_PATH.'/../config/chaplin.ini')) {
        	return $this->_redirect('/');
        }
        $this->_helper->_layout->setLayout('plain');
    }

    public function indexAction()
    {

    }

    public function sqltestAction()
    {
        $arrPost = $this->_request->getPost();
        $strAdapter = isset($arrPost['adapter'])?$arrPost['adapter']:null;
        $arrParams = isset($arrPost['params'])?$arrPost['params']:array();

        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);

        try {
            $adapter = Zend_Db::factory($strAdapter, $arrParams);
            // Make sure we get a PDO instance that tries to connect
            $adapter->prepare('SELECT');
            echo 'DB Connect Success!';
        } catch (Exception $e) {
            echo 'DB Connect failed! Reason: '.$e->getMessage();
        }
    }

    public function amqptestAction()
    {
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);

        try {
            $amqp = new Amqp_Connection($this->_request->getPost());
            $amqp->connect();
            echo 'AMQP connection success!';
        } catch (Exception $e) {
            echo 'Sorry - the connection failed...';
        }
    }
}