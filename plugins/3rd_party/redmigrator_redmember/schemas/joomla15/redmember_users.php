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

class RedMigratorRedmemberUser extends RedMigrator
{
    public function dataHook($rows)
    {
        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            $row['user_status'] = $row['deactivestatus'];
            $row['status_change_date'] = $row['deactivedate'];

            unset($row['deactivestatus']);
            unset($row['deactivedate']);
            unset($row['excludeduser']);
            unset($row['excludeddate']);
        }

        return $rows;
    }
}
?>