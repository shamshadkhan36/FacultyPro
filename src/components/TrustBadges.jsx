import React from 'react';
import { ShieldCheck, Lock } from 'lucide-react';

export const TrustBadges = () => {
  return (
    <div className="bg-slate-50/80 border-b border-slate-200/80 py-10">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex flex-wrap items-center justify-center gap-8 sm:gap-14 text-center">
          
          {/* BBB Accredited Business badge matching Screenshot 5 */}
          <div className="flex flex-col items-center group cursor-pointer">
            <div className="flex items-center gap-2 border-2 border-slate-700 rounded-lg px-3 py-1.5 bg-white shadow-xs">
              <div className="bg-[#005a9c] text-white font-black text-xs px-1.5 py-0.5 rounded">BBB</div>
              <div className="text-left">
                <div className="text-[9px] font-black uppercase text-slate-800 tracking-tighter leading-none">ACCREDITED</div>
                <div className="text-[9px] font-bold text-slate-600 tracking-tighter leading-none">BUSINESS</div>
              </div>
            </div>
            <span className="text-[10px] text-slate-500 font-semibold mt-1.5 group-hover:text-[#0077c8]">Click for Profile</span>
          </div>

          {/* LegitScript Certified badge matching Screenshot 5 */}
          <div className="flex items-center gap-2 bg-white px-3.5 py-2 rounded-lg border border-slate-200 shadow-xs">
            <div className="w-7 h-7 rounded-full bg-[#0d2a4a] flex items-center justify-center text-white">
              <ShieldCheck className="w-4 h-4 text-emerald-400" />
            </div>
            <div className="text-left">
              <div className="text-[11px] font-black text-[#0d2a4a] leading-none">LegitScript</div>
              <div className="text-[9px] font-bold text-emerald-600">Certified Platform</div>
            </div>
          </div>

          {/* Google Review 4.9 Stars badge matching Screenshot 5 */}
          <div className="flex items-center gap-3 bg-white px-4 py-2 rounded-lg border border-slate-200 shadow-xs">
            <div className="text-left">
              <div className="flex items-center gap-1 font-bold text-slate-800 text-xs">
                <span className="text-blue-500 font-black">G</span>
                <span className="text-red-500 font-black">o</span>
                <span className="text-amber-500 font-black">o</span>
                <span className="text-blue-500 font-black">g</span>
                <span className="text-green-500 font-black">l</span>
                <span className="text-red-500 font-black">e</span>
                <span className="text-slate-900 font-extrabold ml-1">4.9</span>
              </div>
              <div className="flex text-amber-400 text-xs">
                ★★★★★
              </div>
            </div>
          </div>

          {/* Trustpilot TrustScore 4.8 badge matching Screenshot 5 */}
          <div className="flex items-center gap-2 bg-white px-4 py-2 rounded-lg border border-slate-200 shadow-xs">
            <div className="text-left">
              <div className="flex items-center gap-1 text-[11px] font-bold text-slate-800">
                <span className="text-[#00b67a] font-black text-sm">★</span>
                <span>Trustpilot</span>
              </div>
              <div className="text-[10px] text-slate-600 font-bold">
                TrustScore <span className="text-[#00b67a] font-black">4.8</span> | 24,000+ reviews
              </div>
            </div>
          </div>

          {/* 256-bit SSL Security */}
          <div className="flex items-center gap-2 bg-white px-3.5 py-2 rounded-lg border border-slate-200 shadow-xs">
            <Lock className="w-4 h-4 text-[#0077c8] stroke-[2.2]" />
            <div className="text-left">
              <div className="text-[10px] font-black text-slate-800 uppercase">256-Bit SSL</div>
              <div className="text-[9px] text-slate-500 font-medium">Bank-Grade Encryption</div>
            </div>
          </div>

        </div>
      </div>
    </div>
  );
};

export default TrustBadges;
