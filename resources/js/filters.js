$(function () {
    var $stateSelect = $('#js-state');
    $('#js-type').change(function (e) {
        $stateSelect.find('option').remove();
        var selected = $stateSelect.data('selected');
        var options = [];
        options.push("<option value=''>Any</option>");
        switch ($(this).val()) {
            case 'ec2':
                options.push("<option value='running'>Running</option>");
                options.push("<option value='stopped'>Stopped</option>");
                break;
            case 's3':
                options.push("<option value='available'>Available</option>");
                break;
            default:
                break;
        }
        $stateSelect.prop('disabled', 1 == options.length);
        $stateSelect.html(options.join(''));
        // if ('' != selected) {
            $stateSelect.val(selected);
        // }
    }).change();
});
