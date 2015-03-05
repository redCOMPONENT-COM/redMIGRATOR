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

class RedMigratorKunenaAttachment extends RedMigrator
{
    public function dataHook($rows)
    {
        JLoader::import('joomla.filesystem.folder');
        JLoader::import('joomla.filesystem.file');

        $arrFields = array('mesid',
                            'userid',
                            'hash',
                            'size',
                            'folder',
                            'filetype',
                            'filename'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            if (isset($row['mesid']))
            {
                $userId = $this->getUserId($row['mesid']);

                if ($userId)
                {
                    $row['userid'] = $userId;

                    $oldMediaDir = JPATH_ADMINISTRATOR . '/components/com_redmigrator/includes/media/joomla15/fbfiles';

                    if (JFolder::exists($oldMediaDir))
                    {
                        $arrFileLocation = explode('/', $row['filelocation']);
                        $lenght = count($arrFileLocation);

                        $name = $arrFileLocation[$lenght - 1];
                        $type = $arrFileLocation[$lenght - 2];

                        $src = $oldMediaDir . '/' . $type . '/' . $name;

                        if (JFile::exists($src))
                        {
                            $row['hash'] = md5_file($src);
                            $row['size'] = filesize($src);
                            $row['folder'] = 'media/kunena/attachments/' . $userId;
                            $row['filetype'] = $this->getMimeType($src);
                            $row['filename'] = $name;

                            $descFolder = JPATH_SITE . '/' . $row['folder'];

                            if (!JFolder::exists($descFolder))
                            {
                                JFolder::create($descFolder);
                            }

                            $desc = $descFolder . '/' . $name;
                            JFile::copy($src, $desc);
                        }
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

        return $rows;
    }

    public function getUserId($mesId)
    {
        $query = $this->_db->getQuery(true);

        $query->select('userid')
                ->from('#__kunena_messages')
                ->where('id = ' . $mesId);

        $this->_db->setQuery($query);

        $userId = $this->_db->loadResult();

        if ($userId)
        {
            return $userId;
        }

        return 0;
    }

    public function getMimeType($filename)
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
?>