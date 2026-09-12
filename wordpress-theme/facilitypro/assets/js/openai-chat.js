/**
 * FacilityPro OpenAI Consultation Client
 * Handles Point-to-Point Q&A, markdown parsing, and live chat simulation
 */

function formatMarkdownToHtml(markdown) {
    if (!markdown) return '';
    
    let html = markdown
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');

    html = html.replace(/\`\`\`([a-zA-Z0-9_]*)\n([\s\S]*?)\`\`\`/g, function(match, lang, code) {
        return '<div class="my-3 rounded-xl bg-slate-900 text-slate-100 p-4 font-mono text-xs overflow-x-auto border border-slate-800"><div class="flex items-center justify-between text-[10px] text-slate-400 pb-2 mb-2 border-b border-slate-800"><span>' + (lang || 'ENGINEERING FORMULA') + '</span><span>FACILITYPRO AI</span></div><pre class="m-0 leading-relaxed">' + code.trim() + '</pre></div>';
    });

    html = html.replace(/\`([^\`]+)\`/g, '<code class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-800 font-mono text-xs border border-slate-200">$1</code>');
    html = html.replace(/^### (.*$)/gim, '<h3 class="text-base font-bold text-slate-900 mt-4 mb-2 flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#0077c8]"></span>$1</h3>');
    html = html.replace(/^## (.*$)/gim, '<h2 class="text-lg font-black text-slate-900 mt-5 mb-2 pb-1 border-b border-slate-200">$1</h2>');
    html = html.replace(/^# (.*$)/gim, '<h1 class="text-xl font-black text-slate-900 mt-6 mb-3">$1</h1>');
    html = html.replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold text-slate-900">$1</strong>');
    html = html.replace(/\*(.*?)\*/g, '<em class="italic text-slate-700">$1</em>');
    html = html.replace(/^\s*[-*+] (.*$)/gim, '<li class="text-xs text-slate-700 leading-relaxed mb-1.5 flex items-start gap-2"><span class="text-[#0077c8] font-bold">•</span><span>$1</span></li>');

    return html;
}

async function handleConsultationSubmit(e) {
    e.preventDefault();

    const form = e.target;
    const submitBtn = document.getElementById('consultationSubmitBtn');
    const loadingState = document.getElementById('consultationLoading');
    const responseArea = document.getElementById('consultationResponse');
    const responseContent = document.getElementById('consultationResponseContent');
    const expertBadge = document.getElementById('consultationExpertBadge');

    const discipline = form.discipline.value;
    const urgency = form.urgency.value;
    const details = form.problem_details.value.trim();

    if (!details) return;

    if (submitBtn) submitBtn.disabled = true;
    if (loadingState) loadingState.classList.remove('hidden');
    if (responseArea) responseArea.classList.add('hidden');

    try {
        const formData = new FormData();
        formData.append('action', 'facilitypro_openai_consultation');
        formData.append('nonce', window.facilityProData?.nonce || '');
        formData.append('discipline', discipline);
        formData.append('urgency', urgency);
        formData.append('problem_details', details);

        const res = await fetch(window.facilityProData?.ajax_url || '/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        if (data.success && data.data) {
            const result = data.data;
            if (responseContent) {
                responseContent.innerHTML = formatMarkdownToHtml(result.response);
            }
            if (expertBadge) {
                expertBadge.innerHTML = '<div class="flex items-center gap-2 px-3 py-1.5 bg-emerald-50 text-emerald-800 rounded-xl text-xs font-bold border border-emerald-200"><span>' + result.expert_name + '</span><span class="text-[10px] text-emerald-600 bg-white px-2 py-0.5 rounded-md">' + result.expert_role + '</span></div>';
            }
            if (responseArea) responseArea.classList.remove('hidden');
        } else {
            if (responseContent) {
                responseContent.innerHTML = '<div class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-xs text-rose-800 font-semibold">' + (data.data || 'Failed to generate solution.') + '</div>';
            }
            if (responseArea) responseArea.classList.remove('hidden');
        }
    } catch (err) {
        if (responseContent) {
            responseContent.innerHTML = '<div class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-xs text-rose-800 font-semibold">Network error: Could not reach consultation server.</div>';
        }
        if (responseArea) responseArea.classList.remove('hidden');
    } finally {
        if (submitBtn) submitBtn.disabled = false;
        if (loadingState) loadingState.classList.add('hidden');
        if (window.lucide) lucide.createIcons();
    }
}

async function handleFloatingChatSubmit(e) {
    e.preventDefault();
    const input = document.getElementById('floatingChatInput');
    const msg = input?.value.trim();
    if (!msg) return;

    const chatMessages = document.getElementById('floatingChatMessages');
    
    const userBubble = document.createElement('div');
    userBubble.className = 'flex items-start gap-2.5 justify-end';
    userBubble.innerHTML = '<div class="max-w-[80%] bg-[#0077c8] text-white p-3 rounded-2xl rounded-tr-none text-xs font-medium leading-relaxed shadow-sm">' + msg.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</div>';
    chatMessages.appendChild(userBubble);
    input.value = '';
    chatMessages.scrollTop = chatMessages.scrollHeight;

    const typingBubble = document.createElement('div');
    typingBubble.className = 'flex items-start gap-2.5 chat-typing-bubble';
    typingBubble.innerHTML = '<div class="w-7 h-7 rounded-full bg-slate-900 text-white flex items-center justify-center text-[10px] font-bold flex-shrink-0">AI</div><div class="bg-slate-100 text-slate-600 p-3 rounded-2xl rounded-tl-none text-xs flex items-center gap-1.5"><div class="w-1.5 h-1.5 rounded-full bg-slate-400 animate-bounce"></div><div class="w-1.5 h-1.5 rounded-full bg-slate-400 animate-bounce" style="animation-delay: 0.2s"></div><div class="w-1.5 h-1.5 rounded-full bg-slate-400 animate-bounce" style="animation-delay: 0.4s"></div></div>';
    chatMessages.appendChild(typingBubble);
    chatMessages.scrollTop = chatMessages.scrollHeight;

    try {
        const formData = new FormData();
        formData.append('action', 'facilitypro_openai_consultation');
        formData.append('nonce', window.facilityProData?.nonce || '');
        formData.append('discipline', 'general');
        formData.append('urgency', 'normal');
        formData.append('problem_details', msg);

        const res = await fetch(window.facilityProData?.ajax_url || '/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        
        typingBubble.remove();

        const aiBubble = document.createElement('div');
        aiBubble.className = 'flex items-start gap-2.5';
        
        if (data.success && data.data) {
            aiBubble.innerHTML = '<div class="w-7 h-7 rounded-full bg-[#0077c8] text-white flex items-center justify-center text-[10px] font-bold flex-shrink-0">AI</div><div class="max-w-[85%] bg-slate-100 text-slate-800 p-3.5 rounded-2xl rounded-tl-none text-xs font-normal leading-relaxed shadow-sm">' + formatMarkdownToHtml(data.data.response) + '</div>';
        } else {
            aiBubble.innerHTML = '<div class="w-7 h-7 rounded-full bg-rose-600 text-white flex items-center justify-center text-[10px] font-bold flex-shrink-0">!</div><div class="max-w-[85%] bg-rose-50 text-rose-800 p-3 rounded-2xl rounded-tl-none text-xs font-medium">' + (data.data || 'Error processing response.') + '</div>';
        }
        
        chatMessages.appendChild(aiBubble);
        chatMessages.scrollTop = chatMessages.scrollHeight;
        if (window.lucide) lucide.createIcons();
    } catch (err) {
        typingBubble.remove();
        const errBubble = document.createElement('div');
        errBubble.className = 'flex items-start gap-2.5';
        errBubble.innerHTML = '<div class="w-7 h-7 rounded-full bg-rose-600 text-white flex items-center justify-center text-[10px] font-bold flex-shrink-0">!</div><div class="max-w-[85%] bg-rose-50 text-rose-800 p-3 rounded-2xl rounded-tl-none text-xs font-medium">Connection failed. Please retry.</div>';
        chatMessages.appendChild(errBubble);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
}
