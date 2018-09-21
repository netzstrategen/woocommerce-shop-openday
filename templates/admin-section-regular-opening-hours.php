<?php

namespace Netzstrategen\ShopOpenDays;

?>

<div class="tab" id ="regular_opening_hours">
  <h3 class="nav-tab-wrapper">
    <a class="nav-tab switchtab nav-tab-active" href="javascript:;" data-target="#opening_hours_1"><?= __('1. Opening hours (e.g. Summer)', Plugin::L10N) ?></a>
    <a class="nav-tab switchtab" href="javascript:;" data-target="#opening_hours_2"><?= __('2. Opening hours (e.g. Winter)', Plugin::L10N) ?></a>
    <a class="nav-tab switchtab" href="javascript:;" data-target="#opening_hours_1,#opening_hours_2"><?= __('All opening hours', Plugin::L10N) ?></a>
  </h3>
  <?php for ($current_tab = 1; $current_tab <= 2; $current_tab++) : ?>
    <div id="opening_hours_<?= $current_tab; ?>" class="tab <?php $current_tab === 1 ? 'active' : '' ?>">
      <strong><?= sprintf('%s. Opening hours valid from', $current_tab) ?></strong>
      <select name="oc_opentimes_from_day_<?php echo $current_tab; ?>">
        <?php for ($current_day = 1; $current_day <= Plugin::MAX_DAYS; $current_day++) : ?>
          <option name="oc_day" value="<?= $current_day; ?>" <?= $ocData['oc_opentimes_from_day_' . $current_tab] === $current_day ? 'selected' : '' ?>>
            <?= $current_day ?>
          </option>
        <?php endfor; ?>
      </select>
      <select name="oc_opentimes_from_month_<?= $current_tab; ?>">
        <?php for ($current_month = 1; $current_month <= Plugin::MONTHS; $current_month++) : ?>
          <option name="oc_month" value="<?= $current_month; ?>" <?= $ocData['oc_opentimes_from_month_' . $current_tab] === $current_month ? 'selected' : '' ?>>
            <?= $current_month; ?>
          </option>
        <?php endfor; ?>
      </select>
      <span><?= __('to', Plugin::L10N) ?></span>
      <select name="oc_opentimes_from_day_<?php echo $current_tab; ?>">
        <?php for ($current_day = 1; $current_day <= Plugin::MAX_DAYS; $current_day++) : ?>
          <option name="oc_day" value="<?= $current_day; ?>" <?= $ocData['oc_opentimes_until_day_' . $current_tab] === $current_day ? 'selected' : '' ?>>
            <?= $current_day ?>
          </option>
        <?php endfor; ?>
      </select>
      <select name="oc_opentimes_from_month_<?= $current_tab; ?>">
        <?php for ($current_month = 1; $current_month <= Plugin::MONTHS; $current_month++) : ?>
          <option name="oc_month" value="<?= $current_month; ?>" <?= $ocData['oc_opentimes_until_month_' . $current_tab] === $current_month ? 'selected' : '' ?>>
            <?= $current_month ?>
          </option>
        <?php endfor; ?>
      </select>
      <ul>
        <?php foreach (Plugin::weekdays as $key => $weekday) : ?>
          <li>
            <strong style="display:inline-block; width: 100px;"><?= $weekday ?></strong>
            <select name="oc_<?php echo $key; ?>_from_<?= $current_tab; ?>_1" style="width: 65px;">
              <?php foreach (Plugin::$hours as $hour) : ?>
                <option value="<?= $hour; ?>" <?= $ocData['oc_' . $key . '_from_' . $current_tab . '_1'] === $hour ? 'selected' : '' ?>>
                  <?= $hour ?>
                </option>
              <?php endforeach; ?>
            </select>
            <span><?= __('to', Plugin::L10N) ?></span>
            <select name="oc_<?php echo $key; ?>_from_<?= $current_tab; ?>_1" style="width: 65px;">
              <?php foreach (Plugin::$hours as $hour) : ?>
                <option value="<?= $hour; ?>" <?= $ocData['oc_' . $key . '_until_' . $current_tab . '_1'] === $hour ? 'selected' : '' ?>>
                  <?= $hour ?>
                </option>
              <?php endforeach; ?>
            </select>
            <span><?= __('and', Plugin::L10N) ?></span>
            <select name="oc_<?php echo $key; ?>_from_<?= $current_tab; ?>_2" style="width: 65px;">
              <?php foreach (Plugin::$hours as $hour) : ?>
                <option value="<?= $hour; ?>" <?= $ocData['oc_' . $key . '_from_' . $current_tab . '_2'] === $hour ? 'selected' : '' ?>>
                  <?= $hour ?>
                </option>
              <?php endforeach; ?>
            </select>
            <span><?= __('to', Plugin::L10N) ?></span>
            <select name="oc_<?php echo $key; ?>_from_<?= $current_tab; ?>_2" style="width: 65px;">
              <?php foreach (Plugin::$hours as $hour) : ?>
                <option value="<?= $hour; ?>" <?= $ocData['oc_' . $key . '_until_' . $current_tab . '_2'] === $hour ? 'selected' : '' ?>>
                  <?= $hour ?>
                </option>
              <?php endforeach; ?>
            </select>
            <input name="oc_closed_<?= $key; ?>_<?= $current_tab; ?>" value="closed" type="checkbox" <?= $ocData['oc_closed_' . $key . '_' . $current_tab] ? 'checked' : '' ?>>
            <label>&nbsp;<?= __('geschlossen', Plugin::L10N) ?></label>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endfor; ?>
</div>
