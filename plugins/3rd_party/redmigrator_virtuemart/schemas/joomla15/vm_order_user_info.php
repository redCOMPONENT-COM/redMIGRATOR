<?php
/**
 * @package     RedMIGRATOR.Backend
 * @subpackage  Controller
 *
 * @copyright   Copyright (C) 2012 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * 
 *  redMIGRATOR is based on JUpgradePRO made by Matias Aguirre
 */

class RedMigratorVirtuemartOrderUserInfo extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('virtuemart_order_userinfo_id',
                            'virtuemart_order_id',
                            'virtuemart_user_id',
                            'address_type',
                            'address_type_name',
                            'company',
                            'title',
                            'last_name',
                            'first_name',
                            'middle_name',
                            'phone_1',
                            'phone_2',
                            'fax',
                            'address_1',
                            'address_2',
                            'city',
                            'virtuemart_state_id',
                            'virtuemart_country_id',
                            'zip',
                            'email'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['order_info_id']))
            {
                $row['virtuemart_order_userinfo_id'] = $row['order_info_id'];
            }
            
            if (isset($row['order_id']))
            {
                $row['virtuemart_order_id'] = $row['order_id'];    
            }
            
            if (isset($row['user_id']))
            {
                $row['virtuemart_user_id'] = $row['user_id'];    
            }

            JLoader::import("helpers.virtuemart", JPATH_PLUGINS . "/redmigrator/redmigrator_virtuemart");
            
            $stateId = VirtuemartHelper::getStateId($row['state']);

            if ($stateId)
            {
                $row['virtuemart_state_id'] = $stateId;
            }

            $countryId = VirtuemartHelper::getCountryId($row['country']);

            if ($countryId)
            {
                $row['virtuemart_country_id'] = $countryId;
            }                
            
            if (isset($row['user_email']))
            {
                $row['email'] = $row['user_email'];    
            }

            foreach ($row as $key => $value)
            {
                if (!in_array($key, $arrFields))
                {
                    unset($row[$key]);
                }
            }
        }

        return $rows;
    }

    
}
?>