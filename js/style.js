// メッセージリンク押下時
$('.message a').click(function(){
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    // css切り替え
    $(".body_login_color").toggleClass("body_register_color");
    $(".login_btn_color").toggleClass("register_btn_color");
    $(".login_message_color").toggleClass("register_message_color");
});