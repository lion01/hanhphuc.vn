<?php
/**
 * @version		$Id: banner.php 20228 2011-01-10 00:52:54Z eddieajau $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

/**
 * Banner model.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_cl_diamond
 * @since		1.6
 */
class Jnt_HanhPhucModelOrder extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_JNT_HANHPHUC_ORDER';

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'Order', $prefix = 'Jnt_HanhPhucTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true) {
		// Get the form.
		$form = $this->loadForm('com_jnt_hanhphuc.order', 'order', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData() {
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_jnt_hanhphuc.edit.order.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
	}
    
    public function getOrderItems() {
        $id = JRequest::getInt('id', 0);
        $db = JFactory::getDbo();
        $query = 'SELECT i.* FROM #__hp_order_items i
                  WHERE i.order_id = '.$id;
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
    function emailTemplate($user, $order, $isAdmin = false) {
		$template = '';
		if(!$isAdmin) {
			$template .= 'Hello <strong>'.$user->name.'</strong>';
			$template .= '<br> <br>';
			$template .= 'This is confirm email that you order watches from website with these infos:';
		} else  {
			$template .= 'Hello <strong>Administrator</strong>';
			$template .= '<br> <br>';
			$template .= 'This is notice email that one of users on website order watches from website with these infos:';
		}

		$template .= '<br> <br>';
		$template .= '<strong>Order</strong> <br>';
		$template .= 'Order ID: 		'.$order->id.' <br>';
		$template .= 'Total Price: 	'.$order->price_unit.' '.$order->total_price.'<br>';
		$template .= 'Created:		'.$order->created.' <br> <br>';

		$template .= '<strong>Customer Info</strong> <br>';
		$template .= 'Username: 		'.$user->username.' <br>';
		$template .= 'Fullname: 		'.$order->fullname.' <br>';
		$template .= 'Address 1:		'.$order->address1.' <br>';
		$template .= 'Address 2:		'.$order->address2.' <br>';
		$template .= 'City:				'.$order->city.' <br>';
		$template .= 'Region			'.$order->region.' <br>';
		$template .= 'Country: 		'.$order->country.' <br>';
		$template .= 'Postal Code: 	'.$order->postal_code.' <br>';
		$template .= 'Phone:		'.$order->phone.' <br> <br>';

		$template .= '<strong>Comments</strong> <br>';
		$template .= $order->order_note.' <br>';
		 $template .= '<br>';
		$template .= '---<br>';
		$template .= 'Regards - '.JURI::base();
		
		return $template;
	}
}
