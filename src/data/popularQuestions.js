export const popularQuestions = [
  {
    id: 'med-1',
    category: 'Medical',
    badgeColor: 'bg-rose-50 text-rose-700 border-rose-200',
    title: 'Pathophysiology of acute cut infections & antibiotic resistance',
    excerpt: 'I have a cut on my finger that does not seem to be healing and is swollen. What are the clinical signs of an acute infection vs cellulitis?',
    image: 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=600&q=80',
    facultyName: 'Dr. Marcus Lin, MD/Ph.D.',
    assignedFacultyId: 'dr-marcus-lin',
    answerPoints: [
      'Primary Signs of Infection: Localized erythema spreading > 1cm from wound edge, elevated skin warmth, throbbing pain out of proportion, and fluctuating edema.',
      'Systemic Red Flags: Presence of lymphangitic streaking, fevers (>38°C), chills, or purulent drainage indicate progressive bacteremia.',
      'Pathophysiology: Staph aureus and Group A Streptococcus break epidermal stratum corneum, releasing exotoxins that trigger neutrophil extravasation.',
      'Action Plan: (1) Cleanse with normal saline, (2) Elevate extremity, (3) Obtain medical evaluation for oral empiric cephalexin.'
    ]
  },
  {
    id: 'vet-1',
    category: 'Veterinary & Bio',
    badgeColor: 'bg-emerald-50 text-emerald-700 border-emerald-200',
    title: 'Theobromine Toxicity in Canines: Lethal Dose & Timeline',
    excerpt: 'My dog is 75 lb and ingested dark baker chocolate. How much theobromine is dangerous for a large dog and what is the exact treatment window?',
    image: 'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?auto=format&fit=crop&w=600&q=80',
    facultyName: 'Dr. Arthur Vance & Vet Faculty Board',
    assignedFacultyId: 'dr-arthur-vance',
    answerPoints: [
      'Toxic Thresholds: Mild signs occur at 20 mg/kg; cardiotoxic arrhythmias at 40-50 mg/kg; fatal neurotoxicity at >=60 mg/kg.',
      'Bakers Calculation: 1 oz Baker chocolate contains ~400mg theobromine. For 75 lb (34 kg), 2 oz is moderate toxicity, 4+ oz is critical.',
      'Metabolic Half-Life: Long half-life (~17.5 hours) due to slow hepatic CYP450 demethylation.',
      'Immediate Action: Decontamination via activated charcoal within 2-4 hours, IV fluid diuresis.'
    ]
  },
  {
    id: 'auto-1',
    category: 'Automotive & Eng',
    badgeColor: 'bg-blue-50 text-blue-700 border-blue-200',
    title: 'Planetary Gearbox Grinding & Torque Converter Diagnosis',
    excerpt: 'My car transmission is making a distinct grinding sound during 2nd to 3rd gear shift. What are the root mechanical causes?',
    image: 'https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=600&q=80',
    facultyName: 'Dr. David Sterling, P.E.',
    assignedFacultyId: 'dr-david-sterling',
    answerPoints: [
      'Synchronizer Ring Wear: Brass synchro teeth on 2-3 hub rounded off, failing to equalize rotational speed.',
      'Torque Converter Stator Clutch Failure: Grinding under high acceleration indicates stator clutch slippage.',
      'Planetary Carrier Bearing Galling: Breakdown on pinion shafts generates metallic debris.',
      'Verification: Inspect pan magnet and run OBD2 line pressure logging.'
    ]
  },
  {
    id: 'law-1',
    category: 'Legal Studies',
    badgeColor: 'bg-amber-50 text-amber-700 border-amber-200',
    title: 'Severance Agreement Waivers, ADEA 21-Day Period & Non-Competes',
    excerpt: 'I was recently laid off. What is legally required in a severance package under federal law, and can I negotiate the non-compete clause?',
    image: 'https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&w=600&q=80',
    facultyName: 'Prof. Elena Rostova, J.D.',
    assignedFacultyId: 'prof-elena-rostova',
    answerPoints: [
      'Statutory Rights (OWBPA/ADEA): Mandates 21-day review period plus 7-day revocation window for age 40+.',
      'Consideration Requirement: Valid release requires consideration beyond what is already owed.',
      'Non-Compete Enforceability: Must be narrowly tailored in duration (<1 year) and protectable interest.',
      'Negotiation Strategy: Focus on COBRA subsidies and mutual non-disparagement.'
    ]
  }
];
