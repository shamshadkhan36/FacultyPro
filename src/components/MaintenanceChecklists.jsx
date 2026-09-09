import React, { useState, useMemo } from 'react';
import { 
  CheckSquare, 
  Square, 
  Clock, 
  AlertCircle, 
  CheckCircle2, 
  ShieldAlert, 
  Printer, 
  RotateCcw, 
  FileCheck, 
  Sparkles, 
  Calendar, 
  UserCheck, 
  BarChart3,
  Search,
  Check
} from 'lucide-react';
import { checklistTemplates } from '../data/checklists';

export const MaintenanceChecklists = ({ onStartAiConsultation }) => {
  const [selectedTemplate, setSelectedTemplate] = useState(checklistTemplates[0]);
  const [itemStatuses, setItemStatuses] = useState({});
  const [itemNotes, setItemNotes] = useState({});
  const [inspectorName, setInspectorName] = useState('Chief Plant Engineer');
  const [locationTag, setLocationTag] = useState('Central Plant Room - Basement B2');
  const [reportGenerated, setReportGenerated] = useState(false);

  // Compute progress for current template
  const currentItems = selectedTemplate.items;
  const completedCount = currentItems.filter(item => itemStatuses[`${selectedTemplate.id}-${item.id}`]).length;
  const progressPercent = Math.round((completedCount / currentItems.length) * 100);

  const toggleItem = (itemId) => {
    const key = `${selectedTemplate.id}-${itemId}`;
    setItemStatuses(prev => ({
      ...prev,
      [key]: !prev[key]
    }));
  };

  const handleResetChecklist = () => {
    if (window.confirm('Reset all items in this checklist?')) {
      const updated = { ...itemStatuses };
      selectedTemplate.items.forEach(item => {
        delete updated[`${selectedTemplate.id}-${item.id}`];
      });
      setItemStatuses(updated);
      setReportGenerated(false);
    }
  };

  const handlePrintReport = () => {
    window.print();
  };

  return (
    <div className="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
      <div className="max-w-7xl mx-auto">
        
        {/* Header */}
        <div className="mb-8 text-center max-w-3xl mx-auto">
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-[#0077c8] text-xs font-bold uppercase tracking-wider mb-3">
            <FileCheck className="w-4 h-4" />
            <span>Interactive PPM & Inspections</span>
          </div>
          <h1 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
            Facility PPM & Preventive Maintenance Checklists
          </h1>
          <p className="mt-2 text-base text-slate-600">
            Interactive daily shift logs, weekly DG tests, monthly substation audits, and pre-monsoon readiness checklists with auditable report generation.
          </p>
        </div>

        {/* Template Selector Cards */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
          {checklistTemplates.map((template) => {
            const isSelected = selectedTemplate.id === template.id;
            const tempCompleted = template.items.filter(item => itemStatuses[`${template.id}-${item.id}`]).length;
            const tempPercent = Math.round((tempCompleted / template.items.length) * 100);

            return (
              <div
                key={template.id}
                onClick={() => { setSelectedTemplate(template); setReportGenerated(false); }}
                className={`p-4 rounded-xl border transition-all cursor-pointer text-left ${
                  isSelected
                    ? 'bg-white border-[#0077c8] shadow-md ring-2 ring-blue-500/10'
                    : 'bg-white border-slate-200 hover:border-slate-300 hover:shadow-sm'
                }`}
              >
                <div className="flex items-center justify-between gap-2">
                  <span className="px-2.5 py-0.5 rounded bg-blue-50 text-[#0077c8] text-xs font-bold border border-blue-200">
                    {template.frequency}
                  </span>
                  <span className="text-[11px] font-semibold text-slate-400 flex items-center gap-1">
                    <Clock className="w-3 h-3" />
                    {template.estimatedTime}
                  </span>
                </div>

                <h3 className="text-sm font-bold text-slate-900 mt-2 line-clamp-2">
                  {template.title}
                </h3>

                {/* Progress bar */}
                <div className="mt-3">
                  <div className="flex items-center justify-between text-[11px] font-semibold mb-1">
                    <span className="text-slate-500">{tempCompleted}/{template.items.length} Checked</span>
                    <span className={tempPercent === 100 ? 'text-emerald-600 font-bold' : 'text-slate-700'}>{tempPercent}%</span>
                  </div>
                  <div className="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                    <div 
                      className={`h-full transition-all duration-300 ${tempPercent === 100 ? 'bg-emerald-500' : 'bg-[#0077c8]'}`}
                      style={{ width: `${tempPercent}%` }}
                    />
                  </div>
                </div>
              </div>
            );
          })}
        </div>

        {/* Active Checklist Workspace */}
        <div className="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
          
          {/* Header Bar */}
          <div className="p-6 sm:p-8 border-b border-slate-200 bg-slate-900 text-white flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
              <div className="flex items-center gap-2 mb-1">
                <span className="px-2.5 py-0.5 rounded bg-[#0077c8] text-white text-xs font-bold uppercase tracking-wider">
                  {selectedTemplate.category}
                </span>
                <span className="text-xs text-slate-300 font-semibold">
                  Frequency: {selectedTemplate.frequency}
                </span>
              </div>
              <h2 className="text-xl sm:text-2xl font-black tracking-tight">
                {selectedTemplate.title}
              </h2>
            </div>

            <div className="flex items-center gap-3">
              <div className="bg-slate-800 px-4 py-2 rounded-xl border border-slate-700 text-right">
                <div className="text-[10px] uppercase font-bold text-slate-400">Audit Completion</div>
                <div className="text-lg font-black text-emerald-400">{progressPercent}% Completed</div>
              </div>
              <button
                onClick={handleResetChecklist}
                className="p-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-300 hover:text-white transition-colors cursor-pointer"
                title="Reset Checklist"
              >
                <RotateCcw className="w-4 h-4" />
              </button>
            </div>
          </div>

          {/* Inspector Details Bar */}
          <div className="bg-slate-50 border-b border-slate-200 p-4 px-6 sm:px-8 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-semibold">
            <div>
              <label className="block text-slate-500 mb-1 font-bold uppercase tracking-wider">Inspector / Duty Engineer</label>
              <input
                type="text"
                value={inspectorName}
                onChange={(e) => setInspectorName(e.target.value)}
                className="w-full px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-slate-800 outline-none focus:border-[#0077c8]"
              />
            </div>
            <div>
              <label className="block text-slate-500 mb-1 font-bold uppercase tracking-wider">Plant Location & Equipment Tag</label>
              <input
                type="text"
                value={locationTag}
                onChange={(e) => setLocationTag(e.target.value)}
                className="w-full px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-slate-800 outline-none focus:border-[#0077c8]"
              />
            </div>
          </div>

          {/* Checklist Items List */}
          <div className="p-6 sm:p-8 space-y-3">
            {selectedTemplate.items.map((item, idx) => {
              const isDone = itemStatuses[`${selectedTemplate.id}-${item.id}`] || false;
              const priorityColors = {
                Critical: 'bg-rose-50 text-rose-700 border-rose-200',
                High: 'bg-amber-50 text-amber-700 border-amber-200',
                Medium: 'bg-blue-50 text-blue-700 border-blue-200',
              };

              return (
                <div
                  key={item.id}
                  className={`p-4 rounded-xl border transition-all ${
                    isDone 
                      ? 'bg-emerald-50/50 border-emerald-300' 
                      : 'bg-white border-slate-200 hover:border-slate-300'
                  }`}
                >
                  <div className="flex items-start gap-3">
                    <button
                      onClick={() => toggleItem(item.id)}
                      className="mt-0.5 text-slate-400 hover:text-emerald-600 cursor-pointer"
                    >
                      {isDone ? (
                        <CheckSquare className="w-5 h-5 text-emerald-600 fill-emerald-100" />
                      ) : (
                        <Square className="w-5 h-5 text-slate-400" />
                      )}
                    </button>

                    <div className="flex-1">
                      <div className="flex flex-wrap items-center gap-2">
                        <span className="text-xs font-mono font-bold text-slate-400">#{idx + 1}</span>
                        <span className={`px-2 py-0.5 rounded text-[10px] font-bold border ${priorityColors[item.priority] || priorityColors.Medium}`}>
                          {item.priority} Priority
                        </span>
                        <span className={`text-xs font-bold ${isDone ? 'text-emerald-950 line-through' : 'text-slate-900'}`}>
                          {item.text}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              );
            })}
          </div>

          {/* Action Footer */}
          <div className="bg-slate-50 p-6 sm:p-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div className="text-xs text-slate-600 font-medium">
              {completedCount === currentItems.length ? (
                <span className="text-emerald-700 font-bold flex items-center gap-1">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600" /> All {currentItems.length} inspection tasks verified & ready for sign-off.
                </span>
              ) : (
                <span>{currentItems.length - completedCount} tasks remaining in this inspection cycle.</span>
              )}
            </div>

            <div className="flex items-center gap-3 w-full sm:w-auto">
              <button
                onClick={() => onStartAiConsultation(`Analyze potential plant risks and maintenance recommendations for our "${selectedTemplate.title}" audit where ${completedCount}/${currentItems.length} items have passed.`)}
                className="flex-1 sm:flex-initial px-4 py-2.5 rounded-xl border border-slate-300 hover:bg-white text-xs font-bold text-slate-700 flex items-center justify-center gap-1.5 cursor-pointer shadow-xs"
              >
                <Sparkles className="w-3.5 h-3.5 text-[#0077c8]" />
                <span>Verify with AI</span>
              </button>

              <button
                onClick={() => { setReportGenerated(true); window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' }); }}
                className="flex-1 sm:flex-initial px-5 py-2.5 rounded-xl bg-[#0077c8] hover:bg-[#0066ad] text-white text-xs font-bold shadow-md cursor-pointer transition-all"
              >
                Generate Audit Report
              </button>
            </div>
          </div>

          {/* Generated Formal Audit Report Block */}
          {reportGenerated && (
            <div className="p-6 sm:p-8 bg-white border-t-4 border-[#0077c8] space-y-6 print:border-none">
              <div className="flex items-center justify-between border-b pb-4">
                <div>
                  <h3 className="text-lg font-black text-slate-900 uppercase tracking-tight">
                    Facility Engineering Compliance Certificate
                  </h3>
                  <p className="text-xs text-slate-500">Document Generated: {new Date().toLocaleString()} | ID: AUD-{Date.now().toString().slice(-6)}</p>
                </div>
                <button
                  onClick={handlePrintReport}
                  className="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold cursor-pointer transition-all"
                >
                  <Printer className="w-3.5 h-3.5" />
                  <span>Print Certificate</span>
                </button>
              </div>

              <div className="grid grid-cols-2 sm:grid-cols-4 gap-4 bg-slate-50 p-4 rounded-xl border border-slate-200 text-xs">
                <div><span className="font-bold text-slate-500 block">Inspection Template:</span> {selectedTemplate.title}</div>
                <div><span className="font-bold text-slate-500 block">Inspector:</span> {inspectorName}</div>
                <div><span className="font-bold text-slate-500 block">Location:</span> {locationTag}</div>
                <div><span className="font-bold text-slate-500 block">Compliance Rate:</span> <span className="font-bold text-emerald-600">{progressPercent}% ({completedCount}/{currentItems.length})</span></div>
              </div>

              <div className="pt-4 border-t flex items-center justify-between text-xs text-slate-500">
                <div>Authorized Signatory: _________________________</div>
                <div className="text-emerald-700 font-bold">FacilityPro Verified Audit Standard</div>
              </div>
            </div>
          )}

        </div>

      </div>
    </div>
  );
};

export default MaintenanceChecklists;
