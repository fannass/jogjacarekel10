// Custom Chatbot Widget Manual dengan Improvisasi UX & Fitur
(function() {
    // Warna utama (mengikuti header web)
    const mainColor = '#00213a';
    const accentColor = '#009cff';
    const botAvatar = '<span style="background:'+accentColor+';border-radius:50%;width:28px;height:28px;display:inline-flex;align-items:center;justify-content:center;margin-right:6px;"><img src="https://img.icons8.com/parakeet-line/96/chatbot.png" alt="bot" style="width:22px;height:22px;display:block;"></span>';
    const userAvatar = '<span style="background:'+mainColor+';color:#fff;border-radius:50%;width:28px;height:28px;display:inline-flex;align-items:center;justify-content:center;font-size:1.1rem;margin-left:6px;">🧑</span>';

    // Inject style
    const style = document.createElement('style');
    style.innerHTML = `
    #custom-chatbot-btn {
        position: fixed; bottom: 24px; right: 24px; width: 56px; height: 56px;
        background: ${mainColor}; color: #fff; border-radius: 50%; display: flex;
        align-items: center; justify-content: center; font-size: 2rem; cursor: pointer;
        z-index: 9999; box-shadow: 0 2px 12px rgba(0,0,0,0.18); transition: box-shadow 0.2s, background 0.2s;
    }
    #custom-chatbot-btn.blink {
        animation: blink-bubble 1s infinite alternate;
    }
    @keyframes blink-bubble {
        0% { box-shadow: 0 2px 8px ${accentColor}; }
        100% { box-shadow: 0 4px 16px ${accentColor}; background: ${accentColor}; }
    }
    #custom-chatbot-btn:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.25); background: ${accentColor}; }
    #custom-chatbot-window {
        position: fixed; bottom: 90px; right: 24px; width: 360px; max-width: 95vw; height: 480px;
        background: #fff; border-radius: 16px; box-shadow: 0 2px 24px 0 #00213a22, 0 0 2rem #009cff11;
        display: none; flex-direction: column; overflow: hidden; z-index: 10000;
        transition: all 0.3s cubic-bezier(.4,0,.2,1);
    }
    #custom-chatbot-header {
        background: ${mainColor}; color: #fff; padding: 12px 16px; font-weight: 600;
        display: flex; justify-content: space-between; align-items: center; font-size: 1.08rem;
        border-bottom: 1px solid #e0e0e0;
    }
    #custom-chatbot-header .header-left {
        display: flex; align-items: center; gap: 10px;
    }
    #custom-chatbot-header img { height: 26px; margin-right: 0; }
    #custom-chatbot-header .header-title {
        font-size: 1rem;
        font-weight: 600;
        color: #fff;
        margin-left: 8px;
        letter-spacing: 0.2px;
        line-height: 1.1;
    }
    #custom-chatbot-header .header-title span {
        display: block;
        font-size: 0.75em;
        font-weight: 400;
        margin-top: 2px;
        opacity: 0.7;
    }
    #custom-chatbot-header .header-actions {
        display: flex; align-items: center; gap: 7px;
    }
    #custom-chatbot-close { cursor: pointer; font-size: 1.5rem; margin: 0; padding: 0 2px; background: none; border: none; color: #fff; }
    #custom-chatbot-reset {
        background: #fff; color: ${accentColor}; border: 1px solid ${accentColor}; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; padding: 0; cursor: pointer; font-size: 1.15rem; transition: background 0.2s, color 0.2s; font-weight: 500; margin: 0;
        box-shadow: 0 1px 2px #00213a08;
    }
    #custom-chatbot-reset:hover { background: ${accentColor}; color: #fff; }
    #custom-chatbot-body {
        flex: 1 1 0%; padding: 12px 8px 8px; overflow-y: auto; background: #f7fafd;
        display: flex; flex-direction: column;
        max-height: 60vh;
    }
    .custom-chatbot-msg {
        margin: 8px 0; display: flex; align-items: flex-end; opacity: 0; transform: translateY(16px); animation: fadeInUp 0.4s forwards;
    }
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }
    .custom-chatbot-msg.bot { justify-content: flex-start; }
    .custom-chatbot-msg.user { justify-content: flex-end; }
    .custom-chatbot-bubble {
        display: inline-block; padding: 9px 15px; border-radius: 15px; max-width: 80%;
        background: #f1f1f1; color: #333; font-size: 1.01rem;
        transition: background 0.2s, color 0.2s;
        box-shadow: 0 1px 4px #00213a11;
    }
    .custom-chatbot-msg.user .custom-chatbot-bubble {
        background: ${accentColor}; color: #fff;
    }
    #custom-chatbot-buttons {
        margin: 8px 0; text-align: left;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
        gap: 8px 8px;
        max-height: 160px;
        overflow-y: auto;
        padding: 2px 2px 2px 2px;
        background: #f7fafd;
        border-radius: 10px;
        box-shadow: 0 1px 4px #00213a08;
    }
    .custom-chatbot-btn-quick {
        background: #fff; color: ${mainColor}; border: 1px solid ${accentColor};
        border-radius: 14px; padding: 8px 0; margin: 0; cursor: pointer; font-size: 1rem;
        transition: background 0.2s, color 0.2s;
        box-shadow: 0 1px 2px #00213a08;
        width: 100%;
        min-width: 0;
        min-height: 38px;
        display: flex; align-items: center; justify-content: center;
        word-break: break-word;
    }
    .custom-chatbot-btn-quick:hover {
        background: ${accentColor}; color: #fff;
    }
    #custom-chatbot-feedback { margin: 8px 0 0 0; text-align: right; }
    .custom-chatbot-feedback-btn {
        background: #fff; color: ${mainColor}; border: 1px solid ${accentColor}; border-radius: 14px; padding: 8px 18px; margin-left: 3px; cursor: pointer; font-size: 1.08rem;
        transition: background 0.2s, color 0.2s;
    }
    .custom-chatbot-feedback-btn:hover { background: ${accentColor}; color: #fff; }
    #custom-chatbot-loading {
        display: inline-block; margin-left: 8px; vertical-align: middle;
    }
    .custom-chatbot-loading-dot {
        display: inline-block; width: 8px; height: 8px; background: ${accentColor}; border-radius: 50%; margin: 0 2px; animation: loading-bounce 1s infinite alternate;
    }
    .custom-chatbot-loading-dot:nth-child(2) { animation-delay: 0.2s; }
    .custom-chatbot-loading-dot:nth-child(3) { animation-delay: 0.4s; }
    @keyframes loading-bounce {
        0% { transform: translateY(0); }
        100% { transform: translateY(-8px); }
    }
    #custom-chatbot-form {
        display: flex; border-top: 1px solid #e0e0e0; background: #fff; padding: 10px 10px 10px 10px;
        position: sticky; bottom: 0; z-index: 2;
    }
    #custom-chatbot-input {
        flex: 1; border: 1px solid #e0e0e0; border-radius: 14px; padding: 14px 14px; font-size: 1.13rem;
        outline: none; margin-right: 7px;
        background: #f7fafd;
    }
    #custom-chatbot-send {
        background: ${accentColor}; color: #fff; border: none; border-radius: 14px; padding: 14px 22px; font-size: 1.13rem; cursor: pointer;
        transition: background 0.2s;
    }
    #custom-chatbot-send:hover { background: ${mainColor}; }
    .typing-dots span {
        display: inline-block; font-size: 1.2em; opacity: 0.5; animation: typingBlink 1.2s infinite;
    }
    .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
    .typing-dots span:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typingBlink {
        0%, 80%, 100% { opacity: 0.5; }
        40% { opacity: 1; }
    }
    .custom-chatbot-msg .custom-chatbot-bubble {
        animation: fadeInBubble 0.5s;
    }
    @keyframes fadeInBubble {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .custom-chatbot-msg.bot .custom-chatbot-bubble {
        background: #f3f3f5;
        color: #222;
        box-shadow: 0 1px 6px #00213a10;
    }
    /* Responsive improvements */
    @media (max-width: 600px) {
        #custom-chatbot-window {
            width: 94vw;
            left: 4vw; right: 2vw;
            height: 65vh;
            max-height: 70vh;
            bottom: 6vh;
            border-radius: 18px 18px 12px 12px;
        }
    }
    @media (max-width: 400px) {
        #custom-chatbot-window {
            width: 96vw;
            left: 2vw; right: 2vw;
            height: 65vh;
            max-height: 70vh;
            bottom: 6vh;
            border-radius: 16px 16px 10px 10px;
        }
    }
    `;
    document.head.appendChild(style);

    // Bubble button
    const btn = document.createElement('div');
    btn.id = 'custom-chatbot-btn';
    btn.innerHTML = '💬';
    document.body.appendChild(btn);

    // Chat window
    const win = document.createElement('div');
    win.id = 'custom-chatbot-window';
    win.innerHTML = `
        <div id="custom-chatbot-header">
            <span class="header-left"><img src="/img/favicon.png" alt="JogjaCare Logo"><span class="header-title">CareNavigator<br><span style='font-weight:400;font-size:0.92em;opacity:0.8;'>Your Medical Tourism Assistant</span></span></span>
            <span class="header-actions">
                <button id="custom-chatbot-reset" title="Start a new search">&#8635;</button>
                <span id="custom-chatbot-close">&times;</span>
            </span>
        </div>
        <div id="custom-chatbot-body"></div>
        <div id="custom-chatbot-buttons"></div>
        <div id="custom-chatbot-feedback"></div>
        <form id="custom-chatbot-form">
            <input type="text" id="custom-chatbot-input" placeholder="Type your question..." autocomplete="off" />
            <button type="submit" id="custom-chatbot-send">Send</button>
        </form>
    `;
    document.body.appendChild(win);

    // Show/hide logic
    btn.onclick = () => { win.style.display = 'flex'; btn.style.display = 'none'; clearBubbleNotif(); restoreChat(); };
    win.querySelector('#custom-chatbot-close').onclick = () => { win.style.display = 'none'; btn.style.display = 'flex'; };
    win.querySelector('#custom-chatbot-reset').onclick = (e) => { e.preventDefault(); startChat(true); };

    // Chat logic
    const chatBody = win.querySelector('#custom-chatbot-body');
    const chatButtons = win.querySelector('#custom-chatbot-buttons');
    const chatForm = win.querySelector('#custom-chatbot-form');
    const chatInput = win.querySelector('#custom-chatbot-input');
    const chatFeedback = win.querySelector('#custom-chatbot-feedback');

    let step = 1;
    let selectedMedical = null;
    let selectedDistrict = null;
    let lastBotMsg = '';
    let loadingEl = null;
    let chatHistory = [];

    // Notifikasi bubble jika ada balasan saat window tertutup
    function showBubbleNotif() { btn.classList.add('blink'); }
    function clearBubbleNotif() { btn.classList.remove('blink'); }

    // Animasi loading
    function showLoading() {
        if (!loadingEl) {
            loadingEl = document.createElement('span');
            loadingEl.id = 'custom-chatbot-loading';
            loadingEl.innerHTML = '<span class="custom-chatbot-loading-dot"></span><span class="custom-chatbot-loading-dot"></span><span class="custom-chatbot-loading-dot"></span>';
            chatBody.appendChild(loadingEl);
            chatBody.scrollTop = chatBody.scrollHeight;
        }
    }
    function hideLoading() {
        if (loadingEl && loadingEl.parentNode) loadingEl.parentNode.removeChild(loadingEl);
        loadingEl = null;
    }

    // Animasi typing bot
    function showTyping() {
        if (!loadingEl) {
            loadingEl = document.createElement('div');
            loadingEl.className = 'custom-chatbot-msg bot';
            loadingEl.innerHTML = botAvatar + '<div class="custom-chatbot-bubble"><span class="typing-dots"><span>.</span><span>.</span><span>.</span></span></div>';
            chatBody.appendChild(loadingEl);
            chatBody.scrollTop = chatBody.scrollHeight;
        }
    }
    function hideTyping() {
        if (loadingEl && loadingEl.parentNode) loadingEl.parentNode.removeChild(loadingEl);
        loadingEl = null;
    }

    // Simpan & restore riwayat chat di sessionStorage
    function saveChat() {
        sessionStorage.setItem('customChatbotHistory', JSON.stringify(chatHistory));
    }
    function restoreChat() {
        chatBody.innerHTML = '';
        chatButtons.innerHTML = '';
        chatFeedback.innerHTML = '';
        let hist = sessionStorage.getItem('customChatbotHistory');
        if (hist) {
            try {
                chatHistory = JSON.parse(hist);
                chatHistory.forEach(item => {
                    appendMessage(item.text, item.sender, false, item.feedback);
                });
            } catch {}
        }
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function appendMessage(text, sender = 'bot', save = true, feedback = null, withTyping = false) {
        if (sender === 'bot' && withTyping) {
            showTyping();
            setTimeout(() => {
                hideTyping();
                _appendMsg(text, sender, save, feedback);
            }, 700 + Math.min(1200, text.length * 20));
        } else {
            _appendMsg(text, sender, save, feedback);
        }
    }
    function _appendMsg(text, sender = 'bot', save = true, feedback = null) {
        const msg = document.createElement('div');
        msg.className = 'custom-chatbot-msg ' + sender;
        if (sender === 'bot') msg.innerHTML = botAvatar;
        msg.innerHTML += `<div class="custom-chatbot-bubble">${text}</div>`;
        if (sender === 'user') msg.innerHTML = `<div class="custom-chatbot-bubble">${text}</div>` + userAvatar;
        chatBody.appendChild(msg);
        chatBody.scrollTop = chatBody.scrollHeight;
        if (save) {
            chatHistory.push({text, sender, feedback});
            saveChat();
        }
    }

    function showButtons(buttons, nextStep) {
        chatButtons.innerHTML = '';
        buttons.forEach(btn => {
            const button = document.createElement('button');
            button.className = 'custom-chatbot-btn-quick';
            button.textContent = btn.label;
            button.onclick = function(e) {
                e.preventDefault();
                handleButtonClick(btn.value, nextStep);
            };
            chatButtons.appendChild(button);
        });
    }

    function showFeedbackButtons() {
        chatFeedback.innerHTML = '<span>Was this answer helpful?</span>' +
            '<button class="custom-chatbot-feedback-btn" data-fb="yes">Yes</button>' +
            '<button class="custom-chatbot-feedback-btn" data-fb="no">No</button>';
        Array.from(chatFeedback.querySelectorAll('.custom-chatbot-feedback-btn')).forEach(btn => {
            btn.onclick = function() {
                let val = btn.getAttribute('data-fb');
                chatFeedback.innerHTML = '<span>Thank you for your feedback!</span>';
                // Save feedback in chatHistory
                if (chatHistory.length > 0) {
                    chatHistory[chatHistory.length-1].feedback = val;
                    saveChat();
                }
            };
        });
    }

    function handleButtonClick(value, nextStep) {
        if (nextStep === 2) {
            selectedMedical = value;
            appendMessage(value, 'user');
            sendToBackend(2, selectedMedical);
        } else if (nextStep === 3) {
            selectedDistrict = value;
            appendMessage(value, 'user');
            sendToBackend(3, selectedMedical, selectedDistrict);
        }
    }

    function sendToBackend(stepSend, medicalType = null, district = null) {
        showLoading();
        fetch('/chatbot/conversation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                step: stepSend,
                medical_type: medicalType,
                district: district
            })
        })
        .then(res => res.json())
        .then(data => {
            hideLoading();
            step = data.step;
            if (data.message) {
                // Step 1: greeting already handled
                // Step 2: district selection
                if (step === 2) {
                    appendMessage('Please select the district in Yogyakarta where you want to find this service.', 'bot', true, null, true);
                }
                // Step 3: show answer or not found
                else if (step === 3) {
                    if (data.message.startsWith('Maaf, belum ada data')) {
                        appendMessage(`Sorry, there is no data for ${selectedMedical} in ${selectedDistrict} yet.`, 'bot', true, null, true);
                    } else {
                        appendMessage(`Here is the information for ${selectedMedical} in ${selectedDistrict}:<br>${data.message}`, 'bot', true, null, true);
                    }
                } else {
                    appendMessage(data.message, 'bot', true, null, true);
                }
                lastBotMsg = data.message;
                if (win.style.display === 'none') showBubbleNotif();
            }
            if (data.buttons) showButtons(data.buttons, step+1);
            else chatButtons.innerHTML = '';
            if (step === 3) showFeedbackButtons();
            else chatFeedback.innerHTML = '';
        });
    }

    chatForm.onsubmit = function(e) {
        e.preventDefault();
        const val = chatInput.value.trim();
        if (!val || val.length < 2) return;
        appendMessage(val, 'user');
        if (step === 1) {
            selectedMedical = val;
            sendToBackend(2, selectedMedical);
        } else if (step === 2) {
            selectedDistrict = val;
            sendToBackend(3, selectedMedical, selectedDistrict);
        } else {
            step = 1;
            selectedMedical = null;
            selectedDistrict = null;
            sendToBackend(1);
        }
        chatInput.value = '';
    };

    // Start conversation
    function startChat(resetHistory = false) {
        chatBody.innerHTML = '';
        chatButtons.innerHTML = '';
        chatFeedback.innerHTML = '';
        step = 1;
        selectedMedical = null;
        selectedDistrict = null;
        lastBotMsg = '';
        if (resetHistory) {
            chatHistory = [];
            saveChat();
        }
        // English greeting
        appendMessage("👋 Hi! I'm CareNavigator, your assistant for medical tourism in Yogyakarta. Please select the type of medical service you are looking for.", 'bot', true, null, true);
        setTimeout(() => sendToBackend(1), 1200);
    }

    // Inisialisasi: restore chat jika ada, atau mulai baru
    if (sessionStorage.getItem('customChatbotHistory')) {
        restoreChat();
    } else {
        startChat();
    }
})(); 