$().ready(function () {
    profil();
})

function profil() {
    let action = 'profil';
    let id = $('#MyID').val();
    $.ajax({
        url: './config.php',
        method: 'post',
        data: {
            action,
            id
        },
        success: function (data) {
            $('.Show-profil').html(data)
        }
    })
}