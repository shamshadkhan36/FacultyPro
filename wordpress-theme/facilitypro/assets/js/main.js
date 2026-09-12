/**
 * FacilityPro Main Theme Controller
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

function facilityProOpenAuthModal(mode = 'login') {
    const modal = document.getElementById('authModal');
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    const loginTab = document.getElementById('authLoginTab');
    const signupTab = document.getElementById('authSignupTab');
    const loginForm = document.getElementById('authLoginForm');
    const signupForm = document.getElementById('authSignupForm');

    if (mode === 'signup') {
        if (signupTab) signupTab.classList.add('border-[#0077c8]', 'text-[#0077c8]');
        if (loginTab) loginTab.classList.remove('border-[#0077c8]', 'text-[#0077c8]');
        if (signupForm) signupForm.classList.remove('hidden');
        if (loginForm) loginForm.classList.add('hidden');
    } else {
        if (loginTab) loginTab.classList.add('border-[#0077c8]', 'text-[#0077c8]');
        if (signupTab) signupTab.classList.remove('border-[#0077c8]', 'text-[#0077c8]');
        if (loginForm) loginForm.classList.remove('hidden');
        if (signupForm) signupForm.classList.add('hidden');
    }
}

function facilityProCloseAuthModal() {
    const modal = document.getElementById('authModal');
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function facilityProToggleMobileMenu() {
    const menu = document.getElementById('mobileMenuDrawer');
    if (!menu) return;
    menu.classList.toggle('hidden');
}

function facilityProFilterCategory(categorySlug) {
    document.querySelectorAll('.category-pill-btn').forEach(btn => {
        if (btn.dataset.category === categorySlug) {
            btn.className = 'category-pill-btn active px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap bg-slate-900 text-white transition-all shadow-md';
        } else {
            btn.className = 'category-pill-btn px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap bg-slate-100 text-slate-700 hover:bg-slate-200 transition-all';
        }
    });

    const cards = document.querySelectorAll('.question-card');
    cards.forEach(card => {
        if (categorySlug === 'all' || card.dataset.category === categorySlug) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
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
