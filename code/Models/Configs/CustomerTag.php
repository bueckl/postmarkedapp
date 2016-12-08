<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 9/6/15
 * Time: 9:42 AM
 * To change this template use File | Settings | File Templates.
 */

class CustomerTag extends DataObject {

	private static $db = array(
		'Title' => 'Varchar'
	);
	
	private static $indexes = array(
		'Title' => 'unique("Title")'
	);
	private static $default_sort = 'Title';
	
	private static $summary_fields = array(
		'Title'
	);
	
	private static $belongs_many_many = array(
		'Recipients' => 'Recipient.Tags' 
	);
	
	// Make sure not to have empty tags or doublettes
	protected function validate() {
		
		parent::validate();
		
		if (!$this->ID) {
			
			
			$exists = CustomerTag::get()->filter('Title', $this->Title)->Count();
			
		
			if ($exists == 1) {
					$message = 'A tag by this name already exists';
					return new ValidationResult(false, $message);
			}
		
			else if ($exists == 0) {
				$message = 'A new tag "'.$this->Title.'" has been added';
				return new ValidationResult(true, $message);
			}
		} else {
			if ($this->Title == "") {
					$message = 'A tag must not be empty';
					return new ValidationResult(false, $message);
			}
			
			return parent::validate();
			
		}
		
	}
	
} 