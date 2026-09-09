import React from 'react';
import { Check, Sparkles, ShieldCheck, Clock, Lock } from 'lucide-react';

export const PricingSection = ({ onSelectPlan }) => {
  const plans = [
    {
      id: 'plan-199',
      name: 'Single Emergency Case',
      price: '₹199',
      period: 'one-time',
      description: 'Ideal for an urgent site breakdown, pump trip, or authority code clarification.',
      features: [
        '1 Complete Point-to-Point MEP Solution',
        'Assigned Licensed Professional Engineer',
        'Exact Sizing Formulas & Code Clauses',
        '24h Follow-up Chat with MEP Specialist',
        'Export to Calculation Notes & PDF'
      ],
      popular: false,
      isComingSoon: false,
      buttonText: 'Solve Issue for ₹199'
    },
    {
      id: 'plan-399',
      name: 'Facility Pro Monthly',
      price: '₹399',
      period: 'per month',
      description: 'Unlimited point-to-point Q&A for Facility Managers, MEP Contractors & Plant Engineers.',
      features: [
        'Unlimited HVAC, Plumbing, Electrical & Fire Q&A',
        'Direct OpenAI GPT-4o MEP Reasoning',
        'Priority Response (< 30s) from Licensed PE',
        'ASHRAE, NFPA, NEC & IPC Standards Engine',
        'Full Engineering Equations & Math Steps',
        'Cancel Anytime With 1-Click'
      ],
      popular: true,
      isComingSoon: false,
      buttonText: 'Get Pro Access for ₹399'
    },
    {
      id: 'plan-enterprise',
      name: 'Enterprise MEP & Plant Lab',
      price: 'Coming Soon',
      period: 'Custom Plant',
      description: 'For MEP Consultancy firms, Hospital facilities, and Data Center operations teams.',
      features: [
        'Everything in Facility Pro',
        'Up to 10 Site Engineer Seats',
        'Custom OpenAI API Key Bring-Your-Own',
        'Single Line Diagram (SLD) & Hydraulic Review',
        'Dedicated Senior MEP Account Director'
      ],
      popular: false,
      isComingSoon: true,
      buttonText: 'Coming Soon'
    }
  ];

  return (
    <section id="pricing" className="py-16 sm:py-24 bg-slate-50 border-b border-slate-200/80">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div className="text-center max-w-3xl mx-auto mb-16">
          <span className="text-xs font-bold uppercase tracking-widest text-[#0077c8] bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
            Transparent Facility Pricing
          </span>
          <h2 className="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight mt-3">
            Affordable On-Demand MEP Engineering
          </h2>
          <p className="text-slate-600 text-sm sm:text-base mt-3">
            Save 90% compared to traditional third-party MEP consultant callout fees. Instant point-to-point solutions.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
          {plans.map((plan, idx) => (
            <div
              key={idx}
              className={`bg-white rounded-3xl p-8 border transition-all duration-300 flex flex-col justify-between relative ${
                plan.popular
                  ? 'border-[#f05423] shadow-2xl ring-2 ring-[#f05423]/20 scale-105 z-10'
                  : plan.isComingSoon
                  ? 'border-slate-200 bg-slate-50/50 shadow-sm opacity-90'
                  : 'border-slate-200/90 shadow-md hover:shadow-xl'
              }`}
            >
              {/* Popular Badge */}
              {plan.popular && (
                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-[#f05423] text-white text-xs font-black uppercase px-4 py-1 rounded-full shadow-md tracking-wider flex items-center gap-1">
                  <Sparkles className="w-3 h-3 fill-white" />
                  <span>Most Popular for Plants</span>
                </div>
              )}

              {/* Coming Soon Badge */}
              {plan.isComingSoon && (
                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-slate-800 text-amber-300 text-xs font-black uppercase px-4 py-1 rounded-full shadow-md tracking-wider flex items-center gap-1 border border-amber-300/30">
                  <Clock className="w-3 h-3 text-amber-400" />
                  <span>Coming Soon</span>
                </div>
              )}

              <div className="space-y-6">
                <div>
                  <h3 className="text-xl font-bold text-slate-900">{plan.name}</h3>
                  <p className="text-xs text-slate-500 mt-1">{plan.description}</p>
                </div>

                <div className="flex items-baseline gap-1">
                  <span className={`text-4xl font-black ${plan.isComingSoon ? 'text-slate-700 text-3xl' : 'text-slate-900'}`}>
                    {plan.price}
                  </span>
                  {!plan.isComingSoon && (
                    <span className="text-xs font-semibold text-slate-500">/ {plan.period}</span>
                  )}
                </div>

                <ul className="space-y-3 pt-2">
                  {plan.features.map((feat, fIdx) => (
                    <li key={fIdx} className="flex items-center gap-3 text-xs font-semibold text-slate-700">
                      <div className={`w-4 h-4 rounded-full flex items-center justify-center shrink-0 ${
                        plan.isComingSoon ? 'bg-slate-200 text-slate-500' : 'bg-emerald-100 text-emerald-600'
                      }`}>
                        <Check className="w-3 h-3 stroke-[3]" />
                      </div>
                      <span>{feat}</span>
                    </li>
                  ))}
                </ul>
              </div>

              <div className="pt-8">
                {plan.isComingSoon ? (
                  <button
                    disabled
                    className="w-full py-3.5 rounded-2xl font-bold text-xs sm:text-sm bg-slate-200 text-slate-500 cursor-not-allowed flex items-center justify-center gap-2 border border-slate-300"
                  >
                    <Lock className="w-4 h-4 text-slate-400" />
                    <span>Coming Soon</span>
                  </button>
                ) : (
                  <button
                    onClick={() => onSelectPlan(plan)}
                    className={`w-full py-3.5 rounded-2xl font-bold text-xs sm:text-sm transition-all cursor-pointer shadow-md ${
                      plan.popular
                        ? 'bg-[#f05423] hover:bg-[#ff6f3c] text-white shadow-orange-500/30'
                        : 'bg-[#0077c8] hover:bg-[#0066ad] text-white'
                    }`}
                  >
                    {plan.buttonText}
                  </button>
                )}
                
                <div className="text-center mt-2">
                  <span className="text-[10px] text-slate-400 font-medium flex items-center justify-center gap-1">
                    <ShieldCheck className="w-3 h-3 text-emerald-500" /> 100% Code-Compliance Guarantee
                  </span>
                </div>
              </div>

            </div>
          ))}
        </div>

      </div>
    </section>
  );
};

export default PricingSection;
