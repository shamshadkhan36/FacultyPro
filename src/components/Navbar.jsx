import React, { useState } from 'react';
import { 
  GraduationCap, 
  ChevronDown, 
  Settings, 
  Sparkles, 
  User, 
  Menu, 
  X, 
  Key, 
  HelpCircle,
  Award,
  Layers
} from 'lucide-react';

export const Navbar = ({ onOpenSettings, onOpenAuth, onOpenApply, hasApiKey, onSelectCategory }) => {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [aboutDropdownOpen, setAboutDropdownOpen] = useState(false);

  return (
    <nav className="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 transition-all">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16 sm:h-20">
          
          {/* Brand Logo matching JustAnswer layout */}
          <div className="flex items-center gap-6">
            <a href="#" className="flex items-center gap-2.5 group">
              <div className="relative flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-tr from-[#0077c8] via-[#0099f7] to-[#f05423] text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-200">
                <GraduationCap className="w-6 h-6 stroke-[2.2]" />
                <span className="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></span>
              </div>
              <div className="flex flex-col">
                <div className="flex items-center">
                  <span className="text-2xl font-black tracking-tight text-slate-900">Faculty</span>
                  <span className="text-2xl font-black tracking-tight text-[#f05423] ml-0.5">Pro</span>
                  <span className="text-[10px] font-bold text-[#0077c8] ml-1.5 px-1.5 py-0.5 rounded bg-blue-50 border border-blue-200/60 uppercase tracking-widest hidden sm:inline-block">AI & Faculty</span>
                </div>
                <span className="text-[11px] font-medium text-slate-400 -mt-1 tracking-tight">Verified Academic Q&A</span>
              </div>
            </a>
          </div>

          {/* Desktop Navigation Links */}
          <div className="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
            
            {/* About us Dropdown */}
            <div className="relative">
              <button 
                onClick={() => setAboutDropdownOpen(!aboutDropdownOpen)}
                onBlur={() => setTimeout(() => setAboutDropdownOpen(false), 200)}
                className="flex items-center gap-1 hover:text-[#0077c8] transition-colors py-2 cursor-pointer"
              >
                About us
                <ChevronDown className={`w-4 h-4 transition-transform duration-200 ${aboutDropdownOpen ? 'rotate-180 text-[#0077c8]' : ''}`} />
              </button>
              
              {aboutDropdownOpen && (
                <div className="absolute top-full left-0 mt-1 w-56 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50 animate-in fade-in slide-in-from-top-2 duration-150">
                  <a href="#how-it-works" className="block px-4 py-2.5 text-xs font-medium text-slate-700 hover:bg-blue-50 hover:text-[#0077c8]">
                    How FacultyPro Works
                  </a>
                  <a href="#experts" className="block px-4 py-2.5 text-xs font-medium text-slate-700 hover:bg-blue-50 hover:text-[#0077c8]">
                    Our Verified Professors
                  </a>
                  <a href="#why-us" className="block px-4 py-2.5 text-xs font-medium text-slate-700 hover:bg-blue-50 hover:text-[#0077c8]">
                    Academic Quality & Verification
                  </a>
                  <div className="border-t border-slate-100 my-1"></div>
                  <a href="#popular" className="block px-4 py-2.5 text-xs font-medium text-slate-700 hover:bg-blue-50 hover:text-[#0077c8]">
                    Student & Scholar Reviews
                  </a>
                </div>
              )}
            </div>

            <a href="#pricing" className="hover:text-[#0077c8] transition-colors">Pricing</a>
            <button onClick={onOpenApply} className="hover:text-[#0077c8] transition-colors cursor-pointer">Become an Expert</button>
            <a href="#pricing" className="hover:text-[#0077c8] transition-colors">Affiliate Partners</a>
            <a href="#how-it-works" className="hover:text-[#0077c8] transition-colors">Help</a>
          </div>

          {/* Right Action Buttons */}
          <div className="hidden md:flex items-center gap-3">
            <button
              onClick={onOpenSettings}
              className={`flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold border transition-all cursor-pointer ${
                hasApiKey
                  ? 'bg-emerald-50 text-emerald-700 border-emerald-300 hover:bg-emerald-100'
                  : 'bg-amber-50 text-amber-700 border-amber-300 hover:bg-amber-100'
              }`}
              title="Configure OpenAI API settings"
            >
              <Key className="w-3.5 h-3.5" />
              <span>{hasApiKey ? 'OpenAI Live' : 'OpenAI Demo'}</span>
              <Settings className="w-3 h-3 ml-0.5 opacity-60" />
            </button>

            <button
              onClick={onOpenAuth}
              className="px-4 py-2 text-sm font-semibold text-slate-700 hover:text-[#0077c8] border border-slate-300 hover:border-[#0077c8] rounded-lg transition-all duration-150 cursor-pointer shadow-xs"
            >
              Log in
            </button>
          </div>

          {/* Mobile Menu Button */}
          <div className="flex md:hidden items-center gap-2">
            <button
              onClick={onOpenSettings}
              className={`p-2 rounded-lg text-xs border ${
                hasApiKey ? 'bg-emerald-50 text-emerald-700 border-emerald-300' : 'bg-amber-50 text-amber-700 border-amber-300'
              }`}
            >
              <Key className="w-4 h-4" />
            </button>
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
        <div className="md:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-3 animate-in slide-in-from-top duration-200">
          <a 
            href="#how-it-works" 
            onClick={() => setMobileMenuOpen(false)}
            className="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-blue-50 hover:text-[#0077c8]"
          >
            How it Works
          </a>
          <a 
            href="#experts" 
            onClick={() => setMobileMenuOpen(false)}
            className="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-blue-50 hover:text-[#0077c8]"
          >
            Meet the Experts
          </a>
          <a 
            href="#popular" 
            onClick={() => setMobileMenuOpen(false)}
            className="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-blue-50 hover:text-[#0077c8]"
          >
            Popular Questions
          </a>
          <a 
            href="#pricing" 
            onClick={() => setMobileMenuOpen(false)}
            className="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-blue-50 hover:text-[#0077c8]"
          >
            Pricing
          </a>
          <button 
            onClick={() => { setMobileMenuOpen(false); onOpenApply(); }}
            className="w-full text-left px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-blue-50 hover:text-[#0077c8]"
          >
            Become an Expert
          </button>
          
          <div className="pt-3 border-t border-slate-200 flex flex-col gap-2">
            <button
              onClick={() => { setMobileMenuOpen(false); onOpenSettings(); }}
              className="w-full flex items-center justify-center gap-2 py-2.5 px-4 text-sm font-semibold rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-800"
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
