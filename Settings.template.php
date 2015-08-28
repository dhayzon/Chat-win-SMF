<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines
 * @copyright 2011 Simple Machines
 * @license http://www.simplemachines.org/about/smf/license.php BSD
 * @author dhayzon
 * @version 2.0
 *
 */ 
 
// colocamos los dos arreglos dentro del array padre  
function template_options()
{
	global $context, $settings, $options, $scripturl, $txt;

	$context['theme_options'] = array(
		   	array(
	    	'id' =>'enable_chat_fm',
	    	'label' =>$txt['enable_chat_fm'],
	    	),

	   	 array(
	   	  'id' => 'chat_secret',
	   	  'label' => $txt['chat_secret'],
	   	  'description' => $txt['chat_description'],
     	  'type' => 'text',
	      	),
