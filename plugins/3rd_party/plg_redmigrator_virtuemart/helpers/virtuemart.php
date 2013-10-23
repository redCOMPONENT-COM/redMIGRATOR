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
defined('_JEXEC') or die;

/**
 * Virtuemart Helper
 */
class VirtuemartHelper
{
    public static function insertData($table, $rows)
    {
        $db = JFactory::getDbo();

        if (is_array($rows))
        {
            $total = count($rows);

            foreach ($rows as $row)
            {
                if ($row != false)
                {
                    // Convert the array into an object.
                    $row = (object) $row;

                    try
                    {
                        $db->insertObject($table, $row);
                    }
                    catch (Exception $e)
                    {
                        throw new Exception($e->getMessage());
                    }
                }
            }
        }
        elseif (is_object($rows))
        {
            if ($rows != false)
            {
                try
                {
                    $db->insertObject($table, $rows);
                }
                catch (Exception $e)
                {
                    throw new Exception($e->getMessage());
                }
            }
        }
    }

    public static function getMediaId()
    {
        $conf = JFactory::getConfig();
        $db = JFactory::getDbo();
        $database = $conf->get('db');

        $query = "SHOW TABLE STATUS FROM `" . $database . "` WHERE name ='" . $db->getPrefix() . "virtuemart_medias'";

        $db->setQuery($query);
        $row = $db->loadObject();

        return $row->Auto_increment;
    }

    public static function getStateId($stateCode)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select('virtuemart_state_id')
                ->from('#__virtuemart_states')
                ->where('state_2_code = "' . $stateCode . '" OR state_3_code = "' . $stateCode . '"');

        $db->setQuery($query);

        $id = $db->loadResult();

        return $id;
    }

    public static function getCountryId($countryCode)
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        $query->select('virtuemart_country_id')
                ->from('#__virtuemart_countries')
                ->where('country_2_code = "' . $countryCode . '" OR country_3_code = "' . $countryCode . '"');

        $db->setQuery($query);

        $id = $db->loadResult();

        return $id;                
    }
}