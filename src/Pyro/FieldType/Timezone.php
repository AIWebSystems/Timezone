<?php namespace Pyro\FieldType;

use Pyro\Module\Streams_core\Core\Field\AbstractField;

/**
 * Timezone Field Type
 *
 * @author		Ryan Thompson
 * @copyright	Copyright (c) 2008-2013, AI Web Systems, Inc.
 * @license		MIT
 * @link		http://aiwebsystems.com/
 */
class Timezone extends AbstractField
{
	public $field_type_name = 'Timezone';
	
	public $field_type_slug = 'timezone';
	
	public $db_col_type = 'varchar';

	public $custom_parameters = array('default_value');

	public $version = '1.1';

	public $author = array(
		'name' => 'Ryan Thompson',
		'url' => 'http://www.aiwebsystems.com/'
		);
	
	/**
	 * Output form input
	 *
	 * @access 	public
	 * @param	array
	 * @return	string
	 */
	public function formInput()
	{
		$choices = array();

		if ($this->field->is_required != 'yes')
		{
			$choices[null] = '---';
		}

		foreach (timezone_identifiers_list() as $key => $val)
		{
			$choices[$val] = $val;
		}

		return form_dropdown($this->field_slug, $choices, empty($this->value) ? $this->value : $this->getParameter('default_value'));
	}
}
