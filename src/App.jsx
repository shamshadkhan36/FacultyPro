import React, { useState, useEffect } from 'react';
import { AnnouncementBar } from './components/AnnouncementBar';
import { Navbar } from './components/Navbar';
import { HeroSection } from './components/HeroSection';
import { CategoryPills } from './components/CategoryPills';
import { PopularQuestions } from './components/PopularQuestions';
import { HowItWorks } from './components/HowItWorks';
import { MeetTheExperts } from './components/MeetTheExperts';
import { WhyYouLoveUs } from './components/WhyYouLoveUs';
import { TrustBadges } from './components/TrustBadges';
import { PricingSection } from './components/PricingSection';
import { Footer } from './components/Footer';
import { FloatingChatWidget } from './components/FloatingChatWidget';
import { ConsultationModal } from './components/ConsultationModal';
import { SettingsModal } from './components/SettingsModal';
import { BecomeExpertModal } from './components/BecomeExpertModal';
import { AuthModal } from './components/AuthModal';

// 8 Extended Main Features
import { EngineeringCalculators } from './components/EngineeringCalculators';
import { KnowledgeHub } from './components/KnowledgeHub';
import { SopLibrary } from './components/SopLibrary';
import { MaintenanceChecklists } from './components/MaintenanceChecklists';
import { UserDashboard } from './components/UserDashboard';
import { AdminPanel } from './components/AdminPanel';

import { faculties } from './data/faculties';
import { getStoredApiKey } from './services/openai';

