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

class RedMigratorJEventsCategory extends RedMigrator
{
    public function dataHook($rows)
    {

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            $cat_params = new stdClass;
            $cat_params->catcolor = $row['color'];
            $cat_params->overlaps = $row['overlaps'];
            $cat_params->admin = $row['admin'];
            $cat_params->image = '';

            $params = json_encode($cat_params);

            $query = $this->_db->getQuery(true);
            $query->clear();
            $query->update("#__categories")
                    ->set("params = '" . $params . "'")
                    ->where("id = " . $row["id"]);

            $this->_db->setQuery($query);
            $this->_db->query();
        }

        return false;
    }
}
?>