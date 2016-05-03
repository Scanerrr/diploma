$('document').ready(function () {
    $('.user-select').on('change', function () {
        //get user's id
        var userID = $(this).attr('id');
        var roleID = $(this).val();

        $.post('changerole', {"roleID": roleID, "userID": userID}, function (response) {
            console.log(response);
        });
    });
});