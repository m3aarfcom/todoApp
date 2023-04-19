

$('.js-example-basic-single').select2({
    theme: "classic",
    dropdownParent: $('#show_modal')

});




window.addEventListener('load', function () {
    $(".add-task").validate({
        rules: {
            title: {
                required: true,
                maxlength: 100,
            },
            descrption: {
                required: false,
                maxlength: 300
            },
            due_date: {
                required: true,
                date: true
            },
            priority: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "title is required",
                maxlength: "title cannot be more than 100 characters"
            },
            description: {
                required: "description is required",
            },
            due_date: {
                required: "Due date is required",
                date: "must be date"
            },
            priority: {
                required: "priority is required",
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});