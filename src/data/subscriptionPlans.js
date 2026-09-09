export const subscriptionPlans = [
  {
    id: 'starter-199',
    name: 'Single Emergency Case',
    price: '₹199',
    priceMonthly: 199,
    priceAnnual: 199,
    period: 'one-time',
    badge: 'Quick Solver',
    description: 'Essential MEP point-to-point Q&A and urgent diagnostic troubleshooting for plant engineers.',
    features: [
      '1 Complete Point-to-Point MEP Solution',
      'Assigned Licensed Professional Engineer',
      'Exact Sizing Formulas & Code Clauses',
      '24h Follow-up Chat with Specialist',
      'Export to Calculation Notes & PDF'
    ],
    popular: false,
    isComingSoon: false,
    ctaText: 'Solve for ₹199',
    disabled: false
  },
  {
    id: 'pro-399',
    name: 'Facility Pro Monthly',
    price: '₹399',
    priceMonthly: 399,
    priceAnnual: 349,
    period: 'per month',
    badge: 'Most Popular for Plants',
    description: 'Unlimited point-to-point Q&A for Facility Managers, MEP Contractors & Plant Engineers.',
    features: [
      'Unlimited OpenAI GPT-4o Point-to-Point Q&A',
      'All 6 Interactive Engineering Calculators',
      'Full Access to 50+ MEP Standard Operating Procedures (SOPs)',
      'Interactive Maintenance & Inspection Checklists',
      'Export Calculations to Markdown & PDF',
      'Direct Question Routing to Licensed PEs',
      'Cancel Anytime with 1-Click'
    ],
    popular: true,
    isComingSoon: false,
    ctaText: 'Upgrade for ₹399/mo',
    disabled: false
  },
  {
    id: 'enterprise-custom',
    name: 'Enterprise MEP & Plant Lab',
    price: 'Coming Soon',
    priceMonthly: 0,
    priceAnnual: 0,
    period: 'Custom Plant',
    badge: 'Enterprise',
    description: 'For MEP Consultancy firms, Hospital facilities, and Data Center operations teams.',
    features: [
      'Everything in Facility Pro',
      'Up to 10 Site Engineer Seats',
      'Customized Plant SOPs & LOTO Safety Standards',
      'Single Line Diagram (SLD) & Hydraulic Review',
      'Dedicated Senior MEP Engineering Account Manager',
      'Custom SLA & 99.99% Guaranteed Uptime'
    ],
    popular: false,
    isComingSoon: true,
    ctaText: 'Coming Soon',
    disabled: true
  }
];

export default subscriptionPlans;
