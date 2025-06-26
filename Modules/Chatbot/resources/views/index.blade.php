@extends('chatbot::layouts.master')

@section('content')
<div id="chatbot-container" style="max-width:400px;margin:40px auto;padding:20px;border:1px solid #ddd;border-radius:8px;box-shadow:0 2px 8px #eee;background:#fff;">
    <div id="chat-messages" style="min-height:200px;max-height:300px;overflow-y:auto;margin-bottom:16px;"></div>
    <div id="chat-buttons" style="margin-bottom:8px;"></div>
    <form id="chat-form" style="display:flex;gap:8px;">
        <input type="text" id="chat-input" class="form-control" placeholder="Ketik pesan..." autocomplete="off" style="flex:1;">
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>

<script>
const chatMessages = document.getElementById('chat-messages');
const chatButtons = document.getElementById('chat-buttons');
const chatForm = document.getElementById('chat-form');
const chatInput = document.getElementById('chat-input');

let step = 1;
let selectedMedical = null;
let selectedDistrict = null;

function appendMessage(text, sender = 'bot') {
    const msg = document.createElement('div');
    msg.style.margin = '8px 0';
    msg.style.textAlign = sender === 'bot' ? 'left' : 'right';
    msg.innerHTML = `<span style="display:inline-block;padding:8px 12px;border-radius:16px;max-width:80%;background:${sender==='bot'?'#f1f1f1':'#007bff'};color:${sender==='bot'?'#333':'#fff'};">${text}</span>`;
    chatMessages.appendChild(msg);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function showButtons(buttons, nextStep) {
    chatButtons.innerHTML = '';
    buttons.forEach(btn => {
        const button = document.createElement('button');
        button.className = 'btn btn-outline-primary btn-sm m-1';
        button.textContent = btn.label;
        button.onclick = function(e) {
            e.preventDefault();
            handleButtonClick(btn.value, nextStep);
        };
        chatButtons.appendChild(button);
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
        step = data.step;
        if (data.message) appendMessage(data.message, 'bot');
        if (data.buttons) showButtons(data.buttons, step+1);
        else chatButtons.innerHTML = '';
    });
}

chatForm.onsubmit = function(e) {
    e.preventDefault();
    const val = chatInput.value.trim();
    if (!val) return;
    appendMessage(val, 'user');
    // Untuk versi manual, input teks hanya digunakan di step 3 jika tidak ada tombol
    if (step === 1) {
        selectedMedical = val;
        sendToBackend(2, selectedMedical);
    } else if (step === 2) {
        selectedDistrict = val;
        sendToBackend(3, selectedMedical, selectedDistrict);
    } else {
        // Reset ke awal
        step = 1;
        selectedMedical = null;
        selectedDistrict = null;
        sendToBackend(1);
    }
    chatInput.value = '';
};

// Mulai percakapan
window.onload = function() {
    sendToBackend(1);
};
</script>
@endsection
