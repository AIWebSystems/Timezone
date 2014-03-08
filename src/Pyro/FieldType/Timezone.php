<?php namespace Pyro\FieldType;

use Pyro\Module\Streams\FieldType\FieldTypeAbstract;
use Carbon\Carbon;

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

        $zones = timezone_identifiers_list();
        
        foreach ($zones as $zone) 
        {

            $zone_full = $zone;
            $zone = explode('/', $zone); // 0 => Continent, 1 => City

            if ($zone[0] == 'Africa' || $zone[0] == 'America' || $zone[0] == 'Antarctica' || $zone[0] == 'Arctic' || $zone[0] == 'Asia' || $zone[0] == 'Atlantic' || $zone[0] == 'Australia' || $zone[0] == 'Europe' || $zone[0] == 'Indian' || $zone[0] == 'Pacific')
            {        
                if (isset($zone[1]) != '')
                {
                    $tz = Carbon::now($zone_full)->format('[P] - T');
                    $choices[$zone[0]][$zone[0]. '/' . $zone[1]] = $zone[0].'/'.str_replace('_', ' ', $zone[1]).' '.$tz;
                } 
            }
        }
        
        return form_dropdown($this->form_slug, $choices, $this->value ?: $this->getParameter('default_value'));

    }

}