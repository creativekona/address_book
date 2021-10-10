(function(){
    $('.address-group-select').change(function(){
        var option_name = $(this).find("option:selected").text().replace(/\-/g, '');
        var option_id = $(this).val();
        $('.appendOptions').append('<input type="hidden" name="groups[]" value="' + option_id + '" />');
        $('.appendOptions').append('<span class="group_tags">' + option_name + '</sapn>');
        $(this).find("option[value='" + option_id + "']").prop('disabled', true);
        $(this).val('');
    })
})();