<?php
/**
Plugin Name: Custom Coming Soon
Plugin URI: https://phpmantras.wordpress.com/
Description: "Custom Coming Soon plugin give the flexibilty to show  'coming soon' ,'maintenance page' and under construction page with custom design and background option in frontend from admin section" .
Author: Surya Bhan Maurya(+91-9654235223)
Author URI: https://phpmantras.wordpress.com/
Version: 2.2
*/
/*** Wordpress Coming Soon Copyright 2016    (email : suryabhan.maurya563@gmail.com)

his program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
***/
if ( ! defined( 'ABSPATH' ) ) exit; 

/** Load jquery liberary **/
add_action( 'wp_enqueue_scripts', 'custom_csn_jquery' );

     
function custom_csn_jquery()
        {
            if ( ! wp_script_is( 'jquery', 'enqueued' ))
                {
                wp_enqueue_script( 'jquery' );
                              
              }
             
        }
/** Load jquery liberary code end here **/

 /** Add admin menu for custom coming soon page **/
add_action('admin_menu','custom_csn_menu');


if(!function_exists('custom_csn_menu')):
function custom_csn_menu(){

	add_options_page('Custom Comming Soon','Custom Coming Soon Setting','manage_options','custom-coming-soon','custom_csn_setting');

}
endif;
/** Add admin menu for Custom coming soon page code end here **/

/** Action to register "Custom coming soon" Options */
add_action('admin_init','custom_csn_fields');


/** Register "custom coming soon" options */
if(!function_exists('custom_csn_fields')):
        function custom_csn_fields(){
                register_setting('ccs_setting_options','ccs_status');
                register_setting('ccs_setting_options','ccs_title');
                register_setting('ccs_setting_options','ccs_heading'); 
                register_setting('ccs_setting_options','ccs_main_logo');
                register_setting('ccs_setting_options','ccs_logo');
                register_setting('ccs_setting_options','ccs_message');
                register_setting('ccs_setting_options','ccs_background_color');
                register_setting('ccs_setting_options','ccs_texth_color');
                register_setting('ccs_setting_options','ccs_text_color');
                register_setting('ccs_setting_options','ccs_enable_wall');
                register_setting('ccs_setting_options','ccs_wall_width');
                              
} 
endif;

