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

class RedMigratorVirtuemartOrder extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('virtuemart_order_id',
                            'virtuemart_user_id',
                            'virtuemart_vendor_id',
                            'order_number',
                            'order_total',
                            'order_subtotal',
                            'order_tax',
                            'order_shipment',
                            'order_shipment_tax',
                            'coupon_discount',
                            'coupon_code',
                            'order_discount',
                            'order_currency',
                            'order_status',
                            'created_on',
                            'modified_on',
                            'virtuemart_shipmentmethod_id',
                            'customer_note',
                            'ip_address'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['order_id']))
            {
                $row['virtuemart_order_id'] = $row['order_id'];    
            }
            
            if (isset($row['user_id']))
            {
                $row['virtuemart_user_id'] = $row['user_id'];    
            }
            
            if (isset($row['vendor_id']))
            {
                $row['virtuemart_vendor_id'] = $row['vendor_id'];    
            }
            
            if (isset($row['order_shipping']))
            {
                $row['order_shipment'] = $row['order_shipping'];    
            }
            
            if (isset($row['order_shipping_tax']))
            {
                $row['order_shipment_tax'] = $row['order_shipping_tax'];    
            }
            
            if (isset($row['cdate']))
            {
                $row['created_on'] = $row['cdate'];    
            }
            
            if (isset($row['mdate']))
            {
                $row['modified_on'] = $row['mdate'];    
            }
            
            if (isset($row['ship_method_id']))
            {
                $row['virtuemart_shipmentmethod_id'] = $row['ship_method_id'];    
            }
            
            // Remove fields in old table which are not in new talbe
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