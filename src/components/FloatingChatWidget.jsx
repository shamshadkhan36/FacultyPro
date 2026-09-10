import React, { useState } from 'react';
import { X, Sparkles, Wrench } from 'lucide-react';

export const FloatingChatWidget = ({ onOpenConsultation }) => {
  const [isOpen, setIsOpen] = useState(false);
  const [bubbleVisible, setBubbleVisible] = useState(true);
  const [quickText, setQuickText] = useState('');

  const handleQuickSubmit = (e) => {
    e.preventDefault();
    if (quickText.trim()) {
      onOpenConsultation(quickText.trim());
      setQuickText('');
      setIsOpen(false);
    }
  };

  return (
    <div className="fixed bottom-5 right-5 z-50 flex flex-col items-end">
      
      {/* Quick Flyout Drawer when expanded */}
      {isOpen && (
        <div className="mb-3 w-80 sm:w-96 bg-white rounded-2xl shadow-2xl border border-slate-200 p-4 animate-in slide-in-from-bottom-5 duration-200 space-y-3">
          
          <div className="flex items-center justify-between border-b border-slate-100 pb-2.5">
            <div className="flex items-center gap-2">
              <div className="w-8 h-8 rounded-full bg-[#0077c8] flex items-center justify-center text-white">
                <Wrench className="w-4 h-4" />
              </div>
              <div>
                <h4 className="font-bold text-xs text-slate-900">FacilityPro MEP Help</h4>
                <div className="flex items-center gap-1 text-[10px] text-emerald-600 font-semibold">
                  <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                  <span>15 MEP Engineers Online</span>
                </div>
              </div>
            </div>
            <button
              onClick={() => setIsOpen(false)}
              className="text-slate-400 hover:text-slate-600 p-1 rounded-md hover:bg-slate-100 cursor-pointer"
            >
              <X className="w-4 h-4" />
            </button>
          </div>

          <div className="p-3 rounded-xl bg-blue-50 text-xs text-slate-700 leading-relaxed">
            <strong>Er. Rajesh Sharma (AI HVAC):</strong> "Hello! What HVAC, Plumbing, Electrical, or Fire Fighting issue can our AI Engineers troubleshoot for you today?"
          </div>

          <form onSubmit={handleQuickSubmit} className="space-y-2">
            <div className="relative">
              <textarea
                value={quickText}
                onChange={(e) => setQuickText(e.target.value)}
                placeholder="Ask about chiller surging, water hammer, transformer inrush, or NFPA 13..."
                rows={2}
                className="w-full text-xs p-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#0077c8] resize-none text-slate-800 placeholder:text-slate-400"
              />
            </div>
            <div className="flex items-center justify-between">
              <span className="text-[10px] text-emerald-600 font-bold flex items-center gap-1">
                <span className="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                AI Models Online (&lt; 5s reply)
              </span>
              <button
                type="submit"
                className="px-3 py-1.5 bg-[#f05423] hover:bg-[#d84315] text-white text-xs font-bold rounded-lg flex items-center gap-1 shadow-xs transition-colors cursor-pointer"
              >
                <span>Ask AI</span>
                <Send className="w-3 h-3" />
              </button>
            </div>
          </form>

        </div>
      )}

      {/* Floating Launcher Button */}
      <div className="flex items-center gap-3">
        
        {/* Floating Bubble Hint */}
        {!isOpen && (
          <div 
            onClick={() => setIsOpen(true)}
            className="hidden sm:flex items-center gap-2 bg-white/95 backdrop-blur-md px-3.5 py-2 rounded-2xl shadow-xl border border-slate-200 text-xs font-bold text-slate-800 cursor-pointer hover:border-[#0077c8] hover:shadow-2xl transition-all duration-200 transform hover:-translate-y-0.5 animate-bounce"
          >
            <Sparkles className="w-4 h-4 text-[#f05423]" />
            <span>Ask our AI MEP Consultants</span>
          </div>
        )}

        {/* Circular Avatar with Notification Badge */}
        <div 
          onClick={() => setIsOpen(!isOpen)}
          className="relative cursor-pointer group"
        >
          <div className="w-14 h-14 sm:w-16 sm:h-16 rounded-full overflow-hidden border-2 border-white shadow-2xl ring-4 ring-blue-500/30 group-hover:ring-[#f05423] transition-all duration-200 group-hover:scale-105">
            <img
              src="/images/avatar_rajesh_sharma.jpg"
              alt="AI MEP Consultant"
              className="w-full h-full object-cover"
            />
          </div>
          
          <span className="absolute top-0 right-0 w-5 h-5 bg-[#e11d48] text-white font-extrabold text-[11px] rounded-full flex items-center justify-center border-2 border-white shadow-md animate-pulse">
            1
          </span>
        </div>

      </div>

    </div>
  );
};

export default FloatingChatWidget;
