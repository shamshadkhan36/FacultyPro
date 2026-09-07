import React from 'react';
import { 
  HelpCircle, 
  Sparkles, 
  MessageSquare, 
  CheckCircle2, 
  GraduationCap, 
  PhoneCall, 
  FileCheck, 
  ArrowRight,
  Zap,
  ListOrdered
} from 'lucide-react';

export const HowItWorks = ({ onTryNow }) => {
  return (
    <section id="how-it-works" className="py-16 sm:py-24 bg-white border-b border-slate-200/70 overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Section Header matching Screenshot 2 */}
        <div className="mb-16">
          <h2 className="text-3xl sm:text-4xl font-extrabold text-[#0b2545] tracking-tight">
            How it works
          </h2>
          <p className="text-slate-600 text-sm sm:text-base mt-2 max-w-xl">
            Simple 3-step process to get verified academic and technical answers in seconds.
          </p>
        </div>

        {/* 3 Step Visual Grid matching Screenshot 2 layout */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          {/* Steps Left Column */}
          <div className="lg:col-span-6 space-y-10">
            
            {/* Step 1 matching Screenshot 2 */}
            <div className="flex items-start gap-5 group">
              <div className="shrink-0 w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-[#0077c8] font-black text-lg group-hover:bg-[#0077c8] group-hover:text-white transition-colors duration-200 shadow-xs">
                1
              </div>
              <div className="space-y-1.5">
                <h3 className="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                  Ask your question
                </h3>
                <p className="text-sm text-slate-600 leading-relaxed">
                  Tell us your situation. Ask any question in any academic category or technical discipline, anytime you want.
                </p>
                <div className="pt-1 flex items-center gap-2 text-xs text-[#0077c8] font-semibold">
                  <span>• Text, code, math formulas, or upload problem</span>
                </div>
              </div>
            </div>

            {/* Step 2 */}
            <div className="flex items-start gap-5 group">
              <div className="shrink-0 w-12 h-12 rounded-2xl bg-orange-50 border border-orange-100 flex items-center justify-center text-[#f05423] font-black text-lg group-hover:bg-[#f05423] group-hover:text-white transition-colors duration-200 shadow-xs">
                2
              </div>
              <div className="space-y-1.5">
                <h3 className="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                  OpenAI & Faculty Synthesis
                </h3>
                <p className="text-sm text-slate-600 leading-relaxed">
                  Our point-to-point engine connects OpenAI advanced reasoning models directly with verified faculty templates to strip away filler words and format exact numbered points.
                </p>
                <div className="pt-1 flex items-center gap-2 text-xs text-[#f05423] font-semibold">
                  <span>• Zero fluff, pure logical progression</span>
                </div>
              </div>
            </div>

            {/* Step 3 */}
            <div className="flex items-start gap-5 group">
              <div className="shrink-0 w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 font-black text-lg group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-200 shadow-xs">
                3
              </div>
              <div className="space-y-1.5">
                <h3 className="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                  Exact Point-to-Point Solution & Chat
                </h3>
                <p className="text-sm text-slate-600 leading-relaxed">
                  Receive structured bullet points, formulas, peer citations, common pitfalls, and carry on interactive follow-up questions with your assigned faculty.
                </p>
                <div className="pt-1 flex items-center gap-2 text-xs text-emerald-600 font-semibold">
                  <span>• Export as study notes or continue live discussion</span>
                </div>
              </div>
            </div>

            <div className="pt-4">
              <button
                onClick={onTryNow}
                className="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#0077c8] hover:bg-[#0066ad] text-white font-bold text-sm shadow-md hover:shadow-lg transition-all duration-150 cursor-pointer"
              >
                <span>Try Asking a Question Now</span>
                <ArrowRight className="w-4 h-4" />
              </button>
            </div>

          </div>

          {/* Graphic Right Column matching Screenshot 2 UI Card Preview */}
          <div className="lg:col-span-6 flex justify-center">
            <div className="relative w-full max-w-md bg-slate-50 border-2 border-slate-200/80 rounded-3xl p-6 shadow-2xl space-y-4">
              
              <div className="absolute -top-4 -right-4 bg-gradient-to-r from-[#ff5722] to-[#f05423] text-white text-xs font-bold px-3.5 py-1.5 rounded-full shadow-lg flex items-center gap-1.5 animate-bounce">
                <Zap className="w-3.5 h-3.5 fill-white" />
                <span>Response in &lt; 30s</span>
              </div>

              {/* Faculty Card Header in mockup */}
              <div className="flex items-center gap-3 bg-white p-3.5 rounded-2xl border border-slate-200 shadow-xs">
                <div className="relative">
                  <img
                    src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80"
                    alt="Faculty"
                    className="w-12 h-12 rounded-full object-cover ring-2 ring-[#0077c8]/20"
                  />
                  <span className="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></span>
                </div>
                <div>
                  <div className="flex items-center gap-1.5">
                    <h4 className="font-bold text-sm text-slate-900">Dr. Arthur Vance</h4>
                    <span className="text-[10px] bg-emerald-50 text-emerald-700 px-1.5 py-0.5 rounded font-bold border border-emerald-200">Verified MIT</span>
                  </div>
                  <div className="flex items-center gap-1 text-amber-500 text-xs font-semibold">
                    <span>★★★★★</span>
                    <span className="text-slate-500 font-normal text-[11px]">(60,004 reviews)</span>
                  </div>
                </div>
              </div>

              {/* Chat snippet preview */}
              <div className="space-y-2.5 text-xs">
                <div className="bg-[#0077c8] text-white p-3 rounded-2xl rounded-tr-none ml-6 shadow-xs">
                  <p className="font-medium">Explain Bell Theorem and how quantum entanglement violates local realism.</p>
                </div>

                <div className="bg-white p-3.5 rounded-2xl rounded-tl-none border border-slate-200 mr-4 shadow-xs space-y-2">
                  <div className="flex items-center gap-1 text-[#f05423] font-bold text-[11px]">
                    <ListOrdered className="w-3.5 h-3.5" />
                    <span>Exact Point-to-Point Solution:</span>
                  </div>
                  <p className="text-slate-700 leading-relaxed font-mono text-[11px]">
                    1. <strong>Local Realism</strong> requires hidden variables.<br />
                    2. <strong>Bell Inequality</strong> proves |E(a,b) - E(a,c)| &le; 1 + E(b,c).<br />
                    3. <strong>Quantum Mechanics</strong> violates bound with S = 2&radic;2 &asymp; 2.828.
                  </p>
                </div>
              </div>

              {/* Bottom status badge */}
              <div className="flex items-center justify-between pt-2 text-[11px] text-slate-500 border-t border-slate-200/60">
                <span className="flex items-center gap-1 text-emerald-600 font-semibold">
                  <CheckCircle2 className="w-3.5 h-3.5" /> Point-to-Point Verified
                </span>
                <span>Powered by OpenAI & FacultyPro</span>
              </div>

            </div>
          </div>

        </div>

      </div>
    </section>
  );
};

export default HowItWorks;
