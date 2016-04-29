$(document).ready(function (){
    $('#edit_em_button').prop('disabled', false);
    $('#edit-em-name, #edit-em-job-title').change(validate);
});
function validate() {
    var $input = $('#edit-em-name, #edit-em-job-title'),
        $edit_em_button = $('#edit_em_button');
    var trigger = false;
    $input.each(function() {
        if ($(this).val() == '') {
                trigger = true;
        }
    });
    trigger ? $edit_em_button.prop('disabled', true) : $edit_em_button.prop('disabled', false);
}