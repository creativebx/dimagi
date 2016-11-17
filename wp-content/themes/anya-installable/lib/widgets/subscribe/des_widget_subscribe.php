<?php
//=============================================
// Create Subscribe Widget
//=============================================
class HubSpot_BlogSubscribe_Widget extends WP_Widget {
    
    /** constructor */
    function HubSpot_BlogSubscribe_Widget() {
        $this->WP_Widget(false, $name = 'HubSpot: Blog Subscribe Form'); 
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) { 

        extract( $args );
        $hs_settings = array();
        $hs_settings = get_option('hs_settings');
        $title = $instance['title'];
        
        echo $before_widget;        
        if (trim($title) != ""){
            echo $before_title . $title . $after_title; 
        }
        echo ' <!--[if lte IE 8]> <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script> <![endif]--> <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script> <script> hbspt.forms.create({ css: "", portalId: "503070", formId: "b5604cf8-d730-43ea-ab51-20d9e1941458" }); </script> ';
        
        echo $after_widget;
    }

} // class hs_Widget

register_widget('HubSpot_BlogSubscribe_Widget');

?>
