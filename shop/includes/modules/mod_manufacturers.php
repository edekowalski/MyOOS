<?php
/* ----------------------------------------------------------------------
   $Id: mod_manufacturers.php,v 1.2 2008/08/29 16:53:12 r23 Exp $

   OOS [OSIS Online Shop]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2008 by the OOS Development Team.
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

    define('MAX_DISPLAY_MANUFACTURER', 8);
    define('MIN_DISPLAY_MANUFACTURER', 1);

    if (!$oEvent->installed_plugin('manufacturers')) return false;

    if (!is_numeric(MAX_DISPLAY_MANUFACTURER)) return false;

    if (!isset($_GET['manufacturers_id'])) {
      $manufacturerstable = $oostable['manufacturers'];
      $manufacturers_infotable = $oostable['manufacturers_info'];
      $query = "SELECT m.manufacturers_id, m.manufacturers_name, m.manufacturers_image, mi.manufacturers_url
                FROM $manufacturerstable m,
                     $manufacturers_infotable mi
                WHERE m.manufacturers_id = mi.manufacturers_id
                  AND mi.manufacturers_languages_id = '" .  intval($nLanguageID) . "'
                ORDER BY m.manufacturers_name";
    $manufacturer_result = $dbconn->SelectLimit($query, MAX_DISPLAY_MANUFACTURER);

    $nManufacturer = $manufacturer_result->RecordCount();
    if ($nManufacturer >=  MIN_DISPLAY_MANUFACTURER) {
      $oSmarty->assign('mod_manufacturer_array', $manufacturer_result->GetArray());
    }
  }

?>