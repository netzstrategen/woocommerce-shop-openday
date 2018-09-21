<?php

/**
 * @file
 * Contains \Netzstrategen\ShopOpenDays\Plugin.
 */

namespace Netzstrategen\ShopOpenDays;

/**
 *
 */
class Settings {

  public static function createMenuPage() {
    $shop_id = isset($_GET['shop']) ? intval($_GET['shop']) : 1;

    // Save.
    if ($_POST) {
      unset($_POST['oc_special_days']['X']);
      $openClosedArr = [];
      $allowedValues = [];

      $allowedValues[] = 'oc_shopname';
      $allowedValues[] = 'oc_open_text';
      $allowedValues[] = 'oc_open_link';
      $allowedValues[] = 'oc_closed_text';
      $allowedValues[] = 'oc_closed_link';
      $allowedValues[] = 'oc_open_frontend_text';
      $allowedValues[] = 'oc_closed_frontend_text';

      $holidaysFiles  = (isset($_FILES['oc_holidays'])) ? $_FILES['oc_holidays'] : [];
      $manualHolidays = (isset($_POST['oc_holidays_manual'])) ? $_POST['oc_holidays_manual'] : [];
      $holidays = FALSE;

      // Checks if Holiday ical File was uploaded, or additional dates are entered.
      if ((!empty( $holidaysFiles['name'][0])) || ! empty($manualHolidays[0]['date'])) {
        $events = [];
        if (($holidaysFiles && !empty( $holidaysFiles['name'][0]))) {
          $uploads = wp_upload_dir();
          $targetFile = $uploads['path'] . '/' . $holidaysFiles['name'][0];
          move_uploaded_file($holidaysFiles['tmp_name'][0], $targetFile);
          require_once(plugin_dir_path(__FILE__) . 'helpers/icalReader.class.php');
          $ical = new ICal($targetFile);
          $events = $ical->events();
        }
        if (!empty($manualHolidays[0]['date'])) {
          $holiday_addition = array();
          foreach ($manualHolidays as $manual){
            list($day, $month, $year) = explode('.', $manual['date']);
            $holiday_addition[] = [
              'DTSTART' => $year . $month . $day,
              'SUMMARY' => $manual['name'],
            ];
          }
          $events = array_merge($events, $holiday_addition);
        }

        $holidays = [];

        foreach ($events as $holiday) {
          if (strpos($holiday['DTSTART'],'-') === FALSE) {
            $localYear = substr($holiday['DTSTART'], 0, 4);
            $localMonth = substr($holiday['DTSTART'], 4, 2);
            $localDay = substr($holiday['DTSTART'], 6, 2);
            $localDate = $localYear . '-' . $localMonth . '-' . $localDay;
          }
          else {
            $localDate = $holiday['DTSTART'];
          }
          $allowedValues[] = 'oc_holiday_' . $localDate;
          $holidays[$localDate] = $holiday['SUMMARY'];
        }
      }

      // Special Day Handling starts here
      for ($extraDate = 1; $extraDate <= OC_MAX_EXTRA_DATES; $extraDate++) {
        $allowedValues[] = 'oc_special_days';
        $allowedValues[] = 'oc_extratime_from_' . $extraDate;
        $allowedValues[] = 'oc_extratime_until_' . $extraDate;
        $allowedValues[] = 'oc_extra_text_' . $extraDate;
        $allowedValues[] = 'oc_extra_link_' . $extraDate;
      }

      $c = date('Y', current_time('timestamp'));
      for ($y = $c; $y <= $c + 2; $y++) {
        for ($m = 1; $m <= 12; $m++) {
          for ($d = 1; $d <= 31; $d++) {
            $holidayKey = $y . '-' . str_pad($m, 2, 0, STR_PAD_LEFT) . '-' . str_pad($d, 2, 0, STR_PAD_LEFT);
            $allowedValues[] = 'oc_holiday_' . $holidayKey;
          }
        }
      }

      for ($j = 1; $j <= 2; $j++) {
        $allowedValues[] = 'oc_opentimes_from_day_' . $j;
        $allowedValues[] = 'oc_opentimes_from_month_' . $j;
        $allowedValues[] = 'oc_opentimes_until_day_' . $j;
        $allowedValues[] = 'oc_opentimes_until_month_' . $j;

        foreach ($weekdays as $key => $weekday) {
          $allowedValues[] = 'oc_' . $key . '_from_' . $j . '_1';
          $allowedValues[] = 'oc_' . $key . '_until_' . $j . '_1';
          $allowedValues[] = 'oc_' . $key . '_from_' . $j . '_2';
          $allowedValues[] = 'oc_' . $key . '_until_' . $j . '_2';
          $allowedValues[] = 'oc_closed_' . $key . '_' . $j;
        }
      }

      if ($_POST['oc_shopname']) {
        $openClosedArr['oc_shortcode_' . $shopId] = 'oc_' . oc_convertToAscii(remove_accents(strtolower($_POST['oc_shopname'])));
      }
      $allowedValues[] = 'oc_images';
      $allowedValues[] = 'oc_caching';

      foreach ($allowedValues as $allowed) {
        if (isset($_POST[$allowed])) {
          $openClosedArr[$allowed] = $_POST[$allowed];
        }
        else if (substr($allowed, 0, 11) == 'oc_holiday_') {
          if (isset($holidays[substr($allowed, 11, 10)])) {
            $openClosedArr[$allowed] = $holidays[substr($allowed, 11, 10)];
          }
        }
      }

      $openClosedArrFlat = serialize($openClosedArr);
      $ocData = $openClosedArr;

      update_option('oc_shop_' . $shopId, $openClosedArrFlat);
    }
    else {
      $ocDataRaw = get_option('oc_shop_' . $shop_id);
      $ocData = unserialize($ocDataRaw);
    }

    Plugin::renderTemplate(['templates/admin.php'], [
      'shop_id' => $shop_id,
      'ocData' => $ocData,
    ]);
  }

  // function oc_convertToAscii($string) {
  //   $toReturn = $string;
  //   $toReturn = strtolower(iconv("utf-8","ascii//TRANSLIT",str_replace(' ', '', $toReturn)));

  //   $toReturn = str_replace("'",'', $toReturn);
  //   $toReturn = str_replace('"','', $toReturn);
  //   $toReturn = str_replace('^','', $toReturn);
  //   $toReturn = str_replace('°','', $toReturn);
  //   $toReturn = str_replace('´','', $toReturn);
  //   $toReturn = str_replace('`','', $toReturn);
  //   $toReturn = str_replace('-','', $toReturn);
  //   $toReturn = str_replace('_','', $toReturn);
  //   $toReturn = str_replace('/','', $toReturn);
  //   $toReturn = str_replace('\\','', $toReturn);
  //   $toReturn = str_replace('&','', $toReturn);
  //   $toReturn = str_replace('?','', $toReturn);
  //   $toReturn = str_replace('%','', $toReturn);
  //   $toReturn = str_replace('$','', $toReturn);

  //   return $toReturn;
  // }

}
