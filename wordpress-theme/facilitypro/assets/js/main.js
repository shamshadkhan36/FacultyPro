/**
 * FacilityPro Main Theme Controller & User Authentication
 */

function facilityProOpenConsultationModal(prefillQuery = '', discipline = 'hvac') {
    const modal = document.getElementById('consultationModal');
    if (!modal) return;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    if (prefillQuery) {
        const textarea = modal.querySelector('textarea[name="problem_details"]');
        if (textarea) textarea.value = prefillQuery;
    }

    if (discipline) {
        const select = modal.querySelector('select[name="discipline"]');
        if (select) select.value = discipline;
    }

    if (window.lucide) lucide.createIcons();
}

function facilityProCloseConsultationModal() {
    const modal = document.getElementById('consultationModal');
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function facilityProToggleFloatingChat() {
    const chat = document.getElementById('floatingChatBox');
    if (!chat) return;
    chat.classList.toggle('hidden');
    if (window.lucide) lucide.createIcons();
}

// Auth Modal Open/Close & Tabs
function facilityProOpenAuthModal(mode = 'login') {
    const modal = document.getElementById('facilitypro-auth-modal');
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    switchModalAuthTab(mode);
    if (window.lucide) lucide.createIcons();
}

function facilityProCloseAuthModal() {
    const modal = document.getElementById('facilitypro-auth-modal');
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function switchModalAuthTab(mode) {
    const tabLogin = document.getElementById('authModalTabLogin');
    const tabSignup = document.getElementById('authModalTabSignup');
    const formLogin = document.getElementById('modal-login-form');
    const formRegister = document.getElementById('modal-register-form');

    if (mode === 'signup') {
        if (tabSignup) tabSignup.className = 'flex-1 pb-3 text-xs font-bold text-center border-b-2 border-[#0077c8] text-[#0077c8] transition-colors cursor-pointer';
        if (tabLogin) tabLogin.className = 'flex-1 pb-3 text-xs font-bold text-center border-b-2 border-transparent text-slate-400 hover:text-slate-600 transition-colors cursor-pointer';
        if (formRegister) formRegister.classList.remove('hidden');
        if (formLogin) formLogin.classList.add('hidden');
    } else {
        if (tabLogin) tabLogin.className = 'flex-1 pb-3 text-xs font-bold text-center border-b-2 border-[#0077c8] text-[#0077c8] transition-colors cursor-pointer';
        if (tabSignup) tabSignup.className = 'flex-1 pb-3 text-xs font-bold text-center border-b-2 border-transparent text-slate-400 hover:text-slate-600 transition-colors cursor-pointer';
        if (formLogin) formLogin.classList.remove('hidden');
        if (formRegister) formRegister.classList.add('hidden');
    }
    if (window.lucide) lucide.createIcons();
}

// Auth Portal Switcher on /dashboard page
function switchAuthTab(mode) {
    const tabLogin = document.getElementById('authPortalTabLogin');
    const tabRegister = document.getElementById('authPortalTabRegister');
    const formLogin = document.getElementById('facilitypro-portal-login-form');
    const formRegister = document.getElementById('facilitypro-portal-register-form');

    if (mode === 'register') {
        if (tabRegister) tabRegister.className = 'flex-1 pb-3 text-xs font-bold text-center border-b-2 border-[#0077c8] text-[#0077c8] transition-colors cursor-pointer';
        if (tabLogin) tabLogin.className = 'flex-1 pb-3 text-xs font-bold text-center border-b-2 border-transparent text-slate-400 hover:text-slate-600 transition-colors cursor-pointer';
        if (formRegister) formRegister.classList.remove('hidden');
        if (formLogin) formLogin.classList.add('hidden');
    } else {
        if (tabLogin) tabLogin.className = 'flex-1 pb-3 text-xs font-bold text-center border-b-2 border-[#0077c8] text-[#0077c8] transition-colors cursor-pointer';
        if (tabRegister) tabRegister.className = 'flex-1 pb-3 text-xs font-bold text-center border-b-2 border-transparent text-slate-400 hover:text-slate-600 transition-colors cursor-pointer';
        if (formLogin) formLogin.classList.remove('hidden');
        if (formRegister) formRegister.classList.add('hidden');
    }
    if (window.lucide) lucide.createIcons();
}

// User Dashboard Tab Switcher (Sidebar & Mobile Tabs)
function switchDashboardTab(tabId) {
    // 1. Update Desktop Sidebar Buttons
    document.querySelectorAll('.dash-tab-btn').forEach(btn => {
        if (btn.dataset.dashtab === tabId) {
            btn.className = 'dash-tab-btn active w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl font-bold text-xs transition-all bg-gradient-to-r from-slate-900 to-slate-800 text-white shadow-md border border-slate-900 cursor-pointer group';
        } else {
            btn.className = 'dash-tab-btn w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl font-semibold text-xs transition-all bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 cursor-pointer group';
        }
    });

    // 2. Update Mobile Tabs
    document.querySelectorAll('.dash-mobile-tab').forEach(btn => {
        if (btn.dataset.dashtab === tabId) {
            btn.className = 'dash-mobile-tab active px-3.5 py-2 rounded-xl font-bold text-xs whitespace-nowrap transition-all bg-slate-900 text-white shadow-sm cursor-pointer flex items-center gap-1.5';
        } else {
            btn.className = 'dash-mobile-tab px-3.5 py-2 rounded-xl font-semibold text-xs whitespace-nowrap transition-all bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer flex items-center gap-1.5';
        }
    });

    // 3. Show Target Panel
    document.querySelectorAll('.dash-panel').forEach(panel => {
        panel.classList.add('hidden');
    });

    const active = document.getElementById('dashtab-' + tabId);
    if (active) active.classList.remove('hidden');
    if (window.lucide) lucide.createIcons();

    // 4. Update URL Hash
    try {
        if (history.pushState) {
            history.pushState(null, null, '#' + tabId);
        } else {
            location.hash = '#' + tabId;
        }
    } catch(e){}
}

// AJAX Login Handler
async function facilityProHandleLogin(e, context = 'modal') {
    e.preventDefault();
    const form = e.target;
    const msgEl = document.getElementById(context === 'portal' ? 'portal-login-msg' : 'modal-login-msg');
    const submitBtn = form.querySelector('button[type="submit"]');

    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>Verifying credentials...</span>';
    }

    const formData = new FormData(form);
    formData.append('action', 'facilitypro_ajax_login');
    formData.append('nonce', window.facilityProData?.nonce || '');

    try {
        const res = await fetch(window.facilityProData?.ajaxUrl || '/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();

        if (data.success) {
            if (msgEl) {
                msgEl.className = 'p-3 rounded-xl text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200 block';
                msgEl.textContent = data.data.message || 'Login successful!';
            }
            setTimeout(() => {
                window.location.href = data.data.redirect_url || '/dashboard/';
            }, 500);
        } else {
            if (msgEl) {
                msgEl.className = 'p-3 rounded-xl text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200 block';
                msgEl.textContent = data.data || 'Invalid username or password.';
            }
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Sign In to Dashboard</span>';
            }
        }
    } catch (err) {
        if (msgEl) {
            msgEl.className = 'p-3 rounded-xl text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200 block';
            msgEl.textContent = 'Network error. Please retry.';
        }
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<span>Sign In to Dashboard</span>';
        }
    }
}

