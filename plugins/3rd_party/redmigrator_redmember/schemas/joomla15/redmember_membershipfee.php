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

class RedMigratorRedmemberMembershipfee extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('membership_id',
                            'membership_name',
                            'user_group_ids',
                            'period',
                            'price',
                            'published'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['membershipfee_id']))
            {
                $row['membership_id'] = $row['membershipfee_id'];    
            }

            if (isset($row['membershipfee_name']))
            {
                $row['membership_name'] = $row['membershipfee_name'];
            }

            if (isset($row['user_type']))
            {
                $row['user_group_ids'] = $row['user_type'];    
            }

            if (isset($row['membershipfee_period']))
            {
                $row['period'] = $row['membershipfee_period'];    
            }

            if (isset($row['membershipfee_price']))
            {
                $row['price'] = $row['membershipfee_price'];    
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