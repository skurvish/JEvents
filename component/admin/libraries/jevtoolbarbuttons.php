<?php
/**
 * JEvents Component for Joomla 1.5.x
 *
 * @version     $Id: jevbuttons.php 2749 2011-10-13 08:54:34Z geraintedwards $
 * @package     JEvents
 * @copyright   Copyright (C)  2008-2009 GWE Systems Ltd
 * @license     GNU/GPLv2, see http://www.gnu.org/licenses/gpl-2.0.html
 * @link        http://www.jevents.net
 */


// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();
jimport('cms.toolbar.button');
	
/* 
 * 
 * Joomla 3.0 version
 * 
 */
class JToolbarButtonJev extends JToolbarButton
{
	/**
	 * Button type
	 *
	 * @access	protected
	 * @var		string
	 */
	var $_name = 'Jev';

	function fetchButton( $type='Jev', $icon = '', $text='',$task='', $list='')
	{
		$i18n_text	= JText::_($text);
		$class	= $this->fetchIconClass($icon);
		$doTask	= $this->_getCommand($text, $task, $list);

		if ($name == "apply" || $name == "new")
		{
			$btnClass = "btn btn-small btn-success";
			$iconWhite = "icon-white";
		}
		else
		{
			$btnClass = "btn btn-small";
			$iconWhite = "";
		}

		$html = "<button href=\"#\" onclick=\"$doTask\" class=\"".$btnClass."\">\n";
		$html .= "<i class=\"$class $iconWhite\">\n";
		$html .= "</i>\n";
		$html .= "$i18n_text\n";
		$html .= "</button>\n";

		return $html;
	}

	/**
	 * Get the button CSS Id
	 *
	 * @access	public
	 * @return	string	Button CSS Id
	 * @since	1.5
	 */
	function fetchId( $type='Js', $icon = '', $text = '', $task='', $listSelect='', $js='' )
	{
		if (JVersion::isCompatible("1.6.0")) {
			return $this->_parent->getName().'-'.$icon;
		}
		else {
			return $this->_parent->_name.'-'.$icon;
		}
	}
	
	/**
	 * Get the JavaScript command for the button
	 *
	 * @access	private
	 * @param	string	$name	The task name as seen by the user
	 * @param	string	$task	The task used by the application
	 * @param	???		$list
	 * @param	boolean	$hide
	 * @return	string	JavaScript command string
	 * @since	1.5
	 */
	function _getCommand($name, $task, $list)
	{
		$todo		= JString::strtolower(JText::_( $name ));
		$message	= JText::sprintf( 'Please make a selection from the list to', $todo );
		$message	= addslashes($message);

		$submitbutton = JVersion::isCompatible("1.6.0")? "Joomla.submitbutton":"submitbutton";
		if ($list) {
			$cmd = "javascript:if(document.adminForm.boxchecked.value==0){alert('$message');}else{  $submitbutton('$task')};return false;";
		} else {
			$cmd = "javascript:$submitbutton('$task');return false;";
		}


		return $cmd;
	}	
}

class JToolbarButtonJevlink extends JToolbarButton
{
	/**
	 * Button type
	 *
	 * @access	protected
	 * @var		string
	 */
	var $_name = 'Jevlink';


	function fetchButton( $type='Jevlink', $icon = '', $text='',$task='', $list='')
	{
		$i18n_text	= JText::_($text);
		$class	= $this->fetchIconClass($icon);
		$doTask	= $this->_getCommand($text, $task, $list);

		$html	= "<a href=\"$doTask\"  class=\"toolbar\">\n";
		$html .= "<span class=\"$class\" title=\"$i18n_text\">\n";
		$html .= "</span>\n";
		$html	.= "$i18n_text\n";
		$html	.= "</a>\n";

		return $html;
	}

