export const categories = [
  { id: 'all', name: 'All Facility & MEP', icon: 'Sparkles', color: 'text-indigo-600', count: '15,000+' },
  { id: 'hvac', name: 'HVAC Systems', icon: 'Wind', color: 'text-sky-600', count: '4,820+' },
  { id: 'plumbing', name: 'Plumbing & Piping', icon: 'Droplets', color: 'text-blue-600', count: '3,790+' },
  { id: 'electrical', name: 'Electrical & Power', icon: 'Zap', color: 'text-amber-600', count: '4,150+' },
  { id: 'firefighting', name: 'Fire Fighting & Safety', icon: 'Flame', color: 'text-rose-600', count: '2,940+' },
];

export const quickPrompts = [
  { text: "Chiller approach temperature high & surging", category: "hvac" },
  { text: "Booster pump head & flow calculation", category: "plumbing" },
  { text: "Transformer fault level & relay coordination", category: "electrical" },
  { text: "NFPA 13 sprinkler hydraulic calculation", category: "firefighting" },
  { text: "VRF low suction pressure & oil return error", category: "hvac" },
  { text: "Water hammer in high-rise riser pipes", category: "plumbing" },
  { text: "Ask any HVAC, Plumbing, Electrical or Fire Fighting question...", category: "all" }
];
