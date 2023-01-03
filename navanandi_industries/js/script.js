var isSideLinksOpen = true;

function toggleSideLinks(){
    var sideBar = document.getElementsByClassName('side-hide-bar')[0].getElementsByTagName('ul')[0];
    var sideBarButton = document.getElementsByClassName('side-hide-bar-button')[0].getElementsByTagName('i')[0];
    if(isSideLinksOpen === true){
        sideBar.style.right = '-100px';
        sideBarButton.style.transform = "rotate(-180deg)";
        isSideLinksOpen = false;
    }else{
        sideBar.style.right = '10px';
        sideBarButton.style.transform = "rotate(0deg)";
        isSideLinksOpen = true;
    }
}

function uploadAdBanner(value){
    value = value.replace('C:\\fakepath\\', "");
    document.getElementById("adImageLabel").innerText = value;
}

function googleTranslateElementInit(){
    new google.translate.TranslateElement({
        includedLanguages: 'en,ar',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
    },'google_translate_element');
}


$('document').ready(function () {
    $('#google_translate_element').on("click", function () {
    $("iframe").contents().find(".goog-te-menu2-item div, .goog-te-menu2-item:link div, .goog-te-menu2-item:visited div, .goog-te-menu2-item:active div, .goog-te-menu2 *")
        .css({
            'color': '#404040'
        });
        $("iframe").contents().find(".goog-te-menu2-item div").hover(function () {
            $(this).css('background-color', '#FFD800').find('span.text').css('color', '#FFFFFF');
        }, function () {
            $(this).css('background-color', '#FFFFFF').find('span.text').css('color', '#404040');
        });
        $("iframe").contents().find(".goog-te-menu2-item div").focus(function () {
            $(this).css('background-color', '#FFD800').find('span.text').css('color', '#FFFFFF');
        }, function () {
            $(this).css('background-color', '#FFFFFF').find('span.text').css('color', '#404040');
        });
        $("iframe").contents().find('.goog-te-menu2').css('border', 'none');
        $(".goog-te-menu-frame").css('box-shadow', '0.0rem 0.25rem 2rem rgba(0,0,0,0.1)');
    });
});
