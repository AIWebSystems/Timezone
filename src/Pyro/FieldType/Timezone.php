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
        return form_dropdown($this->form_slug, $this->getOptions(), $this->value);
    }

    /**
     * Get options
     *
     * @return array
     */
    protected function getOptions()
    {
        $options = timezone_identifiers_list();

        foreach ($options as &$option) {
            $option = str_replace('_', ' ', $option);
        }

        return $options;
    }
}
