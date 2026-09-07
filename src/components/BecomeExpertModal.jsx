import React, { useState } from 'react';
import { X, GraduationCap, CheckCircle2, Award, Send } from 'lucide-react';
import confetti from 'canvas-confetti';

export const BecomeExpertModal = ({ isOpen, onClose }) => {
  if (!isOpen) return null;

  const [submitted, setSubmitted] = useState(false);
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    institution: '',
    degree: 'Ph.D.',
    discipline: 'Physics & STEM',
    yearsExperience: '5+'
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    setSubmitted(true);
    confetti({
      particleCount: 100,
      spread: 70,
      origin: { y: 0.6 }
    });
  };

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm animate-in fade-in duration-200">
      <div className="bg-white rounded-3xl shadow-2xl border border-slate-200 w-full max-w-lg overflow-hidden">
        
        {/* Header */}
        <div className="bg-gradient-to-r from-[#0077c8] to-[#0099f7] text-white p-5 px-6 flex items-center justify-between">
          <div className="flex items-center gap-2.5">
            <div className="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center text-white">
              <GraduationCap className="w-5 h-5" />
            </div>
            <div>
              <h3 className="font-bold text-base text-white">Apply to Become a Faculty Expert</h3>
              <p className="text-xs text-blue-100">Join 15,000+ verified academics and domain leaders</p>
            </div>
          </div>
          <button
            onClick={onClose}
            className="p-1.5 text-white/80 hover:text-white rounded-lg hover:bg-white/10 transition-colors cursor-pointer"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        {submitted ? (
          <div className="p-8 text-center space-y-4">
            <div className="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 mx-auto flex items-center justify-center animate-bounce">
              <CheckCircle2 className="w-10 h-10" />
            </div>
            <h3 className="text-xl font-bold text-slate-900">Application Received!</h3>
            <p className="text-xs text-slate-600 leading-relaxed max-w-sm mx-auto">
              Thank you, <strong>{formData.name || 'Professor'}</strong>. Our Academic Verification Board will review your credentials and university email within 24 hours.
            </p>
            <button
              onClick={onClose}
              className="px-6 py-2.5 rounded-xl bg-[#0077c8] text-white text-xs font-bold shadow-md cursor-pointer hover:bg-[#0066ad]"
            >
              Back to Home
            </button>
          </div>
        ) : (
          <form onSubmit={handleSubmit} className="p-6 space-y-4">
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div className="space-y-1">
                <label className="text-xs font-bold text-slate-700">Full Name</label>
                <input
                  type="text"
                  required
                  placeholder="Dr. Jane Smith"
                  value={formData.name}
                  onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                  className="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#0077c8] focus:outline-none"
                />
              </div>

              <div className="space-y-1">
                <label className="text-xs font-bold text-slate-700">Institutional Email (.edu / org)</label>
                <input
                  type="email"
                  required
                  placeholder="jsmith@mit.edu"
                  value={formData.email}
                  onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                  className="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#0077c8] focus:outline-none"
                />
              </div>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div className="space-y-1">
                <label className="text-xs font-bold text-slate-700">University / Institution</label>
                <input
                  type="text"
                  required
                  placeholder="Stanford / Harvard / Oxford"
                  value={formData.institution}
                  onChange={(e) => setFormData({ ...formData, institution: e.target.value })}
                  className="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#0077c8] focus:outline-none"
                />
              </div>

              <div className="space-y-1">
                <label className="text-xs font-bold text-slate-700">Highest Degree</label>
                <select
                  value={formData.degree}
                  onChange={(e) => setFormData({ ...formData, degree: e.target.value })}
                  className="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#0077c8] focus:outline-none bg-white"
                >
                  <option value="Ph.D.">Ph.D. / Doctorate</option>
                  <option value="M.D.">M.D. / Clinical Degree</option>
                  <option value="J.D.">J.D. / Master of Laws</option>
                  <option value="M.Sc.">M.Sc. / M.Eng.</option>
                  <option value="P.E.">Professional Engineer (P.E.)</option>
                </select>
              </div>
            </div>

            <div className="space-y-1">
              <label className="text-xs font-bold text-slate-700">Primary Academic Discipline</label>
              <select
                value={formData.discipline}
                onChange={(e) => setFormData({ ...formData, discipline: e.target.value })}
                className="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#0077c8] focus:outline-none bg-white"
              >
                <option value="Physics & STEM">Physics & Applied Quantum Mechanics</option>
                <option value="Computer Science & AI">Computer Science & AI Systems</option>
                <option value="Medical & Life Sciences">Medical & Life Sciences</option>
                <option value="Law & Jurisprudence">Law & Jurisprudence</option>
                <option value="Mechanical & Aero Engineering">Mechanical & Aero Engineering</option>
                <option value="Economics & Business">Economics & Finance</option>
              </select>
            </div>

            <div className="p-3 rounded-xl bg-blue-50 text-[11px] text-slate-600 flex items-center gap-2 border border-blue-100">
              <Award className="w-4 h-4 text-[#0077c8] shrink-0" />
              <span>Earn competitive honorariums answering point-to-point questions on your own schedule.</span>
            </div>

            <div className="pt-2 flex items-center justify-end gap-2">
              <button
                type="button"
                onClick={onClose}
                className="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-xl cursor-pointer"
              >
                Cancel
              </button>
              <button
                type="submit"
                className="px-5 py-2.5 text-xs font-bold bg-[#f05423] hover:bg-[#ff6f3c] text-white rounded-xl shadow-md cursor-pointer flex items-center gap-1.5"
              >
                <Send className="w-3.5 h-3.5" />
                <span>Submit Faculty Application</span>
              </button>
            </div>
          </form>
        )}

      </div>
    </div>
  );
};

export default BecomeExpertModal;
