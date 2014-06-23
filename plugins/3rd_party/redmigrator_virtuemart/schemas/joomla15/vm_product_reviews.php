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

class RedMigratorVirtuemartProductReview extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('virtuemart_rating_reiview_id',
                            'virtuemart_product_id',
                            'comment',
                            'review_ok',
                            'review_rates',
                            'published'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['review_id']))
            {
                $row['virtuemart_rating_review_id'] = $row['review_id'];    
            }
            
            if (isset($row['product_id']))
            {
                $row['virtuemart_product_id'] = $row['product_id'];    
            }
            
            if (isset($row['published']))
            {
                if ($row['published'] == 'Y')
                {
                    $row['published'] = 1;
                }
                else
                {
                    $row['published'] = 0;
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
}
?>