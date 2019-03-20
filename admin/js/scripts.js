$(document).ready(function() {

    var user_href;
    var user_href_splitted;
    var user_id;
    var image_src;
    var image_src_splitted;
    var image_name;
    var photo_id;

    $(".modal_thumbnails").click(function() {

        $("#set_user_image").prop('disabled',false);
        $(this).addClass('selected');

        user_href = $("#user-id").prop('href');
        user_href_splitted = user_href.split("=");
        user_id = user_href_splitted[user_href_splitted.length - 1];

        image_src = $(this).prop('src');
        image_src_splitted = image_src.split("/");
        image_name = image_src_splitted[image_src_splitted.length - 1];

        photo_id = $(this).attr('data');

        $.ajax({

            url: "includes/ajax.php",
            data: {photo_id: photo_id},
            type: "POST",
            success:function(data) {
                if (!data.error) {
                    $("#modal_sidebar").html(data);
                }
                else {
                    alert("Cant load the image data.");
                }
            }
        });

        //alert(photo_id);
    });

    $("#set_user_image").click(function() {
        $.ajax({

            url: "includes/ajax.php",
            data: {image_name: image_name,user_id: user_id},
            type: "POST",
            success:function(data) {
                if (!data.error) {
                    $("#user-image").prop('src',image_src);
                }
                else {
                    alert("Cant save the image");
                }
            }
        });
    });

    $(".delete_links").click(function() {
        return confirm("Are you sure to delete this item?");
    });

});