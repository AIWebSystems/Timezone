<?php namespace Pyro\FieldType;

use Pyro\Module\Streams\FieldType\FieldTypeAbstract;

/**
 * Timezone Field Type
 *
 * @author        Ryan Thompson
 * @copyright    Copyright (c) 2008-2013, AI Web Systems, Inc.
 * @license        MIT
 * @link        http://aiwebsystems.com/
 */
class Timezone extends FieldTypeAbstract
{
    public $field_type_name = 'Timezone';
    
    public $field_type_slug = 'timezone';
    
    public $db_col_type = 'string';

    public $custom_parameters = array('default_value');

    public $version = '1.1';

    public $author = array(
        'name' => 'Ryan Thompson',
        'url' => 'http://www.aiwebsystems.com/'
        );
    
    /**
     * Output form input
     *
     * @access     public
     * @param    array
     * @return    string
     */
    public function formInput()
    {
        $choices = array();

        if ($this->field->required != 'yes')
        {
            $choices[null] = '---';
        }

        foreach (timezone_identifiers_list() as $key => $val)
        {
            $choices[$val] = $val;
        }

        return form_dropdown($this->form_slug, $choices, $this->value ?: $this->getParameter('default_value'));
    }
}
