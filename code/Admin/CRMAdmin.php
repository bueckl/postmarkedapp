<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 9/6/15
 * Time: 9:25 AM
 * To change this template use File | Settings | File Templates.
 */

class CRMAdmin extends ModelAdmin {

	private static $url_segment = 'crm';
	private static $menu_title = 'CRM';
	private static $menu_icon = '/silverstripe-postmarked/images/icons/crm.png';


	function getEditForm($id = null, $fields = null){

		$form = parent::getEditForm($id, $fields);

		Requirements::javascript('silverstripe-postmarked/javascript/PostmarkeMessageButton.js');

		if($this->modelClass == Config::inst()->get('PostmarkAdmin', 'member_class')){
			$fields = $form->Fields();
			$grid = $fields->dataFieldByName($this->sanitiseClassName($this->modelClass));
			if($grid){
				$configs = $grid->getConfig();
				$configs->addComponent(new GridFieldPostmarkMessageButton());
			}
		}


		return $form;

	}

} 