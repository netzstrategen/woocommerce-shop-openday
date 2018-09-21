<?php

namespace Netzstrategen\ShopOpenDays;

?>

<div class="tab" id="special_opening_hours">
  <ul id="special_day_listing">
    <li style="display:none;">
      <input type="text" name="oc_special_days[X][date]" placeholder="dd.mm.yyyy" value="" class="datepicker">
      <span><?= __('from', Plugin::L10N) ?></span>
      <select name="oc_special_days[X][from]" style="width: 65px;">
        <?php foreach (Plugin::$hours as $hour) : ?>
          <option value="<?= $hour ?>">
            <?= $hour ?>
          </option>
        <?php endforeach; ?>
      </select>
      <span><?= __('to', Plugin::L10N) ?></span>
      <select name="oc_special_days[X][until]" style="width: 65px;">
        <?php foreach (Plugin::$hours as $hour) : ?>
          <option value="<?= $hour ?>">
            <?= $hour ?>
          </option>
        <?php endforeach; ?>
      </select>
      <input type="text" name="oc_special_days[X][text]" placeholder="<?= __('Link text', Plugin::L10N) ?>" value="">
      <input type="text" name="oc_special_days[X][link]" placeholder="<?= __('http://www.example.netzstrategen.com', Plugin::L10N) ?>" value="">
      <a href="javascript:;" class="remove_parent" style="text-decoration: none;"><span class="dashicons dashicons-no"></span></a>
    </li>
    <?php
    $specialday_count = 0;
    foreach ($ocData['oc_special_days'] as $special_day) : ?>
      <li>
        <input type="text" name="oc_special_days[<?php echo $specialday_count; ?>][date]" placeholder="dd.mm.yyyy" value="<?= $special_day['date'] ?>" class="datepicker">
        <span><?= __('from', Plugin::L10N) ?></span>
        <select name="oc_special_days[<?php echo $specialday_count; ?>][from]" style="width: 65px;">
            <?php foreach ($times as $timeString) : ?>
                <option value="<?= $timeString; ?>" <?= $special_day['from'] === $timeString ? 'selected' : '' ?>>
                    <?php echo $timeString; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <span><?= __('to', Plugin::L10N) ?></span>
        <select name="oc_special_days[<?php echo $specialday_count; ?>][until]" style="width: 65px;">
            <?php foreach ($times as $timeString) : ?>
                <option value="<?= $timeString; ?>" <?= $special_day['until'] === $timeString ? 'selected' : '' ?>>
                    <?php echo $timeString; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="oc_special_days[<?php echo $specialday_count; ?>][text]" placeholder="<?= __('Link text', Plugin::L10N) ?>" value="">
        <input type="text" name="oc_special_days[<?php echo $specialday_count; ?>][link]" placeholder="<?= __('http://www.example.netzstrategen.com', Plugin::L10N) ?>" value="">
        <a href="javascript:;" class="remove_parent" style="text-decoration: none;"><span class="dashicons dashicons-no"></span></a>
      </li>
      <?php $specialday_count++; ?>
    <?php endforeach;?>
  </ul>
  <p>
    <a href="javascript:;" id="duplicate_special_date" class="button-secondary">
      <span class="dashicons dashicons-plus"></span>
      <?= __('Add another special day', Plugin::L10N) ?>
    </a>
  </p>
</div>
