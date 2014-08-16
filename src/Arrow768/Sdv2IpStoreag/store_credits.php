<?php

namespace Arrow768\Sdv2IpStoreag;

/**
 * SDv2 Items Provider for Alongubs Store Plugin
 * 
 * Assigns Store Credits to Users of Alongubkins Store Plugin
 * 
 *  @package    SDv2IP-Paypal
 *  @author     Werner Maisl
 *  @copyright  (c) 2013-2014 - Werner Maisl
 */

class store_credits
{
    
    function add_item($sd_user,$sd_user_infos,$sd_item_handler_params)
    {
        \Log::info("Store Items Provider - Store Credits called");
        \Log::info("User Mail:".$sd_user->email);
        \Log::info("Credits:".$sd_item_handler_params->credits);
        
        $steamid = "";
        foreach($sd_user_infos as $sd_user_info)
        {
            \Log::info("User Info Type:".$sd_user_info->type);
            \Log::info("User Info Value:".$sd_user_info->value);
        }
        
        
    }
    
    function remove_item($sd_user,$sd_user_infos,$sd_item_handler_params)
    {
        
    }
    
}