<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

// Store the requested URL, which will sometimes be different from previous URL.
$hook['pre_controller'][] = array(
    'class'    => 'App_hooks',
    'function' => 'saveRequested',
    'filename' => 'App_hooks.php',
    'filepath' => 'hooks',
    'params'   => ''
);

// Allow performance of good redirects to previous pages.
$hook['post_controller'][] = array(
    'class'    => 'App_hooks',
    'function' => 'prepRedirect',
    'filename' => 'App_hooks.php',
    'filepath' => 'hooks',
    'params'   => ''
);

// Check whether the site is in maintenance mode.
$hook['post_controller_constructor'][] = array(
    'class'    => 'App_hooks',
    'function' => 'checkSiteStatus',
    'filename' => 'App_hooks.php',
    'filepath' => 'hooks',
    'params'   => ''
);
