<?php
namespace ChefMailchimp\Hooks;

use ChefMailchimp\Wrappers\Api;
use ChefForms\Fields\DefaultField;
use Cuisine\Wrappers\Field;

class SelectField extends DefaultField{


    /**
     * Method to override to define the input type
     * that handles the value.
     *
     * @return void
     */
    protected function fieldType(){
        $this->type = 'mc_select';
    }



    /*=============================================================*/
    /**             FRONTEND                                       */
    /*=============================================================*/


    /**
     * Render this field on the front-end
     * @return [type] [description]
     */
    public function render(){

        $this->setDefaults();
        $this->properties['name'] = 'mc_list_select';

        $lists = Api::getListArray();

        Field::select(

            $this->properties['name'],
            $this->getLabel(),
            $lists,
            $this->properties

        )->render();

    }

    /*=============================================================*/
    /**             Backend                                        */
    /*=============================================================*/


    /**
     * Generate the preview for this field:
     * 
     * @return void
     */
    public function buildPreview( $mainOverview = false ){

        $html = '';

        $html .= '<label>'.$this->getLabel().'</label>';

        $html .= '<span class="field-type">select</span>';

        return $html;

    }



}