/** Setting form and support information for "Custom Coming Soon" plugin */
if(!function_exists('custom_csn_setting')):
        function custom_csn_setting()
           { ?>
                 <script>
                   jQuery(document).ready(function($){
                                $('#upload-btn').click(function(e) {
                                        e.preventDefault();
                                        var image = wp.media({ 
                                                title: 'Upload Image',
                                                // mutiple: true if you want to upload multiple files at once
                                                multiple: false
                                        }).open()
                                        .on('select', function(e){
                                                // This will return the selected image from the Media Uploader, the result is an object
                                                var uploaded_image = image.state().get('selection').first();
                                                // We convert uploaded_image to a JSON object to make accessing it easier
                                                // Output to the console uploaded_image
                                                console.log(uploaded_image);
                                                var image_url = uploaded_image.toJSON().url;
                                                // Let's assign the url value to the input field
                                                $('#ccs_logo').val(image_url);
                                        });
                                });
                                
                                        $('#upload-btn-logo').click(function(e) {
                                        e.preventDefault();
                                        var image = wp.media({ 
                                                title: 'Upload Logo',
                                                // mutiple: true if you want to upload multiple files at once
                                                multiple: false
                                        }).open()
                                        .on('select', function(e){
                                                // This will return the selected image from the Media Uploader, the result is an object
                                                var uploaded_image = image.state().get('selection').first();
                                                // We convert uploaded_image to a JSON object to make accessing it easier
                                                // Output to the console uploaded_image
                                                console.log(uploaded_image);
                                                var image_url = uploaded_image.toJSON().url;
                                                // Let's assign the url value to the input field
                                                $('#ccs_main_logo').val(image_url);
                                        });
                                });


                        });

                        jQuery(document).ready(function($){
                            $('.my-color-field').wpColorPicker();

                        });


                        </script>
                        <?php 

                        echo $script='<script type="text/javascript">
                                jQuery(document).ready(function(){

                                  jQuery(".ccs-tab-section").hide();
                                jQuery("#ccs_tabs a").bind("click", function(e){
                                        jQuery("#ccs_tabs a.current").removeClass("current");
                                        jQuery(".ccs-tab-section:visible").hide();
                                        jQuery(this.hash).show();
                                        jQuery(this).addClass("current");
                                        e.preventDefault();
                                }).filter(":first").click();
                                        })
                                </script>';
                        ?>
                        <div>
                            <div style="width: 80%; padding: 10px; margin: 10px;"> 
                                <h1>Custom Coming Soon Page & maintenance Settings</h1>
                                    <ul id="ccs_tabs">
                                        <li><a href="#content">Content</a></li>
                                        <li><a href="#Design">Design</a></li>
                                        <li><a href="#support">Support</a></li>
                                    </ul>
                                <form action="options.php" method="post" id="ccs-settings-form-admin">
                                    <div id="content" class="ccs-tab-section">
                                        <h2>General Settings</h2>
                                        <div class="ccs-content-div">

                                            <div>
                                                <?php
                                                  wp_enqueue_style( 'wp-color-picker' );
                                                  wp_enqueue_script( 'wp-color-picker' );
                                                ?>

                                                <label for="name" class="ccs_lable">Status:</label>
                                                <div class="ccs_radio">
                                                <input type="radio" class="ccs_input" id="ccs_status" name="ccs_status" value="disabled" checked /> Disable
                                                <input type="radio" class="ccs_input" id="ccs_status" name="ccs_status" value="enabled" <?php if(get_option('ccs_status')=="enabled"){?>checked<?php }?>/>Enable
                                                </div>
                                            </div>
                                            <div>
                                                <label for="mail" class="ccs_lable">Page Title:</label>
                                                <input type="text" id="ccs_title" class="ccs_input" name="ccs_title" value="<?php echo get_option('ccs_title'); ?>" />
                                            </div>

                                             <div>
                                                <label for="mail" class="ccs_lable">Main Heading:</label>
                                                <input type="text" id="ccs_title" class="ccs_input" name="ccs_heading" value="<?php echo get_option('ccs_heading'); ?>" />
                                            </div>
                                             
                                            <div>
                                                <label for="image_url" class="ccs_lable">Background Image</label>
                                                <input type="text" class="ccs_input"  name="ccs_logo" id="ccs_logo" class="regular-text" value="<?php echo get_option('ccs_logo');?>">
                                                <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
                                            </div>
                                            <div>
                                                <label for="msg" style="ccs_lable">Meesage:</label>
                                                <br/>
                                                <div class="ccs_editor">
                                                <?php         if(isset($settings)){
                                                  $settings=$settings;
                                              }else{
                                                  $settings="";
                                              }
                                              wp_editor(esc_html( __(get_option('ccs_message', 'Coming soon ...'))), 'ccs_message', $settings);?>
                                                </div>
                                               </div>  
                                        </div>
                                    </div>

                                    <div id="Design" class="ccs-tab-section ccs-design">
                                        <h2>Design Settings</h2>
                                        <div>
                                                <label for="image_url" class="ccs_lable">Logo</label>
                                                <input type="text" class="ccs_input_logo"  name="ccs_main_logo" id="ccs_main_logo" class="regular-text" value="<?php echo get_option('ccs_main_logo');?>">
                                                <input type="button" name="upload-btn-logo" id="upload-btn-logo" class="button-secondary" value="Upload Image">
                                            </div>
                                        
                                         <div>
                                                <label for="mail" class="ccs_lable_design">Background Color:</label>
                                                <input type="text" value="<?php echo $bcol=get_option('ccs_background_color')==""?'#0f0011':get_option('ccs_background_color'); ?>"  name="ccs_background_color" id="ccs_background_color" class="my-color-field" data-default-color="#effeff" />
                                         </div>
                                        <div>
                                                <label for="mail" class="ccs_lable_design">Heading text color:</label>
                                                <input type="text" value="<?php echo $heading_text_col=get_option('ccs_texth_color')==""?'#ea353b':get_option('ccs_texth_color'); ?>"  name="ccs_texth_color" id="ccs_texth_color" class="my-color-field" data-default-color="#effeff" />
                                         </div>    

                                        <div>
                                                <label for="mail" class="ccs_lable_design">Text color:</label>
                                                <input type="text" value="<?php echo $text_col=get_option('ccs_text_color')==""?'#bada55':get_option('ccs_text_color'); ?>"  name="ccs_text_color" id="ccs_text_color" class="my-color-field" data-default-color="#effeff" />
                                         </div>  

                                        <div>
                                                <label for="mail" class="ccs_lables">Enable Wall:</label>
                                                <input type="checkbox" value="yes"  name="ccs_enable_wall" <?php if(get_option('ccs_enable_wall')=="yes"){?>checked<?php }?> id="ccs_enable_wall" />
                                         </div>  

                                        <div>
                                                <label for="mail" class="ccs_lables">Wall Width:</label>
                                                <input type="text" value="<?php echo $wall_width=get_option('ccs_wall_width')==""?'40%':get_option('ccs_wall_width'); ?>"  name="ccs_wall_width" id="ccs_enable_wall" /> width in  % like 20%
                                         </div>  
                                        
                                       
                                    </div>
                                    <div id="support" class="ccs-tab-section ccs-design">
                                        <h2>Help</h2>
                                        <p>
                                          Custom coming soon plugin having simple step to configure as describe in the installation instruction and screenshot. If you need any kind
                                         of help to configure or there is any issue you can contact me <a href="mailto:suryabhan.maurya563@gmail.com">suryabhan.maurya563@gmail.com</a>
                                        </p>
                                    </div>
                                 </div>
                                <?php $ccs_editor_settings = array(
                                    'teeny' => true,
                                    'textarea_rows' => 15,
                                    'tabindex' => 1
                                );
                                ?>   
                            
                            <span class="submit-btn"><?php echo get_submit_button('Save Settings','button-primary','submit','','');?></span>
                                    <?php settings_fields('ccs_setting_options'); ?>
                                </form>
                                        </div>
                                    

                        <!-- End  Form -->


                        <?php
             }
