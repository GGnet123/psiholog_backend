$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function () {

    let current_url = window.location.href;
    $('.navigation-accordion>li>a').each(function (index) {

        if ($(this).hasClass('has-ul')) {
            let show_ul = false;
            let ul_block = $(this).parent().find('.hidden-ul');

            //console.log(ul_block, ul_block.html());
            ul_block.find('a').each(function () {
                //console.log($(this));
                if (current_url.indexOf($(this).attr('href')) > -1) {
                    $(this).parent().addClass('active');
                    show_ul = true;
                }
            });

            if (show_ul) {
                $(this).parent().addClass('active');
                ul_block.css("display", "block");
            }

            let ul_child = $(this).parent().find('.hidden-ul');
            if (ul_child.children().length == 0)
                $(this).parent().remove();

        }
        else {
            if (current_url.indexOf($(this).attr('href')) > -1)
                $(this).parent().addClass('active');
            //console.warn(current_url, $(this).attr('href'), current_url.indexOf($(this).attr('href')));

        }
        //console.log($(this).html());
    });

    $('.file-input').fileinput({
        uploadUrl: "http://localhost",
        uploadAsync: true,
        browseLabel: 'Загрузить',
        browseIcon: '<i class="icon-file-plus"></i>',
        removeIcon: '<i class="icon-cross3"></i>',
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>'
        },
        initialCaption: "Не выбрано файлов",
        allowedFileExtensions: ["png", "jpeg", "jpg", "gif"],
        showUpload: false,
        removeCaption: "Удалить",
    });

    if ($('.table-togglable').length)
        $('.table-togglable').footable();

    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });




    $(".need_validate_form").submit(function (e) {
        let res = true;
        $(this).find('.form-control').each(function (index, value) {
            let v = needValidateAttr(this, true);
            if (!v)
                res = false;
        });

        if (!res) {
            $('html, body').animate({ scrollTop: ($(".has-error:first").offset().top - 15) }, 'slow');
            new PNotify({
                title: 'Внимание',
                text: 'Имеются пустые или некорректно заполнены поля.',
                icon: 'icon-blocked',
                type: 'error'
            });

            e.preventDefault();
        }

    });




    $('.need_validate_form').on('change', '.form-control', function () {
        needValidateAttr(this);
    });

    function needValidateAttr(el, submit = false) {
        if ($(el).val() && $(el).attr('type') != 'file' && $(el).attr('type') != 'email')
            $(el).val($(el).val().trim());

        let parent = $(el).parent();

        parent.children('.help-block').remove();
        parent.removeClass('has-error');
        parent.removeClass('has-error');

        let valid = el.checkValidity();
        let message = el.validationMessage;

        if (valid && $(el).attr('type') == 'file' && $(el).data('file_max') && $(el).val()) {
            let file_size = el.files[0].size;

            if (file_size > ($(el).data('file_max') * 1000000)) {
                message = "Ваш файл превышает максимальный разрешенный размер";
                valid = false;
                $(el).val('');
            }
        }

        if (valid && $(el).data('len')) {
            if ($(el).val().length > parseInt($(el).data('len'))) {
                message = "Указанное значение больше " + parseInt($(el).data('len')) + " символам. Вы указали " + $(el).val().length + " символов";
                valid = false;
            }
            else if ($(el).val().length < parseInt($(el).data('len'))) {
                message = "Указанное значение меньше " + parseInt($(el).data('len')) + " символам. Вы указали " + $(el).val().length + " символов";
                valid = false;
            }
        }

        if (!submit && valid && $(el).data('exist_url')) {
            let url = $(el).data('exist_url');
            url = url + $(el).val();
            $.ajax({
                type: 'GET',
                url: url,
                async: false,
            }).then(function (data) {
                if (!data.val) {
                    message = data.message;
                    valid = false;
                }
            });
        }

        if (valid && submit == true && parent.hasClass('has-error')) {


            return false;
        }

        if (valid) {
            parent.addClass('has-success');

            return true;
        }
        else {


            parent.addClass('has-error');
            parent.append('<span class="help-block">' + message + '</span>');

            return false;
        }
    }

    $('.js_check_phone').mask('+7(000)000-00-00', { placeholder: "+7(XXX)XXX-XX-XX" });

    $('.js_check_bin').mask('000000000000', { placeholder: "XXXXXXXXXXXX" });


    $('.summernote_add').summernote({
        height: 200,
        htmlMode: true,
        toolbar: [
            ['style', ['style']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['insert', [ 'ajaximageupload', 'link', 'video', 'table']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['view', [ 'codeview']],
        ],
    });

});
