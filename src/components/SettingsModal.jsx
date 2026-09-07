import React, { useState, useEffect } from 'react';
import { 
  X, 
  Key, 
  Check, 
  AlertCircle, 
  Sparkles, 
  Trash2,
  Eye,
  EyeOff,
  ExternalLink
} from 'lucide-react';
import { 
  getStoredApiKey, 
  setStoredApiKey, 
  getStoredModel, 
  setStoredModel, 
  AVAILABLE_MODELS, 
  testOpenAiApiKey 
} from '../services/openai';

export const SettingsModal = ({ isOpen, onClose, onSettingsUpdated }) => {
  if (!isOpen) return null;

  const [apiKey, setApiKey] = useState('');
  const [selectedModel, setSelectedModel] = useState('gpt-4o');
  const [showKey, setShowKey] = useState(false);
  const [testing, setTesting] = useState(false);
  const [testResult, setTestResult] = useState(null);
  const [savedSuccess, setSavedSuccess] = useState(false);

  useEffect(() => {
    setApiKey(getStoredApiKey());
    setSelectedModel(getStoredModel());
    setTestResult(null);
    setSavedSuccess(false);
  }, [isOpen]);

  const handleSave = () => {
    setStoredApiKey(apiKey);
    setStoredModel(selectedModel);
    setSavedSuccess(true);
    if (onSettingsUpdated) onSettingsUpdated();
    setTimeout(() => {
      setSavedSuccess(false);
      onClose();
    }, 900);
  };

  const handleClear = () => {
    setApiKey('');
    setStoredApiKey('');
    setTestResult({ success: true, message: 'API Key removed. Switched back to Built-in Faculty Simulator mode.' });
    if (onSettingsUpdated) onSettingsUpdated();
  };

  const handleTest = async () => {
    if (!apiKey.trim()) {
      setTestResult({ success: false, message: 'Please enter an OpenAI API key before testing.' });
      return;
    }
    setTesting(true);
    setTestResult(null);
    const res = await testOpenAiApiKey(apiKey.trim());
    setTesting(false);
    setTestResult(res);
  };

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm animate-in fade-in duration-200">
      
      <div className="bg-white rounded-3xl shadow-2xl border border-slate-200 w-full max-w-lg overflow-hidden animate-in zoom-in-95 duration-200">
        
        {/* Header */}
        <div className="bg-slate-900 text-white p-5 px-6 flex items-center justify-between">
          <div className="flex items-center gap-2.5">
            <div className="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-blue-500 flex items-center justify-center text-white">
              <Key className="w-5 h-5" />
            </div>
            <div>
              <h3 className="font-bold text-base text-white">OpenAI API Configuration</h3>
              <p className="text-xs text-slate-400">Configure live OpenAI reasoning & models</p>
            </div>
          </div>
          <button
            onClick={onClose}
            className="p-1.5 text-slate-400 hover:text-white rounded-lg hover:bg-slate-800 transition-colors cursor-pointer"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        {/* Body */}
        <div className="p-6 space-y-5">
          
          {/* Status Indicator */}
          <div className={`p-3.5 rounded-2xl text-xs flex items-start gap-3 border ${
            apiKey 
              ? 'bg-emerald-50 text-emerald-800 border-emerald-200' 
              : 'bg-amber-50 text-amber-800 border-amber-200'
          }`}>
            <Sparkles className={`w-4 h-4 shrink-0 mt-0.5 ${apiKey ? 'text-emerald-600' : 'text-amber-600'}`} />
            <div>
              <strong className="font-bold">
                {apiKey ? 'Live OpenAI API Connected' : 'Default Mode: Built-in Academic Simulator'}
              </strong>
              <p className="text-[11px] mt-0.5 opacity-90">
                {apiKey
                  ? 'Your answers are powered directly by OpenAI official API with point-to-point formatting.'
                  : 'No key required to explore! The app uses our verified built-in faculty point-to-point engine.'}
              </p>
            </div>
          </div>

          {/* API Key Input */}
          <div className="space-y-2">
            <div className="flex items-center justify-between text-xs font-bold text-slate-700">
              <label>OpenAI API Key</label>
              <a
                href="https://platform.openai.com/api-keys"
                target="_blank"
                rel="noreferrer"
                className="text-[#0077c8] hover:underline flex items-center gap-1 font-semibold text-[11px]"
              >
                Get OpenAI Key <ExternalLink className="w-3 h-3" />
              </a>
            </div>

            <div className="relative">
              <input
                type={showKey ? 'text' : 'password'}
                value={apiKey}
                onChange={(e) => setApiKey(e.target.value)}
                placeholder="sk-proj-... or paste your key here"
                className="w-full px-3.5 py-2.5 pr-20 text-xs font-mono rounded-xl border border-slate-300 focus:outline-none focus:border-[#0077c8] focus:ring-2 focus:ring-blue-100 text-slate-800"
              />
              <div className="absolute right-2 top-2 flex items-center gap-1">
                <button
                  type="button"
                  onClick={() => setShowKey(!showKey)}
                  className="p-1 text-slate-400 hover:text-slate-600 rounded"
                  title={showKey ? 'Hide key' : 'Show key'}
                >
                  {showKey ? <EyeOff className="w-3.5 h-3.5" /> : <Eye className="w-3.5 h-3.5" />}
                </button>
                {apiKey && (
                  <button
                    type="button"
                    onClick={handleClear}
                    className="p-1 text-rose-400 hover:text-rose-600 rounded"
                    title="Clear key"
                  >
                    <Trash2 className="w-3.5 h-3.5" />
                  </button>
                )}
              </div>
            </div>
            <p className="text-[10px] text-slate-400">
              Stored securely in your local browser storage (never shared or sent to third-party servers).
            </p>
          </div>

          {/* Model Selection */}
          <div className="space-y-2">
            <label className="text-xs font-bold text-slate-700">Reasoning Model</label>
            <div className="space-y-2">
              {AVAILABLE_MODELS.map((model) => (
                <label
                  key={model.id}
                  className={`flex items-center justify-between p-3 rounded-xl border text-xs cursor-pointer transition-all ${
                    selectedModel === model.id
                      ? 'bg-blue-50/80 border-[#0077c8] text-slate-900 font-bold shadow-xs'
                      : 'border-slate-200 hover:bg-slate-50 text-slate-700'
                  }`}
                >
                  <div className="flex items-center gap-2.5">
                    <input
                      type="radio"
                      name="model"
                      value={model.id}
                      checked={selectedModel === model.id}
                      onChange={() => setSelectedModel(model.id)}
                      className="text-[#0077c8] focus:ring-[#0077c8]"
                    />
                    <span>{model.name}</span>
                  </div>
                  <span className="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 font-medium">
                    {model.speed}
                  </span>
                </label>
              ))}
            </div>
          </div>

          {/* Test connection result banner */}
          {testResult && (
            <div className={`p-3 rounded-xl text-xs flex items-center gap-2 border animate-in fade-in ${
              testResult.success 
                ? 'bg-emerald-50 text-emerald-800 border-emerald-200' 
                : 'bg-rose-50 text-rose-800 border-rose-200'
            }`}>
              {testResult.success ? <Check className="w-4 h-4 text-emerald-600" /> : <AlertCircle className="w-4 h-4 text-rose-600" />}
              <span>{testResult.message}</span>
            </div>
          )}

          {/* Saved notification */}
          {savedSuccess && (
            <div className="p-3 rounded-xl text-xs bg-emerald-500 text-white font-bold text-center animate-in zoom-in-95">
              Settings Saved Successfully!
            </div>
          )}

        </div>

        {/* Footer Actions */}
        <div className="p-4 px-6 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
          <button
            onClick={handleTest}
            disabled={testing || !apiKey}
            className="px-3.5 py-2 rounded-xl text-xs font-bold border border-slate-300 hover:bg-white text-slate-700 transition-colors disabled:opacity-40 cursor-pointer"
          >
            {testing ? 'Testing...' : 'Test Connection'}
          </button>

          <div className="flex items-center gap-2">
            <button
              onClick={onClose}
              className="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-200 transition-colors cursor-pointer"
            >
              Cancel
            </button>
            <button
              onClick={handleSave}
              className="px-5 py-2 rounded-xl text-xs font-bold bg-[#0077c8] hover:bg-[#0066ad] text-white shadow-md transition-all cursor-pointer"
            >
              Save Settings
            </button>
          </div>
        </div>

      </div>

    </div>
  );
};

export default SettingsModal;
