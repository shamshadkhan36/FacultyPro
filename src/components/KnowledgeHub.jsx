import React, { useState, useMemo } from 'react';
import { 
  BookOpen, 
  Search, 
  Wind, 
  Zap, 
  Droplets, 
  Cpu, 
  Gauge, 
  RotateCw, 
  Flame, 
  Building2, 
  CheckCircle2, 
  AlertTriangle, 
  FileText, 
  Sparkles, 
  ArrowRight, 
  Filter, 
  Clock, 
  ShieldCheck,
  ChevronRight,
  ExternalLink
} from 'lucide-react';
import { knowledgeDisciplines, knowledgeArticles } from '../data/knowledgeBase';

const iconMap = {
  Wind,
  Zap,
  Droplets,
  Cpu,
  Gauge,
  RotateCw,
  Flame,
  Building2
};

export const KnowledgeHub = ({ onStartAiConsultation }) => {
  const [selectedDiscipline, setSelectedDiscipline] = useState('all');
  const [searchQuery, setSearchQuery] = useState('');
  const [selectedArticle, setSelectedArticle] = useState(knowledgeArticles[0]);

  const filteredArticles = useMemo(() => {
    return knowledgeArticles.filter(article => {
      const matchesDiscipline = selectedDiscipline === 'all' || article.discipline === selectedDiscipline;
      const q = searchQuery.toLowerCase().trim();
      const matchesSearch = !q || 
        article.title.toLowerCase().includes(q) ||
        article.summary.toLowerCase().includes(q) ||
        article.category.toLowerCase().includes(q) ||
        (article.codeRef && article.codeRef.toLowerCase().includes(q)) ||
        (article.keyPoints && article.keyPoints.some(kp => kp.toLowerCase().includes(q)));
      return matchesDiscipline && matchesSearch;
    });
  }, [selectedDiscipline, searchQuery]);

  return (
    <div className="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
      <div className="max-w-7xl mx-auto">
        
        {/* Header */}
        <div className="mb-8 text-center max-w-3xl mx-auto">
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-[#0077c8] text-xs font-bold uppercase tracking-wider mb-3">
            <BookOpen className="w-4 h-4" />
            <span>Engineering Knowledge Repository</span>
          </div>
          <h1 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
            MEP Engineering Knowledge & Troubleshooting Hub
          </h1>
          <p className="mt-2 text-base text-slate-600">
            Authoritative technical guides, ASHRAE/NFPA/IEEE standard references, and root cause fault matrices across 8 core facility disciplines.
          </p>
        </div>

        {/* Search and Discipline Filter Bar */}
        <div className="space-y-4 mb-8">
          {/* Search bar */}
          <div className="relative max-w-2xl mx-auto">
            <Search className="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" />
            <input
              type="text"
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              placeholder="Search by symptom, standard code (e.g. ASHRAE 90.1, NFPA 13, IEEE 87T), or equipment..."
              className="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-2xl shadow-sm text-sm font-medium text-slate-900 placeholder:text-slate-400 outline-none focus:border-[#0077c8] focus:ring-2 focus:ring-blue-100 transition-all"
            />
          </div>

          {/* 8 Disciplines Filter Pills */}
          <div className="flex items-center gap-2 overflow-x-auto pb-2 justify-start sm:justify-center no-scrollbar">
            <button
              onClick={() => setSelectedDiscipline('all')}
              className={`px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-all border cursor-pointer ${
                selectedDiscipline === 'all'
                  ? 'bg-slate-900 text-white border-slate-900 shadow-sm'
                  : 'bg-white text-slate-700 border-slate-200 hover:border-slate-300'
              }`}
            >
              All Disciplines ({knowledgeArticles.length})
            </button>
            {knowledgeDisciplines.map((disc) => {
              const Icon = iconMap[disc.icon] || BookOpen;
              const count = knowledgeArticles.filter(a => a.discipline === disc.id).length;
              const isSelected = selectedDiscipline === disc.id;
              return (
                <button
                  key={disc.id}
                  onClick={() => setSelectedDiscipline(disc.id)}
                  className={`flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-all border cursor-pointer ${
                    isSelected
                      ? 'bg-[#0077c8] text-white border-[#0077c8] shadow-sm'
                      : 'bg-white text-slate-700 border-slate-200 hover:border-slate-300'
                  }`}
                >
                  <Icon className="w-3.5 h-3.5" />
                  <span>{disc.name}</span>
                  <span className={`px-1.5 py-0.2 rounded-full text-[10px] ${isSelected ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'}`}>
                    {count}
                  </span>
                </button>
              );
            })}
          </div>
        </div>

        {/* 2-Column Split: Article List & Detail View */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
          
          {/* Left Column: Article List */}
          <div className="lg:col-span-5 space-y-3">
            <div className="flex items-center justify-between px-1">
              <span className="text-xs font-bold uppercase tracking-wider text-slate-500">
                {filteredArticles.length} Technical {filteredArticles.length === 1 ? 'Article' : 'Articles'} Found
              </span>
            </div>

            {filteredArticles.length === 0 ? (
              <div className="bg-white rounded-2xl p-8 text-center border border-slate-200">
                <AlertTriangle className="w-8 h-8 text-amber-500 mx-auto mb-2" />
                <h3 className="text-base font-bold text-slate-800">No articles found</h3>
                <p className="text-xs text-slate-500 mt-1">Try refining your search query or select All Disciplines.</p>
              </div>
            ) : (
              filteredArticles.map((article) => {
                const isSelected = selectedArticle?.id === article.id;
                const disc = knowledgeDisciplines.find(d => d.id === article.discipline);
                const Icon = disc ? (iconMap[disc.icon] || BookOpen) : BookOpen;
                return (
                  <div
                    key={article.id}
                    onClick={() => setSelectedArticle(article)}
                    className={`p-4 rounded-xl border transition-all cursor-pointer text-left ${
                      isSelected
                        ? 'bg-white border-[#0077c8] shadow-md ring-2 ring-blue-500/10'
                        : 'bg-white border-slate-200 hover:border-slate-300 hover:shadow-sm'
                    }`}
                  >
                    <div className="flex items-start justify-between gap-2">
                      <span className="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-[#0077c8] border border-blue-200/60">
                        <Icon className="w-3 h-3" />
                        <span>{article.category}</span>
                      </span>
                      <span className="text-[11px] font-semibold text-slate-400 flex items-center gap-1">
                        <Clock className="w-3 h-3" />
                        {article.readTime}
                      </span>
                    </div>

                    <h3 className="text-sm font-bold text-slate-900 mt-2 line-clamp-2 leading-snug">
                      {article.title}
                    </h3>

                    <p className="text-xs text-slate-500 mt-1 line-clamp-2">
                      {article.summary}
                    </p>

                    <div className="mt-3 flex items-center justify-between pt-2 border-t border-slate-100 text-[11px]">
                      <span className="font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                        {article.codeRef}
                      </span>
                      <span className="font-bold text-[#0077c8] flex items-center gap-0.5">
                        Read Guide <ChevronRight className="w-3.5 h-3.5" />
                      </span>
                    </div>
                  </div>
                );
              })
            )}
          </div>

          {/* Right Column: Active Article Full View */}
          <div className="lg:col-span-7">
            {selectedArticle ? (
              <div className="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xl sticky top-24 space-y-6">
                
                {/* Article Header */}
                <div className="border-b border-slate-100 pb-5">
                  <div className="flex flex-wrap items-center justify-between gap-2 mb-3">
                    <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-sky-50 text-[#0077c8] border border-sky-200">
                      <span>{selectedArticle.category}</span>
                    </span>
                    <span className="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                      Standard: {selectedArticle.codeRef}
                    </span>
                  </div>

                  <h2 className="text-xl sm:text-2xl font-black text-slate-900 tracking-tight leading-tight">
                    {selectedArticle.title}
                  </h2>

                  <p className="text-sm text-slate-600 mt-2 leading-relaxed">
                    {selectedArticle.summary}
                  </p>
                </div>

                {/* Key Engineering Principles */}
                <div>
                  <h3 className="text-xs font-black uppercase tracking-wider text-slate-900 mb-3 flex items-center gap-1.5">
                    <CheckCircle2 className="w-4 h-4 text-emerald-600" />
                    <span>Key Engineering Rules & Protocols</span>
                  </h3>
                  <div className="space-y-2.5">
                    {selectedArticle.keyPoints.map((pt, idx) => (
                      <div key={idx} className="p-3 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-800 leading-relaxed">
                        {pt}
                      </div>
                    ))}
                  </div>
                </div>

                {/* Root Cause Fault Matrix */}
                {selectedArticle.faultMatrix && selectedArticle.faultMatrix.length > 0 && (
                  <div>
                    <h3 className="text-xs font-black uppercase tracking-wider text-slate-900 mb-3 flex items-center gap-1.5">
                      <AlertTriangle className="w-4 h-4 text-amber-500" />
                      <span>Troubleshooting Fault-Remedy Matrix</span>
                    </h3>
                    <div className="overflow-x-auto border border-slate-200 rounded-xl">
                      <table className="w-full text-left text-xs border-collapse">
                        <thead>
                          <tr className="bg-slate-100 text-slate-700 font-bold border-b border-slate-200">
                            <th className="p-2.5">Observed Symptom</th>
                            <th className="p-2.5">Probable Root Cause</th>
                            <th className="p-2.5 text-emerald-800">Corrective Engineering Action</th>
                          </tr>
                        </thead>
                        <tbody className="divide-y divide-slate-100 text-slate-800 font-medium">
                          {selectedArticle.faultMatrix.map((row, idx) => (
                            <tr key={idx} className="hover:bg-slate-50/80 transition-colors">
                              <td className="p-2.5 font-bold text-rose-700 align-top">{row.symptom}</td>
                              <td className="p-2.5 text-slate-600 align-top">{row.cause}</td>
                              <td className="p-2.5 text-emerald-900 bg-emerald-50/40 font-semibold align-top">{row.remedy}</td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    </div>
                  </div>
                )}

                {/* Call to Action: Consult AI */}
                <div className="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                  <div className="text-xs text-slate-500">
                    Need live diagnostic calculations for your site?
                  </div>
                  <button
                    onClick={() => onStartAiConsultation(`I need engineering troubleshooting regarding "${selectedArticle.title}" adhering to ${selectedArticle.codeRef}. Please analyze root cause and corrective actions.`)}
                    className="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#0077c8] to-[#0099f7] hover:from-[#006bb5] text-white text-xs font-bold rounded-xl shadow-md cursor-pointer transition-all"
                  >
                    <Sparkles className="w-3.5 h-3.5 text-amber-300" />
                    <span>Consult AI on this Topic</span>
                  </button>
                </div>

              </div>
            ) : (
              <div className="bg-white rounded-2xl p-12 text-center border border-slate-200 shadow-sm">
                <BookOpen className="w-12 h-12 text-slate-300 mx-auto mb-3" />
                <h3 className="text-base font-bold text-slate-700">Select an article to view details</h3>
              </div>
            )}
          </div>

        </div>

      </div>
    </div>
  );
};

export default KnowledgeHub;
