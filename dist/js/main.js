/* global jQuery wp */

jQuery(document).ready(function ($) {
  function initdatepicker () {
    $('.datepicker').datepicker({
      dateFormat: 'dd.mm.yy',
      showWeek: true,
      changeMonth: true,
      changeYear: true,
      firstDay: 1,
      minDate: 0,
      prevText: '&#x3c;zurück',
      prevStatus: '',
      prevJumpText: '&#x3c;&#x3c;',
      prevJumpStatus: '',
      nextText: 'Vor&#x3e;',
      nextStatus: '',
      nextJumpText: '&#x3e;&#x3e;',
      nextJumpStatus: '',
      currentText: 'heute',
      currentStatus: '',
      todayText: 'heute',
      todayStatus: '',
      clearText: '-',
      clearStatus: '',
      closeText: 'schließen',
      closeStatus: '',
      monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
      monthNamesShort: ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', ' Sep', 'Okt', 'Nov', 'Dez'],
      dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
      dayNamesShort: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
      dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
      weekHeader: 'W',
      yearSuffix: '',
      showMonthAfterYear: false
    });
  }

  var holidayInputContainer = $('#manual_holidayInputs');
  var holidayInput = holidayInputContainer.html();
  var specialDayContainer = $('#special_day_listing');
  var specialDayInput = specialDayContainer.find('li:first-child').html();

  initdatepicker();

  var manualHolidayCounter = 1;
  var wrap = $('.wrap.shop-opendays');

  wrap.on('click', '#duplicate_manual_holiday', function () {
    holidayInputContainer.append(holidayInput.replace(/\[0\]/g, '[' + manualHolidayCounter + ']'));
    manualHolidayCounter++;
    initdatepicker();
  });

  var specialDateCounter = specialDayContainer.find('li').length;
  wrap.on('click', '#duplicate_special_date', function () {
    specialDayContainer.append('<li>' + specialDayInput.replace(/\[X\]/g, '[' + specialDateCounter + ']') + '</li>');
    specialDateCounter++;
    initdatepicker();
  });

  wrap.on('click', '.remove_row', function () {
    $(this).parent().parent().remove();
  });

  wrap.on('click', '.remove_parent', function () {
    $(this).parent().remove();
  });

  wrap.on('click', '.switchtab', function () {
    // Changes active state on tab-buttons.
    $(this).parent().find('.switchtab').removeClass('nav-tab-active');
    $(this).addClass('nav-tab-active');

    // Changes active state on tabs itself.
    $(this).parent().parent().children('.tab').removeClass('active');
    $(this).parent().parent().children($(this).data('target')).addClass('active');
    return false;
  });

  var customUploader;
  var self;

  $('.upload_form').on('click', '.button', function (e) {
    self = $(this);
    e.preventDefault();

    // If the uploader object has already been created, reopen the dialog.
    if (customUploader) {
      customUploader.open();
      return;
    }

    // Extend the wp.media object.
    customUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
        text: 'Choose Image'
      },
      multiple: false
    });

    // When a file is selected, grab the URL and set it as the text field's value.
    customUploader.on('select', function () {
      var attachment = customUploader.state().get('selection').first().toJSON();

      self.parent().find('.file').val(attachment.url);
      self = '';
    });

    // Open the uploader dialog.
    customUploader.open();
  });

  var caching = $('#caching');
  caching.on('click', '#cache_live', function () {
    $('.dashicons.live').toggleClass('dashicons-yes').toggleClass('dashicons-no').toggleClass('unsaved');
  });
  caching.on('click', '#cache_longterm', function () {
    $('.dashicons.longterm').toggleClass('dashicons-yes').toggleClass('dashicons-no').toggleClass('unsaved');
  });
});
