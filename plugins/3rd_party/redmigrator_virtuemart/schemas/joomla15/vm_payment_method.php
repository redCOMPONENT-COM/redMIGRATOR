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

class RedMigratorVirtuemartPaymentMethod extends RedMigrator
{
    public function dataHook($rows)
    {
        $this->insertIntoPaymentMethodENGB($rows);

        $arrFields = array('virtuemart_paymentmethod_id', 'virtuemart_vendor_id', 'ordering');

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['payment_method_id']))
            {
                $row['virtuemart_paymentmethod_id'] = $row['payment_method_id'];    
            }
            
            if (isset($row['vendor_id']))
            {
                $row['virtuemart_vendor_id'] = $row['vendor_id'];    
            }
            
            if (isset($row['list_order']))
            {
                $row['virtuemart_ordering'] = $row['list_order'];    
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

    public function insertIntoPaymentMethodENGB($rows)
    {
        $arrFields = array('virtuemart_paymentmethod_id',
                            'payment_name',
                            'slug'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['payment_method_id']))
            {
                $row['virtuemart_paymentmethod_id'] = $row['payment_method_id'];    
            }
            
            if (isset($row['payment_method_name']))
            {
                $row['payment_name'] = $row['payment_method_name'];

                if (isset($row['payment_method_id']))
                {
                    $row['slug'] = JApplication::stringURLSafe($row['payment_method_name'] . '-' . $row['payment_method_id']);        
                }    
            }

            foreach ($row as $key => $value)
            {
                if (!in_array($key, $arrFields))
                {
                    unset($row[$key]);
                }
            }            
        }

        JLoader::import("helpers.virtuemart", JPATH_PLUGINS . "/redmigrator/redmigrator_virtuemart");
        VirtuemartHelper::insertData('#__virtuemart_paymentmethods_en_gb', $rows);
    }
}
?>