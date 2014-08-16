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
    
    function add_item($sd_user,$sd_user_infos,$sd_item_handler)
    {
        \Log::info("Store Items Provider - Store Credits called");
        \Log::info("User Mail:".$sd_user->email);
        \Log::info("User Params:".print_r($sd_user_infos,true));
        \Log::info("Item Handler:".print_r($sd_item_handler,true));
        
    }
    
    function remove_item($sd_user,$sd_user_infos,$sd_item_handler)
    {
        
    }
    
}