import React from 'react';
import { 
  GraduationCap, 
  ShieldCheck, 
  Lock, 
  ChevronDown
} from 'lucide-react';

export const Footer = ({ onOpenApply, onOpenAuth }) => {
  return (
    <footer className="bg-[#f8fafc] text-slate-600 border-t border-slate-200/80 pt-16 pb-12 text-xs sm:text-sm">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* 4 Navigation Columns matching Screenshot 5 */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
          
          {/* Column 1: FacultyPro */}
          <div className="space-y-3">
            <h4 className="font-bold text-slate-900 text-sm tracking-tight">FacultyPro</h4>
            <ul className="space-y-2 text-slate-500 font-medium">
              <li><a href="#" className="hover:text-[#0077c8] transition-colors">Home</a></li>
              <li><a href="#how-it-works" className="hover:text-[#0077c8] transition-colors">About</a></li>
              <li><a href="#experts" className="hover:text-[#0077c8] transition-colors">Careers | Academic Board</a></li>
              <li><a href="#how-it-works" className="hover:text-[#0077c8] transition-colors">Press & Publications</a></li>
              <li><a href="#pricing" className="hover:text-[#0077c8] transition-colors">Partner Program</a></li>
              <li><a href="#popular" className="hover:text-[#0077c8] transition-colors">Academic Blog</a></li>
              <li>
                <button className="flex items-center gap-1 hover:text-[#0077c8] cursor-pointer">
                  <span>Countries</span>
                  <ChevronDown className="w-3 h-3" />
                </button>
              </li>
            </ul>
          </div>

          {/* Column 2: Members */}
          <div className="space-y-3">
            <h4 className="font-bold text-slate-900 text-sm tracking-tight">Members</h4>
            <ul className="space-y-2 text-slate-500 font-medium">
              <li><a href="#how-it-works" className="hover:text-[#0077c8] transition-colors">How it works</a></li>
              <li><button onClick={onOpenAuth} className="hover:text-[#0077c8] transition-colors cursor-pointer">Login</button></li>
              <li><button onClick={onOpenAuth} className="hover:text-[#0077c8] transition-colors cursor-pointer">Register</button></li>
              <li>
                <button className="flex items-center gap-1 hover:text-[#0077c8] cursor-pointer">
                  <span>Categories</span>
                  <ChevronDown className="w-3 h-3" />
                </button>
              </li>
              <li><a href="#pricing" className="hover:text-[#0077c8] transition-colors">Student Pricing Plans</a></li>
            </ul>
          </div>

          {/* Column 3: Experts */}
          <div className="space-y-3">
            <h4 className="font-bold text-slate-900 text-sm tracking-tight">Experts & Faculty</h4>
            <ul className="space-y-2 text-slate-500 font-medium">
              <li><a href="#experts" className="hover:text-[#0077c8] transition-colors">Meet the Experts</a></li>
              <li><a href="#why-us" className="hover:text-[#0077c8] transition-colors">Expert quality</a></li>
              <li><button onClick={onOpenApply} className="hover:text-[#0077c8] transition-colors cursor-pointer">Become an Expert</button></li>
              <li><a href="#experts" className="hover:text-[#0077c8] transition-colors">Faculty Portal & Guidelines</a></li>
              <li><a href="#why-us" className="hover:text-[#0077c8] transition-colors">Academic Integrity Policy</a></li>
            </ul>
          </div>

          {/* Column 4: Support */}
          <div className="space-y-3">
            <h4 className="font-bold text-slate-900 text-sm tracking-tight">Support</h4>
            <ul className="space-y-2 text-slate-500 font-medium">
              <li><a href="#how-it-works" className="hover:text-[#0077c8] transition-colors">Help Center</a></li>
              <li><a href="#how-it-works" className="hover:text-[#0077c8] transition-colors">Contact Us</a></li>
              <li><a href="#popular" className="hover:text-[#0077c8] transition-colors">Verified Reviews</a></li>
              <li><a href="#pricing" className="hover:text-[#0077c8] transition-colors">API Integration & Developers</a></li>
              <li><a href="#pricing" className="hover:text-[#0077c8] transition-colors">System Status</a></li>
            </ul>
          </div>

        </div>

        {/* Bottom Security Badges & Copyright matching Screenshot 5 */}
        <div className="pt-8 border-t border-slate-200 flex flex-col md:flex-row items-center justify-between gap-6">
          
          <div className="space-y-2 text-center md:text-left">
            <p className="text-xs text-slate-500">
              © 2003-2026 FacultyPro LLC. All rights reserved. Powered by OpenAI & Verified Global Faculty.
            </p>
            <div className="flex flex-wrap items-center justify-center md:justify-start gap-4 text-xs text-slate-500 font-medium">
              <a href="#pricing" className="hover:text-slate-800 transition-colors">Privacy Policy</a>
              <span>•</span>
              <a href="#pricing" className="hover:text-slate-800 transition-colors">Terms of services</a>
              <span>•</span>
              <a href="#how-it-works" className="hover:text-slate-800 transition-colors">Contact us</a>
              <span>•</span>
              <a href="#popular" className="hover:text-slate-800 transition-colors">Sitemap</a>
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

            {/* DMCA Badge matching Screenshot 5 */}
            <div className="inline-flex items-center text-[10px] font-bold tracking-tight rounded overflow-hidden border border-slate-300 shadow-xs">
              <span className="bg-[#5a9e2f] text-white px-2 py-0.5">DMCA</span>
              <span className="bg-slate-900 text-white px-2 py-0.5">PROTECTED</span>
            </div>

            {/* DigiCert / SSL Secured Badge matching Screenshot 5 */}
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
