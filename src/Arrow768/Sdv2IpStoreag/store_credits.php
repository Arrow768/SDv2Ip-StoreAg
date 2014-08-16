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
    
    function add_item($sd_user_id,$sd_item_id)
    {
        $item = \SDItem::find($sd_item_id);
        if(!$item)
        {
            Log::Error("Could not find item with id: ".$sd_item_id);
            exit();
        }
        
        $user = \Sentinel::findById($sd_user_id);
        if(!$user)
        {
            Log::Error("Could not find user with id:".$sd_user_id);
            exit();
        }
        
        $userinfo_steamid = \SDUserinfo::where('type','steamid')->where('user_id',$sd_user_id)->first();
        if(!$userinfo_steamid)
        {
            Log::Error("Could not find Steamid for User");
            exit();
        }
        
        Log::Debug("Got Required info");
        Log::Debug("Item Name:".$item->name_short);
        Log::Debug("User Mail:".$user->email);
        Log::Debug("SteamID64:".$userinfo_steamid->value);
    }
    
    function remove_item($sd_user_id,$sd_item_id)
    {
        
    }
    
}