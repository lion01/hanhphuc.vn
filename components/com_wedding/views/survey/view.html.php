<?php
/**
 * components/com_wedding/views/home/view.html.php
 * @author 		: Phạm Văn An
 * @version 	: 1.0
*/
 
// no direct access 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.view'); 
 
class weddingViewSurvey extends JView
{
    function display($rows, $tpl = null)
    {
    	$this->assignRef('rows', $rows);
    	$content = $this->loadTemplate('survey.default');
    	$this->assignRef('content', $content);
    	$this->assignRef('css', $rows->css);
    	$this->assignRef('images', $rows->images);
    	$this->assignRef('menu', $rows->menu);
    	$this->assignRef('userdata', $rows->userdata);
    	parent::display($tpl);
    }
    
    function svresult($rows, $tpl = null)
    {
    	$this->assignRef('rows', $rows);
    	$content = $this->loadTemplate('survey.svresult');
    	$this->assignRef('content', $content);
    	$this->assignRef('css', $rows->css);
    	$this->assignRef('images', $rows->images);
    	$this->assignRef('menu', $rows->menu);
    	$this->assignRef('userdata', $rows->userdata);
    	parent::display($tpl);
    }
    
    function listitems($rows, $tpl = null)
    {
    	$this->assignRef('rows', $rows);
    	parent::display($tpl);
    }
    
    function edit($rows, $tpl = null)
    {
    	$this->assignRef('rows', $rows);
    	parent::display($tpl);
    }
}