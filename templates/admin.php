<?php

namespace Netzstrategen\ShopOpenDays;

?>

<div class="wrap shop-opendays">
  <h2><?= __('Shop Opendays', Plugin::L10N) ?></h2>
  <div class="ui-helper-clearfix">
    <ul class="subsubsub">
      <?php for ($current_shop_id = 1; $current_shop_id <= Plugin::MAX_SHOPS_NUMBER; $current_shop_id++) : ?>
        <li>
          <a href="admin.php?page=oc-toplevel&shop=<?= $current_shop_id ?>" <?= $current_shop_id === $shop_id ? 'class="current"' : '' ?>>
            <?= sprintf(__('Shop %s', Plugin::L10N), $current_shop_id) ?>
          </a>
        </li>
      <?php endfor; ?>
    </ul>
  </div>
  <form enctype="multipart/form-data" method="post" action="">
    <h3 style="display: inline-block;"><?= sprintf(__('Shop %s', Plugin::L10N), $shop_id) ?></h3>
    <p>
      <label><?= __('Shop name:', Plugin::L10N) ?></label>
      <input type="text" name="shopopenday_shopname" placeholder="Shop name" value="<?= (isset($ocData['oc_shopname'])) ? $ocData['oc_shopname'] : '' ?>">
    </p>
    <p>
      <?= __('Shortcode: ', Plugin::L10N) ?>
      <?php if (empty($ocData['oc_shopname'])) : ?>
        <?php __('Please enter a shop name to generate a shortcode.', Plugin::L10N); ?>
      <?php else : ?>
        <?= sprintf(__('[%s] / alle Öffnungszeiten: [%s]', Plugin::L10N), $ocData['oc_shortcode_' . $shop_id], $ocData['oc_shortcode_' . $shop_id] . '_overview'); ?>
      <?php endif; ?>
    </p>
    <?php if (!empty($ocData['oc_shopname'])) : ?>
      <div class="nav-tab-wrapper">
        <a class="nav-tab switchtab nav-tab-active" href="javascript:;" data-target="#general"><?= __('General', Plugin::L10N) ?></a>
        <a class="nav-tab switchtab" href="javascript:;" data-target="#regular_opening_hours"><?= __('Regular opening hours', Plugin::L10N) ?></a>
        <a class="nav-tab switchtab" href="javascript:;" data-target="#special_opening_hours"><?= __('Special opening hours', Plugin::L10N) ?></a>
        <a class="nav-tab switchtab" href="javascript:;" data-target="#public_holidays"><?= __('Public holidays', Plugin::L10N) ?></a>
        <a class="nav-tab switchtab" href="javascript:;" data-target="#cache"><?= __('Cache', Plugin::L10N) ?></a>
        <a class="nav-tab switchtab" href="javascript:;" data-target="#general,#regular_opening_hours,#special_opening_hours,#public_holidays,#cache"><?= __('All settings', Plugin::L10N) ?></a>
      </div>
      <?php Plugin::renderTemplate(['templates/admin-section-general.php'], ['ocData' => $ocData]); ?>
      <?php Plugin::renderTemplate(['templates/admin-section-regular-opening-hours.php'], ['ocData' => $ocData]); ?>
      <?php Plugin::renderTemplate(['templates/admin-section-special-opening-hours.php'], ['ocData' => $ocData]); ?>
      <?php
      //  require_once dirname(__FILE__) . '/admin-section-public-holidays.php';
      //  require_once dirname(__FILE__) . '/admin-section-cache.php';
       ?>
    <?php endif; ?>
    <p class="submit">
      <input type="submit" name="shopopenday_save" id="save-background-options" class="button-primary" value="<?= __('Save all changes', Plugin::L10N); ?>">
    </p>
  </form>
</div>
