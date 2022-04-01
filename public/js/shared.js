$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$(function () {
    $("#expandEditer").click(function (e) {
        e.preventDefault();
        $(this).hide();
        $(".ql-toolbar.ql-snow, #editor ").toggleClass("maxWidth95");
        $("#compressEditer").show();
    });

    $("#compressEditer").click(function (e) {
        e.preventDefault();
        $(this).hide();
        $(".ql-toolbar.ql-snow, #editor ").toggleClass("maxWidth95");
        $("#expandEditer").show();
    });
    $(".loadingScreen").fadeOut();
    setStyle();
    $(window).resize(function () {
        setStyle();
    });
    $(".menuToggle").click(function (e) {
        e.preventDefault();
        $(".menuTitlesContainer").toggleClass("menuTitlesContainerHide");
        $(".menuTitlesContainer").toggleClass("menuTitlesContainerShow");
    });

    $(".menuToggleForAdmin").click(function (e) {
        e.preventDefault();
        $(".dashboardNav").toggleClass("dashboardNavHide");
    });
    $(".cmToast").click(function (e) {
        e.preventDefault();
        $(this).toggleClass("cmToastHide");
        $(this).toggleClass("cmToastShow");
    });

    $("#files").change(function (e) {
        e.preventDefault();

        var fileName = document.getElementById("files").files[0].name;
        var fileNameArray = fileName.split(".");
        var fileExention =
            fileNameArray[fileNameArray.length - 1].toLowerCase();
        if (
            fileExention != "jpg" &&
            fileExention != "png" &&
            fileExention != "jpeg"
        ) {
            alert("Image must be jpg, jpeg or png");
            document.getElementById("files").value = null;
            alert(document.getElementById("files").files.length);
            fileName = "";
        }
        $("#fileNamePreview").text(fileName);
    });

    $(".goTop").click(function (e) {
        e.preventDefault();
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    });
});

function setStyle() {
    var menuHeight = $(".menuContainer").height();
    var footerHeight = $("footer").height();
    $(".menuTitlesContainer").css("top", menuHeight - 14);
    $(".dashboardContainer").css("margin-top", menuHeight);
    $(".contentContaoner").css("margin-top", menuHeight);
    $("body").css("padding-bottom", footerHeight);
}

function activeTab(target) {
    $(target).css("border", "2px solid royalblue");
}

function activeNavItem(target) {
    $(target).css({
        color: "white",
        "background-color": "royalblue",
    });
}

function activeMenuItem(target) {
    $(target).addClass("activeMenu");
}

function scrollDown() {
    setTimeout(() => {
        document.body.scrollTop = 200;
        document.documentElement.scrollTop = 200;
    }, 1000);
}
