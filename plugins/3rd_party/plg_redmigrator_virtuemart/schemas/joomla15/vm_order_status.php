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

class RedMigratorVirtuemartOrderStatus extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('virtuemart_orderstate_id',
                            'virtuemart_vendor_id',
                            'order_status_code',
                            'order_status_name',
                            'order_status_description',
                            'ordering'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            $row['virtuemart_orderstate_id'] = $row['order_status_id'];
            $row['virtuemart_vendor_id'] = $row['vendor_id'];
            $row['ordering'] = $row['list_order'];
            

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