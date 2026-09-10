import React, { useState } from 'react';
import { 
  User, 
  ShieldCheck, 
  History, 
  Bookmark, 
  CreditCard, 
  Sparkles, 
  Activity, 
  CheckCircle2, 
  Clock, 
  ArrowUpRight, 
  FileText, 
  Calculator, 
  Sliders,
  Zap,
  Wind,
  Droplets,
  Flame,
  Check
} from 'lucide-react';
import { subscriptionPlans } from '../data/subscriptionPlans';

export const UserDashboard = ({ onStartAiConsultation, onOpenPricing, onOpenCalculator, onOpenSop }) => {
  const [activeTab, setActiveTab] = useState('history');

  // Simulated User Data
  const user = {
    name: 'Shamshad Khan',
    role: 'Chief MEP & Facility Manager',
    company: 'Apex Prime Commercial Towers',
    email: 'shamshad.khan@apexprime.com',
    planId: 'pro-399',
    joinedDate: 'January 2026',
    queriesRemaining: 84,
    totalQueriesLimit: 100,
  };

  const currentPlan = subscriptionPlans.find(p => p.id === user.planId) || subscriptionPlans[1];

  // Simulated Consultation History
  const [historyItems] = useState([
    {
      id: 'hist-1',
      date: 'Today at 02:45 PM',
      faculty: 'Er. Rajesh Sharma (AI HVAC)',
      specialty: 'HVAC & Chilled Water',
      question: 'Calculate NFPA 13 sprinkler water demand for Extra Hazard Group 1 warehouse.',
      status: 'Resolved',
      answerSummary: 'Design density 0.30 gpm/sq.ft over 2,500 sq.ft design area + 500 GPM hose stream allowance yields 1,362 GPM total demand at 7.2 bar.'
    },
    {
      id: 'hist-2',
      date: 'Yesterday at 11:20 AM',
      faculty: 'Dr. Vikram Malhotra (AI Electrical)',
      specialty: 'Electrical & Power Systems',
      question: '11kV transformer differential relay 87T trip on cold energization.',
      status: 'Resolved',
      answerSummary: 'Enabled 15% 2nd harmonic restraint in numerical relay to block magnetizing inrush while preserving fault sensitivity.'
    },
    {
      id: 'hist-3',
      date: '3 days ago',
      faculty: 'Er. Amit Patel (AI Plumbing)',
      specialty: 'Plumbing & Drainage',
      question: 'Water hammer surge on high-rise booster pump shutdown.',
      status: 'Resolved',
      answerSummary: 'Installed dual-chamber bladder surge tank (100L, pre-charge 4.2 bar) and adjusted VFD deceleration ramp to 18 seconds.'
    }
  ]);

  // Saved Calculations
  const [savedCalculations] = useState([
    { id: 'calc-1', name: 'Tower B Chiller Plant Sizing', result: '350.0 TR (1,230 kW)', date: 'Mar 08, 2026', type: 'Cooling Load' },
    { id: 'calc-2', name: 'AHU-04 Main Supply Trunk', result: '24" x 16" Duct (3,200 CFM)', date: 'Mar 06, 2026', type: 'Ductwork' },
    { id: 'calc-3', name: 'Substation Feeder 1 Drop', result: '185 mm² Cu (1.4% Drop)', date: 'Mar 04, 2026', type: 'Electrical Cable' },
  ]);

  return (
    <div className="bg-slate-50 py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
      <div className="max-w-7xl mx-auto space-y-8">
        
        {/* User Profile Banner */}
        <div className="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white rounded-2xl p-6 sm:p-8 shadow-xl border border-slate-800">
          <div className="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div className="flex items-center gap-4">
              <div className="w-16 h-16 rounded-2xl bg-gradient-to-tr from-[#0077c8] via-[#0099f7] to-[#f05423] text-white flex items-center justify-center font-black text-2xl shadow-lg">
                SK
              </div>
              <div>
                <div className="flex items-center gap-2">
                  <h1 className="text-2xl font-black tracking-tight">{user.name}</h1>
                  <span className="px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold border border-emerald-400/30 flex items-center gap-1">
                    <ShieldCheck className="w-3.5 h-3.5" /> Verified Engineer
                  </span>
                </div>
                <p className="text-xs text-slate-300 font-medium mt-0.5">{user.role} • {user.company}</p>
                <p className="text-xs text-slate-400">{user.email} • Member since {user.joinedDate}</p>
              </div>
            </div>

            {/* Plan Badge & Quick Action */}
            <div className="flex flex-wrap items-center gap-3">
              <div className="bg-slate-800/90 px-4 py-2.5 rounded-xl border border-slate-700 text-right">
                <div className="text-[10px] uppercase font-bold text-slate-400">Current Plan</div>
                <div className="text-sm font-black text-[#f05423]">{currentPlan.name} Plan</div>
                <div className="text-[11px] text-slate-300">{user.queriesRemaining}/{user.totalQueriesLimit} AI Queries Remaining</div>
              </div>
              <button
                onClick={() => onStartAiConsultation('I need point-to-point assistance with plant diagnostics.')}
                className="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#0077c8] to-[#0099f7] hover:from-[#006bb5] text-white font-bold text-xs shadow-md transition-all cursor-pointer flex items-center gap-1.5"
              >
                <Sparkles className="w-4 h-4 text-amber-300" />
                <span>New AI Problem</span>
              </button>
            </div>
          </div>

          {/* Plant Telemetry Summary */}
          <div className="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6 pt-6 border-t border-slate-800 text-xs">
            <div className="bg-slate-800/50 p-3 rounded-xl border border-slate-700/60">
              <div className="text-slate-400 flex items-center gap-1.5">
                <Wind className="w-3.5 h-3.5 text-sky-400" /> Chiller Plant COP
              </div>
              <div className="text-lg font-black text-white mt-1">5.82 <span className="text-xs font-normal text-emerald-400">(Optimal)</span></div>
            </div>
            <div className="bg-slate-800/50 p-3 rounded-xl border border-slate-700/60">
              <div className="text-slate-400 flex items-center gap-1.5">
                <Zap className="w-3.5 h-3.5 text-amber-400" /> Substation Power Factor
              </div>
              <div className="text-lg font-black text-white mt-1">0.99 <span className="text-xs font-normal text-emerald-400">(Target met)</span></div>
            </div>
            <div className="bg-slate-800/50 p-3 rounded-xl border border-slate-700/60">
              <div className="text-slate-400 flex items-center gap-1.5">
                <Flame className="w-3.5 h-3.5 text-rose-400" /> Fire Tank Reservoir
              </div>
              <div className="text-lg font-black text-white mt-1">350 m³ <span className="text-xs font-normal text-slate-300">(100% Full)</span></div>
            </div>
            <div className="bg-slate-800/50 p-3 rounded-xl border border-slate-700/60">
              <div className="text-slate-400 flex items-center gap-1.5">
                <Activity className="w-3.5 h-3.5 text-emerald-400" /> PPM Compliance
              </div>
              <div className="text-lg font-black text-emerald-400 mt-1">98.4% <span className="text-xs font-normal text-slate-300">(Passing)</span></div>
            </div>
          </div>
        </div>

        {/* Dashboard Tabs */}
        <div className="flex items-center gap-2 border-b border-slate-200 pb-2">
          <button
            onClick={() => setActiveTab('history')}
            className={`flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs transition-all cursor-pointer ${
              activeTab === 'history'
                ? 'bg-slate-900 text-white shadow-sm'
                : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100'
            }`}
          >
            <History className="w-4 h-4 text-[#f05423]" />
            <span>AI Consultation History ({historyItems.length})</span>
          </button>

          <button
            onClick={() => setActiveTab('saved')}
            className={`flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs transition-all cursor-pointer ${
              activeTab === 'saved'
                ? 'bg-slate-900 text-white shadow-sm'
                : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100'
            }`}
          >
            <Bookmark className="w-4 h-4 text-blue-500" />
            <span>Saved Calculations ({savedCalculations.length})</span>
          </button>

          <button
            onClick={() => setActiveTab('plan')}
            className={`flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs transition-all cursor-pointer ${
              activeTab === 'plan'
                ? 'bg-slate-900 text-white shadow-sm'
                : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-100'
            }`}
          >
            <CreditCard className="w-4 h-4 text-emerald-500" />
            <span>Subscription & Billing</span>
          </button>
        </div>

        {/* TAB 1: HISTORY */}
        {activeTab === 'history' && (
          <div className="space-y-4">
            {historyItems.map((item) => (
              <div
                key={item.id}
                className="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow"
              >
                <div className="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-3 mb-3">
                  <div className="flex items-center gap-2">
                    <span className="px-2.5 py-0.5 rounded-full bg-blue-50 text-[#0077c8] text-xs font-bold border border-blue-200">
                      {item.specialty}
                    </span>
                    <span className="text-xs font-bold text-slate-700">{item.faculty}</span>
                  </div>
                  <span className="text-xs text-slate-400 font-medium flex items-center gap-1">
                    <Clock className="w-3.5 h-3.5" />
                    {item.date}
                  </span>
                </div>

                <h3 className="text-sm font-bold text-slate-900 mb-2">
                  Q: {item.question}
                </h3>

                <div className="p-3.5 bg-slate-50 border border-slate-200/80 rounded-xl text-xs text-slate-800 leading-relaxed font-medium">
                  <span className="font-bold text-[#0077c8] block mb-1">Point-to-Point Solution Summary:</span>
                  {item.answerSummary}
                </div>

                <div className="mt-4 flex items-center justify-end gap-2">
                  <button
                    onClick={() => onStartAiConsultation(`Reopening discussion regarding previous solution: "${item.question}".`)}
                    className="px-4 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold flex items-center gap-1 cursor-pointer transition-colors"
                  >
                    <span>Reopen Discussion</span>
                    <ArrowUpRight className="w-3.5 h-3.5" />
                  </button>
                </div>
              </div>
            ))}
          </div>
        )}

        {/* TAB 2: SAVED CALCULATIONS */}
        {activeTab === 'saved' && (
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            {savedCalculations.map((calc) => (
              <div
                key={calc.id}
                className="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between"
              >
                <div>
                  <div className="flex items-center justify-between text-xs text-slate-500 mb-2">
                    <span className="font-bold uppercase tracking-wider text-[#0077c8]">{calc.type}</span>
                    <span>{calc.date}</span>
                  </div>
                  <h3 className="text-base font-bold text-slate-900">{calc.name}</h3>
                  <div className="text-2xl font-black text-slate-900 mt-3">{calc.result}</div>
                </div>

                <button
                  onClick={() => onStartAiConsultation(`Review saved calculation: ${calc.name} (${calc.result}).`)}
                  className="mt-6 w-full py-2 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs rounded-xl cursor-pointer transition-colors"
                >
                  Verify Sizing with AI
                </button>
              </div>
            ))}
          </div>
        )}

        {/* TAB 3: PLAN */}
        {activeTab === 'plan' && (
          <div className="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-6">
              <div>
                <span className="px-3 py-1 rounded-full bg-orange-100 text-[#f05423] text-xs font-black uppercase tracking-wider">
                  Active Subscription
                </span>
                <h2 className="text-2xl font-black text-slate-900 mt-2">{currentPlan.name} Tier</h2>
                <p className="text-xs text-slate-500">{currentPlan.targetAudience} • Next billing date: April 01, 2026</p>
              </div>

              <div className="text-right">
                <div className="text-3xl font-black text-slate-900">{currentPlan.price}</div>
                <div className="text-xs text-slate-500">{currentPlan.period}</div>
              </div>
            </div>

            <div className="space-y-3">
              <h3 className="text-xs font-black uppercase tracking-wider text-slate-900">Included Tier Benefits</h3>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                {currentPlan.features.map((feat, idx) => (
                  <div key={idx} className="flex items-center gap-2 text-xs text-slate-700 font-medium">
                    <Check className="w-4 h-4 text-emerald-600 shrink-0" />
                    <span>{feat}</span>
                  </div>
                ))}
              </div>
            </div>

            <div className="pt-4 border-t border-slate-100 flex items-center justify-end">
              <button
                onClick={onOpenPricing}
                className="px-6 py-2.5 rounded-xl bg-[#0077c8] hover:bg-[#0066ad] text-white font-bold text-xs shadow-md cursor-pointer transition-all"
              >
                Upgrade / Change Plan
              </button>
            </div>
          </div>
        )}

      </div>
    </div>
  );
};

export default UserDashboard;