export function App() {
  const [activeView, setActiveView] = useState('home'); // 'home' | 'calculators' | 'knowledge' | 'sops' | 'checklists' | 'dashboard' | 'admin' | 'pricing'
  
  const [consultationOpen, setConsultationOpen] = useState(false);
  const [activeQuestion, setActiveQuestion] = useState('');
  const [activeFaculty, setActiveFaculty] = useState(faculties[0]);
  
  const [settingsOpen, setSettingsOpen] = useState(false);
  const [applyModalOpen, setApplyModalOpen] = useState(false);
  const [authModalOpen, setAuthModalOpen] = useState(false);
  
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [hasApiKey, setHasApiKey] = useState(false);
  const [currentUser, setCurrentUser] = useState(null);

  const refreshApiKeyStatus = () => {
    setHasApiKey(Boolean(getStoredApiKey()));
  };

  useEffect(() => {
    refreshApiKeyStatus();
  }, []);

  // Smart MEP specialist matching based on query
  const handleStartConsultation = (questionText = '', faculty = null) => {
    const text = questionText || 'Calculate NFPA 13 sprinkler water demand for Extra Hazard Group 1 warehouse.';
    setActiveQuestion(text);
    if (faculty) {
      setActiveFaculty(faculty);
    } else {
      const qLower = (text || '').toLowerCase();
      if (qLower.includes('plumb') || qLower.includes('pipe') || qLower.includes('pump') || qLower.includes('hammer') || qLower.includes('booster') || qLower.includes('drain') || qLower.includes('prv') || qLower.includes('sewage') || qLower.includes('water')) {
        setActiveFaculty(faculties.find(f => f.id === 'eng-amit-patel') || faculties[1]);
      } else if (qLower.includes('electr') || qLower.includes('transform') || qLower.includes('substation') || qLower.includes('breaker') || qLower.includes('inrush') || qLower.includes('dg') || qLower.includes('power') || qLower.includes('short circuit') || qLower.includes('ups') || qLower.includes('earth') || qLower.includes('cable')) {
        setActiveFaculty(faculties.find(f => f.id === 'eng-vikram-malhotra') || faculties[2]);
      } else if (qLower.includes('fire') || qLower.includes('sprinkler') || qLower.includes('nfpa') || qLower.includes('hydrant') || qLower.includes('smoke') || qLower.includes('alarm') || qLower.includes('fm200') || qLower.includes('suppression')) {
        setActiveFaculty(faculties.find(f => f.id === 'eng-ananya-verma') || faculties[3]);
      } else {
        // Default to HVAC & Chilled Water specialist
        setActiveFaculty(faculties.find(f => f.id === 'eng-rajesh-sharma') || faculties[0]);
      }
    }
    setConsultationOpen(true);
  };

  const handleSelectPopularQuestion = (item) => {
    const assigned = faculties.find(f => f.id === item.assignedFacultyId) || faculties[0];
    handleStartConsultation(item.excerpt, assigned);
  };

  const handleSelectFacultyCard = (fac) => {
    handleStartConsultation(`I would like a point-to-point MEP consultation regarding ${fac.specialties.join(', ')}.`, fac);
  };

  const handleCategorySelect = (catId) => {
    setSelectedCategory(catId);
    if (catId === 'hvac') {
      setActiveFaculty(faculties[0]);
    } else if (catId === 'plumbing') {
      setActiveFaculty(faculties[1]);
    } else if (catId === 'electrical') {
      setActiveFaculty(faculties[2]);
    } else if (catId === 'firefighting') {
      setActiveFaculty(faculties[3]);
    }
    if (activeView === 'home') {
      const elem = document.getElementById('popular');
      if (elem) elem.scrollIntoView({ behavior: 'smooth' });
    }
  };

  const handleNavigate = (view) => {
    setActiveView(view);
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  return (
    <div className="min-h-screen bg-white text-slate-900 flex flex-col font-sans selection:bg-[#f05423] selection:text-white">
      
      {/* 1. Top Announcement Bar */}
      <AnnouncementBar onApplyClick={() => setApplyModalOpen(true)} />

      {/* 2. Main Navigation Bar with Tab Routing */}
      <Navbar
        activeView={activeView}
        onNavigate={handleNavigate}
        onOpenSettings={() => setSettingsOpen(true)}
        onOpenAuth={() => setAuthModalOpen(true)}
        onOpenApply={() => setApplyModalOpen(true)}
        onStartAiChat={() => handleStartConsultation()}
        hasApiKey={hasApiKey}
        onSelectCategory={handleCategorySelect}
      />

      {/* View Switcher Routing */}
      <main className="flex-1">
        {activeView === 'home' && (
          <>
            {/* Hero Section */}
            <HeroSection
              onStartChat={(q) => handleStartConsultation(q)}
              onSelectPrompt={(p) => handleStartConsultation(p)}
            />

            {/* Category Pills Ribbon */}
            <CategoryPills
              selectedCategory={selectedCategory}
              onSelectCategory={handleCategorySelect}
            />

            {/* Popular Questions Grid */}
            <PopularQuestions
              onSelectQuestion={handleSelectPopularQuestion}
            />

            {/* How It Works */}
            <HowItWorks
              onTryNow={() => handleStartConsultation('Calculate NFPA 13 sprinkler water demand for Extra Hazard Group 1 warehouse.')}
            />

            {/* Meet The MEP Experts Carousel */}
            <MeetTheExperts
              onSelectFaculty={handleSelectFacultyCard}
            />

            {/* Why Facility Managers Love FacilityPro */}
            <WhyYouLoveUs />

            {/* Pricing Section */}
            <PricingSection
              onSelectPlan={(plan) => handleStartConsultation(`I would like to activate the ${plan.name} for our facility plant.`)}
            />

            {/* Trust Badges */}
            <TrustBadges />
          </>
        )}

        {/* Feature 5: Engineering Calculators */}
        {activeView === 'calculators' && (
          <EngineeringCalculators
            onStartAiConsultation={(q) => handleStartConsultation(q)}
          />
        )}

        {/* Feature 2: Engineering Knowledge Hub */}
        {activeView === 'knowledge' && (
          <KnowledgeHub
            onStartAiConsultation={(q) => handleStartConsultation(q)}
          />
        )}

        {/* Feature 3: SOP Library */}
        {activeView === 'sops' && (
          <SopLibrary
            onStartAiConsultation={(q) => handleStartConsultation(q)}
          />
        )}

        {/* Feature 4: Maintenance Checklists */}
        {activeView === 'checklists' && (
          <MaintenanceChecklists
            onStartAiConsultation={(q) => handleStartConsultation(q)}
          />
        )}

        {/* Feature 6 & 7: User Dashboard & Subscription Status */}
        {activeView === 'dashboard' && (
          <UserDashboard
            onStartAiConsultation={(q) => handleStartConsultation(q)}
            onOpenPricing={() => handleNavigate('home')}
            onOpenCalculator={() => handleNavigate('calculators')}
            onOpenSop={() => handleNavigate('sops')}
          />
        )}

        {/* Feature 8: Admin Panel */}
        {activeView === 'admin' && (
          <AdminPanel
            onStartAiConsultation={(q) => handleStartConsultation(q)}
          />
        )}
      </main>

      {/* Comprehensive Footer */}
      <Footer
        onOpenApply={() => setApplyModalOpen(true)}
        onOpenAuth={() => setAuthModalOpen(true)}
        onNavigate={handleNavigate}
      />

      {/* Persistent Floating Live MEP Chat Helper */}
      <FloatingChatWidget
        onOpenConsultation={(q) => handleStartConsultation(q)}
      />

      {/* Flagship Point-to-Point MEP Consultation Workspace */}
      <ConsultationModal
        isOpen={consultationOpen}
        onClose={() => setConsultationOpen(false)}
        initialQuestion={activeQuestion}
        initialFaculty={activeFaculty}
        onOpenSettings={() => setSettingsOpen(true)}
      />

      {/* OpenAI Settings Configuration Modal */}
      <SettingsModal
        isOpen={settingsOpen}
        onClose={() => setSettingsOpen(false)}
        onSettingsUpdated={refreshApiKeyStatus}
      />

      {/* Become an MEP Expert Application Modal */}
      <BecomeExpertModal
        isOpen={applyModalOpen}
        onClose={() => setApplyModalOpen(false)}
      />

      {/* Authentication Modal */}
      <AuthModal
        isOpen={authModalOpen}
        onClose={() => setAuthModalOpen(false)}
        onAuthSuccess={(userData) => setCurrentUser(userData)}
      />

    </div>
  );
}

export default App;
