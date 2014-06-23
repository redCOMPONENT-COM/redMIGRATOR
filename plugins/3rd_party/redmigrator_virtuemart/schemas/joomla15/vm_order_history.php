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

class RedMigratorVirtuemartOrderhistory extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('virtuemart_order_history_id',
                            'virtuemart_order_id',
                            'order_status_code',
                            'customer_notified',
                            'comments',
                            'created_on'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['order_status_history_id']))
            {
                $row['virtuemart_order_history_id'] = $row['order_status_history_id'];    
            }
            
            if (isset($row['order_id']))
            {
                $row['virtuemart_order_id'] = $row['order_id'];    
            }
            
            if (isset($row['date_added']))
            {
                $row['created_on'] = $row['date_added'];    
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