import React, { useState, useEffect } from 'react';
import { 
  Search, 
  Sparkles, 
  Wrench, 
  Award, 
  CheckCircle,
  Wind,
  Droplets,
  Zap,
  Flame
} from 'lucide-react';
import { quickPrompts } from '../data/categories';

export const HeroSection = ({ onStartChat, onSelectPrompt }) => {
  const [questionInput, setQuestionInput] = useState('');
  const cyclingDisciplines = ['HVAC Specialists', 'Plumbing Engineers', 'Electrical Consultants', 'Fire Safety Experts', 'MEP Facility Directors'];
  const [disciplineIndex, setDisciplineIndex] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => {
      setDisciplineIndex((prev) => (prev + 1) % cyclingDisciplines.length);
    }, 3200);
    return () => clearInterval(interval);
  }, []);

  const handleSubmit = (e) => {
    e.preventDefault();
    if (questionInput.trim()) {
      onStartChat(questionInput.trim());
    }
  };

  return (
    <div className="relative min-h-[580px] sm:min-h-[640px] flex items-center justify-center overflow-hidden bg-slate-900 text-white">
      {/* Background Image of Industrial Plant Room / MEP Facility with Dark Overlay */}
      <div className="absolute inset-0 z-0">
        <img 
          src="/images/bms_control_room.jpg" 
          alt="MEP Facility Plant Room" 
          className="w-full h-full object-cover object-center opacity-30 filter contrast-125 brightness-90 transform scale-105 transition-transform duration-1000"
        />
        <div className="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/80 to-slate-900/60"></div>
        <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-900/20 via-transparent to-black/60"></div>
      </div>

      {/* Main Content Container */}
      <div className="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 text-center sm:text-left">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          
          <div className="lg:col-span-8 space-y-6">
            
            {/* Logo Badge in Hero */}
            <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white shadow-lg animate-in fade-in duration-300">
              <div className="w-5 h-5 rounded-full bg-[#f05423] flex items-center justify-center text-white text-[10px] font-black">
                FP
              </div>
              <span className="text-xs sm:text-sm font-semibold tracking-wide text-slate-100">
                Facility<span className="text-[#ff7849]">Pro</span> MEP Point-to-Point Q&A
              </span>
              <span className="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
            </div>

            {/* Main Headline */}
            <div className="space-y-2">
              <h1 className="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight sm:leading-none">
                Real help from real <br className="hidden sm:inline" />
                <span className="text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-sky-300 transition-all duration-300 inline-block">
                  {cyclingDisciplines[disciplineIndex]}
                </span>
                <span className="text-[#ff5722] ml-2 font-black">, 24/7</span>
              </h1>
              <p className="text-base sm:text-xl font-normal text-slate-300 max-w-2xl leading-relaxed pt-1">
                Talk or text with thousands of verified MEP engineers & OpenAI reasoning for exact, code-compliant point-to-point answers.
              </p>
            </div>

            {/* Quick Prompt Pills with search magnifying glass icon */}
            <div className="flex items-center gap-2 flex-wrap pt-1">
              {quickPrompts.slice(0, 4).map((prompt, idx) => (
                <button
                  key={idx}
                  onClick={() => {
                    setQuestionInput(prompt.text);
                    onSelectPrompt(prompt.text);
                  }}
                  className="group inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-sm border border-white/15 text-xs text-slate-200 hover:text-white font-medium transition-all duration-200 cursor-pointer shadow-xs hover:scale-105 active:scale-95"
                >
                  <Search className="w-3 h-3 text-slate-400 group-hover:text-white transition-colors" />
                  <span>{prompt.text}</span>
                </button>
              ))}
              <button
                onClick={() => {
                  const sample = quickPrompts[4]?.text || "Ask any MEP question...";
                  setQuestionInput(sample);
                  onSelectPrompt(sample);
                }}
                className="group inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur-sm border border-white/15 text-xs text-slate-200 hover:text-white font-medium transition-all duration-200 cursor-pointer"
              >
                <Search className="w-3 h-3 text-slate-400" />
                <span>Ask anything...</span>
              </button>
            </div>

            {/* Central Question Input Bar */}
            <form onSubmit={handleSubmit} className="pt-2">
              <div className="relative flex flex-col sm:flex-row items-center bg-white rounded-2xl sm:rounded-full p-1.5 sm:p-2 shadow-2xl shadow-black/50 border-2 border-white/20 focus-within:border-[#ff5722] transition-all duration-200">
                
                <div className="flex items-center w-full pl-3 sm:pl-4 pr-2 py-2 sm:py-0">
                  <Wrench className="w-5 h-5 text-slate-400 mr-2.5 shrink-0 hidden sm:block" />
                  <input
                    type="text"
                    value={questionInput}
                    onChange={(e) => setQuestionInput(e.target.value)}
                    placeholder="Ask about HVAC, Plumbing, Electrical, or Fire Fighting systems..."
                    className="w-full bg-transparent text-slate-900 placeholder:text-slate-400 text-sm sm:text-base font-medium focus:outline-none"
                  />
                </div>

                {/* Orange/Coral Start Chat Button */}
                <button
                  type="submit"
                  className="w-full sm:w-auto mt-2 sm:mt-0 flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl sm:rounded-full bg-gradient-to-r from-[#ff5722] to-[#f05423] hover:from-[#ff6f3c] hover:to-[#ff5722] text-white font-bold text-sm sm:text-base shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-150 cursor-pointer shrink-0"
                >
                  <Sparkles className="w-4 h-4 fill-white" />
                  <span>Start chat</span>
                </button>
              </div>

              {/* Disclaimer text */}
              <p className="text-[11px] text-slate-400 mt-2.5 text-center sm:text-left">
                By chatting, you understand chats may be recorded and agree to our <a href="#pricing" className="text-sky-400 hover:underline">Terms of Service</a> and <a href="#pricing" className="text-sky-400 hover:underline">Privacy Policy</a>.
              </p>
            </form>

          </div>

          {/* Right Trust Column / Award Seal */}
          <div className="hidden lg:flex lg:col-span-4 flex-col items-center justify-center space-y-4">
            <div className="relative p-6 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 text-center max-w-xs shadow-2xl">
              <div className="w-16 h-16 mx-auto rounded-full bg-gradient-to-tr from-amber-400 to-amber-200 flex items-center justify-center text-slate-950 font-black shadow-lg shadow-amber-500/20 mb-3">
                <Award className="w-9 h-9 stroke-[2] text-amber-900" />
              </div>
              <h3 className="text-lg font-bold text-white tracking-tight">100% Verified MEP Engineers</h3>
              <p className="text-xs text-slate-300 mt-1 leading-relaxed">
                Licensed Professional Engineers (PE), ASHRAE Fellows, NFPA CFPS & IEEE Senior Members.
              </p>
              
              <div className="mt-4 pt-3 border-t border-white/10 flex items-center justify-center gap-3 text-xs text-amber-300 font-semibold">
                <span className="flex items-center gap-1">
                  <CheckCircle className="w-3.5 h-3.5 text-emerald-400" /> 24/7 Site Support
                </span>
                <span>•</span>
                <span>Exact Math & Codes</span>
              </div>
            </div>

            <div className="text-center">
              <span className="text-[10px] tracking-wider uppercase font-extrabold text-slate-400">
                FASTEST-GROWING MEP & FACILITY PLATFORM
              </span>
            </div>
          </div>

        </div>
      </div>
    </div>
  );
};

export default HeroSection;
