<?php
defined( 'ABSPATH' ) || exit;
require_once('functions.php');


/*
1. Tworzenie kuponów
2. System rang
3. Ilość punktów przez waluta.
4.
*/

add_action('admin_menu', 'SimpleLoyalty_admin_menu_pages_create');
function SimpleLoyalty_admin_menu_pages_create(){

    //Main page
    add_menu_page(
        'SimpleLoyalty system for Woocommerce',
        'SimpleLoyalty',
        'manage_options',
        'SimpleLoyalty_main',
        'SimpleLoyalty_main_admin_page',
        'dashicons-format-chat',
        56.5
    );

        //Creating Rewards/Coupons Page
        add_submenu_page(
        'SimpleLoyalty_main',
        'Create Rewards',
        'Create Rewards',
        'manage_options',
        'SimpleLoyalty_create_rewards',
        'SimpleLoyalty_create_rewards_page'
    );
}


//Glowny Panel Wtyczki
function SimpleLoyalty_main_admin_page(){
?>
<h2>Hello :D</h2>
<?php
}



function SimpleLoyalty_create_rewards_page(){
?>
<div>To będzie Header wtyczki ;d</div>

<form method="post" action="options.php">
<?php


settings_fields('SimpleLoyalty_Rewards_Group');
$rewards = get_option('SimpleLoyalty_Reward_Name');

    if(!$rewards){
        ?>
        <h3 class="simpleloyalty-heading-xl">Add Your First Reward</h3>
        <input type="text" name="SimpleLoyalty_Reward_Name[]">
        <?php submit_button(); ?>
        <?php
    }else{
        SimpleLoyalty_show_rewards_fields($rewards);
        ?>
        <div class="SimpleLoyalty_New_Reward">
         <h3 class="simpleloyalty-heading-xl">Add New Reward</h3>
        <input type="text" name="SimpleLoyalty_Reward_Name[]">
        </div>
        <?php submit_button(); 
        
    }


 ?>
</form>
<?php
}


//Register fields.
add_action('admin_init', 'SimpleLoyalty_Rewards_Register_Settings');
function SimpleLoyalty_Rewards_Register_Settings(){
    register_setting('SimpleLoyalty_Rewards_Group','SimpleLoyalty_Reward_Name', [
        //sprawdzanie czy field Jest pusty jak tak to go nie rejestrujemy.
       'sanitize_callback' => 'SimpleLoyalty_CheckIfEmpty'
    ]);
}


