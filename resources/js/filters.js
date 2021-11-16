$(function () {
    var $stateSelect = $('#js-state');
    $('#js-type').change(function (e) {
        $stateSelect.find('option').remove();
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
        $stateSelect.html(options.join(''));
    }).change();
});
