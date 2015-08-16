<?php
namespace ChefMailchimp\Hooks;

use ChefForms\Builders\Fields\DefaultField;
use Cuisine\Wrappers\Field;

class CheckboxField extends DefaultField{


    /**
     * Method to override to define the input type
     * that handles the value.
     *
     * @return void
     */
    protected function fieldType(){
        $this->type = 'mc_checkbox';
    }



    /*=============================================================*/
    /**             FRONTEND                                       */
    /*=============================================================*/


    /**
     * Render this field on the front-end
     * @return [type] [description]
     */
    public function render(){

        $this->setDefaultValue();
        $this->properties['name'] = 'mc_signup';

        Field::checkbox(

            $this->properties['name'],
            $this->getLabel(),
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
    public function buildPreview(){

        $html = '';

        $html .= '<label>'.$this->getLabel().'</label>';

        $html .= '<span class="field-type">checkbox</span>';

        return $html;

    }



}