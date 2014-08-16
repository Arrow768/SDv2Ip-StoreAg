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

    function add_item($sd_user, $sd_user_infos, $sd_item_handler_params)
    {
        \Log::info("Store Items Provider - Store Credits called");
        \Log::info("User Mail:" . $sd_user->email);
        \Log::info("Credits:" . $sd_item_handler_params->credits);

        $steamid64 = "";
        foreach ($sd_user_infos as $sd_user_info)
        {
            if ($sd_user_info->type == "steamid")
            {
                $steamid64 = $sd_user_info->value;
            }

            \Log::info("User Info Type:" . $sd_user_info->type);
            \Log::info("User Info Value:" . $sd_user_info->value);
        }
        \Log::info("Steamid64:" . $steamid64);
        
        $steamid = $this->community_to_steamid($steamid64);
        \Log::info("Steamid:". $steamid);
        
        $store_auth = $this->steamid_to_auth($steamid);
        \Log::info("Auth:". $store_auth);
        
        $store_user = \DB::Connection('ag_store')->table('store_users')->where('auth',$store_auth)->first();
        \Log::info('Store User Name: '.$store_user->name);
        \Log::info('Store User Credits: '.$store_user->credits);
    }

    function remove_item($sd_user, $sd_user_infos, $sd_user_params)
    {
        
    }

    private function steamid_to_auth($steamid)
    {
        //from https://forums.alliedmods.net/showpost.php?p=1890083&postcount=234
        $toks = explode(":", $steamid);
        $odd = (int) $toks[1];
        $halfAID = (int) $toks[2];

        return ($halfAID * 2) + $odd;
    }

    private function auth_to_steamid($authid)
    {
        $steam = array();
        $steam[0] = "STEAM_0";

        if ($authid % 2 == 0)
        {
            $steam[1] = 0;
        }
        else
        {
            $steam[1] = 1;
            $authid -= 1;
        }
        $steam[2] = $authid / 2;
        return $steam[0] . ":" . $steam[1] . ":" . $steam[2];
    }

    private function steamid_to_community($steamid)
    {
        $parts = explode(':', str_replace('STEAM_', '', $steamid));

        $result = bcadd(bcadd('76561197960265728', $parts['1']), bcmul($parts['2'], '2'));
        $remove = strpos($result, ".");
        if ($remove != false)
        {
            $result = substr($result, 0, strpos($result, "."));
        }
        return $result;
    }

    private function community_to_steamid($community)
    {
        if (substr($community, -1) % 2 == 0)
            $server = 0;
        else
            $server = 1;
        $auth = bcsub($community, '76561197960265728');
        if (bccomp($auth, '0') != 1)
        {
            return false;
        }
        $auth = bcsub($auth, $server);
        $auth = bcdiv($auth, 2);
        return 'STEAM_0:' . $server . ':' . $auth;
    }

}
