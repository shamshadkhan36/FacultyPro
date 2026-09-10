import React from 'react';
import { 
  ArrowRight,
  Zap,
  ListOrdered,
  CheckCircle2,
  Wrench,
  Cpu,
  FileCheck
} from 'lucide-react';

export const HowItWorks = ({ onTryNow }) => {
  return (
    <section id="how-it-works" className="py-16 sm:py-24 bg-white border-b border-slate-200/70 overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Section Header */}
        <div className="mb-16">
          <h2 className="text-3xl sm:text-4xl font-extrabold text-[#0b2545] tracking-tight">
            How FacilityPro works
          </h2>
          <p className="text-slate-600 text-sm sm:text-base mt-2 max-w-xl">
            Simple 3-step process to get verified MEP engineering calculations, troubleshooting steps, and standard code compliance in seconds.
          </p>
        </div>

        {/* 3 Step Visual Grid */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          {/* Steps Left Column */}
          <div className="lg:col-span-6 space-y-10">
            
            {/* Step 1 */}
            <div className="flex items-start gap-5 group">
              <div className="shrink-0 w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-[#0077c8] font-black text-lg group-hover:bg-[#0077c8] group-hover:text-white transition-colors duration-200 shadow-xs">
                1
              </div>
              <div className="space-y-1.5">
                <h3 className="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                  Submit your MEP or Plant Issue
                </h3>
                <p className="text-sm text-slate-600 leading-relaxed">
                  Describe your situation across HVAC chillers, plumbing booster pumps, transformer inrush trips, or fire sprinkler calculations.
                </p>
                <div className="pt-1 flex items-center gap-2 text-xs text-[#0077c8] font-semibold">
                  <span>• System symptoms, equipment parameters, or design drawings</span>
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
                  OpenAI & Senior MEP Engineer Synthesis
                </h3>
                <p className="text-sm text-slate-600 leading-relaxed">
                  Our dual reasoning engine cross-references ASHRAE, NFPA, NEC/IEC, and IPC standards to formulate exact sizing equations and step-by-step diagnostic checklists with zero fluff.
                </p>
                <div className="pt-1 flex items-center gap-2 text-xs text-[#f05423] font-semibold">
                  <span>• Fluff-free engineering equations and valve/breaker settings</span>
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
                  Code-Compliant Point-to-Point Solution & Chat
                </h3>
                <p className="text-sm text-slate-600 leading-relaxed">
                  Receive structured bullet points, formulas, preventive maintenance steps, and carry on interactive follow-up questions with your assigned Licensed PE.
                </p>
                <div className="pt-1 flex items-center gap-2 text-xs text-emerald-600 font-semibold">
                  <span>• Export as site documentation notes or continue live discussion</span>
                </div>
              </div>
            </div>

            <div className="pt-4">
              <button
                onClick={onTryNow}
                className="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#0077c8] hover:bg-[#0066ad] text-white font-bold text-sm shadow-md hover:shadow-lg transition-all duration-150 cursor-pointer"
              >
                <span>Try Asking an MEP Question Now</span>
                <ArrowRight className="w-4 h-4" />
              </button>
            </div>

          </div>

          {/* Graphic Right Column */}
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
                    src="/images/avatar_rajesh_sharma.jpg"
                    alt="AI HVAC Consultant"
                    className="w-12 h-12 rounded-full object-cover ring-2 ring-[#0077c8]/20"
                  />
                  <span className="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full" title="AI Active"></span>
                </div>
                <div>
                  <div className="flex items-center gap-1.5">
                    <h4 className="font-bold text-sm text-slate-900">Er. Rajesh Sharma</h4>
                    <span className="text-[10px] bg-purple-50 text-purple-700 px-1.5 py-0.5 rounded font-bold border border-purple-200">AI Specialist</span>
                  </div>
                  <div className="flex items-center gap-1 text-amber-500 text-xs font-semibold">
                    <span>★★★★★</span>
                    <span className="text-slate-500 font-normal text-[11px]">(58,420 resolved cases)</span>
                  </div>
                </div>
              </div>

              {/* Chat snippet preview */}
              <div className="space-y-2.5 text-xs">
                <div className="bg-[#0077c8] text-white p-3 rounded-2xl rounded-tr-none ml-6 shadow-xs">
                  <p className="font-medium">Chiller approach temperature is 6.5°F and surging under 85% load. How to diagnose?</p>
                </div>

                <div className="bg-white p-3.5 rounded-2xl rounded-tl-none border border-slate-200 mr-4 shadow-xs space-y-2">
                  <div className="flex items-center gap-1 text-[#f05423] font-bold text-[11px]">
                    <ListOrdered className="w-3.5 h-3.5" />
                    <span>Exact Point-to-Point Solution:</span>
                  </div>
                  <p className="text-slate-700 leading-relaxed font-mono text-[11px]">
                    1. <strong>Approach Temp</strong> = T_sat - T_leaving (&gt; 3°F indicates tube scaling).<br />
                    2. <strong>Surging Lift</strong> forces compressor above impeller stall curve.<br />
                    3. <strong>Action</strong>: Run non-condensable purge & check cooling tower COC.
                  </p>
                </div>
              </div>

              {/* Bottom status badge */}
              <div className="flex items-center justify-between pt-2 text-[11px] text-slate-500 border-t border-slate-200/60">
                <span className="flex items-center gap-1 text-emerald-600 font-semibold">
                  <CheckCircle2 className="w-3.5 h-3.5" /> ASHRAE / NFPA / NEC Verified
                </span>
                <span>Powered by OpenAI & FacilityPro</span>
              </div>

            </div>
          </div>

        </div>

      </div>
    </section>
  );
};

export default HowItWorks;
