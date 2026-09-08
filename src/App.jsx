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

  // Smart MEP specialist matching based on query
  const handleStartConsultation = (questionText, faculty = null) => {
    setActiveQuestion(questionText);
    if (faculty) {
      setActiveFaculty(faculty);
    } else {
      const qLower = (questionText || '').toLowerCase();
      if (qLower.includes('plumb') || qLower.includes('pipe') || qLower.includes('pump') || qLower.includes('hammer') || qLower.includes('booster') || qLower.includes('drain') || qLower.includes('prv') || qLower.includes('sewage') || qLower.includes('water')) {
        setActiveFaculty(faculties.find(f => f.id === 'eng-robert-vance') || faculties[1]);
      } else if (qLower.includes('electr') || qLower.includes('transform') || qLower.includes('substation') || qLower.includes('breaker') || qLower.includes('inrush') || qLower.includes('dg') || qLower.includes('power') || qLower.includes('short circuit') || qLower.includes('ups') || qLower.includes('earth')) {
        setActiveFaculty(faculties.find(f => f.id === 'eng-marcus-lin') || faculties[2]);
      } else if (qLower.includes('fire') || qLower.includes('sprinkler') || qLower.includes('nfpa') || qLower.includes('hydrant') || qLower.includes('smoke') || qLower.includes('alarm') || qLower.includes('fm200') || qLower.includes('suppression')) {
        setActiveFaculty(faculties.find(f => f.id === 'eng-sarah-chen') || faculties[3]);
      } else {
        // Default to HVAC & Chilled Water specialist
        setActiveFaculty(faculties.find(f => f.id === 'eng-david-sterling') || faculties[0]);
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
    const elem = document.getElementById('popular');
    if (elem) elem.scrollIntoView({ behavior: 'smooth' });
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
        onSelectCategory={handleCategorySelect}
      />

      {/* 3. Hero Section with MEP Question Input & Prompt Badges */}
      <HeroSection
        onStartChat={(q) => handleStartConsultation(q)}
        onSelectPrompt={(p) => handleStartConsultation(p)}
      />

      {/* 4. Category Pills Ribbon (HVAC, Plumbing, Electrical, Fire Fighting) */}
      <CategoryPills
        selectedCategory={selectedCategory}
        onSelectCategory={handleCategorySelect}
      />

      {/* 5. Popular Questions Grid (4 Core MEP Disciplines) */}
      <PopularQuestions
        onSelectQuestion={handleSelectPopularQuestion}
      />

      {/* 6. How It Works 3-Step Guide */}
      <HowItWorks
        onTryNow={() => handleStartConsultation('Calculate NFPA 13 sprinkler water demand for Extra Hazard Group 1 warehouse.')}
      />

      {/* 7. Meet The MEP Experts Carousel */}
      <MeetTheExperts
        onSelectFaculty={handleSelectFacultyCard}
      />

      {/* 8. Why Facility Managers Love FacilityPro */}
      <WhyYouLoveUs />

      {/* 9. Facility & MEP Pricing Section */}
      <PricingSection
        onSelectPlan={(plan) => handleStartConsultation(`I would like to activate the ${plan.name} for our facility plant.`)}
      />

      {/* 10. Trust Badges & Accreditations */}
      <TrustBadges />

      {/* 11. Comprehensive Footer */}
      <Footer
        onOpenApply={() => setApplyModalOpen(true)}
        onOpenAuth={() => setAuthModalOpen(true)}
      />

      {/* 12. Persistent Floating Live MEP Chat Helper */}
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