// AJAX Register Handler
async function facilityProHandleRegister(e, context = 'modal') {
    e.preventDefault();
    const form = e.target;
    const msgEl = document.getElementById(context === 'portal' ? 'portal-register-msg' : 'modal-register-msg');
    const submitBtn = form.querySelector('button[type="submit"]');

    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>Creating Plant Account...</span>';
    }

    const formData = new FormData(form);
    formData.append('action', 'facilitypro_ajax_register');
    formData.append('nonce', window.facilityProData?.nonce || '');

    try {
        const res = await fetch(window.facilityProData?.ajaxUrl || '/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();

        if (data.success) {
            if (msgEl) {
                msgEl.className = 'p-3 rounded-xl text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200 block';
                msgEl.textContent = data.data.message || 'Account created!';
            }
            setTimeout(() => {
                window.location.href = data.data.redirect_url || '/dashboard/';
            }, 500);
        } else {
            if (msgEl) {
                msgEl.className = 'p-3 rounded-xl text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200 block';
                msgEl.textContent = data.data || 'Registration failed.';
            }
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Create Account & Access</span>';
            }
        }
    } catch (err) {
        if (msgEl) {
            msgEl.className = 'p-3 rounded-xl text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200 block';
            msgEl.textContent = 'Network error. Please retry.';
        }
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<span>Create Account & Access</span>';
        }
    }
}