	/**
	 * Get the button CSS Id
	 *
	 * @access	public
	 * @return	string	Button CSS Id
	 * @since	1.5
	 */
	function fetchId( $type='Js', $icon = '', $text = '', $task='', $listSelect='', $js='' )
	{
		if (JVersion::isCompatible("1.6.0")) {
			return $this->_parent->getName().'-'.$icon;
		}
		else {
			return $this->_parent->_name.'-'.$icon;
		}

	}
	
	/**
	 * Get the JavaScript command for the button
	 *
	 * @access	private
	 * @param	string	$name	The task name as seen by the user
	 * @param	string	$task	The task used by the application
	 * @param	???		$list
	 * @param	boolean	$hide
	 * @return	string	JavaScript command string
	 * @since	1.5
	 */
	function _getCommand($name, $task, $list)
	{
		$Itemid = JRequest::getInt("Itemid");
		$link = JRoute::_("index.php?option=".JEV_COM_COMPONENT."&task=$task&Itemid=$Itemid");

		return $link;
	}	
}


class JToolbarButtonJevconfirm extends JToolbarButton
{
	/**
	 * Button type
	 *
	 * @access	protected
	 * @var		string
	 */
	var $_name = 'JevConfirm';

	function fetchButton( $type='Confirm', $msg='', $name = '', $text = '', $task = '', $list = true, $hideMenu = false , $jstestvar = false)
	{
		$text	= JText::_($text);
		$msg	= JText::_($msg, true);
		$class	= $this->fetchIconClass($name);
		$doTask	= $this->_getCommand($msg, $name, $task, $list, $hideMenu,$jstestvar);

		$html = "<button href=\"#\" onclick=\"$doTask\" class=\"btn btn-small\">\n";
		$html .= "<span class=\"$class\">\n";
		$html .= "</span>\n";
		$html .= "$text\n";
		$html .= "</button>\n";

		return $html;
	}

	/**
	 * Get the button CSS Id
	 *
	 * @access	public
	 * @return	string	Button CSS Id
	 * @since	1.5
	 */
	function fetchId( $type='Confirm',  $msg='', $name = '', $text = '', $task = '', $list = true, $hideMenu = false , $jstestvar = false)
	{
		if (JVersion::isCompatible("1.6.0")) {
			return $this->_parent->getName().'-'.$name;
		}
		else {
			return $this->_parent->_name.'-'.$name;
		}
	}

	/**
	 * Get the JavaScript command for the button
	 *
	 * @access	private
	 * @param	object	$definition	Button definition
	 * @return	string	JavaScript command string
	 * @since	1.5
	 */
	function _getCommand($msg, $name, $task, $list, $hide, $jstestvar = false)
	{
		$todo	 = JString::strtolower(JText::_( $name ));
		$message = JText::sprintf( 'Please make a selection from the list to %s', $todo );
		$message = addslashes($message);
		$submitbutton = JVersion::isCompatible("1.6.0")? "Joomla.submitbutton":"submitbutton";
		
		if ($hide) {
			if ($list) {
				$cmd = "javascript:if(document.adminForm.boxchecked.value==0){
					alert('$message');
				}
				else{
					
					if($jstestvar==1) {
						if (confirm('$msg')){
							$submitbutton('$task');
						}
						return false;
					}
					$submitbutton('$task');
				}";
			} else {
				$cmd = "javascript:
					if($jstestvar==1) {
						if (confirm('$msg')){
							$submitbutton('$task');
						}
						return false;
					}
					$submitbutton('$task');
				";
			}
		} else {
			if ($list) {
				$cmd = "javascript:if(document.adminForm.boxchecked.value==0){
					alert('$message');
				}
				else{
					if($jstestvar==1) {
						if (confirm('$msg')){
							$submitbutton('$task');
						}
						return false;
					}
					$submitbutton('$task');
				}";
			} else {
				$cmd = "javascript:
				if($jstestvar==1) {
					if (confirm('$msg')){
						$submitbutton('$task');
					}
					return false;
				}
				$submitbutton('$task');
				";
			}
		}

		return $cmd;
	}
}