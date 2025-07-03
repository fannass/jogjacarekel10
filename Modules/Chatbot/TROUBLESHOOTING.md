# Chatbot Troubleshooting Guide

## Overview
This chatbot module provides a hybrid system that combines structured conversation flow with intelligent fallback to live chat for complex queries.

## NEW: 2-Attempt Unstructured Input System

### How the New System Works
The chatbot now implements a **2-attempt system** for handling unstructured user inputs before redirecting to live chat:

#### Flow Diagram:
```
User asks unstructured question
         ↓
    Bot searches FAQ database
         ↓
    FAQ found? → YES → Show answer + Reset counter
         ↓ NO
    First attempt? → YES → Show "try again" message + Increment counter
         ↓ NO
    Second attempt? → YES → Redirect to live chat
```

#### Detailed Process:

1. **User Input Detection**
   - Bot detects if user input doesn't follow structured flow (step 1 or 2)
   - Input is considered "unstructured" if it's not a button option

2. **First Unstructured Attempt**
   - Bot searches FAQ database using fuzzy search
   - If FAQ found: Returns answer and resets counter to 0
   - If no FAQ found: 
     - Increments counter to 1
     - Shows message: "I understand you're asking about: [user input]. Let me try to help you with that. If I can't find the answer, please try asking in a different way or I'll connect you with our support team."
     - Shows button: "🔄 Try Structured Flow Instead"

3. **Second Unstructured Attempt**
   - User asks another unstructured question
   - Bot searches FAQ database again
   - If FAQ found: Returns answer and resets counter to 0
   - If no FAQ found:
     - Increments counter to 2
     - Automatically redirects to Tawk.to live chat
     - Shows message: "I understand you're asking about: [user input]. Since I couldn't find the answer after trying twice, let me connect you with our support team for a more detailed answer."

4. **Counter Reset Conditions**
   - User follows structured flow (selects buttons)
   - FAQ is found and answered
   - Conversation is restarted
   - User clicks "Try Structured Flow Instead" button

#### Benefits of This System:
- **Better User Experience**: Users get 2 chances before being redirected
- **Reduced Live Chat Load**: Many questions can be answered without human intervention
- **Flexible Interaction**: Users can switch between structured and unstructured modes
- **Intelligent Fallback**: Only redirects to live chat when truly necessary

## How It Works

### Structured Flow
1. **Step 1**: User selects medical service type from predefined options
2. **Step 2**: User selects district in Yogyakarta
3. **Step 3**: Bot provides relevant information or redirects to live chat if no data found

### Unstructured Input Handling (NEW: 2-Attempt System)
When users ask questions that don't follow the structured flow:

1. **First Unstructured Attempt**: 
   - Bot tries to find relevant FAQ based on user input
   - If FAQ found: Provides answer and resets counter
   - If no FAQ found: Shows message asking user to try again or use structured flow
   - User can either ask another unstructured question or switch to structured flow

2. **Second Unstructured Attempt**:
   - Bot tries again to find relevant FAQ
   - If still no FAQ found: Automatically redirects to Tawk.to live chat
   - User gets connected with human support

3. **Counter Reset**: 
   - Counter resets when user follows structured flow
   - Counter resets when FAQ is found
   - Counter resets when conversation restarts

## Configuration

