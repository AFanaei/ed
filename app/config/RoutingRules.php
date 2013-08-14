<?php

/**
 * EasyDev
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *	-- This file lets you re-map URI requests to specific controller functions.
 * @package		EasyDev
 * @subpackage	Config/RoutingRules
 * @Developer	Hassan nasiri
 * @copyright	Copyright (c) 2013, Hassan nasiri
 * @license		http://www.gnu.org/licenses/gpl.html
 * @website		---
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

/*
|----- re-Map uri requests -----

Prototype:
		$auto['product/([1-0]+)'] = 'users/products/\1';
		in this example 'http://domain.com/product/341' re-map to 'http://domain.com/users/product/341'
		
		what is mean 'users/product/productID'
		'users' is controller name.
		'product' is controller method.
		'productID' is requested values and to method.
*/
$routingRules['modules/.*'] = 'raya/modules/\1';
$routingRules['login/.*'] = 'raya/login/\1';
$routingRules['cp/.*'] = 'raya/cp';

?>