import React, { useState } from 'react';
import { 
  Wrench, 
  ChevronDown, 
  Settings, 
  Key, 
  Menu, 
  X, 
  ShieldCheck,
  Flame,
  Wind,
  Droplets,
  Zap,
  BookOpen,
  FileText,
  CheckSquare,
  Calculator,
  User,
  LayoutDashboard,
  Sparkles,
  CreditCard
} from 'lucide-react';

export const Navbar = ({ 
  activeView = 'home', 
  onNavigate, 
  onOpenSettings, 
  onOpenAuth, 
  onOpenApply, 
  onStartAiChat,
  hasApiKey, 
  onSelectCategory 
}) => {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [aboutDropdownOpen, setAboutDropdownOpen] = useState(false);

  const navItems = [
    { id: 'home', label: 'Home' },
    { id: 'calculators', label: 'Calculators', icon: Calculator },
    { id: 'knowledge', label: 'Knowledge Hub', icon: BookOpen },
    { id: 'sops', label: 'SOPs', icon: FileText },
    { id: 'checklists', label: 'Checklists', icon: CheckSquare },
    { id: 'dashboard', label: 'Dashboard', icon: User },
    { id: 'admin', label: 'Admin', icon: LayoutDashboard },
  ];

  return (
    <nav className="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 transition-all">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16 sm:h-20">
          
          {/* Brand Logo matching JustAnswer layout with MEP Wrench */}
          <div className="flex items-center gap-6">
            <button 
              onClick={() => onNavigate('home')} 
              className="flex items-center gap-2.5 group cursor-pointer text-left"
            >
              <div className="relative flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-tr from-[#0077c8] via-[#0099f7] to-[#f05423] text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-200">
                <Wrench className="w-5 h-5 stroke-[2.4]" />
                <span className="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></span>
              </div>
              <div className="flex flex-col">
                <div className="flex items-center">
                  <span className="text-2xl font-black tracking-tight text-slate-900">Facility</span>
                  <span className="text-2xl font-black tracking-tight text-[#f05423] ml-0.5">Pro</span>
                  <span className="text-[10px] font-bold text-[#0077c8] ml-1.5 px-1.5 py-0.5 rounded bg-blue-50 border border-blue-200/60 uppercase tracking-widest hidden sm:inline-block">MEP & AI</span>
                </div>
                <span className="text-[11px] font-semibold text-slate-400 -mt-1 tracking-tight">HVAC • Plumbing • Electrical • Fire</span>
              </div>
            </button>
          </div>

          {/* Desktop Navigation Links */}
          <div className="hidden lg:flex items-center gap-1 text-xs font-bold text-slate-600">
            
            {/* Quick MEP Category Trigger */}
            <div className="relative mr-1">
              <button 
                onClick={() => setAboutDropdownOpen(!aboutDropdownOpen)}
                onBlur={() => setTimeout(() => setAboutDropdownOpen(false), 200)}
                className="flex items-center gap-1 hover:text-[#0077c8] transition-colors py-2 px-2.5 rounded-lg hover:bg-slate-50 cursor-pointer"
              >
                <span>Disciplines</span>
                <ChevronDown className={`w-3.5 h-3.5 transition-transform duration-200 ${aboutDropdownOpen ? 'rotate-180 text-[#0077c8]' : ''}`} />
              </button>
              
              {aboutDropdownOpen && (
                <div className="absolute top-full left-0 mt-1 w-64 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50 animate-in fade-in slide-in-from-top-2 duration-150">
                  <button 
                    onClick={() => { onNavigate('home'); onSelectCategory('hvac'); }}
                    className="w-full text-left px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-sky-50 hover:text-[#0077c8] flex items-center gap-2 cursor-pointer"
                  >
                    <Wind className="w-4 h-4 text-sky-500" />
                    <span>HVAC & Chiller Plants</span>
                  </button>
                  <button 
                    onClick={() => { onNavigate('home'); onSelectCategory('plumbing'); }}
                    className="w-full text-left px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-blue-50 hover:text-[#0077c8] flex items-center gap-2 cursor-pointer"
                  >
                    <Droplets className="w-4 h-4 text-blue-500" />
                    <span>Plumbing, Pumps & Drainage</span>
                  </button>
                  <button 
                    onClick={() => { onNavigate('home'); onSelectCategory('electrical'); }}
                    className="w-full text-left px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-amber-50 hover:text-[#0077c8] flex items-center gap-2 cursor-pointer"
                  >
                    <Zap className="w-4 h-4 text-amber-500" />
                    <span>Electrical, Transformers & DG</span>
                  </button>
                  <button 
                    onClick={() => { onNavigate('home'); onSelectCategory('firefighting'); }}
                    className="w-full text-left px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-rose-50 hover:text-[#0077c8] flex items-center gap-2 cursor-pointer"
                  >
                    <Flame className="w-4 h-4 text-rose-500" />
                    <span>Fire Fighting & NFPA Systems</span>
                  </button>
                </div>
              )}
            </div>

            {/* Navigation Tabs */}
            {navItems.map((item) => {
              const isActive = activeView === item.id;
              return (
                <button
                  key={item.id}
                  onClick={() => onNavigate(item.id)}
                  className={`px-3 py-2 rounded-lg transition-all cursor-pointer ${
                    isActive 
                      ? 'bg-slate-900 text-white shadow-xs' 
                      : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100'
                  }`}
                >
                  {item.label}
                </button>
              );
            })}

            {/* AI Assistant Quick Trigger Button */}
            <button
              onClick={() => onStartAiChat()}
              className="ml-1 flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-orange-50 hover:bg-orange-100 text-[#f05423] border border-orange-200 transition-colors cursor-pointer"
            >
              <Sparkles className="w-3.5 h-3.5 text-[#f05423]" />
              <span>Ask AI</span>
            </button>
          </div>

          {/* Right Action Buttons */}
          <div className="hidden md:flex items-center gap-3">
            <button
              onClick={onOpenAuth}
              className="px-4 py-2 text-xs font-bold text-slate-700 hover:text-[#0077c8] border border-slate-300 hover:border-[#0077c8] rounded-lg transition-all cursor-pointer shadow-xs"
            >
              Log in
            </button>
          </div>

          {/* Mobile Menu Button */}
          <div className="flex lg:hidden items-center gap-2">
            <button
              onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
              className="p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 cursor-pointer"
            >
              {mobileMenuOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
            </button>
          </div>

        </div>
      </div>

      {/* Mobile Menu Drawer */}
      {mobileMenuOpen && (
        <div className="lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-3 animate-in slide-in-from-top duration-200">
          <div className="grid grid-cols-2 gap-2 pb-2">
            <button
              onClick={() => { setMobileMenuOpen(false); onNavigate('home'); onSelectCategory('hvac'); }}
              className="p-2 text-xs font-bold rounded-lg bg-sky-50 text-sky-700 text-left flex items-center gap-1.5"
            >
              <Wind className="w-3.5 h-3.5" /> HVAC
            </button>
            <button
              onClick={() => { setMobileMenuOpen(false); onNavigate('home'); onSelectCategory('plumbing'); }}
              className="p-2 text-xs font-bold rounded-lg bg-blue-50 text-blue-700 text-left flex items-center gap-1.5"
            >
              <Droplets className="w-3.5 h-3.5" /> Plumbing
            </button>
            <button
              onClick={() => { setMobileMenuOpen(false); onNavigate('home'); onSelectCategory('electrical'); }}
              className="p-2 text-xs font-bold rounded-lg bg-amber-50 text-amber-700 text-left flex items-center gap-1.5"
            >
              <Zap className="w-3.5 h-3.5" /> Electrical
            </button>
            <button
              onClick={() => { setMobileMenuOpen(false); onNavigate('home'); onSelectCategory('firefighting'); }}
              className="p-2 text-xs font-bold rounded-lg bg-rose-50 text-rose-700 text-left flex items-center gap-1.5"
            >
              <Flame className="w-3.5 h-3.5" /> Fire Fighting
            </button>
          </div>

          <div className="space-y-1">
            {navItems.map((item) => (
              <button
                key={item.id}
                onClick={() => { setMobileMenuOpen(false); onNavigate(item.id); }}
                className={`w-full text-left px-3 py-2 rounded-md text-sm font-semibold ${
                  activeView === item.id ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-100'
                }`}
              >
                {item.label}
              </button>
            ))}
            <button
              onClick={() => { setMobileMenuOpen(false); onStartAiChat(); }}
              className="w-full text-left px-3 py-2 rounded-md text-sm font-bold text-[#f05423] hover:bg-orange-50 flex items-center gap-2"
            >
              <Sparkles className="w-4 h-4" />
              <span>Ask AI Engineering Assistant</span>
            </button>
            <button
              onClick={() => { setMobileMenuOpen(false); onOpenApply(); }}
              className="w-full text-left px-3 py-2 rounded-md text-sm font-semibold text-slate-700 hover:bg-slate-100"
            >
              Become an MEP Expert
            </button>
          </div>
          
          <div className="pt-3 border-t border-slate-200 flex flex-col gap-2">
            <button
              onClick={() => { setMobileMenuOpen(false); onOpenSettings(); }}
              className="w-full flex items-center justify-center gap-2 py-2 px-4 text-xs font-semibold rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-800"
            >
              <Settings className="w-4 h-4" />
              OpenAI API Settings ({hasApiKey ? 'Connected' : 'Demo Mode'})
            </button>
            <button
              onClick={() => { setMobileMenuOpen(false); onOpenAuth(); }}
              className="w-full py-2.5 px-4 text-sm font-semibold rounded-lg bg-[#0077c8] hover:bg-[#0066ad] text-white text-center shadow-md"
            >
              Log in / Sign up
            </button>
          </div>
        </div>
      )}
    </nav>
  );
};

export default Navbar;