// AJAX Profile Update Handler
async function facilityProHandleProfileUpdate(e) {
    e.preventDefault();
    const form = e.target;
    const msgEl = document.getElementById('profile-update-msg');
    const saveBtn = document.getElementById('profileSaveBtn');

    if (saveBtn) {
        saveBtn.disabled = true;
        saveBtn.textContent = 'Saving...';
    }

    const formData = new FormData(form);
    formData.append('action', 'facilitypro_ajax_update_profile');
    formData.append('nonce', window.facilityProData?.nonce || '');

    try {
        const res = await fetch(window.facilityProData?.ajaxUrl || '/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();

        if (msgEl) {
            if (data.success) {
                msgEl.className = 'p-3 rounded-xl text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200 block';
                msgEl.textContent = data.data || 'Profile updated successfully!';
            } else {
                msgEl.className = 'p-3 rounded-xl text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200 block';
                msgEl.textContent = data.data || 'Failed to update profile.';
            }
        }
    } catch (err) {
        if (msgEl) {
            msgEl.className = 'p-3 rounded-xl text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200 block';
            msgEl.textContent = 'Network error.';
        }
    } finally {
        if (saveBtn) {
            saveBtn.disabled = false;
            saveBtn.textContent = 'Save Profile Changes';
        }
    }
}

function facilityProToggleMobileMenu() {
    const menu = document.getElementById('mobileMenuDrawer');
    if (!menu) return;
    menu.classList.toggle('hidden');
}

function facilityProFilterCategory(categorySlug) {
    // 1. Toggle or Select Category Card
    document.querySelectorAll('.category-card').forEach(card => {
        const iconBox = card.querySelector('.category-icon-box');
        if (card.dataset.category === categorySlug) {
            // Check if already active -> if so, reset to all
            if (card.classList.contains('active') && categorySlug !== 'all') {
                card.classList.remove('active', 'border-[#0077c8]', 'ring-2', 'ring-[#0077c8]/30', 'bg-blue-50/40');
                card.classList.add('border-slate-200/90');
                if (iconBox) {
                    iconBox.className = 'category-icon-box w-11 h-11 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-lg sm:rounded-2xl bg-sky-50 text-[#0077c8] border border-sky-100 flex items-center justify-center transition-all duration-300 mb-1.5 sm:mb-3 shadow-xs group-hover:scale-105 group-hover:bg-[#0077c8] group-hover:text-white';
                }
                categorySlug = 'all';
            } else {
                card.classList.add('active', 'border-[#0077c8]', 'ring-2', 'ring-[#0077c8]/30', 'bg-blue-50/40');
                card.classList.remove('border-slate-200/90');
                if (iconBox) {
                    iconBox.className = 'category-icon-box w-11 h-11 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-lg sm:rounded-2xl bg-[#0077c8] text-white border border-sky-100 flex items-center justify-center transition-all duration-300 mb-1.5 sm:mb-3 shadow-sm';
                }
            }
        } else {
            card.classList.remove('active', 'border-[#0077c8]', 'ring-2', 'ring-[#0077c8]/30', 'bg-blue-50/40');
            card.classList.add('border-slate-200/90');
            if (iconBox) {
                iconBox.className = 'category-icon-box w-11 h-11 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-lg sm:rounded-2xl bg-sky-50 text-[#0077c8] border border-sky-100 flex items-center justify-center transition-all duration-300 mb-1.5 sm:mb-3 shadow-xs group-hover:scale-105 group-hover:bg-[#0077c8] group-hover:text-white';
            }
        }
    });

    // 2. Filter Questions
    const cards = document.querySelectorAll('.question-card');
    cards.forEach(card => {
        if (categorySlug === 'all' || card.dataset.category === categorySlug) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });

    if (window.lucide) {
        lucide.createIcons();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    if (window.lucide) {
        lucide.createIcons();
    }

    const consultForm = document.getElementById('consultationForm');
    if (consultForm) {
        consultForm.addEventListener('submit', handleConsultationSubmit);
    }

    const floatingForm = document.getElementById('floatingChatForm');
    if (floatingForm) {
        floatingForm.addEventListener('submit', handleFloatingChatSubmit);
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            facilityProCloseConsultationModal();
            facilityProCloseAuthModal();
        }
    });
});
