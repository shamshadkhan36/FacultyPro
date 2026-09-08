import React from 'react';
import { Sparkles, ArrowRight, Wrench } from 'lucide-react';

export const AnnouncementBar = ({ onApplyClick }) => {
  return (
    <div className="bg-gradient-to-r from-[#0077c8] via-[#0088df] to-[#0099f7] text-white text-xs sm:text-sm py-2 px-4 shadow-inner relative z-50">
      <div className="max-w-7xl mx-auto flex items-center justify-center gap-2 sm:gap-4 flex-wrap">
        <div className="flex items-center gap-2 font-medium">
          <span className="inline-flex items-center justify-center w-5 h-5 rounded-full bg-white/20 text-white">
            <Wrench className="w-3 h-3" />
          </span>
          <span>Are you a Licensed PE, ASHRAE, NFPA, or IEEE MEP Consultant? Join FacilityPro!</span>
        </div>
        
        <div className="flex items-center gap-2">
          <div className="flex -space-x-1.5 overflow-hidden">
            <img className="inline-block h-5 w-5 rounded-full ring-1 ring-white/50" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80" alt="MEP Engineer" />
            <img className="inline-block h-5 w-5 rounded-full ring-1 ring-white/50" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=100&q=80" alt="MEP Engineer" />
            <img className="inline-block h-5 w-5 rounded-full ring-1 ring-white/50" src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=100&q=80" alt="MEP Engineer" />
          </div>
          
          <button 
            onClick={onApplyClick}
            className="inline-flex items-center gap-1 bg-white/10 hover:bg-white text-white hover:text-[#0077c8] px-3 py-1 rounded-md text-xs font-semibold tracking-wide border border-white/40 transition-all duration-200 cursor-pointer shadow-xs"
          >
            Apply now
            <ArrowRight className="w-3 h-3" />
          </button>
        </div>
      </div>
    </div>
  );
};

export default AnnouncementBar;
