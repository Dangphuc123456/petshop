<link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">

<button id="chatbot-toggle">💬 Chat</button>

<div id="chatbot-container">
    <div class="chatbot-header">
        <strong>🐾 Petshop Bot</strong>
        <span id="chatbot-close">×</span>
    </div>
    <div id="chat-suggestions" style="margin-bottom: 10px;">
        <div id="suggestion-buttons"></div>
    </div>
    <div id="chatbox"></div>

    <div class="chatbot-input">
        <input type="text" id="message" placeholder="Nhập câu hỏi..." />
        <button id="send-btn" onclick="sendMessage()" title="Gửi">
            <i class="fa fa-paper-plane"></i>
        </button>
    </div>
</div>

<script>
    const inputEl = document.getElementById('message');
    const chatbox = document.getElementById('chatbox');

    function sendMessage(msgFromSuggestion = null) {
        const msg = msgFromSuggestion || inputEl.value;
        if (!msg.trim()) return;

        // Hiển thị tin nhắn của user
        chatbox.innerHTML += `<div class="user">Bạn: ${msg}</div>`;
        inputEl.value = '';
        chatbox.scrollTop = chatbox.scrollHeight;

        // Hiển thị typing indicator
        const typingEl = document.createElement('div');
        typingEl.classList.add('bot', 'typing');
        typingEl.innerHTML = `Bot đang viết` +
            `<span class="dot"></span><span class="dot"></span><span class="dot"></span>`;
        chatbox.appendChild(typingEl);
        chatbox.scrollTop = chatbox.scrollHeight;

        // Gửi request
        fetch('/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    message: msg
                })
            })
            .then(res => res.json())
            .then(data => {
                typingEl.remove();
                chatbox.innerHTML += `<div class="bot">${data.reply}</div>`;
                chatbox.scrollTop = chatbox.scrollHeight;
            })
            .catch(err => {
                typingEl.remove();
                chatbox.innerHTML += `<div class="bot">Có lỗi, thử lại sau nhé.</div>`;
                chatbox.scrollTop = chatbox.scrollHeight;
            });
    }

    // Gợi ý câu hỏi mặc định khi mở chatbot
    function showDefaultQuestions() {
        chatbox.innerHTML += `<div class="bot">Xin chào ! Mình có thể giúp đỡ gì bạn ?:Ví dụ.<br>
        Shop có những loại thú cưng nào?<br>
            Thời gian mở cửa của shop là khi nào?<br>
            Shop có chính sách đổi trả không?<br>
            Phụ kiện có được bảo hành không?
            </div>`;
        defaultQuestions.forEach(q => {
            const btn = document.createElement('div');
            btn.classList.add('bot', 'suggestion-bubble');
            btn.innerText = q;
            btn.style.cursor = 'pointer';
            btn.onclick = () => sendMessage(q);
            chatbox.appendChild(btn);
        });

        chatbox.scrollTop = chatbox.scrollHeight;
    }

    // Gửi khi nhấn nút
    document.getElementById('send-btn').onclick = () => sendMessage();

    // Gửi khi nhấn Enter
    inputEl.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });

    // Mở chatbot
    document.getElementById('chatbot-toggle').onclick = () => {
        document.getElementById('chatbot-container').style.display = 'block';
        chatbox.innerHTML = ''; // reset nội dung chat
        showDefaultQuestions();
    };

    // Đóng chatbot
    document.getElementById('chatbot-close').onclick = () => {
        document.getElementById('chatbot-container').style.display = 'none';
    };
</script>