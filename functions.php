<?php

add_action('admin_enqueue_scripts', function() {
    wp_enqueue_media();
});

//pokazywanie fieldów w REWARDS
function SimpleLoyalty_show_rewards_fields($array) {
    ?>
    <ul class="SimpleLoyalty_reward_list">

        <!-- Nagłówek listy -->
        <li class="SimpleLoyalty_accordeon_head SimpleLoyalty_list_header">
            <strong>Name</strong>
            <strong>Type</strong>
            <strong>Value</strong>
            <span class="SimpleLoyalty_accordeon_toggle"></span>
        </li>

        <?php foreach ($array as $item): ?>
               <?php 
               //discount value
               $discount_values = get_option('SimpleLoyalty_discount_value'); 
               $discount_value = isset($discount_values[$item]) ? $discount_values[$item] : '';

               //minimal order value
                $minimal_order_values = get_option('SimpleLoyalty_discount_minimal_order_value'); 
               $minimal_order_value = isset($minimal_order_values[$item]) ? $minimal_order_values[$item] : '';

               //maximum order value
                $max_order_values = get_option('SimpleLoyalty_discount_max_order_value'); 
               $max_order_value = isset($max_order_values[$item]) ? $max_order_values[$item] : '';

                $free_shiping_values = get_option('SimpleLoyalty_discount_shipping'); 
               $is_checked = isset($free_shiping_values[$item]) && $free_shiping_values[$item];


                $discount_types = get_option('SimpleLoyalty_discount_type');
                $selected_value = isset($discount_types[$item]) ? $discount_types[$item] : 'percent';

                $discount_descriptions = get_option('SimpleLoyalty_discount_description');
                $discount_description = isset($discount_descriptions[$item]) ? $discount_descriptions[$item] : 'Best Discount';
                
                ?>




            <li class="SimpleLoyalty_wrap">
                <div class="SimpleLoyalty_container">

                    <!-- Główka akordeonu -->
                    <div class="SimpleLoyalty_accordeon_head">
                        <span class="simpleloyalty-heading-md"><?php echo esc_html($item); ?></span>
                        <span>Percent</span> <!-- Możesz dynamicznie zmieniać -->
                        <span>10</span>     <!-- Również możesz z czasem wypełnić dynamicznie -->
                        <div class="SimpleLoyalty_accordeon_toggle">X</div>
                    </div>

                    <!-- Treść akordeonu -->
                    <div class="SimpleLoyalty_accordeon_body" aria-hidden="true">

                    <span class="simpleloyalty-heading-md">Coupon Settings</span>

                        <div class="SimpleLoyalty_Reward_Settings">
                            <div class="SimpleLoyalty_Reward_Settings_Part">   
                                <label for="simpleloyalty_discount_type">Discount Type</label>
                                <select name="SimpleLoyalty_discount_type[<?php echo esc_attr($item); ?>]" id="simpleloyalty_discount_type">
                                    <option value="percent" <?php selected($selected_value, 'percent'); ?>>Percentage Discount</option>
                                    <option value="fixed_cart" <?php selected($selected_value, 'fixed_cart'); ?>>Fixed Cart Discount</option>
                                    <option value="fixed_product" <?php selected($selected_value, 'fixed_product'); ?>>Fixed Product Discount</option>
                                </select>
                            </div>


                            <div class="SimpleLoyalty_Reward_Settings_Part">
                                 <label for="simpleloyalty_discount_value">Discount Value</label>
                                 <input name="SimpleLoyalty_discount_value[<?php echo esc_html($item); ?>]" type="text" id="simpleloyalty_discount_value" placeholder="0"   value="<?php echo esc_attr($discount_value); ?>">
                            </div>


                            <div class="SimpleLoyalty_Reward_Settings_Part">
                                     <label for="simpleloyalty_discount_minimal_order_value">Minimal Order Value</label>
                                 <input name="SimpleLoyalty_discount_minimal_order_value[<?php echo esc_html($item); ?>]" type="text" id="simpleloyalty_discount_minimal_order_value" placeholder="0" value="<?php echo esc_attr($minimal_order_value) ?>">
                            </div>


                            <div class="SimpleLoyalty_Reward_Settings_Part">
                                     <label for="simpleloyalty_discount_max_order_value">Maximum Order Value</label>
                                 <input name="SimpleLoyalty_discount_max_order_value[<?php echo esc_html($item); ?>]" type="text" id="simpleloyalty_discount_max_order_value" placeholder="0" value="<?php echo esc_attr($max_order_value) ?>">
                            </div>

                            <div class="SimpleLoyalty_Reward_Settings_Part">
                                 <label for="simpleloyalty_discount_shipping">Free Shipping</label>
                                 <input name="SimpleLoyalty_discount_shipping[<?php echo esc_html($item); ?>]" type="checkbox" id="simpleloyalty_discount_shipping" <?php checked($is_checked) ?> >
                            </div>

                            
                        </div>

                        <span class="simpleloyalty-heading-md">Text/View settings</span>

                        <div class="SimpleLoyalty_Reward_Settings">

                        
                        <?php
                        $safe_id = sanitize_title($item);
                        $images = get_option('SimpleLoyalty_discount_image', []);
                        $image_url = isset($images[$item]) ? esc_url($images[$item]) : '';
                        ?>

                        <div class="SimpleLoyalty_Reward_Settings_Part">
                            <label>Picture of coupon</label><br>

                            <img src="<?php echo $image_url; ?>"
                                id="preview_<?php echo esc_attr($safe_id); ?>"
                                style="max-width:150px; <?php echo $image_url ? '' : 'display:none;'; ?>">

                            <input type="hidden"
                                name="SimpleLoyalty_discount_image[<?php echo esc_attr($item); ?>]"
                                id="image_input_<?php echo esc_attr($safe_id); ?>"
                                value="<?php echo esc_url($image_url); ?>">

                            <br>
                            <button type="button"
                                    class="button select-media"
                                    data-target="<?php echo esc_attr($safe_id); ?>">Choose image</button>
                        </div>



                              <div class="SimpleLoyalty_Reward_Settings_Part">
                            <label for="simpleLoyalty_discount_description">Description of coupon</label>
                            <textarea name="SimpleLoyalty_discount_description[<?php echo esc_html($item); ?>]" id="simpleLoyalty_discount_description">
                                <?php echo $discount_description?>
                            </textarea>
                             </div>
                        </div>

                        <input type="text" name="SimpleLoyalty_Reward_Name[]" value="<?php echo esc_attr($item); ?>">
                        <!-- Dodaj więcej pól tutaj -->
                    </div>

                </div>
            </li>
        <?php endforeach; ?>

                        <script>
                            jQuery(document).ready(function($){
                                $('.select-media').on('click', function(e){
                                    e.preventDefault();

                                    const target = $(this).data('target');
                                    const input = $('#image_input_' + target);
                                    const preview = $('#preview_' + target);

                                    const frame = wp.media({
                                        title: 'Wybierz obraz',
                                        button: { text: 'Użyj tego obrazu' },
                                        multiple: false
                                    });

                                    frame.on('select', function() {
                                        const attachment = frame.state().get('selection').first().toJSON();

                                        // Ustawiamy dokładny URL
                                        const imageUrl = attachment.url;

                                        input.val(imageUrl);
                                        preview.attr('src', imageUrl).show();
                                    });

                                    frame.open();
                                });
                            });
            </script>


    </ul>
    <?php
}


