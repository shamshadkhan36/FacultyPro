import React, { useState, useMemo } from 'react';
import { 
  FileText, 
  Search, 
  ShieldAlert, 
  ShieldCheck, 
  CheckCircle2, 
  Clock, 
  User, 
  Printer, 
  Sparkles, 
  ListChecks, 
  Layers, 
  HardHat, 
  CheckSquare, 
  Square,
  AlertTriangle,
  Download,
  Share2
} from 'lucide-react';
import { sopLibrary } from '../data/sopLibrary';

export const SopLibrary = ({ onStartAiConsultation }) => {
  const [selectedDiscipline, setSelectedDiscipline] = useState('all');
  const [searchQuery, setSearchQuery] = useState('');
  const [selectedSop, setSelectedSop] = useState(sopLibrary[0]);
  const [checkedSteps, setCheckedSteps] = useState({});

  const disciplines = [
    { id: 'all', name: 'All Procedures' },
    { id: 'hvac', name: 'HVAC & Chillers' },
    { id: 'electrical', name: 'Electrical & HT/LT' },
    { id: 'dg', name: 'DG & AMF Systems' },
    { id: 'plumbing', name: 'Plumbing & Pumps' },
    { id: 'fire', name: 'Fire & Sprinklers' },
    { id: 'bms', name: 'BMS Controls' },
  ];

  const filteredSops = useMemo(() => {
    return sopLibrary.filter(sop => {
      const matchDisc = selectedDiscipline === 'all' || sop.discipline === selectedDiscipline;
      const q = searchQuery.toLowerCase().trim();
      const matchSearch = !q ||
        sop.title.toLowerCase().includes(q) ||
        sop.code.toLowerCase().includes(q) ||
        sop.purpose.toLowerCase().includes(q) ||
        sop.category.toLowerCase().includes(q);
      return matchDisc && matchSearch;
    });
  }, [selectedDiscipline, searchQuery]);

  const toggleStep = (sopId, stepNum) => {
    const key = `${sopId}-${stepNum}`;
    setCheckedSteps(prev => ({
      ...prev,
      [key]: !prev[key]
    }));
  };

  const handlePrintSop = () => {
    window.print();
  };

  return (
    <div className="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
      <div className="max-w-7xl mx-auto">
        
        {/* Header */}
        <div className="mb-8 text-center max-w-3xl mx-auto">
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-[#0077c8] text-xs font-bold uppercase tracking-wider mb-3">
            <FileText className="w-4 h-4" />
            <span>Standard Operating Procedures</span>
          </div>
          <h1 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
            MEP Standard Operating Procedures & Safety Protocols
          </h1>
          <p className="mt-2 text-base text-slate-600">
            Standardized start/stop sequences, LOTO electrical isolation protocols, and emergency procedures verified by Licensed Professional Engineers.
          </p>
        </div>

        {/* Filter & Search Bar */}
        <div className="space-y-4 mb-8">
          <div className="relative max-w-2xl mx-auto">
            <Search className="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" />
            <input
              type="text"
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              placeholder="Search SOP by code (e.g. SOP-HVAC-01, SOP-ELEC-01), equipment or procedure..."
              className="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-2xl shadow-sm text-sm font-medium text-slate-900 placeholder:text-slate-400 outline-none focus:border-[#0077c8] focus:ring-2 focus:ring-blue-100 transition-all"
            />
          </div>

          <div className="flex items-center gap-2 overflow-x-auto pb-2 justify-start sm:justify-center no-scrollbar">
            {disciplines.map((disc) => (
              <button
                key={disc.id}
                onClick={() => setSelectedDiscipline(disc.id)}
                className={`px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-all border cursor-pointer ${
                  selectedDiscipline === disc.id
                    ? 'bg-slate-900 text-white border-slate-900 shadow-sm'
                    : 'bg-white text-slate-700 border-slate-200 hover:border-slate-300'
                }`}
              >
                {disc.name}
              </button>
            ))}
          </div>
        </div>

        {/* 2-Column Split: SOP Index & Live Runner */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
          
          {/* Left Column: SOP Cards */}
          <div className="lg:col-span-5 space-y-3">
            <div className="flex items-center justify-between px-1">
              <span className="text-xs font-bold uppercase tracking-wider text-slate-500">
                {filteredSops.length} Standard {filteredSops.length === 1 ? 'Procedure' : 'Procedures'} Available
              </span>
            </div>

            {filteredSops.map((sop) => {
              const isSelected = selectedSop?.id === sop.id;
              return (
                <div
                  key={sop.id}
                  onClick={() => setSelectedSop(sop)}
                  className={`p-4 rounded-xl border transition-all cursor-pointer text-left ${
                    isSelected
                      ? 'bg-white border-[#0077c8] shadow-md ring-2 ring-blue-500/10'
                      : 'bg-white border-slate-200 hover:border-slate-300 hover:shadow-sm'
                  }`}
                >
                  <div className="flex items-center justify-between gap-2">
                    <span className="px-2.5 py-0.5 rounded bg-blue-50 text-[#0077c8] font-mono text-xs font-bold border border-blue-200">
                      {sop.code}
                    </span>
                    <span className="text-[11px] font-semibold text-slate-400">
                      {sop.version} • {sop.effectiveDate}
                    </span>
                  </div>

                  <h3 className="text-sm font-bold text-slate-900 mt-2 line-clamp-2 leading-snug">
                    {sop.title}
                  </h3>

                  <p className="text-xs text-slate-500 mt-1 line-clamp-2">
                    {sop.purpose}
                  </p>

                  <div className="mt-3 pt-2 border-t border-slate-100 flex items-center justify-between text-[11px]">
                    <span className="text-slate-600 font-medium flex items-center gap-1">
                      <HardHat className="w-3 h-3 text-amber-500" />
                      {sop.steps.length} Sequenced Steps
                    </span>
                    <span className="font-bold text-[#0077c8]">View Protocol &rarr;</span>
                  </div>
                </div>
              );
            })}
          </div>

          {/* Right Column: Full SOP Document View & Execution Checklist */}
          <div className="lg:col-span-7">
            {selectedSop ? (
              <div className="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-xl space-y-6 print:p-0 print:border-none print:shadow-none">
                
                {/* SOP Formal Header */}
                <div className="border-b-2 border-slate-900 pb-5">
                  <div className="flex flex-wrap items-center justify-between gap-2 mb-3">
                    <div className="flex items-center gap-2">
                      <span className="px-3 py-1 bg-slate-900 text-white font-mono text-xs font-bold rounded-lg tracking-wider">
                        {selectedSop.code}
                      </span>
                      <span className="px-2.5 py-1 bg-blue-50 text-[#0077c8] text-xs font-bold rounded-lg border border-blue-200">
                        {selectedSop.category}
                      </span>
                    </div>

                    <div className="flex items-center gap-2">
                      <button
                        onClick={handlePrintSop}
                        className="p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-slate-200 text-xs font-semibold flex items-center gap-1 cursor-pointer transition-colors"
                        title="Print SOP Document"
                      >
                        <Printer className="w-3.5 h-3.5" />
                        <span>Print</span>
                      </button>
                    </div>
                  </div>

                  <h2 className="text-xl sm:text-2xl font-black text-slate-900 tracking-tight leading-tight">
                    {selectedSop.title}
                  </h2>

                  <div className="mt-3 grid grid-cols-2 sm:grid-cols-3 gap-2 text-xs text-slate-600 bg-slate-50 p-3 rounded-xl border border-slate-200">
                    <div><span className="font-bold text-slate-800">Version:</span> {selectedSop.version}</div>
                    <div><span className="font-bold text-slate-800">Effective:</span> {selectedSop.effectiveDate}</div>
                    <div><span className="font-bold text-slate-800">Author:</span> {selectedSop.author}</div>
                  </div>

                  <p className="text-xs text-slate-600 mt-3 italic">
                    <strong>Purpose:</strong> {selectedSop.purpose}
                  </p>
                </div>

                {/* PPE Requirements */}
                <div>
                  <h3 className="text-xs font-black uppercase tracking-wider text-slate-900 mb-2.5 flex items-center gap-1.5">
                    <HardHat className="w-4 h-4 text-amber-500" />
                    <span>Mandatory PPE Equipment</span>
                  </h3>
                  <div className="flex flex-wrap gap-2">
                    {selectedSop.ppe.map((item, idx) => (
                      <span key={idx} className="px-3 py-1 rounded-lg bg-amber-50 border border-amber-200 text-amber-900 text-xs font-bold flex items-center gap-1.5">
                        <ShieldCheck className="w-3.5 h-3.5 text-amber-600" />
                        {item}
                      </span>
                    ))}
                  </div>
                </div>

                {/* Hazard Warnings */}
                <div className="p-4 bg-rose-50 border border-rose-200 rounded-xl space-y-1.5">
                  <h3 className="text-xs font-black uppercase tracking-wider text-rose-900 flex items-center gap-1.5">
                    <AlertTriangle className="w-4 h-4 text-rose-600" />
                    <span>Critical Safety Hazards</span>
                  </h3>
                  <ul className="list-disc list-inside text-xs text-rose-800 space-y-1 font-medium">
                    {selectedSop.hazards.map((h, idx) => (
                      <li key={idx}>{h}</li>
                    ))}
                  </ul>
                </div>

                {/* Pre-requisites */}
                <div>
                  <h3 className="text-xs font-black uppercase tracking-wider text-slate-900 mb-2.5 flex items-center gap-1.5">
                    <CheckCircle2 className="w-4 h-4 text-emerald-600" />
                    <span>Pre-Start Mandatory Verification</span>
                  </h3>
                  <div className="space-y-2">
                    {selectedSop.prerequisites.map((req, idx) => (
                      <div key={idx} className="p-2.5 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-800 font-medium flex items-start gap-2">
                        <span className="w-4 h-4 rounded bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center shrink-0 text-[10px]">
                          ✓
                        </span>
                        <span>{req}</span>
                      </div>
                    ))}
                  </div>
                </div>

                {/* Interactive Step-by-Step Procedure */}
                <div>
                  <h3 className="text-xs font-black uppercase tracking-wider text-slate-900 mb-3 flex items-center gap-1.5">
                    <ListChecks className="w-4 h-4 text-[#0077c8]" />
                    <span>Step-by-Step Execution Sequence (Field Checklist)</span>
                  </h3>
                  <div className="space-y-3">
                    {selectedSop.steps.map((step) => {
                      const isChecked = checkedSteps[`${selectedSop.id}-${step.stepNumber}`] || false;
                      return (
                        <div
                          key={step.stepNumber}
                          onClick={() => toggleStep(selectedSop.id, step.stepNumber)}
                          className={`p-3.5 rounded-xl border transition-all cursor-pointer flex items-start gap-3 ${
                            isChecked
                              ? 'bg-emerald-50/60 border-emerald-300'
                              : 'bg-white border-slate-200 hover:border-slate-300'
                          }`}
                        >
                          <button className="mt-0.5 text-slate-500 hover:text-emerald-600 cursor-pointer">
                            {isChecked ? (
                              <CheckSquare className="w-5 h-5 text-emerald-600 fill-emerald-100" />
                            ) : (
                              <Square className="w-5 h-5 text-slate-400" />
                            )}
                          </button>
                          
                          <div className="flex-1">
                            <div className="flex items-center gap-2">
                              <span className={`px-2 py-0.5 rounded text-[10px] font-bold ${
                                isChecked ? 'bg-emerald-200 text-emerald-900' : 'bg-slate-100 text-slate-700'
                              }`}>
                                Step {step.stepNumber}
                              </span>
                              <h4 className={`text-xs font-bold ${isChecked ? 'text-emerald-950 line-through' : 'text-slate-900'}`}>
                                {step.title}
                              </h4>
                            </div>
                            <p className="text-xs text-slate-600 mt-1 leading-relaxed">
                              {step.description}
                            </p>
                          </div>
                        </div>
                      );
                    })}
                  </div>
                </div>

                {/* AI Troubleshooting Hook */}
                <div className="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                  <div className="text-xs text-slate-500">
                    Encountered an anomaly during procedure execution?
                  </div>
                  <button
                    onClick={() => onStartAiConsultation(`We are executing ${selectedSop.code}: "${selectedSop.title}". Please provide real-time troubleshooting for any parameter deviations or step alarms.`)}
                    className="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#0077c8] to-[#0099f7] hover:from-[#006bb5] text-white text-xs font-bold rounded-xl shadow-md cursor-pointer transition-all"
                  >
                    <Sparkles className="w-3.5 h-3.5 text-amber-300" />
                    <span>Troubleshoot SOP with AI</span>
                  </button>
                </div>

              </div>
            ) : (
              <div className="bg-white rounded-2xl p-12 text-center border border-slate-200">
                <FileText className="w-12 h-12 text-slate-300 mx-auto mb-3" />
                <h3 className="text-base font-bold text-slate-700">Select an SOP procedure</h3>
              </div>
            )}
          </div>

        </div>

      </div>
    </div>
  );
};

export default SopLibrary;
