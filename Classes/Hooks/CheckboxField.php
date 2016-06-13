<?php
namespace ChefMailchimp\Hooks;

use ChefForms\Fields\DefaultField;
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

        $this->setDefaults();
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
     * @return string (html)
     */
    public function buildPreview( $mainOverview = false ){

        $html = '';

        $html .= '<span class="single-checkbox-wrapper">';

            $html .= '<input class="preview-input preview-'.esc_attr( $this->type ).'" disabled type="'.esc_attr( $this->type ).'">';

            $html .= '<label class="preview-label">'.esc_html( $this->getLabel() ).'</label>';

        $html .= '</span>';
    
        //do not display these in the lightbox:
        if( $mainOverview ){

            $html .= $this->getFieldIcon();
            $html .= $this->previewControls();

        }

        echo $html;

    }



}