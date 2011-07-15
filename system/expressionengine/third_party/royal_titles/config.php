<?php

if ( ! defined('BW_RT_VERSION'))
{
  define('BW_RT_VERSION', '0.6');
  define('BW_RT_NAME', 'Royal Titles');
  define('BW_RT_DESCRIPTION', 'Enable EE global variables for the default weblog title setting.');  
  define('BW_RT_DOCUMENTATION', 'http://support.baseworks.nl/discussions/royal_titles');
  define('BW_RT_DEBUG', FALSE);
}

$config['name'] = BW_RT_NAME;
$config['version'] = BW_RT_VERSION;
$config['description'] = BW_RT_DESCRIPTION;
$config['nsm_addon_updater']['versions_xml'] = '';