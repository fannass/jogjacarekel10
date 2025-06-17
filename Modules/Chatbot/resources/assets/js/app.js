// Chatbot Widget Sederhana dengan Tampilan Modern & Bubble Pendek

document.addEventListener('DOMContentLoaded', function() {
    // Buat tombol chat
    const chatButton = document.createElement('div');
    chatButton.id = 'custom-chatbot-btn';
    chatButton.innerHTML = '💬';
    chatButton.style.position = 'fixed';
    chatButton.style.bottom = '30px';
    chatButton.style.right = '30px';
    chatButton.style.width = '60px';
    chatButton.style.height = '60px';
    chatButton.style.background = '#007bff';
    chatButton.style.color = '#fff';
    chatButton.style.borderRadius = '50%';
    chatButton.style.display = 'flex';
    chatButton.style.alignItems = 'center';
    chatButton.style.justifyContent = 'center';
    chatButton.style.fontSize = '2rem';
    chatButton.style.cursor = 'pointer';
    chatButton.style.zIndex = '9999';
    chatButton.style.boxShadow = '0 2px 8px rgba(0,0,0,0.2)';
    chatButton.style.transition = 'box-shadow 0.2s';
    chatButton.onmouseover = () => chatButton.style.boxShadow = '0 4px 16px rgba(0,0,0,0.3)';
    chatButton.onmouseleave = () => chatButton.style.boxShadow = '0 2px 8px rgba(0,0,0,0.2)';
    document.body.appendChild(chatButton);

    // Buat jendela chat
    const chatWindow = document.createElement('div');
    chatWindow.id = 'custom-chatbot-window';
    chatWindow.style.position = 'fixed';
    chatWindow.style.bottom = '100px';
    chatWindow.style.right = '30px';
    chatWindow.style.width = '350px';
    chatWindow.style.maxWidth = '95vw';
    chatWindow.style.height = '480px';
    chatWindow.style.background = '#fff';
    chatWindow.style.borderRadius = '16px';
    chatWindow.style.boxShadow = '0 8px 32px rgba(0,0,0,0.25)';
    chatWindow.style.display = 'none';
    chatWindow.style.flexDirection = 'column';
    chatWindow.style.overflow = 'hidden';
    chatWindow.style.zIndex = '10000';
    document.body.appendChild(chatWindow);

    // Header
    const chatHeader = document.createElement('div');
    chatHeader.style.background = '#007bff';
    chatHeader.style.color = '#fff';
    chatHeader.style.padding = '16px 20px';
    chatHeader.style.fontWeight = 'bold';
    chatHeader.style.display = 'flex';
    chatHeader.style.justifyContent = 'space-between';
    chatHeader.style.alignItems = 'center';
    chatHeader.style.fontSize = '1.1rem';
    chatHeader.innerHTML = '<span>JogjaCare Assistant</span>';
    // Tombol close
    const closeBtn = document.createElement('span');
    closeBtn.innerHTML = '&times;';
    closeBtn.style.cursor = 'pointer';
    closeBtn.style.fontSize = '1.7rem';
    closeBtn.style.marginLeft = '12px';
    chatHeader.appendChild(closeBtn);
    chatWindow.appendChild(chatHeader);

    // Area chat
    const chatBody = document.createElement('div');
    chatBody.id = 'custom-chatbot-body';
    chatBody.style.flex = '1';
    chatBody.style.padding = '14px 8px 8px 8px';
    chatBody.style.overflowY = 'auto';
    chatBody.style.background = '#f4f7fb';
    chatBody.style.display = 'flex';
    chatBody.style.flexDirection = 'column';
    chatWindow.appendChild(chatBody);

    // Input
    const chatForm = document.createElement('form');
    chatForm.style.display = 'flex';
    chatForm.style.borderTop = '1px solid #e0e0e0';
    chatForm.style.background = '#fff';
    chatForm.style.padding = '10px';
    const chatInput = document.createElement('input');
    chatInput.type = 'text';
    chatInput.placeholder = 'Tulis pertanyaan...';
    chatInput.style.flex = '1';
    chatInput.style.padding = '10px 14px';
    chatInput.style.border = '1px solid #e0e0e0';
    chatInput.style.borderRadius = '20px';
    chatInput.style.outline = 'none';
    chatInput.style.fontSize = '1rem';
    chatInput.style.marginRight = '8px';
    const sendBtn = document.createElement('button');
    sendBtn.type = 'submit';
    sendBtn.innerHTML = 'Kirim';
    sendBtn.style.background = '#007bff';
    sendBtn.style.color = '#fff';
    sendBtn.style.border = 'none';
    sendBtn.style.padding = '0 22px';
    sendBtn.style.borderRadius = '20px';
    sendBtn.style.fontWeight = 'bold';
    sendBtn.style.fontSize = '1rem';
    sendBtn.style.cursor = 'pointer';
    chatForm.appendChild(chatInput);
    chatForm.appendChild(sendBtn);
    chatWindow.appendChild(chatForm);

    // Tampilkan pesan awal dari backend, bukan pesan statis
    // addMessage('👋 Halo! Silakan tanya seputar fasilitas medical di Jogja.');

    // Definisikan addMessage di atas agar bisa dipakai di triggerWelcome
    function addMessage(text, from = 'bot') {
        const msg = document.createElement('div');
        msg.style.margin = '6px 0';
        msg.style.padding = '8px 14px';
        msg.style.borderRadius = '16px';
        msg.style.maxWidth = '60%';
        msg.style.wordBreak = 'break-word';
        msg.style.fontSize = '1rem';
        msg.style.display = 'inline-block';
        msg.style.boxShadow = '0 1px 4px rgba(0,0,0,0.04)';
        if (from === 'bot') {
            msg.style.background = '#f0f1f5';
            msg.style.color = '#222';
            msg.style.alignSelf = 'flex-start';
        } else {
            msg.style.background = 'linear-gradient(90deg,#007bff 60%,#339dff 100%)';
            msg.style.color = '#fff';
            msg.style.alignSelf = 'flex-end';
            msg.style.marginLeft = 'auto';
        }
        msg.innerText = text;
        chatBody.appendChild(msg);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    // Saat chat dibuka, langsung trigger pesan awal ke backend
    function triggerWelcome() {
        fetch('/botman', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                driver: 'web',
                userId: 'web-user',
                message: '/start'
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data && data.messages && data.messages.length > 0) {
                data.messages.forEach(m => addMessage(m.text, 'bot'));
            } else {
                addMessage('Maaf, tidak ada balasan dari bot.', 'bot');
            }
        })
        .catch(() => addMessage('Terjadi kesalahan koneksi.', 'bot'));
    }

    // Event
    chatButton.onclick = function() {
        chatWindow.style.display = 'flex';
        if (chatBody.childElementCount === 0) {
            triggerWelcome();
        }
    };
    closeBtn.onclick = function() {
        chatWindow.style.display = 'none';
    };
    chatForm.onsubmit = function(e) {
        e.preventDefault();
        const userMsg = chatInput.value.trim();
        if (!userMsg) return;
        addMessage(userMsg, 'user');
        chatInput.value = '';
        // Kirim ke backend
        fetch('/botman', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                driver: 'web',
                userId: 'web-user',
                message: userMsg
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data && data.messages && data.messages.length > 0) {
                data.messages.forEach(m => addMessage(m.text, 'bot'));
            } else {
                addMessage('Maaf, tidak ada balasan dari bot.', 'bot');
            }
        })
        .catch(() => addMessage('Terjadi kesalahan koneksi.', 'bot'));
    };
});
