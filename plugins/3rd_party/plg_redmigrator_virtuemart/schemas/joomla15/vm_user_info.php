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
        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            $row['virtuemart_userinfo_id'] = $row['user_info_id'];
            $row['virtuemart_user_id'] = $row['user_id'];
            $row['virtuemart_state_id'] = $row['state'];
            $row['virtuemart_country_id'] = $row['country'];
            $row['created_on'] = $row['cdate'];
            $row['modified_on'] = $row['mdate'];

            // Remove unused fields.
            unset($row['user_info_id']);
            unset($row['user_id']);
            unset($row['state']);
            unset($row['country']);
            unset($row['user_email']);
            unset($row['extra_field_1']);
            unset($row['extra_field_2']);
            unset($row['extra_field_3']);
            unset($row['extra_field_4']);
            unset($row['extra_field_5']);
            unset($row['cdate']);
            unset($row['mdate']);
            unset($row['perms']);
            unset($row['bank_account_nr']);
            unset($row['bank_name']);
            unset($row['bank_sort_code']);
            unset($row['bank_iban']);
            unset($row['bank_account_holder']);
            unset($row['bank_account_type']);
        }

        return $rows;
    }
}