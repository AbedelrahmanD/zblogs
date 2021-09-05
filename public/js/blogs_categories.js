$(function () {
    $("#blogsCategoryAdd").click(function (e) {
        e.preventDefault();
        $(".cmAlert").css("display", "none");
        $("#categoryName").parent().removeClass("cmInputContainerError");
        var categoryName = $("#categoryName").val().trim();
        var categoryId = $("#categoryIdEdit").val();
        if (categoryName == "") {
            $("#categoryName").parent().addClass("cmInputContainerError");
            return;
        }

        $(".loadingScreen").fadeIn();

        var formData = new FormData();
        var totalfiles = document.getElementById("files").files.length;
        for (var index = 0; index < totalfiles; index++) {
            formData.append(
                "files[]",
                document.getElementById("files").files[index]
            );
        }

        formData.append("blog_category_id", categoryId);
        formData.append("blog_category_name", categoryName);

        $.ajax({
            type: "post",
            url: "/saveBlogCategory",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
                $("#saveCategoryToast").removeClass("cmToastHide");
                $("#saveCategoryToast").addClass("cmToastShow");
                $(".loadingScreen").fadeOut();
                if (categoryId == 0) $("#categoryName").val("");
            },
        });
    });

    $(".deleteBtn").click(function (e) {
        e.preventDefault();
        var id = $(this).attr("id");
        var idNumber = id.split("_")[1];
        if (!confirm("Are you sure you want to delet this category?")) {
            return;
        }

        $.ajax({
            type: "post",
            url: "/deleteCategory",
            headers: { "content-type": "application/json" },
            data: JSON.stringify({
                blog_category_id: idNumber,
            }),
            success: function (response) {
                $("#singleItemRow_" + idNumber).fadeOut();
            },
        });
    });
});
