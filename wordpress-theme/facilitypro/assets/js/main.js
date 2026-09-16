/**
 * FacilityPro Main Theme Controller & User Authentication
 */

// AI Consultation Modal & Point-to-Point Reasoning
function facilityProOpenConsultationModal(prefillQuery = '', expertName = '', discipline = 'hvac') {
    const modal = document.getElementById('facilitypro-consultation-modal') || document.getElementById('consultationModal');
    if (!modal) return;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    if (prefillQuery) {
        const queryInput = document.getElementById('modal-query-input');
        if (queryInput) queryInput.value = prefillQuery;
        
        facilityProFetchConsultationSolution(prefillQuery, discipline, expertName);
    } else {
        const userQueryText = document.getElementById('modal-user-query-text');
        if (userQueryText) userQueryText.textContent = 'Enter your facility engineering question below...';
        const answerEl = document.getElementById('modal-ai-answer-content');
        if (answerEl) {
            answerEl.innerHTML = '<p class="text-xs text-slate-600">Type any complex HVAC, Electrical, Fire, Plumbing, STP, DG, BMS, or Solar query to receive instant derivations and IS/NBC code clauses.</p>';
        }
    }

    if (window.lucide) lucide.createIcons();
}

function facilityProCloseConsultationModal() {
    const modal = document.getElementById('facilitypro-consultation-modal') || document.getElementById('consultationModal');
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function facilityProHandleHeroSearch(e) {
    if (e && e.preventDefault) e.preventDefault();
    const input = document.getElementById('hero-search-input');
    const query = input ? input.value.trim() : '';
    if (query) {
        facilityProOpenConsultationModal(query, 'Er. Rajesh Sharma', 'general');
    } else {
        facilityProOpenConsultationModal('Calculate plant equipment efficiency and sizing derivation.', 'Er. Rajesh Sharma', 'hvac');
    }
}

async function facilityProFetchConsultationSolution(query, discipline = 'general', expertName = '') {
    const answerEl = document.getElementById('modal-ai-answer-content');
    const userQueryEl = document.getElementById('modal-user-query-text');
    const expertNameEl = document.getElementById('modal-expert-name');
    const expertTitleEl = document.getElementById('modal-expert-title');
    const expertAvatarEl = document.getElementById('modal-expert-avatar');

    if (userQueryEl) userQueryEl.textContent = query;
    if (answerEl) {
        answerEl.innerHTML = `
            <div class="flex items-center gap-3 py-6 justify-center text-slate-500 text-xs">
                <i data-lucide="loader-2" class="w-5 h-5 animate-spin text-[#0077c8]"></i>
                <span>Formulating thermodynamic derivations and IS/NBC code clauses...</span>
            </div>`;
        if (window.lucide) lucide.createIcons();
    }

    const expertProfiles = {
        'Er. Rajesh Sharma': { title: 'Senior HVAC & Central Chilled Water AI Specialist', avatar: 'avatar_rajesh_sharma.jpg' },
        'Dr. Vikram Malhotra': { title: 'Chief Electrical & Substation Engineer (PhD, PE)', avatar: 'avatar_vikram_malhotra.jpg' },
        'Er. Amit Patel': { title: 'Lead Plumbing & Hydro-Pneumatics Specialist (M.Tech)', avatar: 'avatar_amit_patel.jpg' },
        'Er. Ananya Verma': { title: 'Senior Fire Protection & Life Safety Consultant (NFPA Cert.)', avatar: 'avatar_ananya_verma.jpg' }
    };

    if (expertName && expertProfiles[expertName]) {
        if (expertNameEl) expertNameEl.textContent = expertName;
        if (expertTitleEl) expertTitleEl.textContent = expertProfiles[expertName].title;
        if (expertAvatarEl && window.facilityProData?.themeUri) {
            expertAvatarEl.src = window.facilityProData.themeUri + '/assets/images/' + expertProfiles[expertName].avatar;
        }
    }

    const formData = new FormData();
    formData.append('action', 'facilitypro_openai_consultation');
    formData.append('nonce', window.facilityProData?.nonce || '');
    formData.append('discipline', discipline || 'general');
    formData.append('urgency', 'high');
    formData.append('problem_details', query);

    try {
        const res = await fetch(window.facilityProData?.ajaxUrl || '/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();

        if (data.success && data.data) {
            if (answerEl) {
                answerEl.innerHTML = typeof formatMarkdownToHtml === 'function' 
                    ? formatMarkdownToHtml(data.data.response) 
                    : data.data.response.replace(/\n/g, '<br>');
            }
            if (data.data.expert_name && expertNameEl) {
                expertNameEl.textContent = data.data.expert_name;
            }
            if (data.data.expert_role && expertTitleEl) {
                expertTitleEl.textContent = data.data.expert_role;
            }
        } else {
            if (answerEl) {
                answerEl.innerHTML = `<div class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-xs text-rose-800 font-semibold">${data.data || 'Failed to generate solution.'}</div>`;
            }
        }
    } catch (err) {
        if (answerEl) {
            answerEl.innerHTML = `<div class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-xs text-rose-800 font-semibold">Network error connecting to AI engine.</div>`;
        }
    } finally {
        if (window.lucide) lucide.createIcons();
    }
}

function facilityProHandleModalSubmit(e) {
    if (e && e.preventDefault) e.preventDefault();
    const input = document.getElementById('modal-query-input');
    const query = input ? input.value.trim() : '';
    if (query) {
        facilityProFetchConsultationSolution(query);
        input.value = '';
    }
}

function facilityProExportModalAnswer() {
    window.print();
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


// Robust Mobile Navigation Sidebar Drawer Controller
function facilityProToggleMobileMenu() {
    const drawer = document.getElementById('mobileSidebarDrawer');
    if (!drawer) return;
    if (drawer.style.display === 'none' || drawer.classList.contains('hidden')) {
        facilityProOpenMobileMenu();
    } else {
        facilityProCloseMobileMenu();
    }
}

function facilityProOpenMobileMenu() {
    const drawer = document.getElementById('mobileSidebarDrawer');
    const content = document.getElementById('mobileDrawerContent');
    if (!drawer || !content) return;
    drawer.style.display = 'block';
    drawer.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    setTimeout(() => {
        content.classList.remove('-translate-x-full');
        content.classList.add('translate-x-0');
    }, 20);
    if (window.lucide) lucide.createIcons();
}

function facilityProCloseMobileMenu() {
    const drawer = document.getElementById('mobileSidebarDrawer');
    const content = document.getElementById('mobileDrawerContent');
    if (!drawer || !content) return;
    content.classList.remove('translate-x-0');
    content.classList.add('-translate-x-full');
    document.body.classList.remove('overflow-hidden');
    setTimeout(() => {
        drawer.classList.add('hidden');
        drawer.style.display = 'none';
    }, 300);
}

function facilityProToggleMobileAccordion(submenuId, chevronId) {
    const sub = document.getElementById(submenuId);
    const chev = chevronId ? document.getElementById(chevronId) : null;
    if (!sub) return;
    const isHidden = sub.classList.contains('hidden');
    if (isHidden) {
        sub.classList.remove('hidden');
        if (chev) chev.classList.add('rotate-180');
    } else {
        sub.classList.add('hidden');
        if (chev) chev.classList.remove('rotate-180');
    }
}

function facilityProToggleMobileMechanical() {
    facilityProToggleMobileAccordion('mobileMechanicalSubmenu', 'mobileMechChevron');
}

function facilityProFilterCategory(catId) {
    let target = (catId || 'all').toLowerCase();
    if (target === 'fire') target = 'firefighting';
    if (target === 'dgset') target = 'dg';

    // 1. Highlight Category Cards
    document.querySelectorAll('.category-card').forEach(card => {
        let cCat = card.dataset.category ? card.dataset.category.toLowerCase() : '';
        if (cCat === 'fire') cCat = 'firefighting';
        if (cCat === 'dgset') cCat = 'dg';

        if (target === 'all' || cCat === target) {
            card.classList.remove('opacity-40', 'grayscale');
            card.classList.add('opacity-100');
            if (cCat === target) {
                card.classList.add('border-[#0077c8]', 'bg-sky-50/50', 'ring-2', 'ring-[#0077c8]/20');
            } else {
                card.classList.remove('border-[#0077c8]', 'bg-sky-50/50', 'ring-2', 'ring-[#0077c8]/20');
            }
        } else {
            card.classList.remove('border-[#0077c8]', 'bg-sky-50/50', 'ring-2', 'ring-[#0077c8]/20');
            card.classList.add('opacity-40', 'grayscale');
        }
    });

    // 2. Filter Homepage Featured Blog Cards
    const blogCards = document.querySelectorAll('#homeBlogCardsGrid .blog-card');
    let visibleCount = 0;
    blogCards.forEach(card => {
        let bDisc = card.dataset.discipline ? card.dataset.discipline.toLowerCase() : '';
        if (bDisc === 'fire') bDisc = 'firefighting';
        if (bDisc === 'dgset') bDisc = 'dg';

        if (target === 'all' || bDisc === target) {
            card.style.display = 'flex';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    // 3. Update Filter Label on Homepage
    const labelEl = document.getElementById('currentFilterLabel');
    if (labelEl) {
        if (target === 'all') {
            labelEl.textContent = 'Showing All Engineering Articles';
        } else {
            labelEl.textContent = 'Filtered: ' + target.toUpperCase() + ' (' + visibleCount + ' articles)';
        }
    }

    // 4. Scroll smoothly to Featured Blogs on homepage
    const blogSec = document.getElementById('featured-blogs-section');
    if (blogSec && target !== 'all') {
        blogSec.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // 5. Also trigger Knowledge Hub filtering if on Knowledge Hub page
    facilityProFilterKb(target);

    if (window.lucide) lucide.createIcons();
}

function facilityProFilterKb(catId) {
    let target = (catId || 'all').toLowerCase();
    if (target === 'fire') target = 'firefighting';
    if (target === 'dgset') target = 'dg';

    // Update Knowledge Hub Filter Buttons
    document.querySelectorAll('.kb-filter-btn').forEach(btn => {
        let bFilter = btn.dataset.kbfilter ? btn.dataset.kbfilter.toLowerCase() : '';
        if (bFilter === 'fire') bFilter = 'firefighting';
        if (bFilter === 'dgset') bFilter = 'dg';

        if (bFilter === target) {
            btn.className = 'kb-filter-btn active px-4 py-2 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap bg-slate-900 text-white shadow-sm border border-slate-900 cursor-pointer';
        } else {
            btn.className = 'kb-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold whitespace-nowrap bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer';
        }
    });

    // Filter Knowledge Hub Cards
    const kbCards = document.querySelectorAll('#kbCardsGrid .kb-card');
    kbCards.forEach(card => {
        let cardDisc = card.dataset.discipline ? card.dataset.discipline.toLowerCase() : '';
        if (cardDisc === 'fire') cardDisc = 'firefighting';
        if (cardDisc === 'dgset') cardDisc = 'dg';

        if (target === 'all' || cardDisc === target) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });

    if (window.lucide) lucide.createIcons();
}

// Auto-filter on page load if ?discipline= is in URL
document.addEventListener('DOMContentLoaded', () => {
    try {
        const urlParams = new URLSearchParams(window.location.search);
        const discParam = urlParams.get('discipline');
        if (discParam) {
            facilityProFilterCategory(discParam);
        }
    } catch (e) {}
});

function initCyclingDisciplines() {
    const el = document.getElementById('cyclingDiscipline');
    if (!el) return;
    setInterval(() => {
        cyclingDisciplineIndex = (cyclingDisciplineIndex + 1) % cyclingDisciplines.length;
        el.style.opacity = '0';
        el.style.transform = 'translateY(-6px)';
        setTimeout(() => {
            el.textContent = cyclingDisciplines[cyclingDisciplineIndex];
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, 250);
    }, 3000);
}

function facilityProToggleMobileAccordion(submenuId, chevronId) {
    const sub = document.getElementById(submenuId);
    const chev = document.getElementById(chevronId);
    if (!sub) return;
    sub.classList.toggle('hidden');
    if (chev) {
        chev.classList.toggle('rotate-180');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    initCyclingDisciplines();

    // Auto switch dashboard tab based on URL hash (e.g. #vault or #approvals)
    try {
        const hash = window.location.hash.replace('#', '');
        if (hash && document.getElementById('dashtab-' + hash)) {
            switchDashboardTab(hash);
        }
    } catch(e) {}
});

// Admin User Status Handler (Approve / Reject / Pending)
async function facilityProUpdateUserStatus(userId, newStatus, btnEl) {
    if (!userId || !newStatus) return;
    
    const rowEl = document.getElementById(`user-row-${userId}`);
    const originalText = btnEl ? btnEl.innerHTML : '';
    if (btnEl) {
        btnEl.disabled = true;
        btnEl.innerHTML = '<span class="inline-block animate-spin">⏳</span> Updating...';
    }

    const formData = new FormData();
    formData.append('action', 'facilitypro_admin_update_user_status');
    formData.append('target_user_id', userId);
    formData.append('target_status', newStatus);
    formData.append('nonce', window.facilityProData?.nonce || '');

    try {
        const res = await fetch(window.facilityProData?.ajaxUrl || '/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();

        if (data.success) {
            const statusBadge = document.getElementById(`user-status-badge-${userId}`);
            const actionsCell = document.getElementById(`user-actions-${userId}`);
            
            if (rowEl) {
                rowEl.dataset.userStatus = newStatus;
            }

            if (statusBadge) {
                if (newStatus === 'approved') {
                    statusBadge.className = 'inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300';
                    statusBadge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Approved';
                } else if (newStatus === 'rejected') {
                    statusBadge.className = 'inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-300';
                    statusBadge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Rejected';
                } else {
                    statusBadge.className = 'inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-300';
                    statusBadge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending';
                }
            }

            if (actionsCell) {
                let html = '';
                if (newStatus === 'approved') {
                    html = `<button onclick="facilityProUpdateUserStatus(${userId}, 'rejected', this)" class="px-2.5 py-1 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 rounded-lg text-xs font-bold transition-colors cursor-pointer">Revoke / Reject</button>`;
                } else if (newStatus === 'rejected') {
                    html = `<button onclick="facilityProUpdateUserStatus(${userId}, 'approved', this)" class="px-3 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition-colors shadow-xs cursor-pointer flex items-center gap-1"><span>✓</span> Approve</button>`;
                } else {
                    html = `<button onclick="facilityProUpdateUserStatus(${userId}, 'approved', this)" class="px-3 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition-colors shadow-xs cursor-pointer flex items-center gap-1"><span>✓</span> Approve</button> <button onclick="facilityProUpdateUserStatus(${userId}, 'rejected', this)" class="px-2.5 py-1 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 rounded-lg text-xs font-bold transition-colors cursor-pointer">Reject</button>`;
                }
                actionsCell.innerHTML = html;
            }

            const pendingCounter = document.getElementById('sidebar-pending-counter');
            if (pendingCounter && data.data.pending_count !== undefined) {
                pendingCounter.textContent = `${data.data.pending_count} Pending`;
                pendingCounter.className = data.data.pending_count > 0 ? 'px-2 py-0.5 rounded-full text-[10px] font-black bg-amber-500 text-white animate-pulse' : 'px-2 py-0.5 rounded-full text-[10px] font-black bg-slate-200 text-slate-600';
            }

            const toast = document.getElementById('admin-approvals-toast');
            if (toast) {
                toast.className = 'p-3 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 block mb-4';
                toast.textContent = data.data.message || 'Status updated.';
                setTimeout(() => { toast.className = 'hidden'; }, 4000);
            }
        } else {
            alert(data.data || 'Failed to update user status.');
            if (btnEl) {
                btnEl.disabled = false;
                btnEl.innerHTML = originalText;
            }
        }
    } catch (err) {
        alert('Network error while updating status.');
        if (btnEl) {
            btnEl.disabled = false;
            btnEl.innerHTML = originalText;
        }
    }
}

// Filter Users in Approvals Tab
function facilityProFilterUsers(filterStatus) {
    document.querySelectorAll('.user-filter-btn').forEach(btn => {
        if (btn.dataset.statusFilter === filterStatus) {
            btn.className = 'user-filter-btn active px-3 py-1.5 rounded-xl text-xs font-bold bg-slate-900 text-white shadow-sm border border-slate-900 cursor-pointer';
        } else {
            btn.className = 'user-filter-btn px-3 py-1.5 rounded-xl text-xs font-semibold bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer';
        }
    });

    document.querySelectorAll('.user-approval-row').forEach(row => {
        const rowStatus = row.dataset.userStatus;
        row.style.display = (filterStatus === 'all' || rowStatus === filterStatus) ? '' : 'none';
    });
}

// Premium Vault File Download Handler
async function facilityProDownloadFile(fileId, btnEl) {
    if (!fileId) return;
    const origText = btnEl ? btnEl.innerHTML : '';
    if (btnEl) {
        btnEl.disabled = true;
        btnEl.innerHTML = '<span class="inline-block animate-spin">⏳</span> Verifying Access...';
    }

    const formData = new FormData();
    formData.append('action', 'facilitypro_download_premium_file');
    formData.append('file_id', fileId);
    formData.append('nonce', window.facilityProData?.nonce || '');

    try {
        const res = await fetch(window.facilityProData?.ajaxUrl || '/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();

        if (data.success) {
            if (btnEl) {
                btnEl.innerHTML = '<span>✓ Access Granted!</span>';
                setTimeout(() => {
                    btnEl.disabled = false;
                    btnEl.innerHTML = origText;
                }, 2500);
            }
            if (data.data.download_url) {
                window.open(data.data.download_url, '_blank');
            }
        } else {
            if (btnEl) {
                btnEl.disabled = false;
                btnEl.innerHTML = origText;
            }
            if (data.data?.locked) {
                if (confirm(data.data.message + "\n\nWould you like to view Pro subscription plans?")) {
                    window.location.href = data.data.plan_url || '/pricing/';
                }
            } else {
                alert(data.data?.message || data.data || 'Could not verify download.');
            }
        }
    } catch (err) {
        alert('Network error while processing download.');
        if (btnEl) {
            btnEl.disabled = false;
            btnEl.innerHTML = origText;
        }
    }
}

// Filter Vault Files by Discipline
function facilityProFilterVaultFiles(disc) {
    document.querySelectorAll('.vault-filter-btn').forEach(btn => {
        if (btn.dataset.vaultDisc === disc) {
            btn.className = 'vault-filter-btn active px-3 py-1.5 rounded-xl text-xs font-bold bg-slate-900 text-white shadow-sm border border-slate-900 cursor-pointer';
        } else {
            btn.className = 'vault-filter-btn px-3 py-1.5 rounded-xl text-xs font-semibold bg-white text-slate-700 hover:bg-slate-100 border border-slate-200 cursor-pointer';
        }
    });

    document.querySelectorAll('.vault-file-card').forEach(card => {
        const cardDisc = card.dataset.discipline;
        card.style.display = (disc === 'all' || cardDisc === disc) ? '' : 'none';
    });
}

// Modal open/close for adding premium file
function facilityProOpenAddFileModal() {
    const m = document.getElementById('adminAddFileModal');
    if (m) m.classList.remove('hidden');
}

function facilityProCloseAddFileModal() {
    const m = document.getElementById('adminAddFileModal');
    if (m) m.classList.add('hidden');
}

// Handle Admin Save Premium File
async function facilityProHandleSavePremiumFile(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const msgEl = document.getElementById('admin-file-save-msg');

    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>Saving File to Vault...</span>';
    }

    const formData = new FormData(form);
    formData.append('action', 'facilitypro_admin_save_premium_file');
    formData.append('nonce', window.facilityProData?.nonce || '');

    try {
        const res = await fetch(window.facilityProData?.ajaxUrl || '/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();

        if (data.success) {
            if (msgEl) {
                msgEl.className = 'p-3 rounded-xl text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200 block mb-3';
                msgEl.textContent = data.data.message || 'File saved!';
            }
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            if (msgEl) {
                msgEl.className = 'p-3 rounded-xl text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200 block mb-3';
                msgEl.textContent = data.data || 'Failed to save file.';
            }
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Save to Vault</span>';
            }
        }
    } catch (err) {
        if (msgEl) {
            msgEl.className = 'p-3 rounded-xl text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200 block mb-3';
            msgEl.textContent = 'Network error.';
        }
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<span>Save to Vault</span>';
        }
    }
}

// Handle Admin Delete Premium File
async function facilityProHandleDeletePremiumFile(fileId, btnEl) {
    if (!fileId || !confirm('Are you sure you want to remove this premium file from the vault?')) return;

    const formData = new FormData();
    formData.append('action', 'facilitypro_admin_delete_premium_file');
    formData.append('file_id', fileId);
    formData.append('nonce', window.facilityProData?.nonce || '');

    try {
        const res = await fetch(window.facilityProData?.ajaxUrl || '/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        });
        const data = await res.json();
        if (data.success) {
            const card = document.getElementById(`vault-card-${fileId}`);
            if (card) card.remove();
        } else {
            alert(data.data || 'Failed to delete file.');
        }
    } catch (err) {
        alert('Network error.');
    }
}
