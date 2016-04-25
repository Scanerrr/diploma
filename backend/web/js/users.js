$('document').ready(function () {
    $('.user-select').on('change', function () {
        //get user's id
        var roleID = $(this).val();

        $.post('changerole', {"roleID": roleID}, function (response) {
            console.log(response);
        });
    });
});