<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

/**
 * Bannerclient Field class for the Joomla Framework.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_banners
 * @since		1.6
 */

?>
<script type="text/javascript">

</script>
<?php

class JFormFieldLocation extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Location';

    protected function getInput() {
        $input = parent::getInput();
        $script = '';
        if($this->element['location_parent_field']) {
            //TODO: #nttuyen JS load ajax
            $script = '<script type="text/javascript">
                            jQuery(document).ready(function($){
                                jQuery("#jform_'.$this->group.'_'.$this->element['location_parent_field'].'").change(function(){
                                    value = jQuery(this).val();
                                    jQuery.get(
                                        "'.JURI::root().'index.php?option=com_jnt_hanhphuc&task=location.getLocations&type='.$this->element['location_type'].'&parent_column='.$this->element['location_parent_column'].'&parent="+value
                                        , function(data){
                                            $input = "";
                                            currentValue = '.$this->value.';
                                            jQuery(data).each(function(index, element){
                                                $input += "<option value=\""+element.value+"\"";
                                                if(element.value == currentValue) {
                                                    $input += "selected=\"selected\"";
                                                }
                                                $input += ">";
                                                $input += element.text;
                                                $input += "</option>";
                                            });
                                            jQuery("#jform_'.$this->group.'_'.$this->element['id'].'").html($input);
                                        }
                                        , "json"
                                    );
                                });
                            });
                       </script>';
        }
        if($script) {
            $input .= $script;
        }
        //var_dump($input);
        return $input;
    }


    /**
	 * Method to get the field options.
	 *
	 * @return	array	The field option objects.
	 * @since	1.6
	 */
	public function getOptions() {

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

        $table = '#__location';
        if($this->element['location_type'] == 'district') {
            $table .= '_district';
        } else {
            $table .= '_province';
        }

        $query->select('l.id as value, l.title as text');
        $query->from($table . ' as l');
        $query->order('l.title');

        if($this->element['location_parent_field'] && $this->element['location_parent_column']) {
            $group = $this->element['location_parent_group'] ? $this->element['location_parent_group'] : $this->group;
            $parentField = $this->form->getField($this->element['location_parent_field'], $group);
            $parentValue = $parentField->value;
            $query->where('l.'.$this->element['location_parent_column']. ' = '.$parentValue);
        }

		// Get the options.
		$db->setQuery($query);

		$options = $db->loadObjectList();

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}

		// Merge any additional options in the XML definition.
		//$options = array_merge(parent::getOptions(), $options);

		array_unshift($options, JHtml::_('select.option', '0', JText::_('COM_JNT_HANHPHUC_NO_LOCATION')));

		return $options;
	}
}
