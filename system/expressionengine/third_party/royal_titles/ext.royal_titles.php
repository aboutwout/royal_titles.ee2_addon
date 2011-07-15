<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Royal Titles Extension
*
* @package		ExpressionEngine
* @subpackage	Addons
* @category	Extension
* @author		Wouter Vervloet
* @link		http://www.baseworks.nl/
* @license    http://creativecommons.org/licenses/by-sa/3.0/
* 
* This work is licensed under the Creative Commons Attribution-Share Alike 3.0 Unported.
* To view a copy of this license, visit http://creativecommons.org/licenses/by-sa/3.0/
* or send a letter to Creative Commons, 171 Second Street, Suite 300,
* San Francisco, California, 94105, USA.
* 
*/

require PATH_THIRD.'royal_titles/config.php';

class Royal_titles_ext
{
  public $settings            = array();
  
	public $description = BW_RT_DESCRIPTION;
	public $docs_url = BW_RT_DOCUMENTATION;
	public $name = BW_RT_NAME;
	public $settings_exist = 'n';
	public $version = BW_RT_VERSION;
  
	// -------------------------------
	// Constructor
	// -------------------------------
	function Royal_titles_ext($settings='')
	{
	  $this->__construct($settings);
	}
	
	function __construct($settings='')
	{	  
	  $this->EE =& get_instance();
		$this->settings = $settings;	
	}
	// END Super_titles
	
	function publish_form_channel_preferences($data = array())
	{
	  
	  $this->EE->load->helper('url');
	  
	  $title = $data['default_entry_title'];
 	  
	  $data['current_time'] = $this->EE->localize->now;

    if ( ! isset($this->EE->TMPL) AND ! class_exists('EE_Template'))
    {
      require APPPATH.'/libraries/Template.php';
      $this->EE->TMPL = new EE_Template();
    }
		
		$title = $this->EE->TMPL->parse_variables_row($title, $data);
			  
	  $data['default_entry_title'] = $title;
	  $data['url_title_prefix'] = url_title(strtolower($title));

	  return $data;
	}

	// --------------------------------
	//  Activate Extension
	// --------------------------------
	function activate_extension()
	{

    // hooks array
    $hooks = array(
      'publish_form_channel_preferences' => 'publish_form_channel_preferences'
    );

    // insert hooks and methods
    foreach ($hooks AS $hook => $method)
    {
      // data to insert
      $data = array(
        'class'		=> __CLASS__,
        'method'	=> $method,
        'hook'		=> $hook,
        'priority'	=> 1,
        'version'	=> $this->version,
        'enabled'	=> 'y',
        'settings'	=> serialize($this->settings)
      );

      // insert in database
      $this->EE->db->insert('exp_extensions', $data);
    }

    return TRUE;
	}
	// END activate_extension
	 
	 
	// --------------------------------
	//  Update Extension
	// --------------------------------  
	function update_extension($current='')
	{
		
    if ($current == '' OR $current == $this->version)
    {
      return FALSE;
    }
    
  }
  // END update_extension

	// --------------------------------
	//  Disable Extension
	// --------------------------------
	function disable_extension()
	{	
		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->delete('extensions');
  }
  // END disable_extension

	 
}
// END CLASS