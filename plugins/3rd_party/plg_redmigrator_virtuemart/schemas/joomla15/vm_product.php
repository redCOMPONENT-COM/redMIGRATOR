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

class RedMigratorVirtuemartProduct extends RedMigrator
{
    public function dataHook($rows)
    {
        $this->insertIntoProductENGB($rows);

        $session = JFactory::getSession();
        $mediaId = $session->get('mediaId', 0, 'redmigrator_virtuemart');

        if ($mediaId == null || $mediaId == 0)
        {
            JLoader::import("helpers.virtuemart", JPATH_PLUGINS . "/redmigrator/redmigrator_virtuemart");
            $mediaId = VirtuemartHelper::getMediaId();
            $session->set('mediaId', $mediaId, 'redmigrator_virtuemart');
        }

        $this->insertIntoProductMedias($rows);

        $this->insertIntoMedias($rows);

        $arrFields = array('virtuemart_product_id',
                            'virtuemart_vendor_id',
                            'product_parent_id',
                            'product_sku',
                            'published',
                            'product_weight',
                            'product_weight_uom',
                            'product_length',
                            'product_width',
                            'product_height',
                            'product_lwh_uom',
                            'product_url',
                            'product_in_stock',
                            'product_available_date',
                            'product_availability',
                            'product_special',
                            'created_on',
                            'modified_on',
                            'published',
                            'pordering',
                            'slug'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['product_id']))
            {
                $row['virtuemart_product_id'] = $row['product_id'];
            }
            
            if (isset($row['vendor_id']))
            {
                $row['virtuemart_vendor_id'] = $row['vendor_id'];    
            }
            
            if (isset($row['product_publish']))
            {
                if ($row['product_publish'] == 'Y')
                {
                    $row['published'] = 1;
                }
                else
                {
                    $row['published'] = 0;
                }    
            }
                 
            if (isset($row['product_order_levels']))
            {
                $row['pordering'] = $row['product_order_levels'];    
            }
            
            if (isset($row['cdate']))
            {
                $row['created_on'] = $row['cdate'];    
            }
            
            if (isset($row['mdate']))
            {
                $row['modified_on'] = $row['mdate'];    
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

    public function insertIntoProductENGB($rows)
    {
        $arrFields = array('virtuemart_product_id',
                            'product_s_desc',
                            'product_desc',
                            'product_name',
                            'slug'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['product_id']))
            {
                $row['virtuemart_product_id'] = $row['product_id'];    
            
                if (isset($row['product_id']))
                {
                    $row['slug'] = JApplication::stringURLSafe($row['product_name'] . '-' . $row['product_id']);        
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
        VirtuemartHelper::insertData('#__virtuemart_products_en_gb', $rows);
    }

    public function insertIntoProductMedias($rows)
    {
        $arrFields = array('virtuemart_product_id',
                            'virtuemart_media_id'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['product_id']))
            {
                $row['virtuemart_product_id'] = $row['product_id'];    
            }
            
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
        VirtuemartHelper::insertData('#__virtuemart_product_medias', $rows);
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

            if (isset($row['product_full_image']))
            {
                $row['file_url'] = $row['product_full_image'];    
            }
            
            if (isset($row['product_thumb_image']))
            {
                $row['file_url_thumb'] = $row['product_thumb_image'];    
            }
                        
            $row['file_is_product_image'] = 1;

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