### Tawk.to Setup
1. Create account at [Tawk.to](https://www.tawk.to)
2. Get your widget ID from dashboard
3. Update configuration in `Modules/Chatbot/config/config.php`:

```php
'tawkto' => [
    'enabled' => env('TAWKTO_ENABLED', true),
    'widget_id' => env('TAWKTO_WIDGET_ID', 'YOUR_ACTUAL_WIDGET_ID'),
    'auto_redirect_delay' => env('TAWKTO_AUTO_REDIRECT_DELAY', 3000), // 3 seconds
],
```

### Environment Variables
Add these to your `.env` file:
```
TAWKTO_ENABLED=true
TAWKTO_WIDGET_ID=your_actual_widget_id
TAWKTO_AUTO_REDIRECT_DELAY=3000
```

### Medical Services & FAQs
- Add medical services in admin panel: `/admin/medical-lists`
- Add FAQs in admin panel: `/admin/faqs`
- FAQs should include district names for better matching

## Troubleshooting

### Live Chat Not Working
1. Check if Tawk.to widget ID is configured correctly
2. Verify Tawk.to account is active
3. Check browser console for JavaScript errors
4. Ensure `/chatbot/tawkto-config` endpoint returns correct data

### Chatbot Not Responding
1. Check if CSRF token is present in page
2. Verify `/chatbot/conversation` endpoint is accessible
3. Check Laravel logs for errors
4. Ensure database tables exist and have data

### Unstructured Input Issues
1. Verify FAQ data exists in database
2. Check if search queries are working properly
3. Ensure counter logic is functioning correctly
4. Test both structured and unstructured flows

### Counter Not Working
1. Check if `unstructured_count` is being sent in requests
2. Verify counter is being updated in responses
3. Ensure counter resets properly when following structured flow
4. Check JavaScript console for errors

## Testing Scenarios

### Structured Flow Test
1. Open chatbot
2. Select medical service type
3. Select district
4. Verify information is displayed

### Unstructured Flow Test (2-Attempt System)
1. Open chatbot
2. Type unstructured question (e.g., "Where can I find dental care?")
3. Verify bot responds with first attempt message
4. Verify counter shows 1
5. Type another unstructured question
6. Verify redirect to live chat after second attempt

### FAQ Search Test
1. Add FAQ with specific keywords
2. Ask question using those keywords
3. Verify bot finds and displays FAQ answer
4. Verify counter resets to 0

### Counter Reset Test
1. Ask unstructured question (counter = 1)
2. Click "Try Structured Flow Instead" button
3. Verify counter resets to 0
4. Verify structured flow starts

## Step-by-Step Testing Examples

### Example 1: Complete Unstructured Flow
```
User: "I need dental treatment"
Bot: "I understand you're asking about: 'I need dental treatment'. Let me try to help you with that. If I can't find the answer, please try asking in a different way or I'll connect you with our support team."
[Shows: 🔄 Try Structured Flow Instead]

User: "Where can I get teeth whitening?"
Bot: "I understand you're asking about: 'Where can I get teeth whitening?'. Since I couldn't find the answer after trying twice, let me connect you with our support team for a more detailed answer."
[Redirects to live chat]
```

### Example 2: FAQ Found (Counter Reset)
```
User: "Dental care in Sleman"
Bot: [Shows FAQ answer about dental care in Sleman]
[Counter resets to 0]
```

### Example 3: Switch to Structured Flow
```
User: "I need help with medical tourism"
Bot: "I understand you're asking about: 'I need help with medical tourism'. Let me try to help you with that. If I can't find the answer, please try asking in a different way or I'll connect you with our support team."
[Shows: 🔄 Try Structured Flow Instead]

User: [Clicks "Try Structured Flow Instead"]
Bot: "Please select the type of medical service you are looking for:"
[Shows medical service buttons]
[Counter resets to 0]
```

### Example 4: Mixed Flow
```
User: "Dental care" [Unstructured]
Bot: [Shows FAQ answer]
[Counter = 0]

User: "Cardiology" [Structured - selects button]
Bot: "Please select the district in Yogyakarta:"
[Shows district buttons]
[Counter = 0]

User: "Sleman" [Structured - selects button]
Bot: [Shows cardiology info for Sleman]
[Counter = 0]
```

## Debug Information

### Check Counter Status
To debug counter issues, check browser console for:
```javascript
console.log('Current unstructured count:', unstructuredCount);
```

### Check Request/Response
Monitor network requests to `/chatbot/conversation`:
```javascript
// Request should include:
{
  step: 1,
  medical_type: null,
  district: null,
  user_input: "your question",
  unstructured_count: 1
}

// Response should include:
{
  step: "unstructured_first",
  message: "...",
  unstructured_count: 1,
  user_input: "your question"
}
```

### Common Issues and Solutions

#### Issue: Counter not incrementing
**Solution**: Check if `unstructured_count` is being sent in request and updated in response

#### Issue: Counter not resetting
**Solution**: Verify structured flow is properly detected and counter is reset to 0

#### Issue: Live chat not redirecting after 2 attempts
**Solution**: Check if counter reaches 2 and `redirect_to_live_chat` is true in response

#### Issue: FAQ search not working
**Solution**: Verify FAQ data exists and search query is working properly

## API Endpoints

- `POST /chatbot/conversation` - Main conversation handler (now includes unstructured_count)
- `GET /chatbot/tawkto-config` - Get Tawk.to configuration
- `GET /admin/medical-lists` - Manage medical services (admin)
- `GET /admin/faqs` - Manage FAQs (admin)

## Database Tables

- `medical_lists` - Available medical services
- `faqs` - Frequently asked questions and answers
- Both tables are managed through admin interface

## Browser Compatibility
- Modern browsers (Chrome, Firefox, Safari, Edge)
- Mobile responsive design
- Requires JavaScript enabled
- Requires internet connection for Tawk.to integration

## Technical Implementation

### Backend Changes
- Added `unstructured_count` parameter to conversation endpoint
- Modified `handleUnstructuredInput()` method to track attempts
- Added new response type `unstructured_first` for first attempt
- Counter resets when following structured flow or finding FAQ

### Frontend Changes
- Added `unstructuredCount` variable to track attempts
- Modified `sendToBackend()` and `sendUnstructuredInput()` to include counter
- Added handling for `unstructured_first` response type
- Added "Try Structured Flow Instead" button
- Counter resets when switching to structured flow

### Response Types
- `step: 1, 2, 3` - Normal structured flow
- `step: 'unstructured_first'` - First unstructured attempt
- `step: 'live_chat'` - Redirect to live chat
- `unstructured_count: 0, 1, 2` - Current attempt counter

# Troubleshooting Chatbot Hybrid dengan Tawk.to

## Masalah: "Unable to connect to live chat. Please try again later."

### Penyebab dan Solusi:

#### 1. **Endpoint `/chatbot/tawkto-config` tidak bisa diakses**

**Gejala:**
- Error di browser console: `Failed to fetch /chatbot/tawkto-config`
- Chatbot tidak bisa redirect ke Tawk.to

**Solusi:**
1. **Clear cache Laravel:**
   ```bash
   php artisan cache:clear
   php artisan route:clear
   php artisan config:clear
   ```

2. **Periksa route:**
   ```bash
   php artisan route:list --name=chatbot
   ```

3. **Pastikan module Chatbot aktif:**
   ```bash
   php artisan module:enable Chatbot
   ```

4. **Restart server:**
   ```bash
   php artisan serve
   ```

#### 2. **Widget ID Tawk.to tidak valid**

**Gejala:**
- Tawk.to widget tidak muncul
- Error di console: "Widget not found"

**Solusi:**
1. **Periksa Widget ID di `.env`:**
   ```env
   TAWKTO_WIDGET_ID=68507566a1bfba190de84b28/1itt4l687
   ```

2. **Atau di `Modules/Chatbot/Config/config.php`:**
   ```php
   'widget_id' => '68507566a1bfba190de84b28/1itt4l687',
   ```

3. **Test Widget ID di browser:**
   ```
   https://embed.tawk.to/68507566a1bfba190de84b28/1itt4l687
   ```

#### 3. **Fallback Configuration**

**Jika endpoint tetap bermasalah, chatbot akan menggunakan fallback:**
```javascript
const fallbackConfig = {
    enabled: true,
    widget_id: '68507566a1bfba190de84b28/1itt4l687',
    auto_redirect_delay: 3000
};
```

#### 4. **Test Manual Endpoint**

**Test endpoint secara manual:**
```bash
# Test dengan curl
curl -X GET http://localhost:8000/chatbot/tawkto-config

# Atau buka di browser
http://localhost:8000/chatbot/tawkto-config
```

**Response yang diharapkan:**
```json
{
    "enabled": true,
    "widget_id": "68507566a1bfba190de84b28/1itt4l687",
    "auto_redirect_delay": 3000
}
```

#### 5. **Debug Frontend**

**Buka browser console dan test:**
```javascript
// Test fetch endpoint
fetch('/chatbot/tawkto-config')
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(err => console.error(err));

// Test Tawk.to script loading
const script = document.createElement('script');
script.src = 'https://embed.tawk.to/68507566a1bfba190de84b28/1itt4l687';
document.head.appendChild(script);
```

#### 6. **Periksa Network Tab**

1. Buka **Developer Tools** (F12)
2. Pilih tab **Network**
3. Klik chatbot dan ketik pertanyaan tidak terstruktur
4. Periksa request ke `/chatbot/tawkto-config`
5. Lihat response dan error yang muncul

#### 7. **Alternative Solution**

**Jika endpoint tetap bermasalah, edit `public/js/custom-chatbot.js`:**
```javascript
// Ganti bagian loadTawkToScript() dengan:
function loadTawkToScript() {
    // Skip endpoint check, langsung load Tawk.to
    const config = {
        enabled: true,
        widget_id: '68507566a1bfba190de84b28/1itt4l687',
        auto_redirect_delay: 3000
    };
    loadTawkToScriptWithConfig(config);
}
```

#### 8. **Check Laravel Logs**

**Periksa log error:**
```bash
tail -f storage/logs/laravel.log
```

**Cari error terkait:**
- `Modules\Chatbot\Http\Controllers\ChatbotController`
- `chatbot.tawkto` config
- Route not found

#### 9. **Verifikasi Module Structure**

**Pastikan struktur module benar:**
```
Modules/Chatbot/
├── Http/Controllers/ChatbotController.php
├── Config/config.php
├── routes/web.php
└── README.md
```

#### 10. **Test Complete Flow**

1. **Akses website**
2. **Klik chatbot bubble**
3. **Ketik pertanyaan terstruktur** → harus dapat jawaban FAQ
4. **Ketik pertanyaan tidak terstruktur** → harus redirect ke Tawk.to
5. **Periksa Tawk.to dashboard** → harus ada chat dari user

---

## **Quick Fix Checklist:**

- [ ] Clear Laravel cache
- [ ] Restart server
- [ ] Periksa Widget ID
- [ ] Test endpoint manual
- [ ] Periksa browser console
- [ ] Verifikasi module aktif
- [ ] Test complete flow

---

## **Contact Support:**

Jika masalah masih berlanjut, berikan informasi:
1. Error message lengkap
2. Browser console log
3. Network tab screenshot
4. Laravel log error
5. Versi Laravel dan module 