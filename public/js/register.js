$(document).ready(function () {
    $('#registerForm').submit(function (e) {
        e.preventDefault();

        $('.text-danger').removeClass('show').addClass('hidden');

        var formData = new FormData(this);
        formData.set('phone', $('#phone').cleanVal());

        $.ajax({
            url: '/register',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrfToken
            },
            data: formData,
            processData: false,
            contentType: false
        }).done(function (msg) {
            window.location = '/home';
        }).fail(function (msg) {
            var errors = msg.responseJSON;
            for (var prop in errors) {
                $('#' + prop + '-error').html(errors[prop][0]);
                $('#' + prop + '-error').removeClass('hidden').addClass('show');
            }
        });
    });
});