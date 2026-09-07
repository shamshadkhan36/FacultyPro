import React, { useState } from 'react';
import { X, Sparkles, GraduationCap } from 'lucide-react';

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
                <GraduationCap className="w-4 h-4" />
              </div>
              <div>
                <h4 className="font-bold text-xs text-slate-900">FacultyPro Live Help</h4>
                <div className="flex items-center gap-1 text-[10px] text-emerald-600 font-semibold">
                  <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                  <span>15 Professors Online</span>
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
            <strong>Dr. Arthur Vance (MIT):</strong> "Hello! What subject or problem can I help you break down with exact point-to-point clarity today?"
          </div>

          <form onSubmit={handleQuickSubmit} className="space-y-2">
            <div className="relative">
              <textarea
                value={quickText}
                onChange={(e) => setQuickText(e.target.value)}
                placeholder="Type your math, physics, code, medical or legal question..."
                rows={2}
                className="w-full text-xs p-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-[#0077c8] resize-none text-slate-800 placeholder:text-slate-400"
              />
            </div>
            <div className="flex items-center justify-between">
              <span className="text-[10px] text-slate-400">Instant Point-to-Point Solution</span>
              <button
                type="submit"
                className="px-3.5 py-1.5 rounded-lg bg-[#f05423] hover:bg-[#ff6f3c] text-white text-xs font-bold flex items-center gap-1 cursor-pointer shadow-xs"
              >
                <Sparkles className="w-3 h-3" />
                <span>Start Now</span>
              </button>
            </div>
          </form>

        </div>
      )}

      {/* Floating Trigger Group matching All Screenshots */}
      <div className="flex items-center gap-2.5">
        
        {/* Blue speech bubble pill matching Screenshot 1-5 */}
        {bubbleVisible && !isOpen && (
          <div 
            onClick={() => setIsOpen(true)}
            className="relative cursor-pointer bg-[#2563eb] hover:bg-[#1d4ed8] text-white text-xs sm:text-sm font-bold px-4 py-2.5 rounded-2xl rounded-br-none shadow-xl border border-blue-400/30 flex items-center gap-2 animate-in fade-in slide-in-from-right-4 duration-300 transition-all hover:scale-105 select-none"
          >
            <span>What can we help with today?</span>
            <button
              onClick={(e) => {
                e.stopPropagation();
                setBubbleVisible(false);
              }}
              className="text-blue-200 hover:text-white ml-1 -mr-1 p-0.5 rounded-full hover:bg-white/10"
            >
              <X className="w-3 h-3" />
            </button>
          </div>
        )}

        {/* Circular Avatar with Notification Badge matching screenshots */}
        <div 
          onClick={() => setIsOpen(!isOpen)}
          className="relative cursor-pointer group"
        >
          <div className="w-14 h-14 sm:w-16 sm:h-16 rounded-full overflow-hidden border-2 border-white shadow-2xl ring-4 ring-blue-500/30 group-hover:ring-[#f05423] transition-all duration-200 group-hover:scale-105">
            <img
              src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80"
              alt="Faculty Advisor"
              className="w-full h-full object-cover"
            />
          </div>
          
          {/* Unread badge '1' matching Screenshot 1-5 */}
          <span className="absolute top-0 right-0 w-5 h-5 bg-[#e11d48] text-white font-extrabold text-[11px] rounded-full flex items-center justify-center border-2 border-white shadow-md animate-pulse">
            1
          </span>
        </div>

      </div>

    </div>
  );
};

export default FloatingChatWidget;
