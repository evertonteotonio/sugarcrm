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

/*********************************************************************************

 * Description:  
 ********************************************************************************/



class PercentageDiscount {

	function is_readonly() {
		return 'readonly';
	}
	
	function get_edit_html($pricing_factor) {
		global $current_language;
		$template_mod_strings = return_module_language($current_language, "ProductTemplates");
		return "${template_mod_strings['LBL_PERCENTAGE']} <input language='javascript' onkeyup='set_discount_price(this.form)' id='pricing_factor_PercentageDiscount' type='text' tabindex='1' size='4' maxlength='4' value='".$pricing_factor."'>";
	}
	
	function get_detail_html($formula,$factor) {
		global $current_language, $app_list_strings;
		$template_mod_strings = return_module_language($current_language, "ProductTemplates");
		return $app_list_strings['pricing_formula_dom'][$formula]." [".$template_mod_strings['LBL_PERCENTAGE']." = ".$factor."]";
	}
	
	function get_formula_js() {
		//Percentage Markup: $discount_price = $cost_price x (1 + $percentage) 
		global $current_user, $sugar_config;
		$precision = null;

		if($precision == null) {
	 		$precision_val = $current_user->getPreference('default_currency_significant_digits');
			$precision = (empty($precision_val) ? $sugar_config['default_currency_significant_digits'] : $precision_val);			
		}	
		$the_script = "form.discount_price.readOnly = true;\n";
		$the_script .= 	"this.document.getElementById('discount_price').value = formatNumber(Math.round(unformatNumber(this.document.getElementById('list_price').value, num_grp_sep, dec_sep) * (1 - (unformatNumber(this.document.getElementById('pricing_factor_PercentageDiscount').value, num_grp_sep, dec_sep) /100))*100)/100, num_grp_sep, dec_sep, $precision, $precision);\n";
		return $the_script;  
	}

	function calculate_price($cost_price, $list_price, $discount_price, $factor) {
		//Percentage Markup: $discount_price = $cost_price x (1 + $percentage) 
		$discount_price  = 	$list_price * (1 - ($factor/100));
		return $discount_price;
	}
}
?>
