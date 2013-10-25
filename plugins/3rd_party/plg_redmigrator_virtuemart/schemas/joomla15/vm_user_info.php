<?php
/**
 * @package     RedMIGRATOR.Backend
 * @subpackage  Controller
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * 
 *  redMIGRATOR is based on JUpgradePRO made by Matias Aguirre
 */

class RedMigratorVirtuemartUserInfo extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('virtuemart_order_userinfo_id',
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
                            'created_on',
                            'modified_on'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['user_info_id']))
            {
                $row['virtuemart_userinfo_id'] = $row['user_info_id'];    
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

            if (isset($row['cdate']))
            {
                $row['created_on'] = $row['cdate'];    
            }
            
            if (isset($row['mdate']))
            {
                $row['modified_on'] = $row['mdate'];    
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