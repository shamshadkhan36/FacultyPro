import React, { useState, useEffect } from 'react';
import { 
  LayoutDashboard, 
  Users, 
  FileText, 
  BookOpen, 
  Sparkles, 
  Plus, 
  Trash2, 
  Edit3, 
  CheckCircle2, 
  AlertCircle, 
  TrendingUp, 
  Database, 
  Shield, 
  Search, 
  Save,
  Check,
  X,
  Clock,
  Activity
} from 'lucide-react';
import { knowledgeArticles } from '../data/knowledgeBase';
import { sopLibrary } from '../data/sopLibrary';

export const AdminPanel = ({ onStartAiConsultation }) => {
  const [activeTab, setActiveTab] = useState('overview');

  // Local state initialized with datasets
  const [kbList, setKbList] = useState(knowledgeArticles);
  const [sops, setSops] = useState(sopLibrary);
  
  // Simulated Users Table
  const [userList, setUserList] = useState([
    { id: 'usr-1', name: 'Shamshad Khan', email: 'shamshad@apexprime.com', role: 'Facility Director', company: 'Apex Towers', plan: 'Business', status: 'Active', queriesUsed: 142 },
    { id: 'usr-2', name: 'John Doe', email: 'johnd@marriott-dubai.com', role: 'Chief Engineer', company: 'Marriott Resort', plan: 'Enterprise', status: 'Active', queriesUsed: 380 },
    { id: 'usr-3', name: 'Alina Perez', email: 'alina.p@hilton.com', role: 'MEP Maintenance Lead', company: 'Hilton Worldwide', plan: 'Professional', status: 'Active', queriesUsed: 89 },
    { id: 'usr-4', name: 'Vikram Mehta', email: 'vikram@dlf-cyber.in', role: 'HVAC Specialist', company: 'DLF Cybercity', plan: 'Free', status: 'Active', queriesUsed: 5 },
  ]);

  // Simulated AI Logs
  const [aiLogs] = useState([
    { id: 'log-1', time: '14:45:12', user: 'Shamshad Khan', discipline: 'Fire Fighting', latency: '640ms', tokens: 820, status: 'Success 200' },
    { id: 'log-2', time: '14:41:03', user: 'John Doe', discipline: 'HVAC & Chillers', latency: '710ms', tokens: 950, status: 'Success 200' },
    { id: 'log-3', time: '14:38:29', user: 'Alina Perez', discipline: 'Electrical HT/LT', latency: '580ms', tokens: 740, status: 'Success 200' },
    { id: 'log-4', time: '14:32:55', user: 'Vikram Mehta', discipline: 'Plumbing & Pumps', latency: '490ms', tokens: 610, status: 'Success 200' },
  ]);

  // Form states for creating KB / SOP
  const [showAddKbModal, setShowAddKbModal] = useState(false);
  const [newKbTitle, setNewKbTitle] = useState('');
  const [newKbCategory, setNewKbCategory] = useState('HVAC & Chilled Water');
  const [newKbCodeRef, setNewKbCodeRef] = useState('ASHRAE Standard 90.1');
  const [newKbSummary, setNewKbSummary] = useState('');

  const [showAddSopModal, setShowAddSopModal] = useState(false);
  const [newSopCode, setNewSopCode] = useState('SOP-GEN-01');
  const [newSopTitle, setNewSopTitle] = useState('');
  const [newSopCategory, setNewSopCategory] = useState('HVAC & Chilled Water');
  const [newSopAuthor, setNewSopAuthor] = useState('Chief Plant Engineer');
  const [newSopPurpose, setNewSopPurpose] = useState('');

  const handleAddKb = (e) => {
    e.preventDefault();
    if (!newKbTitle || !newKbSummary) return;
    const newArticle = {
      id: `kb-custom-${Date.now()}`,
      discipline: 'hvac',
      title: newKbTitle,
      category: newKbCategory,
      readTime: '5 min read',
      codeRef: newKbCodeRef,
      summary: newKbSummary,
      keyPoints: ['Protocol verified by Facility Admin', 'Adheres to facility standard operating limits.'],
      faultMatrix: [
        { symptom: 'Abnormal vibration or alarm', cause: 'Component mechanical stress', remedy: 'Perform inspection according to OEM manual' }
      ]
    };
    setKbList([newArticle, ...kbList]);
    setShowAddKbModal(false);
    setNewKbTitle('');
    setNewKbSummary('');
  };

  const handleDeleteKb = (id) => {
    if (window.confirm('Are you sure you want to delete this knowledge article?')) {
      setKbList(kbList.filter(item => item.id !== id));
    }
  };

  const handleAddSop = (e) => {
    e.preventDefault();
    if (!newSopTitle || !newSopCode) return;
    const newSopItem = {
      id: `sop-custom-${Date.now()}`,
      code: newSopCode,
      title: newSopTitle,
      category: newSopCategory,
      discipline: 'hvac',
      version: 'v1.0',
      effectiveDate: 'Mar 2026',
      author: newSopAuthor,
      purpose: newSopPurpose || 'Standard Operating Procedure established by facility management.',
      ppe: ['Safety Shoes', 'Safety Glasses', 'Gloves'],
      hazards: ['General electrical & mechanical pinch points'],
      prerequisites: ['Verify area is cleared and work permit is signed.'],
      steps: [
        { stepNumber: 1, title: 'Pre-Start Verification', description: 'Confirm isolation valves and power feeds are nominal.' },
        { stepNumber: 2, title: 'Execution', description: 'Operate unit under calibrated setpoints.' }
      ]
    };
    setSops([newSopItem, ...sops]);
    setShowAddSopModal(false);
    setNewSopCode('SOP-GEN-01');
    setNewSopTitle('');
    setNewSopPurpose('');
  };

  const handleDeleteSop = (id) => {
    if (window.confirm('Delete this SOP procedure from the repository?')) {
      setSops(sops.filter(s => s.id !== id));
    }
  };

  const handlePlanChange = (userId, newPlan) => {
    setUserList(userList.map(u => u.id === userId ? { ...u, plan: newPlan } : u));
  };

  return (
    <div className="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
      <div className="max-w-7xl mx-auto space-y-8">
        
        {/* Admin Header */}
        <div className="bg-slate-900 text-white rounded-2xl p-6 sm:p-8 shadow-xl border border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div>
            <div className="flex items-center gap-2 mb-1">
              <span className="px-2.5 py-0.5 rounded-full bg-rose-500/20 text-rose-300 text-xs font-bold border border-rose-400/30 flex items-center gap-1">
                <Shield className="w-3.5 h-3.5" /> SuperAdmin Portal
              </span>
              <span className="text-xs text-slate-400">v2.4.0 Live Production</span>
            </div>
            <h1 className="text-2xl sm:text-3xl font-black tracking-tight">
              FacilityPro Engineering Admin Console
            </h1>
            <p className="text-xs text-slate-400 mt-1">
              Manage engineering datasets, SOP workflows, user subscription tiers, and monitor AI telemetry.
            </p>
          </div>

          <div className="flex items-center gap-2">
            <button
              onClick={() => onStartAiConsultation('Perform automated system health audit and report any discrepancies across plant SOPs.')}
              className="px-4 py-2.5 rounded-xl bg-[#0077c8] hover:bg-[#0066ad] text-white font-bold text-xs shadow-md transition-all cursor-pointer flex items-center gap-1.5"
            >
              <Sparkles className="w-4 h-4 text-amber-300" />
              <span>AI System Audit</span>
            </button>
          </div>
        </div>

        {/* Overview Stats Cards */}
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-4">
          <div className="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <div className="flex items-center justify-between text-slate-500 mb-2">
              <span className="text-xs font-bold uppercase tracking-wider">Total AI Consultations</span>
              <Sparkles className="w-4 h-4 text-[#f05423]" />
            </div>
            <div className="text-2xl sm:text-3xl font-black text-slate-900">1,842</div>
            <div className="text-[11px] text-emerald-600 font-bold mt-1 flex items-center gap-1">
              <TrendingUp className="w-3 h-3" /> +18.4% this week
            </div>
          </div>

          <div className="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <div className="flex items-center justify-between text-slate-500 mb-2">
              <span className="text-xs font-bold uppercase tracking-wider">Active Engineers</span>
              <Users className="w-4 h-4 text-[#0077c8]" />
            </div>
            <div className="text-2xl sm:text-3xl font-black text-slate-900">{userList.length * 48}</div>
            <div className="text-[11px] text-slate-500 font-medium mt-1">Across 14 Hotel & Plant Chains</div>
          </div>

          <div className="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <div className="flex items-center justify-between text-slate-500 mb-2">
              <span className="text-xs font-bold uppercase tracking-wider">Managed SOPs</span>
              <FileText className="w-4 h-4 text-amber-500" />
            </div>
            <div className="text-2xl sm:text-3xl font-black text-slate-900">{sops.length}</div>
            <div className="text-[11px] text-emerald-600 font-bold mt-1">100% ISO & OSHA Compliant</div>
          </div>

          <div className="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <div className="flex items-center justify-between text-slate-500 mb-2">
              <span className="text-xs font-bold uppercase tracking-wider">Knowledge Base</span>
              <BookOpen className="w-4 h-4 text-emerald-500" />
            </div>
            <div className="text-2xl sm:text-3xl font-black text-slate-900">{kbList.length}</div>
            <div className="text-[11px] text-slate-500 font-medium mt-1">8 Core Engineering Disciplines</div>
          </div>
        </div>

        {/* Navigation Tabs */}
        <div className="flex items-center gap-2 border-b border-slate-200 pb-2 overflow-x-auto no-scrollbar">
          <button
            onClick={() => setActiveTab('overview')}
            className={`flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs transition-all cursor-pointer ${
              activeTab === 'overview' ? 'bg-slate-900 text-white shadow-sm' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100'
            }`}
          >
            <LayoutDashboard className="w-4 h-4" />
            <span>Dashboard Overview</span>
          </button>

          <button
            onClick={() => setActiveTab('kb')}
            className={`flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs transition-all cursor-pointer ${
              activeTab === 'kb' ? 'bg-slate-900 text-white shadow-sm' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100'
            }`}
          >
            <BookOpen className="w-4 h-4" />
            <span>Knowledge Base ({kbList.length})</span>
          </button>

          <button
            onClick={() => setActiveTab('sop')}
            className={`flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs transition-all cursor-pointer ${
              activeTab === 'sop' ? 'bg-slate-900 text-white shadow-sm' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100'
            }`}
          >
            <FileText className="w-4 h-4" />
            <span>SOP Procedures ({sops.length})</span>
          </button>

          <button
            onClick={() => setActiveTab('users')}
            className={`flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs transition-all cursor-pointer ${
              activeTab === 'users' ? 'bg-slate-900 text-white shadow-sm' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100'
            }`}
          >
            <Users className="w-4 h-4" />
            <span>Users & Subscriptions ({userList.length})</span>
          </button>

          <button
            onClick={() => setActiveTab('logs')}
            className={`flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs transition-all cursor-pointer ${
              activeTab === 'logs' ? 'bg-slate-900 text-white shadow-sm' : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100'
            }`}
          >
            <Activity className="w-4 h-4 text-emerald-500" />
            <span>AI Telemetry Logs</span>
          </button>
        </div>

        {/* TAB 1: OVERVIEW */}
        {activeTab === 'overview' && (
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div className="lg:col-span-8 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
              <h3 className="text-base font-bold text-slate-900 flex items-center gap-2">
                <Activity className="w-4 h-4 text-[#0077c8]" />
                <span>Live Engineering Activity Stream</span>
              </h3>
              <div className="divide-y divide-slate-100 text-xs">
                {aiLogs.map((log) => (
                  <div key={log.id} className="py-3 flex items-center justify-between">
                    <div>
                      <span className="font-bold text-slate-800">{log.user}</span>
                      <span className="text-slate-500"> queried </span>
                      <span className="font-bold text-[#0077c8]">{log.discipline}</span>
                    </div>
                    <div className="flex items-center gap-3 text-slate-400">
                      <span>{log.latency}</span>
                      <span className="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold">{log.status}</span>
                    </div>
                  </div>
                ))}
              </div>
            </div>

            <div className="lg:col-span-4 bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
              <h3 className="text-base font-bold text-slate-900">System Health</h3>
              <div className="space-y-3 text-xs">
                <div>
                  <div className="flex justify-between mb-1 font-semibold text-slate-600">
                    <span>OpenAI API Latency</span>
                    <span className="text-emerald-600 font-bold">580ms (Normal)</span>
                  </div>
                  <div className="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div className="bg-emerald-500 h-full w-4/5" />
                  </div>
                </div>
                <div>
                  <div className="flex justify-between mb-1 font-semibold text-slate-600">
                    <span>Knowledge Embeddings Index</span>
                    <span className="text-emerald-600 font-bold">100% Synced</span>
                  </div>
                  <div className="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div className="bg-[#0077c8] h-full w-full" />
                  </div>
                </div>
                <div>
                  <div className="flex justify-between mb-1 font-semibold text-slate-600">
                    <span>Daily Token Quota Usage</span>
                    <span className="text-slate-800 font-bold">42% (58k / 150k)</span>
                  </div>
                  <div className="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div className="bg-amber-500 h-full w-[42%]" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        )}

        {/* TAB 2: KNOWLEDGE BASE MANAGEMENT */}
        {activeTab === 'kb' && (
          <div className="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div className="flex items-center justify-between border-b pb-4">
              <div>
                <h3 className="text-lg font-bold text-slate-900">Engineering Knowledge Articles</h3>
                <p className="text-xs text-slate-500">Manage technical references, standards, and troubleshooting trees.</p>
              </div>
              <button
                onClick={() => setShowAddKbModal(true)}
                className="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold flex items-center gap-1.5 cursor-pointer"
              >
                <Plus className="w-3.5 h-3.5" />
                <span>Add New Article</span>
              </button>
            </div>

            {/* Add KB Modal */}
            {showAddKbModal && (
              <form onSubmit={handleAddKb} className="p-5 bg-slate-50 border border-slate-200 rounded-xl space-y-4 text-xs animate-in fade-in">
                <div className="flex justify-between items-center font-bold text-sm text-slate-900">
                  <span>Create New Engineering Knowledge Entry</span>
                  <button type="button" onClick={() => setShowAddKbModal(false)}><X className="w-4 h-4" /></button>
                </div>
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                  <div>
                    <label className="font-bold text-slate-700 block mb-1">Article Title</label>
                    <input type="text" required value={newKbTitle} onChange={e => setNewKbTitle(e.target.value)} placeholder="e.g. Variable Primary Chilled Water Flow Control" className="w-full p-2 bg-white border border-slate-300 rounded-lg outline-none" />
                  </div>
                  <div>
                    <label className="font-bold text-slate-700 block mb-1">Discipline Category</label>
                    <select value={newKbCategory} onChange={e => setNewKbCategory(e.target.value)} className="w-full p-2 bg-white border border-slate-300 rounded-lg outline-none">
                      <option>HVAC & Chilled Water</option>
                      <option>Electrical & Power</option>
                      <option>Plumbing & Drainage</option>
                      <option>BMS & Automation</option>
                      <option>DG Sets & Backup</option>
                      <option>Fire & Life Safety</option>
                    </select>
                  </div>
                  <div>
                    <label className="font-bold text-slate-700 block mb-1">Engineering Code / Standard Ref</label>
                    <input type="text" value={newKbCodeRef} onChange={e => setNewKbCodeRef(e.target.value)} className="w-full p-2 bg-white border border-slate-300 rounded-lg outline-none" />
                  </div>
                  <div>
                    <label className="font-bold text-slate-700 block mb-1">Summary Overview</label>
                    <input type="text" required value={newKbSummary} onChange={e => setNewKbSummary(e.target.value)} placeholder="Brief description of the engineering concept..." className="w-full p-2 bg-white border border-slate-300 rounded-lg outline-none" />
                  </div>
                </div>
                <button type="submit" className="px-4 py-2 bg-[#0077c8] hover:bg-[#0066ad] text-white font-bold rounded-lg cursor-pointer">
                  Save Article to Live DB
                </button>
              </form>
            )}

            {/* List */}
            <div className="divide-y divide-slate-100">
              {kbList.map((article) => (
                <div key={article.id} className="py-4 flex items-start justify-between gap-4">
                  <div>
                    <div className="flex items-center gap-2">
                      <span className="px-2 py-0.5 rounded bg-blue-50 text-[#0077c8] font-bold text-[11px] border border-blue-200">
                        {article.category}
                      </span>
                      <span className="text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">
                        {article.codeRef}
                      </span>
                    </div>
                    <h4 className="text-sm font-bold text-slate-900 mt-1">{article.title}</h4>
                    <p className="text-xs text-slate-500 mt-0.5 line-clamp-1">{article.summary}</p>
                  </div>

                  <button
                    onClick={() => handleDeleteKb(article.id)}
                    className="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg cursor-pointer transition-colors"
                    title="Delete Article"
                  >
                    <Trash2 className="w-4 h-4" />
                  </button>
                </div>
              ))}
            </div>
          </div>
        )}

        {/* TAB 3: SOP PROCEDURES */}
        {activeTab === 'sop' && (
          <div className="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div className="flex items-center justify-between border-b pb-4">
              <div>
                <h3 className="text-lg font-bold text-slate-900">Standard Operating Procedures</h3>
                <p className="text-xs text-slate-500">Add or modify facility operational steps and safety LOTO sequences.</p>
              </div>
              <button
                onClick={() => setShowAddSopModal(true)}
                className="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold flex items-center gap-1.5 cursor-pointer"
              >
                <Plus className="w-3.5 h-3.5" />
                <span>Create New SOP</span>
              </button>
            </div>

            {/* Add SOP Form */}
            {showAddSopModal && (
              <form onSubmit={handleAddSop} className="p-5 bg-slate-50 border border-slate-200 rounded-xl space-y-4 text-xs animate-in fade-in">
                <div className="flex justify-between items-center font-bold text-sm text-slate-900">
                  <span>Create Standard Operating Procedure</span>
                  <button type="button" onClick={() => setShowAddSopModal(false)}><X className="w-4 h-4" /></button>
                </div>
                <div className="grid grid-cols-1 sm:grid-cols-3 gap-3">
                  <div>
                    <label className="font-bold text-slate-700 block mb-1">Document Code</label>
                    <input type="text" required value={newSopCode} onChange={e => setNewSopCode(e.target.value)} placeholder="SOP-HVAC-05" className="w-full p-2 bg-white border border-slate-300 rounded-lg outline-none" />
                  </div>
                  <div>
                    <label className="font-bold text-slate-700 block mb-1">SOP Title</label>
                    <input type="text" required value={newSopTitle} onChange={e => setNewSopTitle(e.target.value)} placeholder="Cooling Tower Basin De-scaling Procedure" className="w-full p-2 bg-white border border-slate-300 rounded-lg outline-none" />
                  </div>
                  <div>
                    <label className="font-bold text-slate-700 block mb-1">Category</label>
                    <select value={newSopCategory} onChange={e => setNewSopCategory(e.target.value)} className="w-full p-2 bg-white border border-slate-300 rounded-lg outline-none">
                      <option>HVAC & Chilled Water</option>
                      <option>Electrical & Power</option>
                      <option>Plumbing & Drainage</option>
                      <option>DG Sets & Backup</option>
                      <option>Fire & Life Safety</option>
                    </select>
                  </div>
                </div>
                <div>
                  <label className="font-bold text-slate-700 block mb-1">Operational Purpose</label>
                  <input type="text" value={newSopPurpose} onChange={e => setNewSopPurpose(e.target.value)} placeholder="Sequential instructions for safe plant operation..." className="w-full p-2 bg-white border border-slate-300 rounded-lg outline-none" />
                </div>
                <button type="submit" className="px-4 py-2 bg-[#0077c8] hover:bg-[#0066ad] text-white font-bold rounded-lg cursor-pointer">
                  Publish SOP Procedure
                </button>
              </form>
            )}

            {/* List */}
            <div className="divide-y divide-slate-100">
              {sops.map((sop) => (
                <div key={sop.id} className="py-4 flex items-start justify-between gap-4">
                  <div>
                    <div className="flex items-center gap-2">
                      <span className="px-2 py-0.5 rounded bg-slate-900 text-white font-mono text-xs font-bold">
                        {sop.code}
                      </span>
                      <span className="text-xs font-bold text-slate-500">
                        {sop.category} ({sop.steps.length} Steps)
                      </span>
                    </div>
                    <h4 className="text-sm font-bold text-slate-900 mt-1">{sop.title}</h4>
                    <p className="text-xs text-slate-500 mt-0.5 line-clamp-1">{sop.purpose}</p>
                  </div>

                  <button
                    onClick={() => handleDeleteSop(sop.id)}
                    className="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg cursor-pointer transition-colors"
                    title="Delete SOP"
                  >
                    <Trash2 className="w-4 h-4" />
                  </button>
                </div>
              ))}
            </div>
          </div>
        )}

        {/* TAB 4: USER & SUBSCRIPTIONS */}
        {activeTab === 'users' && (
          <div className="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-6">
            <div>
              <h3 className="text-lg font-bold text-slate-900">Registered Facility Engineers & Subscriptions</h3>
              <p className="text-xs text-slate-500">Manage account access, active plan tiers, and AI query allotments.</p>
            </div>

            <div className="overflow-x-auto border border-slate-200 rounded-xl">
              <table className="w-full text-left text-xs border-collapse">
                <thead>
                  <tr className="bg-slate-100 text-slate-700 font-bold border-b border-slate-200">
                    <th className="p-3">Engineer / Name</th>
                    <th className="p-3">Company / Site</th>
                    <th className="p-3">Subscription Tier</th>
                    <th className="p-3">AI Queries Used</th>
                    <th className="p-3">Account Status</th>
                    <th className="p-3 text-right">Actions</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-100 font-medium text-slate-800">
                  {userList.map((usr) => (
                    <tr key={usr.id} className="hover:bg-slate-50/80 transition-colors">
                      <td className="p-3">
                        <div className="font-bold text-slate-900">{usr.name}</div>
                        <div className="text-[11px] text-slate-400">{usr.email}</div>
                      </td>
                      <td className="p-3">
                        <div>{usr.company}</div>
                        <div className="text-[11px] text-slate-500">{usr.role}</div>
                      </td>
                      <td className="p-3">
                        <select
                          value={usr.plan}
                          onChange={(e) => handlePlanChange(usr.id, e.target.value)}
                          className="px-2 py-1 bg-slate-50 border border-slate-300 rounded font-bold text-slate-900 outline-none"
                        >
                          <option value="Free">Free</option>
                          <option value="Professional">Professional</option>
                          <option value="Business">Business</option>
                          <option value="Enterprise">Enterprise</option>
                        </select>
                      </td>
                      <td className="p-3 font-bold text-slate-700">{usr.queriesUsed} queries</td>
                      <td className="p-3">
                        <span className="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px] border border-emerald-200">
                          {usr.status}
                        </span>
                      </td>
                      <td className="p-3 text-right">
                        <button
                          onClick={() => alert(`Password reset link dispatched to ${usr.email}`)}
                          className="text-[11px] text-[#0077c8] font-bold hover:underline cursor-pointer"
                        >
                          Reset Access
                        </button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}

        {/* TAB 5: AI TELEMETRY LOGS */}
        {activeTab === 'logs' && (
          <div className="bg-slate-900 text-slate-100 rounded-2xl p-6 border border-slate-800 font-mono text-xs space-y-4">
            <div className="flex items-center justify-between border-b border-slate-800 pb-3">
              <span className="text-emerald-400 font-bold flex items-center gap-2">
                <Activity className="w-4 h-4" /> Live AI Inference & Telemetry Stream
              </span>
              <span className="text-slate-400 text-[11px]">Real-time polling active</span>
            </div>

            <div className="space-y-2">
              {aiLogs.map((log) => (
                <div key={log.id} className="p-2.5 bg-slate-800/60 rounded border border-slate-700/60 flex items-center justify-between">
                  <div>
                    <span className="text-slate-400">[{log.time}]</span>{' '}
                    <span className="text-white font-bold">{log.user}</span>{' '}
                    <span className="text-sky-400">&gt;&gt;</span>{' '}
                    <span className="text-amber-300">{log.discipline}</span>
                  </div>
                  <div className="flex items-center gap-4 text-slate-400">
                    <span>{log.tokens} tokens</span>
                    <span>{log.latency}</span>
                    <span className="text-emerald-400 font-bold">{log.status}</span>
                  </div>
                </div>
              ))}
            </div>
          </div>
        )}

      </div>
    </div>
  );
};

export default AdminPanel;
