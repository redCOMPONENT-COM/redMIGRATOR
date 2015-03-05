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

class RedMigratorRedshopMedia extends RedMigrator
{
	public function dataHook($rows)
	{
		// Do some custom post processing on the list.
		foreach ($rows as &$row)
		{
			$row = (array) $row;

			if ($row['media_type'] == "download")
			{
				$arrMediaName = explode("/", $row['media_name']);

				$filename = $arrMediaName[count($arrMediaName) - 1];

				$row['media_name'] = JPATH_ROOT . '/components/com_redshop/assets/download/product/' . $filename;
			}
		}

		return $rows;
	}
}
?>