import React, { useState } from 'react';
import { X, Lock, Mail, ArrowRight } from 'lucide-react';

export const AuthModal = ({ isOpen, onClose, onAuthSuccess }) => {
  if (!isOpen) return null;

  const [isSignUp, setIsSignUp] = useState(false);
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [name, setName] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    if (onAuthSuccess) onAuthSuccess({ name: name || email.split('@')[0], email });
    onClose();
  };

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm animate-in fade-in duration-200">
      <div className="bg-white rounded-3xl shadow-2xl border border-slate-200 w-full max-w-md overflow-hidden">
        
        {/* Modal Header */}
        <div className="bg-slate-900 text-white p-5 px-6 flex items-center justify-between">
          <div className="flex items-center gap-2">
            <div className="w-8 h-8 rounded-lg bg-[#f05423] flex items-center justify-center text-white font-bold">
              FP
            </div>
            <div>
              <h3 className="font-bold text-sm text-white">
                {isSignUp ? 'Create FacultyPro Account' : 'Log in to FacultyPro'}
              </h3>
              <p className="text-[11px] text-slate-400">Access 24/7 Verified Faculty & OpenAI Answers</p>
            </div>
          </div>
          <button
            onClick={onClose}
            className="text-slate-400 hover:text-white p-1 rounded-lg cursor-pointer"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        {/* Modal Body */}
        <form onSubmit={handleSubmit} className="p-6 space-y-4">
          
          {isSignUp && (
            <div className="space-y-1">
              <label className="text-xs font-bold text-slate-700">Your Name</label>
              <input
                type="text"
                required
                placeholder="Alex Johnson"
                value={name}
                onChange={(e) => setName(e.target.value)}
                className="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#0077c8] focus:outline-none"
              />
            </div>
          )}

          <div className="space-y-1">
            <label className="text-xs font-bold text-slate-700">Email Address</label>
            <div className="relative">
              <input
                type="email"
                required
                placeholder="alex@university.edu"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className="w-full text-xs pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#0077c8] focus:outline-none"
              />
              <Mail className="w-4 h-4 text-slate-400 absolute left-3 top-3" />
            </div>
          </div>

          <div className="space-y-1">
            <div className="flex items-center justify-between text-xs">
              <label className="font-bold text-slate-700">Password</label>
              {!isSignUp && (
                <a href="#pricing" className="text-[11px] text-[#0077c8] hover:underline">Forgot password?</a>
              )}
            </div>
            <div className="relative">
              <input
                type="password"
                required
                placeholder="••••••••"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                className="w-full text-xs pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-[#0077c8] focus:outline-none"
              />
              <Lock className="w-4 h-4 text-slate-400 absolute left-3 top-3" />
            </div>
          </div>

          <button
            type="submit"
            className="w-full py-3 rounded-xl bg-[#0077c8] hover:bg-[#0066ad] text-white font-bold text-xs shadow-md transition-all cursor-pointer flex items-center justify-center gap-2 mt-2"
          >
            <span>{isSignUp ? 'Create Student/Scholar Account' : 'Sign in to Account'}</span>
            <ArrowRight className="w-3.5 h-3.5" />
          </button>

          <div className="text-center pt-2">
            <button
              type="button"
              onClick={() => setIsSignUp(!isSignUp)}
              className="text-xs text-slate-600 hover:text-[#0077c8] font-semibold cursor-pointer"
            >
              {isSignUp ? 'Already have an account? Log in' : "Don't have an account? Create one"}
            </button>
          </div>

        </form>

      </div>
    </div>
  );
};

export default AuthModal;
