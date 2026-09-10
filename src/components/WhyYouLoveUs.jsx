import React from 'react';
import { 
  BadgeCheck, 
  PiggyBank, 
  HeartHandshake, 
  Hourglass
} from 'lucide-react';

export const WhyYouLoveUs = () => {
  const benefits = [
    {
      icon: BadgeCheck,
      title: '15,000+ verified MEP Engineers',
      description: 'Multi-step verification including state PE board validation, ASHRAE credentials, NFPA certifications, and past project audits.'
    },
    {
      icon: PiggyBank,
      title: 'Prevent Costly Facility Downtime',
      description: 'Avoid thousands of dollars in emergency breakdown costs, consultant site visit fees, and regulatory civil defence penalties.'
    },
    {
      icon: HeartHandshake,
      title: "Solutions tailored to your plant",
      description: 'Discuss your specific chiller model, pump curve, substation single line diagram (SLD), or sprinkler hydraulic calculation directly, 24/7.'
    },
    {
      icon: Hourglass,
      title: 'Save critical on-site time',
      description: 'Connect directly from equipment plant rooms, electrical substations, or site offices in under 30 seconds.'
    }
  ];

  const collageImages = [
    { src: '/images/hvac_chiller_plant.jpg', alt: 'Chiller Plant Room' },
    { src: '/images/plumbing_booster_pumps.jpg', alt: 'Plumbing Booster Pumps' },
    { src: '/images/electrical_substation_room.jpg', alt: 'Electrical Substation' },
    { src: '/images/fire_sprinkler_pumps.jpg', alt: 'Fire Pump Room' },
    { src: '/images/bms_control_room.jpg', alt: 'BMS Facility Control' },
  ];

  return (
    <section id="why-us" className="py-16 sm:py-24 bg-white border-b border-slate-200/70 overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div className="text-center max-w-3xl mx-auto mb-16">
          <h2 className="text-3xl sm:text-5xl font-extrabold text-[#0b2545] tracking-tight">
            Why facility managers trust Facility<span className="text-[#f05423]">Pro</span>
          </h2>
          <p className="text-slate-600 text-sm sm:text-base mt-3">
            The mathematical precision of OpenAI reasoning paired with the real-world authority of licensed MEP consulting engineers.
          </p>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
          {benefits.map((b, idx) => {
            const Icon = b.icon;
            return (
              <div key={idx} className="text-center space-y-4 px-2 group">
                <div className="w-16 h-16 mx-auto rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-[#0084d6] group-hover:bg-[#0084d6] group-hover:text-white transition-colors duration-200 shadow-xs">
                  <Icon className="w-8 h-8 stroke-[1.8]" />
                </div>
                <h3 className="text-lg font-bold text-slate-900 tracking-tight">
                  {b.title}
                </h3>
                <p className="text-xs sm:text-sm text-slate-600 leading-relaxed">
                  {b.description}
                </p>
              </div>
            );
          })}
        </div>

        <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 pt-6">
          {collageImages.map((img, idx) => (
            <div key={idx} className="relative rounded-2xl overflow-hidden h-36 sm:h-44 shadow-xs group bg-slate-100">
              <img
                src={img.src}
                alt={img.alt}
                loading="lazy"
                referrerPolicy="no-referrer"
                className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent opacity-60"></div>
            </div>
          ))}
        </div>

      </div>
    </section>
  );
};

export default WhyYouLoveUs;
