<?php namespace Pyro\FieldType;

use Pyro\Module\Streams\FieldType\FieldTypeAbstract;

class Timezone extends FieldTypeAbstract
{
    /**
     * Field type slug
     *
     * @var string
     */
    public $field_type_slug = 'timezone';

    /**
     * DB col type
     *
     * @var string
     */
    public $db_col_type = 'string';

    /**
     * Version
     *
     * @var string
     */
    public $version = '1.1';

    /**
     * Author
     *
     * @var array
     */
    public $author = array(
        'name' => 'Ryan Thompson',
        'url'  => 'http://www.aiwebsystems.com/',
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

        if ($this->field->required != 'yes') {
            $choices[null] = '---';
        }

        foreach (timezone_identifiers_list() as $key => $val) {
            $choices[$val] = str_replace(array('_'), ' ', $val);
        }

        return form_dropdown($this->form_slug, $choices, $this->value ? : $this->getParameter('default_value'));
    }
}
