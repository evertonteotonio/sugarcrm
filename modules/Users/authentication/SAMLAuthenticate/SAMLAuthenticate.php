<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Master Subscription
 * Agreement ("License") which can be viewed at
 * http://www.sugarcrm.com/crm/master-subscription-agreement
 * By installing or using this file, You have unconditionally agreed to the
 * terms and conditions of the License, and You may not use this file except in
 * compliance with the License.  Under the terms of the license, You shall not,
 * among other things: 1) sublicense, resell, rent, lease, redistribute, assign
 * or otherwise transfer Your rights to the Software, and 2) use the Software
 * for timesharing or service bureau purposes such as hosting the Software for
 * commercial gain and/or for the benefit of a third party.  Use of the Software
 * may be subject to applicable fees and any use of the Software without first
 * paying applicable fees is strictly prohibited.  You do not have the right to
 * remove SugarCRM copyrights from the source code or user interface.
 *
 * All copies of the Covered Code must include on each user interface screen:
 *  (i) the "Powered by SugarCRM" logo and
 *  (ii) the SugarCRM copyright notice
 * in the same form as they appear in the distribution.  See full license for
 * requirements.
 *
 * Your Warranty, Limitations of liability and Indemnity are expressly stated
 * in the License.  Please refer to the License for the specific language
 * governing these rights and limitations under the License.  Portions created
 * by SugarCRM are Copyright (C) 2004-2012 SugarCRM, Inc.; All Rights Reserved.
 ********************************************************************************/




/**
 * This file is used to control the authentication process. 
 * It will call on the user authenticate and controll redirection 
 * based on the users validation
 *
 */


require_once('modules/Users/authentication/SugarAuthenticate/SugarAuthenticate.php');
class SAMLAuthenticate extends SugarAuthenticate {
	var $userAuthenticateClass = 'SAMLAuthenticateUser';
	var $authenticationDir = 'SAMLAuthenticate';
	/**
	 * Constructs SAMLAuthenticate
	 * This will load the user authentication class
	 *
	 * @return SAMLAuthenticate
	 */
	function SAMLAuthenticate(){
		parent::SugarAuthenticate();
	}

    /**
     * pre_login
     * 
     * Override the pre_login function from SugarAuthenticate so that we can set a default user_name/user_password $_REQUEST values
     * if none are supplied
     */
    function pre_login()
    {
        if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'Authenticate')
        {
            if(empty($_REQUEST['user_name']))$_REQUEST['user_name'] = 'onelogin';
            if(empty($_REQUEST['user_password']))$_REQUEST['user_password'] = 'onelogin';
        }
    }

}