endif;
/** add css to admin footer */
if (isset($_GET['page']) && $_GET['page'] == 'custom-coming-soon')
    {
             add_action('admin_footer','init_custom_css_scripts');
    }
if(!function_exists('init_custom_css_scripts')):
            function init_custom_css_scripts()
            {
            wp_register_style( 'ccs_admin_style', plugins_url( 'css/ccs_admin.css',__FILE__ ) );
            wp_enqueue_style( 'ccs_admin_style' );
    }
endif;


/* function for setting link */
function custom_csn_settings_link($links) { 
            $settings_link = '<a href="options-general.php?page=custom-coming-soon">Settings</a>'; 
            array_unshift($links, $settings_link); 
            return $links; 
}
/* function for setting link end here */

$plugin = plugin_basename(__FILE__); 

add_filter("plugin_action_links_$plugin", 'custom_csn_settings_link' );


/** register_deactivation_hook */
/** Delete exits options during deactivation the plugins */
if( function_exists('register_uninstall_hook') ){
       register_uninstall_hook(__FILE__,'custom_csn_uninstall');
    }

/* Delete all Custom coming soon page setting when you uninstall plugin */
if(!function_exists('custom_csn_uninstall')):
    function custom_csn_deactivation()
    {
            delete_option('ccs_status');
            delete_option('ccs_title');	
            delete_option('ccs_heading');	
            delete_option('ccs_logo');	
            delete_option('ccs_message');
            delete_option('ccs_background_color');
            delete_option('ccs_texth_color');
            delete_option('ccs_text_color');
            delete_option('ccs_enable_wall');
            delete_option('ccs_wall_width');
   }
endif;

/*Function that check wheather the coming soon or maintanance mode is disable or enable */
if(get_option('ccs_status')=='enabled')
{
    add_action( 'template_redirect', 'custom_csn_template' ); 
    if(!function_exists('custom_csn_template')):
    
        function custom_csn_template()
        {
            get_template_directory();
            require dirname(__FILE__).'/ccs-theme.php';

            exit;
        }
        endif;
        } 
 ?>
