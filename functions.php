<?php

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


                    
                        <div class="SimpleLoyalty_Reward_Settings">
                            <div class="SimpleLoyalty_Reward_Settings_Part">   
                                <label for="simpleloyalty_discount_type">Discount Type</label>
                                <select name="SimpleLoyalty_discount_type[<?php echo esc_html($item); ?>]" id="simpleloyalty_discount_type">
                                <option value="percent">Percentage Discount</option>
                                <option value="fixed_cart">Fixed Cart Discount</option>
                                <option value="fixed_product">Fixed Product Discount</option>
                                </select>
                            </div>


                            <div class="SimpleLoyalty_Reward_Settings_Part">
                                 <label for="simpleloyalty_discount_value">Discount Value</label>
                                 <input name="SimpleLoyalty_discount_value[<?php echo esc_html($item); ?>]" type="text" id="simpleloyalty_discount_value" placeholder="0">
                            </div>


                            <div class="SimpleLoyalty_Reward_Settings_Part">
                                     <label for="simpleloyalty_discount_minimal_order_value">Minimal Order Value</label>
                                 <input name="SimpleLoyalty_discount_minimal_order_value[<?php echo esc_html($item); ?>]" type="text" id="simpleloyalty_discount_minimal_order_value" placeholder="0">
                            </div>


                            <div class="SimpleLoyalty_Reward_Settings_Part">
                                     <label for="simpleloyalty_discount_max_order_value">Maximum Order Value</label>
                                 <input name="SimpleLoyalty_discount_max_order_value[<?php echo esc_html($item); ?>]" type="text" id="simpleloyalty_discount_max_order_value" placeholder="0">
                            </div>

                            <div class="SimpleLoyalty_Reward_Settings_Part">
                                 <label for="simpleloyalty_discount_shipping">Free Shipping</label>
                                 <input name="SimpleLoyalty_discount_shipping[<?php echo esc_html($item); ?>]" type="checkbox" id="simpleloyalty_discount_shipping" placeholder="0">
                            </div>

                            
                        </div>

                        <input type="text" name="SimpleLoyalty_Reward_Name[]" value="<?php echo esc_attr($item); ?>">
                        <!-- Dodaj więcej pól tutaj -->
                    </div>

                </div>
            </li>
        <?php endforeach; ?>
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