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

class RedMigratorVirtuemartShopperVendorXref extends RedMigrator
{
    public function dataHook($rows)
    {

        $this->insertIntoVmuser($rows);

        $arrFields = array('virtuemart_user_id',
                            'virtuemart_shoppergroup_id'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['user_id']))
            {
                $row['virtuemart_user_id'] = $row['user_id'];    
            }

            if (isset($row['shopper_group_id']))
            {
                $row['virtuemart_shoppergroup_id'] = $row['shopper_group_id'];    
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

    public function insertIntoVmuser($rows)
    {
        $arrFields = array('virtuemart_user_id',
                            'virtuemart_vendor_id',
                            'user_is_vendor',
                            'customer_number'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['user_id']))
            {
                $row['virtuemart_user_id'] = $row['user_id'];    
            }

            $row['user_is_vendor'] = 1;

            if (isset($row['vendor_id']))
            {
                $row['virtuemart_vendor_id'] = $row['vendor_id'];    
            }

            foreach ($row as $key => $value)
            {
                if (!in_array($key, $arrFields))
                {
                    unset($row[$key]);
                }
            }

            JLoader::import("helpers.virtuemart", JPATH_PLUGINS . "/redmigrator/redmigrator_virtuemart");
            VirtuemartHelper::insertData('#__virtuemart_vmusers', $rows);
        }
    }
}
?>