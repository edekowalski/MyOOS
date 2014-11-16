<?php
/* ----------------------------------------------------------------------
   $Id: function_output.php,v 1.3 2008/08/14 10:24:05 r23 Exp $

   MyOOS [Shopsystem]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2014 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: html_output.php,v 1.49 2003/02/11 01:31:02 hpdl
         html_output.php 1498 2007-03-29 14:04:50Z hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

 /**
  * html output
  *
  * @link http://www.oos-shop.de/
  * @package html output
  * @version $Revision: 1.3 $ - changed by $Author: r23 $ on $Date: 2008/08/14 10:24:05 $
  */

  /** ensure this file is being included by a parent file */
  defined( 'OOS_VALID_MOD' ) or die( 'Direct Access to this location is not allowed.' );

 /**
  * The HTML href link wrapper function
  *
  * @param $modul
  * @param $page
  * @param $parameters
  * @param $connection
  * @param $add_session_id
  * @param $search_engine_safe
  * @return string
  */
  function oos_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = TRUE, $search_engine_safe = TRUE) {
    global $oEvent, $spider_flag;


    if ($connection == 'NONSSL') {
      $link = OOS_HTTP_SERVER . OOS_SHOP;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == 'true') {
        $link = OOS_HTTPS_SERVER . OOS_SHOP;
      } else {
        $link = OOS_HTTP_SERVER . OOS_SHOP;
      }
    } else {
      die('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><b>Error!</b></font><br /><br /><b>Unable to determine connection method on a link!<br /><br />Known methods: NONSSL SSL</b><br /><br />');
    }

    if (oos_is_not_null($parameters)) {
      $link .= 'index.php?content=' . $page . '&amp;' . oos_output_string($parameters);
    } else {
      $link .= 'index.php?content=' . $page;
    }

    $separator = '&amp;';

    while ( (substr($link, -5) == '&amp;') || (substr($link, -1) == '?') ) {
      if (substr($link, -1) == '?') {
        $link = substr($link, 0, -1);
      } else {
        $link = substr($link, 0, -5);
      }
    }

    if (isset($_SESSION)) {
		// Add the session ID when moving from HTTP and HTTPS servers or when SID is defined
		if ( (ENABLE_SSL == 'true' ) && ($connection == 'SSL') && ($add_session_id == TRUE) ) {
			$_sid = oos_session_name() . '=' . oos_session_id();
		} elseif ( ($add_session_id == TRUE) && (oos_is_not_null(SID)) ) {
			$_sid = SID;
		}

		if ( $spider_flag === FALSE) $_sid = NULL;
	}
	
	
    if ( ($search_engine_safe == TRUE) &&  $oEvent->installed_plugin('sefu') ) {
      $link = str_replace(array('?', '&amp;', '='), '/', $link);

      $separator = '?';

      $pos = strpos ($link, 'action');
      if ($pos === FALSE) {
        $url_rewrite = new url_rewrite;
        $link = $url_rewrite->transform_uri($link);
      }

    }

    if (isset($_sid)) {
      $link .= $separator . oos_output_string($_sid);
    }

    return $link;
  }


 /**
  * The HTML image wrapper function
  *
  * @param $src
  * @param $title
  * @param $width
  * @param $height
  * @param $parameters
  * @return string
  */
  function oos_image($src, $title = null, $width = 0, $height = 0, $parameters = null) {
    if ( (empty($src) || ($src == OOS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
      return FALSE;
    }

    if (!is_numeric($width)) {
      $width = 0;
    }

    if (!is_numeric($height)) {
      $height = 0;
    }

    $image = '<img src="' . oos_output_string($src) . '" border="0" alt="' . oos_output_string($title) . '"';

    if (!empty($title)) {
      $image .= ' title="' . oos_output_string($title) . '"';
    }

    if ($width > 0) {
      $image .= ' width="' . (int)$width . '"';
    }

    if ($height > 0) {
      $image .= ' height="' . (int)$height . '"';
    }

    if (!empty($parameters)) {
      $image .= ' ' . oos_output_string($parameters);
    }

    $image .= ' />';

    return $image;
  }


 /**
  * Output a function button in the selected language
  *
  * @param $image
  * @param $alt
  * @param $parameters
  * @return string
  */
  function oos_image_button($image, $alt = '', $parameters = '') {

    $sTheme = oos_var_prep_for_os($_SESSION['theme']);
    $sLanguage = isset($_SESSION['language']) ? $_SESSION['language'] : DEFAULT_LANGUAGE;

    return oos_image('themes/' . $sTheme . '/images/buttons/' . $sLanguage . '/' . $image, $alt, '', '', $parameters);
  }


  /**
   * The HTML form submit button wrapper function
   * Outputs a button in the selected language
   *
   * @param $image
   * @param $alt
   * @param $parameters
   * @return string
   */
   function oos_image_submit($image, $alt = '', $parameters = '') {

     $sTheme = oos_var_prep_for_os($_SESSION['theme']);
     $sLanguage = isset($_SESSION['language']) ? $_SESSION['language'] : DEFAULT_LANGUAGE;

     return '<input type="image" src="' . 'themes/' . $sTheme . '/images/buttons/' . $sLanguage . '/' . $image .'" alt="'.$alt.'" border="0" '.$parameters.' />';
   }



 /**
  * Output a folder image
  *
  * @param $image
  * @param $alt
  * @param $parameters
  * @return string
  */
  function oos_image_folder($image, $alt = '', $parameters = '') {

     $sTheme = oos_var_prep_for_os($_SESSION['theme']);
     return oos_image('themes/' . $sTheme . '/images/icons/' . $image, $alt, '', '', $parameters);
  }


 /**
  * Output a separator either through whitespace, or with an image
  *
  * @param $height
  * @param $width
  * @param $image
  */
  function oos_black_line($width = '100%', $height = '1', $image = 'black.gif') {
    return oos_image(OOS_IMAGES . $image, '', $width, $height);
  }



 /**
  * Output a form input field
  *
  * @param $name
  * @param $value
  * @param $parameters
  * @param $type
  * @param $reinsert_value
  * @return string
  */
  function oos_draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = TRUE) {

    $field_value = $value;

    $field = '<input type="' . oos_output_string($type) . '" name="' . oos_output_string($name) . '"';

    if ($reinsert_value === TRUE) {
      if (isset($_GET[$name])) {
        $field_value = $_GET[$name];
      } elseif (isset($_POST[$name])) {
        $field_value = $_POST[$name];
      }
    }

    if (strlen(trim($field_value)) > 0) {
      $field .= ' value="' . oos_output_string($field_value) . '"';
    }

    if (!empty($parameters)) {
      $field .= ' ' . $parameters;
    }

    $field .= ' />';


    return $field;
  }



/**
 * Output a selection field - alias function for oos_draw_checkbox_field() and oos_draw_radio_field()
 *
 * @param $name
 * @param $type
 * @param $value
 * @param $checked
 * @param $parameters
 * @return string
 */
function oos_draw_select_field($name, $type, $value = null, $checked = FALSE, $parameters = null)
{

    $selection = '<input type="' . oos_output_string($type) . '" name="' . oos_output_string($name) . '"';

    if (!empty( $value )) $selection .= ' value="' . oos_output_string($value) . '"';

    if ( ($checked === TRUE) || ( isset($GLOBALS[$name]) && is_string($GLOBALS[$name]) && ( ($GLOBALS[$name] == 'on') || (isset($value) && (stripslashes($GLOBALS[$name]) == $value)) ) ) ) {
        $selection .= ' checked="checked"';
    }

    if (!empty( $parameters ) && is_string( $parameters ) ) {
        $selection .= ' ' . $parameters;
    }


    $selection .= ' />';

    return $selection;
}  
  
  

 /**
  * Output a form checkbox field
  *
  * @param $name
  * @param $value
  * @param $checked
  * @param $parameters
  */
  function oos_draw_checkbox_field($name, $value = '', $checked = FALSE, $parameters = '') {
    return oos_draw_select_field($name, 'checkbox', $value, $checked, $parameters);
  }


 /**
  * Output a form radio field
  *
  * @param $name
  * @param $value
  * @param $checked
  * @param $parameters
  */
  function oos_draw_radio_field($name, $value = '', $checked = FALSE, $parameters = '') {
    return oos_draw_select_field($name, 'radio', $value, $checked, $parameters);
  }



 /**
  * Output a form hidden field
  *
  * @param $name
  * @param $value
  * @param $parameters
  */
  function oos_draw_hidden_field($name, $value = '', $parameters = '') {

    if (empty($value)) {
      if (isset($_GET[$name])) {
        $value = $_GET[$name];
      } elseif (isset($_POST[$name])) {
        $value = $_POST[$name];
      }
    }

    $field = '<input type="hidden" name="' . oos_output_string($name) . '"';

    if (!empty($value)) {
      $field .= ' value="' . oos_output_string($value) . '"';
    }

    if (!empty($parameters)) {
      $field .= ' ' . $parameters;
    }

    $field .= ' />';

    return $field;
  }




 /**
  * Hide form elements
  */
  function oos_hide_session_id() {
    if (defined('SID') && oos_is_not_null(SID)) return oos_draw_hidden_field(oos_session_name(), oos_session_id());
  }


 /**
  * Return all GET variables, except those passed as a parameter
  *
  */
  function oos_get_all_as_hidden_field($aExclude = '') {

    if (!is_array($aExclude)) $aExclude = array();

    $sField = '';
    if (is_array($_GET) && (count($_GET) > 0)) {
      reset($_GET);
      while (list($sKey, $sValue) = each($_GET)) {
        if (!empty($sValue)) {
          if ( ($sKey != oos_session_name()) && ($sKey != 'error') && ($sKey != 'p') && ($sKey != 'rewrite') && ($sKey != 'c') && ($sKey != 'm') &&  ($sKey != 'content') && ($sKey != 'index.php') && ($sKey != 'history_back') && (!in_array($sKey, $aExclude)) && ($sKey != 'x') && ($sKey != 'y') ) {
            $sField = '<input type="hidden" name="' . oos_output_string($sKey) . '"';
            $sField .= ' value="' . oos_output_string($sValue) . '" />';
          }
        }
      }
    }

    return $sField;
  }


/**
 * Output a form pull down menu
 *
 * @param $$name
 * @param $values
 * @param $default
 * @param $parameters
 * @param $required
 */
function oos_draw_pull_down_menu($name, $values, $default = null, $parameters = null, $required = FALSE)
{

    $field = '<select name="' . oos_output_string($name) . '"';

    if (!empty( $parameters ) && is_string( $parameters ) ) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && isset($GLOBALS[$name])) $default = $GLOBALS[$name];

    for ($i=0, $n=count($values); $i<$n; $i++) {
        $field .= '<option value="' . oos_output_string($values[$i]['id']) . '"';
        if ($default == $values[$i]['id']) {
            $field .= ' selected="selected"';
        }

        $field .= '>' . oos_output_string($values[$i]['text']) . '</option>';
    }
    $field .= '</select>';

    if ($required == TRUE) $field .= TEXT_FIELD_REQUIRED;

    return $field;
}
