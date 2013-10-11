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

class RedMigratorComKunenaUser extends RedMigrator
{
    public function dataHook($rows)
    {
        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            $row['icq'] = $row['ICQ'];
            $row['aim'] = $row['AIM'];
            $row['yim'] = $row['YIM'];
            $row['msn'] = $row['MSN'];
            $row['skype'] = $row['SKYPE'];
            $row['gtalk'] = $row['GTALK'];

            // Remove unused fields.
            unset($row['ICQ']);
            unset($row['AIM']);
            unset($row['YIM']);
            unset($row['MSN']);
            unset($row['SKYPE']);
            unset($row['gtalk']);
        }

        return $rows;
    }
}
?>