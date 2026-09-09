export const subscriptionPlans = [
  {
    id: 'free',
    name: 'Free Starter',
    priceMonthly: 0,
    priceAnnual: 0,
    badge: 'Free Forever',
    description: 'Essential MEP point-to-point Q&A and basic engineering references for technicians and students.',
    features: [
      '5 Daily AI Point-to-Point MEP Solutions',
      'Basic Engineering Knowledge Articles',
      'Standard CFM & Electrical Calculators',
      'Read-Only Preview of SOP Library',
      'Community Discussion Access'
    ],
    popular: false,
    ctaText: 'Current Plan',
    disabled: false
  },
  {
    id: 'pro',
    name: 'Professional Engineer',
    priceMonthly: 29,
    priceAnnual: 24,
    badge: 'Most Popular',
    description: 'For Facility Managers, MEP Project Engineers, and Licensed Consultants needing daily calculations and code verification.',
    features: [
      'Unlimited OpenAI GPT-4o Point-to-Point Q&A',
      'All 6 Interactive Engineering Calculators',
      'Full Access to 50+ MEP Standard Operating Procedures (SOPs)',
      'Interactive Maintenance & Inspection Checklists',
      'Export Calculations to Markdown & PDF',
      'Text-to-Speech Audio Explanations',
      'Direct Question Routing to Licensed PEs'
    ],
    popular: true,
    ctaText: 'Upgrade to Professional',
    disabled: false
  },
  {
    id: 'business',
    name: 'Facility Operations Team',
    priceMonthly: 89,
    priceAnnual: 74,
    badge: 'Best for Plants',
    description: 'For commercial buildings, multi-story hotels, hospitals, and MEP contracting teams.',
    features: [
      'Everything in Professional',
      'Up to 5 Team Member Accounts',
      'Custom Plant Equipment Sizing & Log History',
      'Signed Inspection PDF Report Generator',
      'Bring Your Own OpenAI API Key (BYOK)',
      'Priority 24/7 Site Support (< 30s response)',
      'Custom Maintenance Checklist Creator'
    ],
    popular: false,
    ctaText: 'Start 14-Day Team Trial',
    disabled: false
  },
  {
    id: 'enterprise',
    name: 'Enterprise Facility Lab',
    priceMonthly: 249,
    priceAnnual: 199,
    badge: 'Enterprise',
    description: 'For corporate real estate portfolios, data centers, and multi-property hotel chains.',
    features: [
      'Everything in Business Team',
      'Unlimited Site Engineer Seats',
      'Customized Plant SOPs & LOTO Safety Standards',
      'BMS & SCADA Protocol Integration Consulting',
      'Dedicated Senior MEP Engineering Account Manager',
      'Single Sign-On (SSO) & Audit Compliance Log',
      'Custom SLA & 99.99% Guaranteed Uptime'
    ],
    popular: false,
    ctaText: 'Contact Enterprise Sales',
    disabled: false
  }
];
