<?php

/**
 * Contact Model
 * @author James Fairhurst <info@jamesfairhurst.co.uk>
 */
class Contact extends AppModel {

	/**
	 * Model Class name
	 * @param string
	 */
	public $name = 'Contact';

	/**
	 * Validation Rules
	 * @param array
	 */
	public $validate = array(
		'full_name' => 'notEmpty',
        'email' => array(
			'rule' => 'email',
			'required' => true,
			'message' => 'Please enter a valid Email Address',
			'class'=>'error'
		),
		'phone' => array(
			'rule' => 'numeric',
			'required' => true,
			'message' => 'Please enter a numeric Telephone Number',
			'class'=>'error'
		),
		'message' => 'notEmpty'
    );
}