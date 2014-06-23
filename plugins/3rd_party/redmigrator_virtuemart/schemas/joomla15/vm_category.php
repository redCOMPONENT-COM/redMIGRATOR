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

class RedMigratorVirtuemartCategory extends RedMigrator
{
    public function dataHook($rows)
    {
        // Migrate data to virtuemart_categories_en_gb table
        $this->insertIntoCategoryENGB($rows);

        // Get next media id and save it to session
        $session = JFactory::getSession();
        $mediaId = $session->get('mediaId', 0, 'redmigrator_virtuemart');

        if ($mediaId == 0)
        {
            JLoader::import("helpers.virtuemart", JPATH_PLUGINS . "/redmigrator/redmigrator_virtuemart");
            $mediaId = VirtuemartHelper::getMediaId();
            $session->set('mediaId', $mediaId, 'redmigrator_virtuemart');
        }
       
        // Migrate data to virtuemart_category_medias table
        $this->insertIntoCategoryMedias($rows);

        // Migrate data to virtuemart_medias table
        $this->insertIntoMedias($rows);

        // Keep fields in new table (2.5.x or 3.x) which have values in old table (1.5.x)
        $arrFields = array('virtuemart_category_id',
                            'virtuemart_vendor_id',
                            'products_per_row',
                            'published',
                            'created_on',
                            'modified_on',
                            'ordering'
                        );

        // Migrate data to virtuemart_categories table
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['category_id']))
            {
                $row['virtuemart_category_id'] = $row['category_id'];
            }

            if (isset($row['vendor_id']))
            {
                $row['virtuemart_vendor_id'] = $row['vendor_id'];
            }

            if (isset($row['category_publish']))
            {
                if ($row['category_publish'] == 'Y')
                {
                    $row['published'] = 1;
                }
                else
                {
                    $row['published'] = 0;
                }
            }
            
            if (isset($row['cdate']))
            {
                $row['created_on'] = $row['cdate'];
            }

            if (isset($row['mdate']))
            {
                $row['modified_on'] = $row['mdate'];
            }

            if (isset($row['list_order']))
            {
                $row['ordering'] = $row['list_order'];
            }

            // Remove fields in old table which are not in new talbe
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

    public function insertIntoCategoryENGB($rows)
    {
        $arrFields = array('virtuemart_category_id',
                            'category_name',
                            'category_description',
                            'slug'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['category_id']))
            {
                $row['virtuemart_category_id'] = $row['category_id'];

                if (isset($row['category_name']))
                {
                    $row['slug'] = JApplication::stringURLSafe($row['category_name'] . '-' . $row['category_id']);
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
        VirtuemartHelper::insertData('#__virtuemart_categories_en_gb', $rows);
    }

    public function insertIntoCategoryMedias($rows)
    {
        $arrFields = array('virtuemart_category_id',
                            'virtuemart_media_id'
                        );

        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['category_id']))
            {
                $row['virtuemart_category_id'] = $row['category_id'];
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
        VirtuemartHelper::insertData('#__virtuemart_category_medias', $rows);
    }

    public function insertIntoMedias($rows)
    {
        JLoader::import('joomla.filesystem.folder');
        JLoader::import('joomla.filesystem.file');
        JLoader::import('helpers.virtuemart', JPATH_PLUGINS . '/redmigrator/redmigrator_virtuemart');

        $arrFields = array('file_title',
                            'file_mimetype',
                            'file_type',
                            'file_url',
                            'file_url_thumb'
                        );

        foreach ($rows as &$row)
        {
            $row = (array) $row;

            $oldMediaDir = JPATH_ADMINISTRATOR . '/components/com_redmigrator/includes/media/joomla15/shop_image/category';

            if (JFolder::exists($oldMediaDir))
            {
                $descFolder = JPATH_SITE . '/images/stories/virtuemart/category';

                if (!JFolder::exists($descFolder))
                {
                    JFolder::create($descFolder);
                }

                if (isset($row['category_full_image']))
                {
                    $row['file_title'] = $row['category_full_image'];

                    $src = $oldMediaDir . '/' . $row['category_full_image'];

                    if (JFile::exists($src))
                    {
                        $row['file_mimetype'] = VirtuemartHelper::getMimeType($src);
                        $row['file_type'] = 'category';
                        $row['file_url'] = 'images/stories/virtuemart/category/' . $row['category_full_image'];
                        
                        $desc = $descFolder . '/' . $row['category_full_image'];
                        JFile::copy($src, $desc);
                    }
                }

                if (isset($row['category_thumb_image']))
                {
                    $srcThumb = $oldMediaDir . '/' . $row['category_thumb_image'];

                    if (JFile::exists($src))
                    {
                        $row['file_url_thumb'] = 'images/stories/virtuemart/category/' . $row['category_thumb_image'];
                        
                        $descThumb = $descFolder . '/' . $row['category_thumb_image'];
                        JFile::copy($src, $desc);
                    }
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