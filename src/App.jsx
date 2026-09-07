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
import { faculties } from './data/faculties';
import { getStoredApiKey } from './services/openai';

export function App() {
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

  const handleStartConsultation = (questionText, faculty = null) => {
    setActiveQuestion(questionText);
    if (faculty) {
      setActiveFaculty(faculty);
    } else {
      const qLower = questionText.toLowerCase();
      if (qLower.includes('law') || qLower.includes('contract') || qLower.includes('severance') || qLower.includes('legal')) {
        setActiveFaculty(faculties.find(f => f.id === 'prof-elena-rostova') || faculties[0]);
      } else if (qLower.includes('medical') || qLower.includes('doctor') || qLower.includes('infection') || qLower.includes('antibiotic')) {
        setActiveFaculty(faculties.find(f => f.id === 'dr-marcus-lin') || faculties[0]);
      } else if (qLower.includes('code') || qLower.includes('algorithm') || qLower.includes('cs') || qLower.includes('software') || qLower.includes('deadlock') || qLower.includes('raft')) {
        setActiveFaculty(faculties.find(f => f.id === 'prof-sarah-chen') || faculties[0]);
      } else if (qLower.includes('auto') || qLower.includes('car') || qLower.includes('gear') || qLower.includes('engine') || qLower.includes('thermodynamic')) {
        setActiveFaculty(faculties.find(f => f.id === 'dr-david-sterling') || faculties[0]);
      } else {
        setActiveFaculty(faculties.find(f => f.id === 'dr-arthur-vance') || faculties[0]);
      }
    }
    setConsultationOpen(true);
  };

  const handleSelectPopularQuestion = (item) => {
    const assigned = faculties.find(f => f.id === item.assignedFacultyId) || faculties[0];
    handleStartConsultation(item.excerpt, assigned);
  };

  const handleSelectFacultyCard = (fac) => {
    handleStartConsultation(`I would like a point-to-point consultation regarding ${fac.specialties.join(', ')}.`, fac);
  };

  return (
    <div className="min-h-screen bg-white text-slate-900 flex flex-col font-sans selection:bg-[#f05423] selection:text-white">
      
      {/* 1. Top Announcement Bar */}
      <AnnouncementBar onApplyClick={() => setApplyModalOpen(true)} />

      {/* 2. Main Navigation Bar */}
      <Navbar
        onOpenSettings={() => setSettingsOpen(true)}
        onOpenAuth={() => setAuthModalOpen(true)}
        onOpenApply={() => setApplyModalOpen(true)}
        hasApiKey={hasApiKey}
        onSelectCategory={(catId) => setSelectedCategory(catId)}
      />

      {/* 3. Hero Section with Question Input & Prompt Badges */}
      <HeroSection
        onStartChat={(q) => handleStartConsultation(q)}
        onSelectPrompt={(p) => handleStartConsultation(p)}
      />

      {/* 4. Category Pills Ribbon matching Screenshot 2 */}
      <CategoryPills
        selectedCategory={selectedCategory}
        onSelectCategory={(catId) => {
          setSelectedCategory(catId);
          const elem = document.getElementById('popular');
          if (elem) elem.scrollIntoView({ behavior: 'smooth' });
        }}
      />

      {/* 5. Popular Questions Grid matching Screenshot 2 */}
      <PopularQuestions
        onSelectQuestion={handleSelectPopularQuestion}
      />

      {/* 6. How It Works 3-Step Guide matching Screenshot 2 */}
      <HowItWorks
        onTryNow={() => handleStartConsultation('Explain Bell Inequality and why local hidden variable theories fail.')}
      />

      {/* 7. Meet The Experts Carousel matching Screenshot 3 */}
      <MeetTheExperts
        onSelectFaculty={handleSelectFacultyCard}
      />

      {/* 8. Why You'll Love FacultyPro matching Screenshot 4 */}
      <WhyYouLoveUs />

      {/* 9. Student & Scholar Pricing Section */}
      <PricingSection
        onSelectPlan={(plan) => handleStartConsultation(`I would like to activate the ${plan.name} with point-to-point faculty guidance.`)}
      />

      {/* 10. Trust Badges & Accreditation matching Screenshot 5 */}
      <TrustBadges />

      {/* 11. Footer matching Screenshot 5 */}
      <Footer
        onOpenApply={() => setApplyModalOpen(true)}
        onOpenAuth={() => setAuthModalOpen(true)}
      />

      {/* 12. Persistent Floating Live Chat Helper matching Screenshot 1-5 */}
      <FloatingChatWidget
        onOpenConsultation={(q) => handleStartConsultation(q)}
      />

      {/* Flagship Point-to-Point Consultation Workspace */}
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

      {/* Become an Expert Application Modal */}
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
