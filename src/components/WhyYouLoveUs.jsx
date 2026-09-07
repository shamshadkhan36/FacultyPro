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
      title: '15,000+ verified Faculty',
      description: 'Multi-Step Academic Quality Process, including university faculty registry, doctoral diploma verification, and peer reviews.'
    },
    {
      icon: PiggyBank,
      title: 'Every question saves money',
      description: 'Join over 2 million students and researchers who save hundreds on private tutoring or expensive consultation fees.'
    },
    {
      icon: HeartHandshake,
      title: "Service that's tailored to you",
      description: 'Discuss your specific syllabus, problem set, or research paper with a Professor who specializes in your exact discipline, 24/7.'
    },
    {
      icon: Hourglass,
      title: 'Save valuable time at home',
      description: 'Connect from your laptop or smartphone in under 45 seconds. No booking weeks ahead or waiting in academic office hours.'
    }
  ];

  const collageImages = [
    { src: 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=400&q=80', alt: 'Study group' },
    { src: 'https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=400&q=80', alt: 'Professor teaching' },
    { src: 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=400&q=80', alt: 'Students discussing' },
    { src: 'https://images.unsplash.com/photo-1531545514256-b1400bc00f31?auto=format&fit=crop&w=400&q=80', alt: 'Online research' },
    { src: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=400&q=80', alt: 'Tech lab' },
  ];

  return (
    <section id="why-us" className="py-16 sm:py-24 bg-white border-b border-slate-200/70 overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Title matching Screenshot 4 */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <h2 className="text-3xl sm:text-5xl font-extrabold text-[#0b2545] tracking-tight">
            Why you’ll love Faculty<span className="text-[#f05423]">Pro</span>
          </h2>
          <p className="text-slate-600 text-sm sm:text-base mt-3">
            The precision of OpenAI reasoning paired with the authority of verified university professors.
          </p>
        </div>

        {/* 4 Benefits Columns matching Screenshot 4 */}
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

        {/* Bottom Photo Collage matching Screenshot 4 */}
        <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 pt-6">
          {collageImages.map((img, idx) => (
            <div key={idx} className="relative rounded-2xl overflow-hidden h-36 sm:h-44 shadow-xs group">
              <img
                src={img.src}
                alt={img.alt}
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
