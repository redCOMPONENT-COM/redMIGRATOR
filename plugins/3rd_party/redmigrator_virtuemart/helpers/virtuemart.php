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

    public static function getMimeType($filename)
    {
        $mime_types = array(
                            'txt' => 'text/plain',
                            'htm' => 'text/html',
                            'html' => 'text/html',
                            'php' => 'text/html',
                            'css' => 'text/css',
                            'js' => 'application/javascript',
                            'json' => 'application/json',
                            'xml' => 'application/xml',
                            'swf' => 'application/x-shockwave-flash',
                            'flv' => 'video/x-flv',

                            // images
                            'png' => 'image/png',
                            'jpe' => 'image/jpeg',
                            'jpeg' => 'image/jpeg',
                            'jpg' => 'image/jpeg',
                            'gif' => 'image/gif',
                            'bmp' => 'image/bmp',
                            'ico' => 'image/vnd.microsoft.icon',
                            'tiff' => 'image/tiff',
                            'tif' => 'image/tiff',
                            'svg' => 'image/svg+xml',
                            'svgz' => 'image/svg+xml',

                            // archives
                            'zip' => 'application/zip',
                            'rar' => 'application/x-rar-compressed',
                            'exe' => 'application/x-msdownload',
                            'msi' => 'application/x-msdownload',
                            'cab' => 'application/vnd.ms-cab-compressed',

                            // audio/video
                            'mp3' => 'audio/mpeg',
                            'qt' => 'video/quicktime',
                            'mov' => 'video/quicktime',

                            // adobe
                            'pdf' => 'application/pdf',
                            'psd' => 'image/vnd.adobe.photoshop',
                            'ai' => 'application/postscript',
                            'eps' => 'application/postscript',
                            'ps' => 'application/postscript',

                            // ms office
                            'doc' => 'application/msword',
                            'rtf' => 'application/rtf',
                            'xls' => 'application/vnd.ms-excel',
                            'ppt' => 'application/vnd.ms-powerpoint',

                            // open office
                            'odt' => 'application/vnd.oasis.opendocument.text',
                            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
                        );

        $ext = strtolower(array_pop(explode('.', $filename)));

        if (array_key_exists($ext, $mime_types))
        {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open'))
        {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else
        {
            return 'application/octet-stream';
        }
    }
}