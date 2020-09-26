function logout() {
    $('#logout').submit();
}

$(document).ready(function() {
    $('.dataTable').DataTable({
        "pageLength": 25
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('.select2').select2();
});

function imageView(input, img_id = 'image_view', img_err = 'image_error') {
    var input_file = input.files[0];
    if (input.files && input_file) {
        var fsize = input_file.size;
        var fname = input_file.name;
        var fextension = fname.split('.').pop();
        var validExtensions = ["jpg", "jpeg", "png", "bmp", "gif"];
        var reader = new FileReader();

        if ($.inArray(fextension, validExtensions) == -1) {
            $('#' + img_err).css('display', 'block').html('Only photo is allowed');
            input.value = "";
            $('#' + img_id).css('display', 'block').attr('src', '');
            return false;
        }

        if (fsize > 2097152) {
            $('#' + img_err).css('display', 'block').html('Photo should be less than 2mb');
            input.value = "";
            $('#' + img_id).css('display', 'block').attr('src', '');
            return false;
        }

        $('#' + img_err).css('display', 'none').html('');

        reader.onload = function (e) {
            $('#' + img_id).css('display', 'block').attr('src', e.target.result);
        }

        reader.readAsDataURL(input_file);

        return true;
    } else {
        $('#' + img_id).css('display', 'none').attr('src', '');
    }
}

function multipleImageView(input, img_holder = 'image_block', photo_error = 'image_error', clear_img = '') {
    console.warn(input);
    var countFiles = input.files.length;
    var imgPath = input.value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    var image_holder = $("#" + img_holder);
    $("#" + img_holder).html("");

    for (var i = 0; i < countFiles; i++) {
        var j = 0;
        var file = input.files[i];
        var fsize = file.size;
        var extn = file.name.split('.').pop();
        var media_photo = input.files[i];
        var img;

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {

            if (fsize > 2097152) {
                $('#' + photo_error).css('display', 'block').html('Each image should be less than 2mb.');
                $('#' + input.id).val("");
                $("#" + img_holder).html("");

                return false;
            }

            var reader = new FileReader();
            reader.fileName = file.name;
            reader.onload = function (e) {
                $("<div class='create_up_img upload-thumbnail'><img src='" + e.target.result + "' class='mul-image' /></div>").appendTo(image_holder);
            }

            if (clear_img) {
                $('#' + clear_img).show();
            }

            reader.readAsDataURL(input.files[i]);
        } else {
            $('#' + photo_error).css('display', 'block').html('Please select only images.');
        }
    }
}

