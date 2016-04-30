$(document).ready(function () {
    var $input = $('#em-name, #em-job-title'),
        $em_button = $('#em_button');
    $em_button.prop('disabled', true);
    $input.keyup(function () {
        var trigger = false;
        $input.each(function() {
            if ($(this).val() == '') {
                trigger = true;
            }
        });
        trigger ? $em_button.prop('disabled', true) : $em_button.prop('disabled', false);
    });

    $input.change(function() {
        var trigger = false;
        $input.each(function() {
            if (!$(this).val()) {
                trigger = true;
            }
        });
        trigger ? $em_button.prop('disabled', true) : $em_button.prop('disabled', false);
    });
});

    