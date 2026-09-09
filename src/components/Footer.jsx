import React from 'react';
import { 
  Wrench, 
  ShieldCheck, 
  Lock, 
  ChevronDown
} from 'lucide-react';

export const Footer = ({ onOpenApply, onOpenAuth, onNavigate }) => {
  return (
    <footer className="bg-[#f8fafc] text-slate-600 border-t border-slate-200/80 pt-16 pb-12 text-xs sm:text-sm">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* 4 Navigation Columns matching Screenshot 5 */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
          
          {/* Column 1: FacilityPro Platform */}
          <div className="space-y-3">
            <h4 className="font-bold text-slate-900 text-sm tracking-tight">FacilityPro</h4>
            <ul className="space-y-2 text-slate-500 font-medium">
              <li><button onClick={() => onNavigate && onNavigate('home')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Home</button></li>
              <li><button onClick={() => onNavigate && onNavigate('calculators')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Engineering Calculators</button></li>
              <li><button onClick={() => onNavigate && onNavigate('knowledge')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Knowledge Hub & Fault Trees</button></li>
              <li><button onClick={() => onNavigate && onNavigate('sops')} className="hover:text-[#0077c8] transition-colors cursor-pointer">SOP Library & Safety</button></li>
              <li><button onClick={() => onNavigate && onNavigate('checklists')} className="hover:text-[#0077c8] transition-colors cursor-pointer">PPM Maintenance Checklists</button></li>
              <li><button onClick={() => onNavigate && onNavigate('dashboard')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Engineer Dashboard</button></li>
              <li><button onClick={() => onNavigate && onNavigate('admin')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Admin Console</button></li>
            </ul>
          </div>

          {/* Column 2: MEP Disciplines */}
          <div className="space-y-3">
            <h4 className="font-bold text-slate-900 text-sm tracking-tight">Core MEP Disciplines</h4>
            <ul className="space-y-2 text-slate-500 font-medium">
              <li><button onClick={() => onNavigate && onNavigate('home')} className="hover:text-[#0077c8] transition-colors cursor-pointer">HVAC & Chillers</button></li>
              <li><button onClick={() => onNavigate && onNavigate('home')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Plumbing & Hydro-Pneumatic</button></li>
              <li><button onClick={() => onNavigate && onNavigate('home')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Electrical & Substations</button></li>
              <li><button onClick={() => onNavigate && onNavigate('home')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Fire Fighting & NFPA Systems</button></li>
              <li><button onClick={() => onNavigate && onNavigate('home')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Facility Pricing Plans</button></li>
            </ul>
          </div>

          {/* Column 3: Consultants */}
          <div className="space-y-3">
            <h4 className="font-bold text-slate-900 text-sm tracking-tight">MEP Consultants</h4>
            <ul className="space-y-2 text-slate-500 font-medium">
              <li><button onClick={() => onNavigate && onNavigate('home')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Meet the Licensed PEs</button></li>
              <li><button onClick={onOpenApply} className="hover:text-[#0077c8] transition-colors cursor-pointer">Join as MEP Consultant</button></li>
              <li><button onClick={() => onNavigate && onNavigate('dashboard')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Consultant Portal</button></li>
              <li><button onClick={() => onNavigate && onNavigate('knowledge')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Code Integrity Guidelines</button></li>
            </ul>
          </div>

          {/* Column 4: Support */}
          <div className="space-y-3">
            <h4 className="font-bold text-slate-900 text-sm tracking-tight">Support & Documentation</h4>
            <ul className="space-y-2 text-slate-500 font-medium">
              <li><button onClick={() => onNavigate && onNavigate('home')} className="hover:text-[#0077c8] transition-colors cursor-pointer">24/7 Site Support Center</button></li>
              <li><button onClick={() => onNavigate && onNavigate('sops')} className="hover:text-[#0077c8] transition-colors cursor-pointer">Emergency Breakdown SOPs</button></li>
              <li><button onClick={() => onNavigate && onNavigate('home')} className="hover:text-[#0077c8] transition-colors cursor-pointer">OpenAI MEP Integration</button></li>
              <li><button onClick={() => onNavigate && onNavigate('admin')} className="hover:text-[#0077c8] transition-colors cursor-pointer">System Uptime (99.99%)</button></li>
            </ul>
          </div>

        </div>

        {/* Bottom Security Badges & Copyright */}
        <div className="pt-8 border-t border-slate-200 flex flex-col md:flex-row items-center justify-between gap-6">
          
          <div className="space-y-2 text-center md:text-left">
            <p className="text-xs text-slate-500">
              © 2003-2026 FacilityPro LLC. All rights reserved. Powered by OpenAI & Verified Licensed MEP Engineers.
            </p>
            <div className="flex flex-wrap items-center justify-center md:justify-start gap-4 text-xs text-slate-500 font-medium">
              <button onClick={() => onNavigate && onNavigate('home')} className="hover:text-slate-800 transition-colors cursor-pointer">Privacy Policy</button>
              <span>•</span>
              <button onClick={() => onNavigate && onNavigate('home')} className="hover:text-slate-800 transition-colors cursor-pointer">Terms of Service</button>
              <span>•</span>
              <button onClick={() => onNavigate && onNavigate('home')} className="hover:text-slate-800 transition-colors cursor-pointer">Contact Us</button>
              <span>•</span>
              <button onClick={() => onNavigate && onNavigate('home')} className="hover:text-slate-800 transition-colors cursor-pointer">Sitemap</button>
            </div>
          </div>

          <div className="flex items-center gap-4 flex-wrap justify-center">
            
            {/* Social Icons */}
            <div className="flex items-center gap-2">
              <div className="w-7 h-7 rounded-full bg-slate-400/80 hover:bg-[#0077c8] text-white flex items-center justify-center font-bold text-xs cursor-pointer transition-colors">
                f
              </div>
              <div className="w-7 h-7 rounded-full bg-slate-400/80 hover:bg-[#0077c8] text-white flex items-center justify-center font-bold text-xs cursor-pointer transition-colors">
                in
              </div>
              <div className="w-7 h-7 rounded-full bg-slate-400/80 hover:bg-[#0077c8] text-white flex items-center justify-center font-bold text-xs cursor-pointer transition-colors">
                𝕏
              </div>
            </div>

            {/* DMCA Badge */}
            <div className="inline-flex items-center text-[10px] font-bold tracking-tight rounded overflow-hidden border border-slate-300 shadow-xs">
              <span className="bg-[#5a9e2f] text-white px-2 py-0.5">DMCA</span>
              <span className="bg-slate-900 text-white px-2 py-0.5">PROTECTED</span>
            </div>

            {/* DigiCert / SSL Secured Badge */}
            <div className="inline-flex items-center gap-1 px-2 py-0.5 rounded border border-slate-300 bg-white shadow-xs text-[10px] font-bold text-slate-700">
              <Lock className="w-3 h-3 text-[#0077c8]" />
              <span className="text-[#0077c8] font-black">digicert</span>
              <span className="text-slate-400">SECURED</span>
            </div>

          </div>

        </div>

      </div>
    </footer>
  );
};

export default Footer;
