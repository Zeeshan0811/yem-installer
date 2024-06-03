<?php
/*
Plugin Name:       YEM Installer
Description:       A WordPress plugin for installing YEM.
Version:           1.0.1
Author:            Sylvex Studio
Author URI:        https://sylvex.com.au/
*/


// Include Admin Page Functionality
require_once(plugin_dir_path(__FILE__) . 'admin-page.php');

// Activation Hook
register_activation_hook(__FILE__, 'yem_installer_activate');

function yem_installer_activate()
{
    // Perform actions upon activation, if necessary
}

// Deactivation Hook
register_deactivation_hook(__FILE__, 'yem_installer_deactivate');

function yem_installer_deactivate()
{
    // Perform actions upon deactivation, if necessary
}
