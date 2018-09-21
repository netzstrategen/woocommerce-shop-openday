<?php

namespace Netzstrategen\ShopOpenDays;

?>

<div class="tab active" id="general">
  <table class="form-table">
    <tbody>
      <tr>
        <th><?= __('Link text and link "open":', Plugin::L10N) ?></th>
        <td>
          <fieldset>
            <input class="regular-text" type="text" name="oc_open_text" placeholder="<?= __('"Open" link text', Plugin::L10N) ?>" value="<?= $ocData['oc_open_text']; ?>">
            <input class="regular-text code" type="text" name="oc_open_link" placeholder="<?= __('"Open" link', Plugin::L10N) ?>" value="<?= $ocData['oc_open_link']; ?>">
            <span><?= __('Corresponds to ', Plugin::L10N) . '{LinktextOpen}' ?></span>
          </fieldset>
        </td>
      </tr>
      <tr>
        <th><?= __('Link text and link "closed":', Plugin::L10N) ?></th>
        <td>
          <fieldset>
            <input class="regular-text" type="text" name="oc_closed_text" placeholder="<?= __('"Closed" link text', Plugin::L10N) ?>" value="<?= $ocData['oc_closed_text']; ?>">
            <input class="regular-text code" type="text" name="oc_closed_link" placeholder="<?= __('"Closed" link', Plugin::L10N) ?>" value="<?= $ocData['oc_closed_link']; ?>">
            <span><?= __('Corresponds to ', Plugin::L10N) . '{LinktextClosed}' ?></span>
          </fieldset>
        </td>
      </tr>
      <tr>
        <th><?= __('Frontend text "open":', Plugin::L10N) ?></th>
        <td>
          <fieldset>
            <legend class="screen-reader-text"><span><?= __('Frontend text "open":', Plugin::L10N) ?></span></legend>
            <input class="regular-text" type="text" placeholder="<?= __('Text displayed around the "open" link', Plugin::L10N) ?>" name="oc_open_frontend_text" value="<?= $ocData['oc_open_frontend_text']; ?>">
          </fieldset>
        </td>
      </tr>
      <tr>
        <th><?= __('Frontend text "closed":', Plugin::L10N) ?></th>
        <td>
          <fieldset>
            <legend class="screen-reader-text"><span><?= __('Frontend text "closed":', Plugin::L10N) ?></span></legend>
            <input class="regular-text" type="text" placeholder="<?= __('Text displayed around the "closed" link', Plugin::L10N) ?>" name="oc_closed_frontend_text" id="oc_closed_frontend_text" value="<?= $ocData['oc_closed_frontend_text']; ?>">
          </fieldset>
        </td>
      </tr>
      <tr>
        <th><?= __('Available macros:', Plugin::L10N) ?></th>
        <td>
          <dl>
            <dt class="code">
            <dt class="code">{LinktextOpen}</dt><dd><?= __('Contains the hint link or text when currently open.', Plugin::L10N) ?></dd>
            <dt class="code">{LinktextClosed}</dt><dd><?= __('Contains the hint link or text when currently closed.', Plugin::L10N) ?></dd>
            <dt class="code">{DayNextOpen}</dt><dd><?= __('Returns the next date and day name that is reopened.', Plugin::L10N) ?></dd>
            <dt class="code">{OpenTime}</dt><dd><?= __('Returns the time from which it is reopened.', Plugin::L10N) ?></dd>
            <dt class="code">{CloseTime}</dt><dd><?= __('Returns the time until when it is open today.', Plugin::L10N) ?></dd>
            <dt class="code">{sign}</dt><dd><?= __('Outputs the corresponding "traffic light image" and indicates whether it is currently open or closed.', Plugin::L10N) ?></dd>
          </dl>
        </td>
      </tr>
      <tr>
        <th rowspan="2">Darstellung:<br>
          <span class="small" style="font-weight:normal;">Optimale Größe: 24 x 16 px</span>
          <br>
        </th>
        <td>
          <label  class="upload_form" for="upload_open_image"><strong>Offen</strong><br>
            <?php if (!empty($ocData['oc_images']['open'])) : ?>
              <img src="<?= $ocData['oc_images']['open'] ?>" style="max-width:100px;height:auto;">
              <br>
            <?php endif; ?>
            <input class="regular-text code file" id="upload_open_image" type="text" size="36" name="oc_images[open]" placeholder="http://..." value="<?= (isset($ocData['oc_images']['open'])) ? $ocData['oc_images']['open'] : $default_open ?>">
            <input id="upload_open_image_button" class="button" type="button" value="Upload Image">
          </label>
          <br>
          Default Wert: <code><?php echo $default_image['open']; ?></code>
          <br>
          Wert (neutral): <code><?php echo $default_image['neutral']; ?></code>
      </td>
      </tr>
      <tr>
        <td>
          <label class="upload_form" for="upload_closed_image"><strong>Geschlossen</strong><br>
            <?php
              if(!empty($ocData['oc_images']['closed']))
                echo '<img src="' . $ocData['oc_images']['closed'] . '" style="max-width:100px;height:auto;"><br>';
              ?>
                    <input class="regular-text code file" id="upload_closed_image" type="text"  size="36" name="oc_images[closed]" placeholder="http://..." value="<?php echo ( isset($ocData['oc_images']['closed']) ) ? $ocData['oc_images']['closed'] : $default_close; ?>" />
                    <input id="upload_closed_image_button" class="button" type="button" value="Upload Image" />
                </label>
                <br /> Default Wert: <code><?php echo $default_image['closed']; ?></code>
                <br /> Wert (neutral): <code><?php echo $default_image['neutral']; ?></code>
            </td>
        </tr>
        </tbody>
    </table>
</div>
