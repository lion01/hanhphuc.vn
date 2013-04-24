<?php
/**
 * @version		$Id: categories.php $
 * @package		Joomla.Site
 * @subpackage	com_je_content
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		muinx
 * This component was generated by http://joomlavietnam.net/ - 2012
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Categories model for the je_content component.
 *
 * @package		Joomla.Site
 * @subpackage	com_je_content
 * @since		1.6
 */
class Jnt_HanhphucModelCategory extends JModel
{
	public function getCategory()
	{
		jimport ('joomla.application.categories');
		
		$id = JRequest::getUInt('id');
		
		$catObj = JCategories::getInstance('JNT_Hanhphuc', array('extension' => 'com_jnt_hanhphuc', 'table' => ''));
		
		$category = $catObj->get($id);
		
		$users = FrontJntHanhphucHelper::getUsers($category->id);
		
		$category->users = $users;
		
		return $category;
	}
	
	
}