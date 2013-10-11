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

class RedMigratorComKunenaVersion extends RedMigrator
{
    // Update newest version of Kunena
    protected function afterAllDataHook()
    {
        $row = new stdClass;

        $row->version = '3.0.2';
        $row->versiondate = '2013-08-18';
        $row->installdate = '2013-10-10';
        $row->versionname = 'Nocturne';

        $this->insertData($row);

        return parent::afterAllDataHook();
    }
}
?>