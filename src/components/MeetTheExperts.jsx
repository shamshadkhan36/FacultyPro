import React, { useState } from 'react';
import { faculties } from '../data/faculties';
import { 
  CheckCircle2, 
  ChevronLeft, 
  ChevronRight, 
  Star, 
  ArrowRight,
  ShieldCheck,
  Award
} from 'lucide-react';

export const MeetTheExperts = ({ onSelectFaculty }) => {
  const [startIndex, setStartIndex] = useState(0);
  const itemsPerPage = 3;

  const institutions = [
    'ISHRAE & ASHRAE AI Chilled Water Models',
    'Indian Plumbing Association (IPA) & ASPE AI',
    'IEEE & CPRI High-Voltage Electrical Models',
    'NFPA & FSAI Certified Fire Safety AI',
    'Licensed Professional Engineers (PE, FPE) Backed',
    'IS / NBC & LEED AP Building Code Engines'
  ];

  const handleNext = () => {
    setStartIndex((prev) => (prev + 1) % (faculties.length - itemsPerPage + 1));
  };

  const handlePrev = () => {
    setStartIndex((prev) => (prev === 0 ? 0 : prev - 1));
  };

  const visibleFaculties = faculties.slice(startIndex, startIndex + itemsPerPage);

  return (
    <section id="experts" className="py-16 sm:py-24 bg-white border-b border-slate-200/70">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
          
          {/* Left Column */}
          <div className="lg:col-span-4 space-y-6">
            
            <div className="flex items-center justify-between">
              <div>
                <span className="text-xs font-black uppercase tracking-widest text-[#f05423] bg-orange-50 px-3 py-1 rounded-full border border-orange-100 inline-block mb-2">
                  AI Engineering Intelligence
                </span>
                <h2 className="text-3xl sm:text-4xl font-extrabold text-[#0b2545] tracking-tight">
                  Meet the AI MEP Experts
                </h2>
              </div>
              
              <div className="flex items-center gap-2">
                <button
                  onClick={handlePrev}
                  disabled={startIndex === 0}
                  className={`w-9 h-9 rounded-full border border-slate-200 flex items-center justify-center text-slate-600 hover:border-[#0077c8] hover:text-[#0077c8] transition-colors cursor-pointer ${
                    startIndex === 0 ? 'opacity-40 cursor-not-allowed' : ''
                  }`}
                >
                  <ChevronLeft className="w-5 h-5" />
                </button>
                <button
                  onClick={handleNext}
                  disabled={startIndex >= faculties.length - itemsPerPage}
                  className={`w-9 h-9 rounded-full border border-slate-200 flex items-center justify-center text-slate-600 hover:border-[#0077c8] hover:text-[#0077c8] transition-colors cursor-pointer ${
                    startIndex >= faculties.length - itemsPerPage ? 'opacity-40 cursor-not-allowed' : ''
                  }`}
                >
                  <ChevronRight className="w-5 h-5" />
                </button>
              </div>
            </div>

            <p className="text-sm text-slate-600 leading-relaxed">
              Our domain-specialized AI Engineering Consultants are modeled after premier Indian & international MEP consultants, trained on verified standards including:
            </p>

            {/* Checklist */}
            <ul className="space-y-3 pt-2">
              {institutions.map((inst, idx) => (
                <li key={idx} className="flex items-center gap-3 text-sm font-semibold text-slate-800">
                  <CheckCircle2 className="w-4 h-4 text-emerald-500 shrink-0" />
                  <span>{inst}</span>
                </li>
              ))}
            </ul>

            <div className="pt-2">
              <div className="p-4 rounded-2xl bg-slate-50 border border-slate-200/90 text-xs text-slate-600 space-y-1">
                <div className="font-bold text-slate-800 flex items-center gap-1.5">
                  <ShieldCheck className="w-4 h-4 text-[#0077c8]" />
                  <span>24/7 Instant AI Calculation Guarantee</span>
                </div>
                <p className="text-[11px] text-slate-500">
                  Every AI consultant delivers verified equations, Indian NBC / IS standards, and international ASHRAE/NFPA code calculations in under 5 seconds.
                </p>
              </div>
            </div>

          </div>

          {/* Right Column: Expert Cards Grid */}
          <div className="lg:col-span-8">
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
              {visibleFaculties.map((fac) => (
                <div
                  key={fac.id}
                  className="bg-white rounded-2xl border border-slate-200/90 hover:border-[#0077c8] p-6 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between space-y-4 group"
                >
                  <div className="space-y-3">
                    
                    <div className="flex items-center gap-3.5">
                      <div className="relative shrink-0">
                        <img
                          src={fac.avatar}
                          alt={fac.name}
                          className="w-14 h-14 rounded-full object-cover ring-2 ring-slate-100 group-hover:ring-[#0077c8] transition-all"
                        />
                        <span className="absolute bottom-0 right-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full" title="AI Online"></span>
                      </div>
                      <div>
                        <div className="flex items-center gap-1.5">
                          <h4 className="font-bold text-sm sm:text-base text-slate-900 group-hover:text-[#0077c8] transition-colors leading-tight">
                            {fac.name}
                          </h4>
                        </div>
                        <span className="inline-block mt-0.5 px-2 py-0.5 rounded-full bg-purple-50 text-purple-700 border border-purple-200 text-[10px] font-bold">
                          {fac.aiBadge || 'AI Specialist'}
                        </span>
                        <div className="flex items-center gap-0.5 text-amber-500 text-xs mt-1">
                          <Star className="w-3.5 h-3.5 fill-amber-400 text-amber-400" />
                          <Star className="w-3.5 h-3.5 fill-amber-400 text-amber-400" />
                          <Star className="w-3.5 h-3.5 fill-amber-400 text-amber-400" />
                          <Star className="w-3.5 h-3.5 fill-amber-400 text-amber-400" />
                          <Star className="w-3.5 h-3.5 fill-amber-400 text-amber-400" />
                        </div>
                      </div>
                    </div>

                    <div className="space-y-1">
                      <h5 className="text-xs font-bold text-slate-800 uppercase tracking-wide">
                        {fac.title.split('&')[0]}
                      </h5>
                      <p className="text-xs text-slate-500 line-clamp-3 leading-relaxed">
                        {fac.degrees}. {fac.experience}.
                      </p>
                    </div>

                  </div>

                  <div className="pt-3 border-t border-slate-100">
                    <button
                      onClick={() => onSelectFaculty(fac)}
                      className="w-full py-2.5 px-3 rounded-xl bg-blue-50 hover:bg-[#0077c8] text-[#0077c8] hover:text-white font-bold text-xs transition-colors flex items-center justify-center gap-1.5 cursor-pointer"
                    >
                      <span>Consult {fac.name.split(' ')[1] || 'AI'} (AI)</span>
                      <ArrowRight className="w-3 h-3" />
                    </button>
                  </div>

                </div>
              ))}
            </div>
          </div>

        </div>

      </div>
    </section>
  );
};

export default MeetTheExperts;