//callback sprawdzajacy czy fieldy są empty

function SimpleLoyalty_CheckIfEmpty($array){
    foreach($array as $key=>$item){
        if($item == ''){
             unset($array[$key]);
        }
    }
     return $array;
}



//Enqueing admin scripts and styles

function SimpleLoyalty_enqueue_admin_scripts(){
    wp_enqueue_style(
        'SimpleLoyalty_Admin_Panel',
       plugin_dir_url(__FILE__) . '/assets/css/admin_main.css',
        NULL,
        false  
    );

    wp_enqueue_script(
        'SimpleLoyalty_Admin_Panel_Accordeon',
        plugin_dir_url(__FILE__) . '/assets/js/admin.acordeon.js',
        NULL,
        false,
        true
    );
}




//Adding new Woocommerce acount page
function SimpleLoyalty_Rewards_endpoint() {
    add_rewrite_endpoint( 'rewards-page', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'SimpleLoyalty_Rewards_endpoint' );

function SimpleLoyalty_Rewards_Add_to_Woocommerce_Acount( $items ) {
    $items['rewards-page'] = 'Rewards'; 
    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'SimpleLoyalty_Rewards_Add_to_Woocommerce_Acount' );


function SimpleLoyalty_Rewards_Woocommerce_Acount_Page() {
    $coupons = get_option('SimpleLoyalty_Reward_Name');
    ?>
        <div class="SimpleLoyalty_main_rewards">
            <div class="SimpleLoyalty_rewards">
            <?php foreach($coupons as $coupon): ?>
              <div class="SimpleLoyalty_reward">
                <div class="SimpleLoyalty_reward_head">
                    <img src="" alt="" class="SimpleLoyalty_image">
                </div>
                <div class="SimpleLoyalty_reward_body">
                    <h3 class="SimpleLoyalty_reward_name"><?php echo $coupon ?></h3>
                    <p class="SimpleLoyalty_description"></p>
                    <div class="SimpleLoyalty_get_coupon"></div>
                </div>
              </div>
            <?php endforeach ?>
            </div>
        </div>
    <?php
}

add_action( 'woocommerce_account_rewards-page_endpoint', 'SimpleLoyalty_Rewards_Woocommerce_Acount_Page' );
