import React, { useState, useEffect, useRef } from 'react';
import ReactMarkdown from 'react-markdown';
import remarkGfm from 'remark-gfm';
import confetti from 'canvas-confetti';
import { 
  X, 
  Sparkles, 
  Send, 
  Copy, 
  Check, 
  Share2, 
  Volume2, 
  VolumeX, 
  ThumbsUp, 
  ThumbsDown, 
  Download, 
  RotateCcw, 
  GraduationCap, 
  CheckCircle2, 
  Star, 
  User, 
  Clock, 
  SlidersHorizontal, 
  MessageSquare,
  FileText,
  Award,
  Zap,
  ChevronDown
} from 'lucide-react';
import { faculties } from '../data/faculties';
import { streamOpenAiResponse, getStoredApiKey, getStoredModel } from '../services/openai';

export const ConsultationModal = ({ 
  isOpen, 
  onClose, 
  initialQuestion = '', 
  initialFaculty = null,
  onOpenSettings 
}) => {
  if (!isOpen) return null;

  const [question, setQuestion] = useState(initialQuestion || '');
  const [selectedFaculty, setSelectedFaculty] = useState(
    initialFaculty || faculties[0]
  );
  const [activeTab, setActiveTab] = useState('solution');
  const [loading, setLoading] = useState(false);
  const [answerMarkdown, setAnswerMarkdown] = useState('');
  const [copied, setCopied] = useState(false);
  const [speaking, setSpeaking] = useState(false);
  const [feedbackGiven, setFeedbackGiven] = useState(null);
  
  const [followUpInput, setFollowUpInput] = useState('');
  const [chatMessages, setChatMessages] = useState([]);
  
  const answerContainerRef = useRef(null);
  const chatEndRef = useRef(null);

  useEffect(() => {
    if (initialQuestion) {
      setQuestion(initialQuestion);
      executeGeneration(initialQuestion, selectedFaculty);
    }
  }, [initialQuestion]);

  const executeGeneration = async (queryText, faculty) => {
    setLoading(true);
    setAnswerMarkdown('');
    setFeedbackGiven(null);

    setChatMessages([
      { id: '1', sender: 'user', text: queryText, timestamp: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) }
    ]);

    try {
      const fullResult = await streamOpenAiResponse({
        question: queryText,
        faculty: faculty || selectedFaculty,
        onChunk: (chunk) => {
          setAnswerMarkdown(chunk);
          if (answerContainerRef.current) {
            answerContainerRef.current.scrollTop = answerContainerRef.current.scrollHeight;
          }
        },
        onError: (err) => {
          console.error(err);
        }
      });

      setChatMessages(prev => [
        ...prev,
        { 
          id: '2', 
          sender: 'faculty', 
          text: fullResult, 
          facultyName: faculty?.name || selectedFaculty.name,
          timestamp: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) 
        }
      ]);
    } catch (e) {
      console.error(e);
    } finally {
      setLoading(false);
    }
  };

  const handleCopy = () => {
    if (!answerMarkdown) return;
    navigator.clipboard.writeText(answerMarkdown);
    setCopied(true);
    setTimeout(() => setCopied(false), 2000);
  };

  const handleSpeech = () => {
    if (!('speechSynthesis' in window)) {
      alert('Speech synthesis is not supported in this browser.');
      return;
    }

    if (speaking) {
      window.speechSynthesis.cancel();
      setSpeaking(false);
    } else {
      const cleanText = answerMarkdown
        .replace(/[#*`_\[\]()]/g, '')
        .replace(/🎯|📌|🔬|🎓|✅/g, '');
      
      const utterance = new SpeechSynthesisUtterance(cleanText);
      utterance.rate = 1.0;
      utterance.pitch = 1.0;
      utterance.onend = () => setSpeaking(false);
      utterance.onerror = () => setSpeaking(false);
      
      window.speechSynthesis.speak(utterance);
      setSpeaking(true);
    }
  };

  const handleThumbsUp = () => {
    setFeedbackGiven('up');
    confetti({
      particleCount: 80,
      spread: 60,
      origin: { y: 0.8 }
    });
  };

  const handleExportMarkdown = () => {
    const blob = new Blob([`# FacultyPro Verified Answer\n\n**Question:** ${question}\n**Faculty:** ${selectedFaculty.name} (${selectedFaculty.title})\n\n---\n\n${answerMarkdown}`], { type: 'text/markdown' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `FacultyPro-Answer-${Date.now()}.md`;
    a.click();
    URL.revokeObjectURL(url);
  };

  const handleSendFollowUp = async (e) => {
    e.preventDefault();
    if (!followUpInput.trim() || loading) return;

    const userMsg = followUpInput.trim();
    setFollowUpInput('');

    const newChat = [
      ...chatMessages,
      { id: String(Date.now()), sender: 'user', text: userMsg, timestamp: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) }
    ];
    setChatMessages(newChat);
    setActiveTab('chat');
    setLoading(true);

    try {
      let facultyReply = '';
      await streamOpenAiResponse({
        question: userMsg,
        faculty: selectedFaculty,
        conversationHistory: newChat,
        onChunk: (chunk) => {
          facultyReply = chunk;
        }
      });

      setChatMessages(prev => [
        ...prev,
        {
          id: String(Date.now() + 1),
          sender: 'faculty',
          text: facultyReply,
          facultyName: selectedFaculty.name,
          timestamp: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
        }
      ]);
    } catch (e) {
      console.error(e);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-2 sm:p-4 bg-slate-950/70 backdrop-blur-sm animate-in fade-in duration-200">
      
      <div className="bg-white rounded-3xl shadow-2xl border border-slate-200 w-full max-w-5xl h-[92vh] sm:h-[88vh] flex flex-col overflow-hidden">
        
        {/* Modal Top Header */}
        <div className="bg-gradient-to-r from-[#0b2545] via-[#133b5c] to-[#0077c8] text-white p-4 sm:px-6 flex items-center justify-between shadow-md shrink-0">
          
          <div className="flex items-center gap-3 sm:gap-4">
            <div className="relative shrink-0">
              <img
                src={selectedFaculty.avatar}
                alt={selectedFaculty.name}
                className="w-11 h-11 sm:w-12 sm:h-12 rounded-full object-cover ring-2 ring-white/50"
              />
              <span className="absolute bottom-0 right-0 w-3.5 h-3.5 bg-emerald-400 border-2 border-slate-900 rounded-full animate-pulse"></span>
            </div>

            <div className="space-y-0.5">
              <div className="flex items-center gap-2 flex-wrap">
                <h3 className="font-bold text-sm sm:text-base text-white tracking-tight">
                  {selectedFaculty.name}
                </h3>
                <span className="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                  {selectedFaculty.verifiedBadge || 'Verified Faculty'}
                </span>
              </div>
              <p className="text-xs text-slate-300 font-medium hidden sm:block">
                {selectedFaculty.title} • {selectedFaculty.institution}
              </p>
            </div>
          </div>

          <div className="flex items-center gap-2">
            <div className="relative hidden md:block">
              <select
                value={selectedFaculty.id}
                onChange={(e) => {
                  const found = faculties.find(f => f.id === e.target.value);
                  if (found) {
                    setSelectedFaculty(found);
                    if (question) executeGeneration(question, found);
                  }
                }}
                className="bg-white/10 hover:bg-white/20 text-white text-xs font-semibold px-3 py-1.5 rounded-lg border border-white/20 focus:outline-none cursor-pointer appearance-none pr-7"
              >
                {faculties.map(f => (
                  <option key={f.id} value={f.id} className="text-slate-900">
                    Switch to {f.name} ({f.specialties[0]})
                  </option>
                ))}
              </select>
              <ChevronDown className="w-3.5 h-3.5 text-white/70 absolute right-2 top-2.5 pointer-events-none" />
            </div>

            <button
              onClick={onOpenSettings}
              className="p-2 text-white/80 hover:text-white hover:bg-white/10 rounded-lg transition-colors cursor-pointer"
              title="OpenAI API Settings"
            >
              <SlidersHorizontal className="w-4 h-4" />
            </button>

            <button
              onClick={() => {
                if (speaking) window.speechSynthesis?.cancel();
                onClose();
              }}
              className="p-2 text-white/80 hover:text-white hover:bg-white/10 rounded-lg transition-colors cursor-pointer"
            >
              <X className="w-5 h-5" />
            </button>
          </div>

        </div>

        {/* Tab Navigation */}
        <div className="flex items-center justify-between px-6 border-b border-slate-200 bg-slate-50/90 shrink-0">
          <div className="flex items-center gap-6 text-xs sm:text-sm font-bold">
            <button
              onClick={() => setActiveTab('solution')}
              className={`py-3 flex items-center gap-2 border-b-2 transition-all cursor-pointer ${
                activeTab === 'solution'
                  ? 'border-[#f05423] text-[#f05423]'
                  : 'border-transparent text-slate-600 hover:text-slate-900'
              }`}
            >
              <FileText className="w-4 h-4" />
              <span>Point-to-Point Solution</span>
              {loading && <span className="w-2 h-2 rounded-full bg-orange-500 animate-ping"></span>}
            </button>

            <button
              onClick={() => setActiveTab('chat')}
              className={`py-3 flex items-center gap-2 border-b-2 transition-all cursor-pointer ${
                activeTab === 'chat'
                  ? 'border-[#0077c8] text-[#0077c8]'
                  : 'border-transparent text-slate-600 hover:text-slate-900'
              }`}
            >
              <MessageSquare className="w-4 h-4" />
              <span>Interactive Discussion ({chatMessages.length})</span>
            </button>

            <button
              onClick={() => setActiveTab('faculty')}
              className={`py-3 flex items-center gap-2 border-b-2 transition-all cursor-pointer hidden sm:flex ${
                activeTab === 'faculty'
                  ? 'border-[#0077c8] text-[#0077c8]'
                  : 'border-transparent text-slate-600 hover:text-slate-900'
              }`}
            >
              <Award className="w-4 h-4" />
              <span>Faculty Credentials</span>
            </button>
          </div>

          <div className="flex items-center gap-2 text-xs font-semibold text-slate-500">
            <span className="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span className="hidden sm:inline">OpenAI Verified Reasoning</span>
          </div>
        </div>

        {/* Main Content Body */}
        <div className="flex-1 overflow-y-auto p-4 sm:p-6 space-y-5" ref={answerContainerRef}>
          
          {/* Question Banner Box */}
          <div className="p-4 rounded-2xl bg-blue-50/70 border border-blue-100 flex items-start gap-3">
            <div className="w-8 h-8 rounded-full bg-[#0077c8] text-white flex items-center justify-center shrink-0 font-bold text-xs shadow-xs">
              Q
            </div>
            <div className="space-y-1 flex-1">
              <div className="flex items-center justify-between">
                <span className="text-[11px] font-bold uppercase tracking-wider text-[#0077c8]">
                  Consultation Topic
                </span>
                <span className="text-[11px] text-slate-400 font-medium flex items-center gap-1">
                  <Clock className="w-3 h-3" /> Just now
                </span>
              </div>
              <h2 className="text-sm sm:text-base font-bold text-slate-900 leading-snug">
                {question || 'No question provided'}
              </h2>
            </div>
          </div>

          {/* TAB 1: POINT-TO-POINT SOLUTION */}
          {activeTab === 'solution' && (
            <div className="space-y-6">
              
              <div className="bg-white rounded-2xl border border-slate-200/90 p-6 shadow-xs relative">
                
                {loading && !answerMarkdown && (
                  <div className="py-12 flex flex-col items-center justify-center space-y-3 text-center">
                    <div className="w-12 h-12 rounded-2xl bg-orange-100 text-[#f05423] flex items-center justify-center animate-bounce shadow-md">
                      <Sparkles className="w-6 h-6" />
                    </div>
                    <div className="space-y-1">
                      <h4 className="text-base font-bold text-slate-800">
                        {selectedFaculty.name} is synthesizing your point-to-point solution...
                      </h4>
                      <p className="text-xs text-slate-500">
                        Applying OpenAI reasoning model and verifying academic citations
                      </p>
                    </div>
                  </div>
                )}

                {answerMarkdown && (
                  <div className="prose prose-slate max-w-none prose-headings:font-bold prose-headings:text-[#0b2545] prose-h3:text-base prose-h3:border-b prose-h3:border-slate-100 prose-h3:pb-2 prose-h3:mt-6 prose-p:text-sm prose-p:leading-relaxed prose-li:text-sm prose-li:leading-relaxed prose-code:text-[#f05423] prose-code:bg-orange-50 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded prose-pre:bg-slate-900 prose-pre:text-slate-100 prose-pre:rounded-xl">
                    <ReactMarkdown remarkPlugins={[remarkGfm]}>
                      {answerMarkdown}
                    </ReactMarkdown>
                  </div>
                )}

              </div>

              {/* Action Toolbar */}
              {answerMarkdown && (
                <div className="bg-slate-50 rounded-2xl border border-slate-200/80 p-4 flex flex-wrap items-center justify-between gap-4">
                  
                  <div className="flex items-center gap-2 flex-wrap">
                    <button
                      onClick={handleCopy}
                      className="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 hover:border-slate-300 text-xs font-semibold text-slate-700 shadow-xs cursor-pointer transition-all active:scale-95"
                    >
                      {copied ? <Check className="w-3.5 h-3.5 text-emerald-600" /> : <Copy className="w-3.5 h-3.5" />}
                      <span>{copied ? 'Copied!' : 'Copy Answer'}</span>
                    </button>

                    <button
                      onClick={handleSpeech}
                      className={`flex items-center gap-1.5 px-3 py-1.5 rounded-lg border text-xs font-semibold shadow-xs cursor-pointer transition-all ${
                        speaking
                          ? 'bg-orange-500 text-white border-orange-600'
                          : 'bg-white border-slate-200 hover:border-slate-300 text-slate-700'
                      }`}
                    >
                      {speaking ? <VolumeX className="w-3.5 h-3.5" /> : <Volume2 className="w-3.5 h-3.5" />}
                      <span>{speaking ? 'Stop Audio' : 'Listen Answer'}</span>
                    </button>

                    <button
                      onClick={handleExportMarkdown}
                      className="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 hover:border-slate-300 text-xs font-semibold text-slate-700 shadow-xs cursor-pointer transition-all active:scale-95"
                    >
                      <Download className="w-3.5 h-3.5" />
                      <span>Export Notes</span>
                    </button>

                    <button
                      onClick={() => executeGeneration(question, selectedFaculty)}
                      disabled={loading}
                      className="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-200 hover:border-slate-300 text-xs font-semibold text-slate-700 shadow-xs cursor-pointer transition-all"
                    >
                      <RotateCcw className={`w-3.5 h-3.5 ${loading ? 'animate-spin' : ''}`} />
                      <span>Regenerate</span>
                    </button>
                  </div>

                  <div className="flex items-center gap-3">
                    <span className="text-xs font-semibold text-slate-500">Was this answer helpful?</span>
                    <div className="flex items-center gap-1.5">
                      <button
                        onClick={handleThumbsUp}
                        className={`p-1.5 rounded-lg border transition-colors cursor-pointer ${
                          feedbackGiven === 'up'
                            ? 'bg-emerald-100 border-emerald-400 text-emerald-700'
                            : 'bg-white border-slate-200 hover:bg-emerald-50 hover:text-emerald-600 text-slate-600'
                        }`}
                      >
                        <ThumbsUp className="w-4 h-4" />
                      </button>
                      <button
                        onClick={() => setFeedbackGiven('down')}
                        className={`p-1.5 rounded-lg border transition-colors cursor-pointer ${
                          feedbackGiven === 'down'
                            ? 'bg-rose-100 border-rose-400 text-rose-700'
                            : 'bg-white border-slate-200 hover:bg-rose-50 hover:text-rose-600 text-slate-600'
                        }`}
                      >
                        <ThumbsDown className="w-4 h-4" />
                      </button>
                    </div>
                  </div>

                </div>
              )}

            </div>
          )}

          {/* TAB 2: INTERACTIVE DISCUSSION */}
          {activeTab === 'chat' && (
            <div className="space-y-4">
              {chatMessages.map((msg, index) => {
                const isUser = msg.sender === 'user';
                return (
                  <div
                    key={msg.id || index}
                    className={`flex items-start gap-3 ${isUser ? 'flex-row-reverse' : ''}`}
                  >
                    <div className={`w-9 h-9 rounded-full flex items-center justify-center font-bold text-xs shrink-0 ring-2 ${
                      isUser 
                        ? 'bg-[#0077c8] text-white ring-blue-200' 
                        : 'bg-orange-500 text-white ring-orange-200'
                    }`}>
                      {isUser ? 'You' : 'FP'}
                    </div>

                    <div className={`max-w-[85%] rounded-2xl p-4 text-xs sm:text-sm leading-relaxed shadow-xs ${
                      isUser
                        ? 'bg-[#0077c8] text-white rounded-tr-none'
                        : 'bg-white border border-slate-200 text-slate-800 rounded-tl-none prose prose-slate max-w-none'
                    }`}>
                      <div className="flex items-center justify-between gap-4 mb-1 text-[10px] opacity-70 font-semibold">
                        <span>{isUser ? 'You' : msg.facultyName || selectedFaculty.name}</span>
                        <span>{msg.timestamp}</span>
                      </div>
                      
                      {isUser ? (
                        <p>{msg.text}</p>
                      ) : (
                        <ReactMarkdown remarkPlugins={[remarkGfm]}>
                          {msg.text}
                        </ReactMarkdown>
                      )}
                    </div>
                  </div>
                );
              })}

              {loading && (
                <div className="flex items-center gap-2 text-xs text-slate-500 font-semibold p-2 bg-slate-50 rounded-xl w-fit animate-pulse">
                  <Sparkles className="w-3.5 h-3.5 text-orange-500" />
                  <span>{selectedFaculty.name} is typing a response...</span>
                </div>
              )}

              <div ref={chatEndRef} />
            </div>
          )}

          {/* TAB 3: FACULTY CREDENTIALS */}
          {activeTab === 'faculty' && (
            <div className="bg-white rounded-2xl border border-slate-200 p-6 space-y-6">
              <div className="flex items-start gap-5">
                <img
                  src={selectedFaculty.avatar}
                  alt={selectedFaculty.name}
                  className="w-20 h-20 rounded-2xl object-cover ring-4 ring-blue-100"
                />
                <div className="space-y-1.5">
                  <div className="flex items-center gap-2">
                    <h3 className="text-xl font-bold text-slate-900">{selectedFaculty.name}</h3>
                    <span className="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                      Verified Doctor/Prof
                    </span>
                  </div>
                  <p className="text-xs font-semibold text-slate-600">{selectedFaculty.title}</p>
                  <p className="text-xs text-[#0077c8] font-bold">{selectedFaculty.institution}</p>
                </div>
              </div>

              <div className="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                <div className="p-4 rounded-xl bg-slate-50 border border-slate-100 text-center">
                  <div className="text-2xl font-black text-[#0077c8]">{selectedFaculty.rating}</div>
                  <div className="text-xs text-amber-500 font-bold">★★★★★</div>
                  <div className="text-[11px] text-slate-500 mt-1">5-Star Average Rating</div>
                </div>

                <div className="p-4 rounded-xl bg-slate-50 border border-slate-100 text-center">
                  <div className="text-2xl font-black text-emerald-600">{selectedFaculty.reviewsCount.toLocaleString()}+</div>
                  <div className="text-xs text-slate-600 font-bold">Questions Solved</div>
                  <div className="text-[11px] text-slate-500 mt-1">Peer Reviewed Answers</div>
                </div>

                <div className="p-4 rounded-xl bg-slate-50 border border-slate-100 text-center">
                  <div className="text-2xl font-black text-orange-600">&lt; 45s</div>
                  <div className="text-xs text-slate-600 font-bold">Average Response Time</div>
                  <div className="text-[11px] text-slate-500 mt-1">24/7 Availability</div>
                </div>
              </div>

              <div className="space-y-3 pt-2">
                <h4 className="text-xs font-bold uppercase tracking-wider text-slate-500">Specialties & Areas of Expertise</h4>
                <div className="flex flex-wrap gap-2">
                  {selectedFaculty.specialties.map((spec, i) => (
                    <span key={i} className="px-3 py-1 rounded-lg bg-blue-50 text-[#0077c8] text-xs font-semibold border border-blue-100">
                      {spec}
                    </span>
                  ))}
                </div>
              </div>
            </div>
          )}

        </div>

        {/* Modal Bottom Follow-up Input Bar */}
        <div className="p-4 sm:p-5 bg-slate-50 border-t border-slate-200/90 shrink-0">
          <form onSubmit={handleSendFollowUp} className="flex items-center gap-2 sm:gap-3">
            <div className="relative flex-1">
              <input
                type="text"
                value={followUpInput}
                onChange={(e) => setFollowUpInput(e.target.value)}
                placeholder={`Ask ${selectedFaculty.name.split(' ')[0]} a follow-up question (e.g., 'Can you clarify step 2?')...`}
                className="w-full bg-white px-4 py-3 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-[#0077c8] focus:ring-2 focus:ring-blue-100 shadow-xs"
              />
            </div>

            <button
              type="submit"
              disabled={loading || !followUpInput.trim()}
              className={`px-5 py-3 rounded-xl font-bold text-xs sm:text-sm text-white flex items-center gap-2 transition-all cursor-pointer shadow-md shrink-0 ${
                loading || !followUpInput.trim()
                  ? 'bg-slate-300 cursor-not-allowed'
                  : 'bg-gradient-to-r from-[#ff5722] to-[#f05423] hover:from-[#ff6f3c] hover:to-[#ff5722] active:scale-95 shadow-orange-500/20'
              }`}
            >
              <Send className="w-4 h-4" />
              <span className="hidden sm:inline">Send</span>
            </button>
          </form>
        </div>

      </div>

    </div>
  );
};

export default ConsultationModal;
