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

class RedMigratorVirtuemartVendor extends RedMigrator
{
    public function dataHook($rows)
    {
        $this->insertIntoVendorENGB($rows);

        $session = JFactory::getSession();
        $mediaId = $session->get('mediaId', 0, 'redmigrator_virtuemart');

        if ($mediaId == 0)
        {
            JLoader::import("helpers.virtuemart", JPATH_PLUGINS . "/redmigrator/redmigrator_virtuemart");
            $mediaId = VirtuemartHelper::getMediaId();
            $session->set('mediaId', $mediaId, 'redmigrator_virtuemart');
        }

        $this->insertIntoVendorMedias($rows);

        $this->insertIntoMedias($rows);

        $arrFields = array('virtuemart_vendor_id',
                            'vendor_name',
                            'vendor_currency',
                            'vendor_accepted_currencies',
                            'vendor_params',
                            'created_on',
                            'modified_on'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            $row['virtuemart_vendor_id'] = $row['vendor_id'];
            $row['virtuemart_created_on'] = $row['cdate'];
            $row['virtuemart_modified_on'] = $row['mdate'];
            $row['vendor_params'] = 'vendor_min_pov="' . $row['vendor_min_pov'] . '"|'
                                    . 'vendor_freeshipment=' . $row['vendor_freeshipping'] . '|'
                                    . 'vendor_address_format="' . $row['vendor_address_format'] . '"|'
                                    . 'vendor_date_format="' . $row['vendor_date_format'] . '"|';

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

    public function insertIntoVendorENGB($rows)
    {
        $arrFields = array('virtuemart_vendor_id',
                            'vendor_store_desc',
                            'vendor_store_name',
                            'vendor_terms_of_service',
                            'vendor_phone',
                            'vendor_url',
                            'slug'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            $row['virtuemart_vendor_id'] = $row['vendor_id'];
            $row['slug'] = JApplication::stringURLSafe($row['vendor_name']);

            foreach ($row as $key => $value)
            {
                if (!in_array($key, $arrFields))
                {
                    unset($row[$key]);
                }
            }            
        }

        JLoader::import("helpers.virtuemart", JPATH_PLUGINS . "/redmigrator/redmigrator_virtuemart");
        VirtuemartHelper::insertData('#__virtuemart_vendors_en_gb', $rows);
    }

    public function insertIntoVendorMedias($rows)
    {
        $arrFields = array('virtuemart_vendor_id',
                            'virtuemart_media_id'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            $row['virtuemart_vendor_id'] = $row['vendor_id'];

            $session = JFactory::getSession();
            $mediaId = $session->get('mediaId', 0, 'redmigrator_virtuemart');
            
            $row['virtuemart_media_id'] = $mediaId;

            $mediaId ++;
            $session->set('mediaId', $mediaId, 'redmigrator_virtuemart');

            foreach ($row as $key => $value)
            {
                if (!in_array($key, $arrFields))
                {
                    unset($row[$key]);
                }
            }            
        }

        JLoader::import("helpers.virtuemart", JPATH_PLUGINS . "/redmigrator/redmigrator_virtuemart");
        VirtuemartHelper::insertData('#__virtuemart_vendor_medias', $rows);
    }

    public function insertIntoMedias($rows)
    {
        $arrFields = array('file_mimetype',
                            'file_type',
                            'file_url',
                            'file_url_thumb',
                            'file_is_product_image'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            $row['file_mimetype'] = 0; // sua sau
            $row['file_type'] = 0; // sua sau
            $row['file_url'] = $row['vendor_full_image'];
            $row['file_url_thumb'] = $row['vendor_thumb_image'];

            foreach ($row as $key => $value)
            {
                if (!in_array($key, $arrFields))
                {
                    unset($row[$key]);
                }
            }            
        }

        JLoader::import("helpers.virtuemart", JPATH_PLUGINS . "/redmigrator/redmigrator_virtuemart");
        VirtuemartHelper::insertData('#__virtuemart_medias', $rows);
    }

    public function afterHook($rows)
    {
        $session = JFactory::getSession();
        $session->set('mediaId', 0, 'redmigrator_virtuemart');

        return parent::afterHook($rows);
    }
}
?>