import React from 'react';
import { Check, Sparkles, ShieldCheck } from 'lucide-react';

export const PricingSection = ({ onSelectPlan }) => {
  const plans = [
    {
      name: 'Single Question Trial',
      price: '$5',
      period: 'one-time',
      description: 'Ideal for an urgent homework problem, bug fix, or legal question.',
      features: [
        '1 Complete Point-to-Point Answer',
        'Assigned Verified Professor',
        'Full Step-by-Step Breakdown',
        '24h Follow-up Chat with Faculty',
        'Export to Markdown & PDF'
      ],
      popular: false,
      buttonText: 'Ask Single Question'
    },
    {
      name: 'Monthly Scholar Pro',
      price: '$29',
      period: 'per month',
      description: 'Unlimited point-to-point Q&A for undergraduate, graduate & PhD researchers.',
      features: [
        'Unlimited Point-to-Point Questions',
        'Direct OpenAI GPT-4o Integration',
        'Priority Faculty Response (< 30s)',
        'Direct Messaging with MIT/Stanford Faculty',
        'LaTeX Math & Full Code Sandbox',
        'Cancel Anytime With 1-Click'
      ],
      popular: true,
      buttonText: 'Start 7-Day Free Trial'
    },
    {
      name: 'Academic Research Lab',
      price: '$89',
      period: 'per month',
      description: 'For university research groups, law firms, and engineering teams.',
      features: [
        'Everything in Scholar Pro',
        'Up to 5 Team Member Seats',
        'Custom OpenAI API Key Bring-Your-Own',
        'Peer-Review Publication Verification',
        'Dedicated Faculty Account Manager'
      ],
      popular: false,
      buttonText: 'Get Lab Access'
    }
  ];

  return (
    <section id="pricing" className="py-16 sm:py-24 bg-slate-50 border-b border-slate-200/80">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div className="text-center max-w-3xl mx-auto mb-16">
          <span className="text-xs font-bold uppercase tracking-widest text-[#0077c8] bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
            Simple Transparent Pricing
          </span>
          <h2 className="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight mt-3">
            Affordable Academic & Technical Clarity
          </h2>
          <p className="text-slate-600 text-sm sm:text-base mt-3">
            Save 80% compared to private tutoring fees ($60-150/hr). Direct, fluff-free point-to-point solutions.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
          {plans.map((plan, idx) => (
            <div
              key={idx}
              className={`bg-white rounded-3xl p-8 border transition-all duration-300 flex flex-col justify-between relative ${
                plan.popular
                  ? 'border-[#f05423] shadow-2xl ring-2 ring-[#f05423]/20 scale-105 z-10'
                  : 'border-slate-200/90 shadow-md hover:shadow-xl'
              }`}
            >
              {plan.popular && (
                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-[#f05423] text-white text-xs font-black uppercase px-4 py-1 rounded-full shadow-md tracking-wider flex items-center gap-1">
                  <Sparkles className="w-3 h-3 fill-white" />
                  <span>Most Popular</span>
                </div>
              )}

              <div className="space-y-6">
                <div>
                  <h3 className="text-xl font-bold text-slate-900">{plan.name}</h3>
                  <p className="text-xs text-slate-500 mt-1">{plan.description}</p>
                </div>

                <div className="flex items-baseline gap-1">
                  <span className="text-4xl font-black text-slate-900">{plan.price}</span>
                  <span className="text-xs font-semibold text-slate-500">/ {plan.period}</span>
                </div>

                <ul className="space-y-3 pt-2">
                  {plan.features.map((feat, fIdx) => (
                    <li key={fIdx} className="flex items-center gap-3 text-xs font-semibold text-slate-700">
                      <div className="w-4 h-4 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <Check className="w-3 h-3 stroke-[3]" />
                      </div>
                      <span>{feat}</span>
                    </li>
                  ))}
                </ul>
              </div>

              <div className="pt-8">
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
                <div className="text-center mt-2">
                  <span className="text-[10px] text-slate-400 font-medium flex items-center justify-center gap-1">
                    <ShieldCheck className="w-3 h-3 text-emerald-500" /> 30-Day Money-Back Guarantee
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
