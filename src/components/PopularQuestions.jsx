import React, { useState } from 'react';
import { popularQuestions } from '../data/popularQuestions';
import { ArrowRight, Sparkles, CheckCircle2, Wind, Droplets, Zap, Flame, Wrench } from 'lucide-react';

const iconMap = {
  Wind,
  Droplets,
  Zap,
  Flame,
  Wrench
};

export const PopularQuestions = ({ onSelectQuestion }) => {
  const [imageErrors, setImageErrors] = useState({});

  const handleImageError = (id) => {
    setImageErrors((prev) => ({
      ...prev,
      [id]: true
    }));
  };

  return (
    <section id="popular" className="py-16 sm:py-20 bg-slate-50 border-b border-slate-200/60">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-12">
          <h2 className="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
            Popular questions at Facility<span className="text-[#f05423]">Pro</span>
          </h2>
          <p className="text-sm sm:text-base text-slate-600 mt-2.5 font-normal">
            Real problems solved with point-to-point step-by-step clarity by verified professors and licensed engineers.
          </p>
        </div>

        {/* 4 Cards Grid */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          {popularQuestions.map((q) => {
            const Icon = iconMap[q.fallbackIcon] || Wrench;
            const hasError = imageErrors[q.id];

            return (
              <div
                key={q.id}
                onClick={() => onSelectQuestion(q)}
                className="group bg-white rounded-2xl overflow-hidden border border-slate-200/90 hover:border-[#0077c8] shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between cursor-pointer transform hover:-translate-y-1"
              >
                <div className="p-6 space-y-3">
                  {/* Category Header */}
                  <div className="flex items-center justify-between">
                    <span className="text-lg font-black text-slate-900 tracking-tight group-hover:text-[#0077c8] transition-colors">
                      {q.category}
                    </span>
                    <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-[#0077c8] border border-blue-100">
                      Verified
                    </span>
                  </div>

                  {/* Question Excerpt */}
                  <p className="text-xs sm:text-sm text-slate-600 line-clamp-4 leading-relaxed font-medium">
                    {q.excerpt}
                  </p>

                  {/* Faculty badge preview */}
                  <div className="pt-2 flex items-center gap-1.5 text-[11px] font-semibold text-slate-500">
                    <CheckCircle2 className="w-3.5 h-3.5 text-emerald-500 shrink-0" />
                    <span className="truncate">Answered by {q.facultyName.split(',')[0]}</span>
                  </div>
                </div>

                {/* Bottom Image Container with Graceful Fallback */}
                <div className="relative h-44 sm:h-48 overflow-hidden bg-slate-100 flex items-center justify-center">
                  {!hasError ? (
                    <img
                      src={q.image}
                      alt={`${q.category} Engineering`}
                      loading="lazy"
                      referrerPolicy="no-referrer"
                      onError={() => handleImageError(q.id)}
                      className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    />
                  ) : (
                    <div className="w-full h-full bg-gradient-to-br from-slate-800 to-slate-900 flex flex-col items-center justify-center text-white p-4 text-center">
                      <Icon className="w-10 h-10 text-[#f05423] mb-2 opacity-90" />
                      <span className="text-xs font-bold">{q.category} Engineering</span>
                    </div>
                  )}
                  
                  {/* Hover CTA Overlay */}
                  <div className="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-end p-4">
                    <div className="w-full flex items-center justify-between text-white font-bold text-xs bg-[#f05423] py-2 px-3.5 rounded-xl shadow-lg">
                      <span>View Point-to-Point Answer</span>
                      <ArrowRight className="w-3.5 h-3.5" />
                    </div>
                  </div>
                </div>

              </div>
            );
          })}
        </div>

        {/* Bottom prompt helper */}
        <div className="mt-10 text-center">
          <span className="inline-flex items-center gap-2 text-xs sm:text-sm text-slate-500 font-medium bg-white px-4 py-2 rounded-full border border-slate-200 shadow-xs">
            <Sparkles className="w-4 h-4 text-[#f05423]" />
            Have a different question? Type it directly in the search bar above or the chat helper.
          </span>
        </div>

      </div>
    </section>
  );
};

export default PopularQuestions;
