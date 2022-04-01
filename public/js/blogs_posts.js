$(function () {
    $("#blogsPostAdd").click(function (e) {
        e.preventDefault();
        var postTitle = $("#postTitle").val().trim();
        var postCategory = $("#postCategory").val().trim();
        var postDesc = $(".ql-editor");

        var postIdEdit = $("#postIdEdit").val().trim();
        var isHorizontal = $("#isHorizontal").is(":checked") ? 1 : 0;

        var err = 0;
        if (postTitle == "") {
            $("#postTitle").parent().addClass("cmInputContainerError");
            err++;
        }

        if (postDesc.text() == "") {
            $(".ql-editor").css("border", "1px solid red");
            err++;
        }
        if (err > 0) {
            document.body.scrollTop = 100; // For Safari
            document.documentElement.scrollTop = 100; // For Chrome, Firefox, IE and Opera
            return;
        }

        $(".loadingScreen").fadeIn();
        var formData = new FormData();

        // Read selected files
        var totalfiles = document.getElementById("files").files.length;
        for (var index = 0; index < totalfiles; index++) {
            formData.append(
                "files[]",
                document.getElementById("files").files[index]
            );
        }

        formData.append("blog_post_id", postIdEdit);
        formData.append("blog_post_title", postTitle);
        formData.append("blog_post_description", postDesc.html());
        formData.append("blog_category_id", postCategory);
        formData.append("blog_post_is_horizontal", isHorizontal);

        $.ajax({
            type: "post",
            url: "/savePost",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response != "saved" && postIdEdit != 0)
                    $(".previewImage").html(
                        "  <img id='postImageId' src='" + response + "' >"
                    );
                document.body.scrollTop = 300; // For Safari
                document.documentElement.scrollTop = 300; // For Chrome, Firefox, IE and Opera
                $("#savePostToast").removeClass("cmToastHide");
                $("#savePostToast").addClass("cmToastShow");
                $(".loadingScreen").fadeOut();

                if (postIdEdit == 0) {
                    $("#postTitle").val("");
                    $(".ql-editor").html("");
                }
            },
        });
    });

    $(".deletePostBtn").click(function (e) {
        e.preventDefault();
        var id = $(this).attr("id");
        var idNumber = id.split("_")[1];
        var idName = id.split("_")[0];

        if (!confirm("Are you sure you want to delet this post?")) {
            return;
        }

        $(".loadingScreen").fadeIn();
        $.ajax({
            type: "post",
            url: "/deletePost",
            data: {
                blog_post_id: idNumber,
            },
            success: function (response) {
                if (idName == "appBlogsPostDelet") {
                    window.location.href = "/my_posts";
                } else {
                    window.location.href = "/admin/blogs_posts_list";
                }
                $("#singleItemRow_" + idNumber).fadeOut();
            },
        });
    });

    $("#uploadFile").click(function (e) {
        e.preventDefault();
        $("#files").trigger("click");
    });
});
