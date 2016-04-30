$(document).ready(function (){
    var $input = $('#dp-name, #dp-office-number'),
        $dp_button = $('#dp_button');
 
    $dp_button.prop('disabled', true);
    $input.keyup(function() {
        var trigger = false;
        $input.each(function() {
            if (!$(this).val()) {
                trigger = true;
            }
        });
        trigger ? $dp_button.prop('disabled', true) : $dp_button.prop('disabled', false);
    });
  
    $input.change(function() {
        var trigger = false;
        $input.each(function() {
            if (!$(this).val()) {
                trigger = true;
            }
        });
        trigger ? $dp_button.prop('disabled', true) : $dp_button.prop('disabled', false);
    });
});
