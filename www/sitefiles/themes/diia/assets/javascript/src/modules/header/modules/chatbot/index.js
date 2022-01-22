export default function chatbot() {
    const btn = $('#chatbot_btn');
    const chatBotBtns = $('#chatbot_content');
    if (btn && chatBotBtns) {
        btn.on('click', function() {
            $(this).toggleClass('active');
            $('body').toggleClass('chatbot-open');
            if (!$(chatBotBtns).hasClass('fadeInUpChatBot')) {
                $(chatBotBtns).addClass('fadeInUpChatBot');
            } else {
                $(chatBotBtns).removeClass('fadeInUpChatBot');
            }
        });
    }
}
