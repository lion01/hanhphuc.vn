<?php
/**
 * @version		$Id: article.php $
 * @package		Joomla.Site
 * @subpackage	com_je_content
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @author		muinx
 * This component was generated by http://joomlavietnam.net/ - 2012
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.helper');

/**
 * Article model for the je_content component.
 *
 * @package		Joomla.Site
 * @subpackage	com_je_content
 * @since		1.6
 */
class JE_ContentModelArticle extends JModel
{
	/**
	 * Gets a list of article
	 *
	 * @return	#x# object or false.
	 * @since	1.6
	 */
	function getItem()
	{
		//init vars
		$db		= $this->getDbo();
		$id 		= JRequest::getInt('id');
		$query		= $db->getQuery(true);
		
		$query->select(
				'a.id, a.catid, a.title, a.alias, a.introtext, a.fulltext, a.images, a.featured'
			    );
		
		$query->from('#__je_content a');
		
		// Join over the categories
		$query->select('c.title AS category_title');
		$query->join('INNER', '#__categories AS c ON c.id = a.catid');
		
		$query->where('`a`.id = ' . $id);
		
		$db->setQuery($query);
		$record = $db->loadObject();
		
//		echo str_replace('#__', 'hp_', $query);
		
		if($record)
		    return $record;
		
		// Update hit
		$this->hit();
			
		return false;
	}
	
	/**
	 * Increment the hit counter for the article.
	 *
	 * @param	int		Optional primary key of the article to increment.
	 *
	 * @return	boolean	True if successful; false otherwise and internal error set.
	 */
	public function hit($pk = 0)
	{
            $hitcount = JRequest::getInt('hitcount', 1);

            if ($hitcount)
            {
                // Initialise variables.
                $pk = (!empty($pk)) ? $pk : (int) $this->getState('article.id');
                $db = $this->getDbo();

                $db->setQuery(
                        'UPDATE #__je_content' .
                        ' SET hits = hits + 1' .
                        ' WHERE id = '.(int) $pk
                );

                if (!$db->query()) {
                        $this->setError($db->getErrorMsg());
                        return false;
                }
            }

            return true;
	}
	
	public function getOthersContent()
	{
		$db			= $this->getDbo();
		$query		= $db->getQuery(true);

		$query->select(
			'a.id , a.title, a.alias, a.introtext, a.featured_images, a.catid'
		);

		$query->from('`#__je_content` a');

		// Join over the categories
		$query->select('c.title AS category_title');
		$query->join('INNER', '#__categories AS c ON c.id = a.catid');
		$query->where('state = 1');
		$query->order('a.id DESC');

		$db->setQuery($query, 0, 10);
		$rs = $db->loadObjectList();

		if ($db->getErrorMsg())
			die ($db->getErrorMsg ());
		
		return $rs;
	}
}