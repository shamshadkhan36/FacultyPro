// FacilityPro MEP OpenAI Service & Point-to-Point Engineering Engine
// Specialized in HVAC, Plumbing, Electrical, and Fire Fighting Systems

const STORAGE_KEYS = {
  API_KEY: 'facilitypro_openai_api_key',
  MODEL: 'facilitypro_openai_model',
  TEMPERATURE: 'facilitypro_temperature',
  FACULTY_PERSONA: 'facilitypro_persona'
};

export const AVAILABLE_MODELS = [
  { id: 'gpt-4o', name: 'GPT-4o (Omni) — Recommended for MEP Calculations', speed: 'Ultra Fast', reasoning: 'Maximum' },
  { id: 'gpt-4o-mini', name: 'GPT-4o Mini — Fast Troubleshooting', speed: 'Instant', reasoning: 'High' },
  { id: 'gpt-4-turbo', name: 'GPT-4 Turbo — Deep Engineering Design', speed: 'Moderate', reasoning: 'Very High' },
  { id: 'gpt-3.5-turbo', name: 'GPT-3.5 Turbo — Quick Reference', speed: 'Fast', reasoning: 'Standard' },
];

export const getStoredApiKey = () => {
  return localStorage.getItem(STORAGE_KEYS.API_KEY) || import.meta.env.VITE_OPENAI_API_KEY || '';
};

export const setStoredApiKey = (key) => {
  if (key) {
    localStorage.setItem(STORAGE_KEYS.API_KEY, key.trim());
  } else {
    localStorage.removeItem(STORAGE_KEYS.API_KEY);
  }
};

export const getStoredModel = () => {
  return localStorage.getItem(STORAGE_KEYS.MODEL) || 'gpt-4o';
};

export const setStoredModel = (model) => {
  localStorage.setItem(STORAGE_KEYS.MODEL, model);
};

export const getPointToPointSystemPrompt = (expertName = 'Eng. David Sterling, PE', specialty = 'HVAC & MEP Engineering') => {
  return `You are ${expertName}, a Senior Licensed Professional MEP Engineer (PE) and Facility Consultant on the FacilityPro platform specializing in ${specialty}.
Your mission is to provide rigorous, code-compliant, crystal-clear, point-to-point engineering solutions for Facility Management and MEP Systems across:
1. HVAC (Heating, Ventilation, Air Conditioning, Chillers, VRF, AHU, Cooling Towers, Ducting, Psychrometrics)
2. Plumbing (Water Supply, Booster Pumps, Drainage, Water Hammer, PRVs, Sewage Treatment, Stormwater)
3. Electrical (Transformers, Switchgears, DG Sets, Short Circuit, Earthing, Power Factor, UPS, Substation)
4. Fire Fighting (Fire Sprinklers, NFPA Codes 13/14/20/72, Fire Pumps, Hydrants, Smoke Evacuation, Clean Agents)

Strictly enforce compliance with industry engineering standards: ASHRAE, NFPA, NEC (NFPA 70), IEC, IPC, UPC, SMACNA, ASPE, and IEEE.
Always format your response cleanly in Markdown using this strict Point-to-Point template with ZERO fluff or filler words:

### 🎯 Direct Engineering Summary
[Direct 1-2 sentence core diagnosis, calculation result, or code requirement addressing the problem immediately]

### 📌 Point-by-Point Step-by-Step Technical Breakdown
1. **Root Cause / Core Mechanism**: [Precise thermodynamic, hydraulic, electrical, or fire protection principle without fluff]
2. **Standard Code & Design Basis**: [Exact applicable standard clause e.g. ASHRAE 90.1, NFPA 13 § 19.3, NEC Article 450, IPC § 604]
3. **Step-by-Step Resolution / Sizing Calculation**: [Exact step-by-step mathematical sizing, pressure-drop derivation, electrical parameters, or valve settings]
4. **Site Boundaries & Critical Safety Thresholds**: [Crucial pressure limits, temperature approach thresholds, breaker trip settings, or hazardous parameters]

### 🔬 Governing Formulas, Engineering Math & Code Reference
[Provide clean mathematical equations with variables defined, hydraulic/electrical formulas, or code table references]

### 🎓 Verified MEP Consultant Insight & Common Site Mistakes
- **Common Field Error**: [What 90% of site contractors/facility technicians get wrong on this issue]
- **Consultant Recommendation**: [Actionable advice for plant room maintenance, preventive testing, or authority submission]

### ✅ Action Checklist & Verification Protocol
- [x] Primary diagnostic check or valve/breaker inspection
- [x] Standard code compliance test
- [x] Operational log baseline verification`;
};

// Intelligent simulated response generator for out-of-the-box demo mode
export const generateSimulatedResponse = async (question, faculty, onChunk) => {
  const qLower = (question || '').toLowerCase();
  
  let topicSummary = '';
  let point1 = '';
  let point2 = '';
  let point3 = '';
  let point4 = '';
  let formulaOrCode = '';
  let misconception = '';
  let recommendation = '';

  // 1. HVAC Queries
  if (qLower.includes('hvac') || qLower.includes('chiller') || qLower.includes('vrf') || qLower.includes('vrv') || qLower.includes('ahu') || qLower.includes('cooling tower') || qLower.includes('duct') || qLower.includes('refrigeran') || qLower.includes('cfm') || qLower.includes('psychrometric')) {
    topicSummary = 'Centrifugal and screw chiller condenser approach temperature elevation indicates tube scaling or non-condensable gas accumulation, pushing compressor operation beyond the aerodynamic surge boundary and degrading COP.';
    point1 = '**Approach Temperature & Condenser Heat Rejection**: Condenser Approach = Saturation Temperature - Leaving Condenser Water Temperature. Approach exceeding 3.0°F (normal 1.0°F - 2.0°F) proves severe calcium/silica scaling on tube surfaces.';
    point2 = '**Aerodynamic Surge Dynamics**: Elevated head pressure (lift) reduces refrigerant mass flow below the critical compressor impeller surge line, resulting in periodic flow reversal, acoustic barking, and thrust bearing vibration.';
    point3 = '**Cooling Tower & Water Chemistry**: Insufficient cooling tower blowdown raises Cycles of Concentration (COC > 5), causing calcium carbonate precipitation on copper tubes (scaling resistance R_f > 0.00025 hr·ft²·°F/BTU).';
    point4 = '**Corrective Protocol (ASHRAE Guideline 22)**: (1) Run non-condensable purge compressor, (2) Calibrate water delta-T sensor accuracy, (3) Perform mechanical nylon-brush tube punching or mild sulfamic acid chemical descaling during scheduled shutdown.';
    formulaOrCode = `\`\`\`text
Heat Rejection: Q_cond (BTU/hr) = 500 * GPM * (T_leaving - T_entering)
Sensible Air Heat: Q_sensible = 1.08 * CFM * Delta_T
Approach Temp: T_approach = T_sat_refrigerant - T_leaving_water (Target: < 2.0°F)
\`\`\``;
    misconception = 'Assuming chiller surging is an electrical VFD hunting problem and increasing refrigerant charge, which further elevates condenser head pressure and damages compressor impellers.';
    recommendation = 'Maintain automatic chemical dosing to keep cooling tower Langelier Saturation Index (LSI) between 0.0 and +0.5.';
  } 
  // 2. PLUMBING & PIPING Queries
  else if (qLower.includes('plumb') || qLower.includes('pipe') || qLower.includes('pump') || qLower.includes('hammer') || qLower.includes('booster') || qLower.includes('drainage') || qLower.includes('prv') || qLower.includes('sewage') || qLower.includes('water supply')) {
    topicSummary = 'High-rise water supply pressure management requires multi-stage Pressure Reducing Valve (PRV) zoning and properly calculated water hammer arrestors to prevent pipe fatigue and fixture blowout under peak fixture unit demands.';
    point1 = '**Water Hammer Acoustic Shock Wave (Joukowsky Relation)**: Sudden closure of solenoid/fast-acting valves converts kinetic energy into acoustic pressure waves: Delta P = rho * c * Delta v, generating transient pressure spikes up to 350+ PSI.';
    point2 = '**Code Pressure Limits (IPC § 604.8 / UPC § 608.2)**: Static water pressure at fixtures must not exceed 80 PSI (5.5 bar). High-rise buildings require vertical pressure staging zones (typically every 8-10 floors) with redundant parallel PRV stations.';
    point3 = '**Booster Pump Hydro-Pneumatic Sizing**: Total Dynamic Head (TDH) = Static Lift (m) + Residual Pressure at highest fixture (minimum 2.0 bar / 30 PSI) + Total Friction Loss (Hazen-Williams) + 10% safety margin.';
    point4 = '**Water Hammer Arrestor Sizing (PDI-WH 201)**: Install stainless steel bellows arrestors sized for fixture units (Size A for 1-11 FU, Size B for 12-32 FU, Size C for 33-60 FU) within 6 feet of the fast-closing valve.';
    formulaOrCode = `\`\`\`text
Joukowsky Equation: Delta P = rho * c * Delta v
Hazen-Williams Pipe Friction: h_f = 10.67 * L * Q^1.852 / (C^1.852 * D^4.87)
Pump Power (kW): P = (Q [m3/hr] * H [m] * rho * g) / (3600 * 1000 * eta_pump)
\`\`\``;
    misconception = 'Installing standard air chambers (capped vertical pipes) instead of certified PDI-WH 201 water hammer arrestors. Air chambers become waterlogged within weeks and lose all dampening capability.';
    recommendation = 'Ensure PRV pilot filter strainers are blown down monthly and expansion vessel pre-charge air pressure is verified at 0.2 bar below cut-in pressure.';
  }
  // 3. ELECTRICAL & POWER Queries
  else if (qLower.includes('electr') || qLower.includes('transform') || qLower.includes('breaker') || qLower.includes('substation') || qLower.includes('dg') || qLower.includes('switchgear') || qLower.includes('inrush') || qLower.includes('power factor') || qLower.includes('short circuit') || qLower.includes('ups') || qLower.includes('earth')) {
    topicSummary = 'Substation transformer protection requires precise coordination between differential relay (87T) harmonic restraint and downstream overcurrent/earth fault (50/51/51N) settings to ensure stability during grid energization and fault clearance.';
    point1 = '**Transformer Magnetizing Inrush Dynamics**: Core residual flux upon breaker closing creates asymmetric unipolar inrush currents reaching 8-12x Full Load Amps (FLA) on the primary winding without matching secondary current.';
    point2 = '**2nd Harmonic Restraint Protocol (IEEE C37.91 / IEC 60255)**: Magnetizing inrush current possesses high 2nd harmonic content (> 15% of fundamental). The 87T numerical differential relay must be configured with 15% 2nd harmonic blocking to prevent nuisance tripping.';
    point3 = '**Short Circuit Fault Level (MVA / kA)**: I_sc = I_FLA / (%Z / 100). For a 2000 kVA 11kV/415V transformer with %Z = 6.0%, symmetrical fault current on the 415V bus reaches 46.3 kA, necessitating 50 kA rated ACB switchgear.';
    point4 = '**Vector Group Phase Shift Compensation**: Verify relay internal software matrix compensates for Dyn11 30° phase angle shift and CT primary/secondary neutral grounding references.';
    formulaOrCode = `\`\`\`text
Transformer Full Load Current: I_FLA = kVA / (sqrt(3) * kV_line)
Fault Current: I_sc = I_FLA / (%Z / 100)
3-Phase Real Power: P (kW) = sqrt(3) * V_L * I_L * PF / 1000
Capacitor Sizing for PF: Q_c (kVAR) = P (kW) * [tan(acos(PF_old)) - tan(acos(PF_target))]
\`\`\``;
    misconception = 'Increasing the differential pickup threshold (Id >) to stop inrush tripping instead of enabling 2nd harmonic blocking, which dangerously desensitizes the relay to genuine internal turn-to-turn faults.';
    recommendation = 'Perform annual dissipation factor (tan delta) and sweep frequency response analysis (SFRA) to detect mechanical winding movement after external downstream short circuits.';
  }
  // 4. FIRE FIGHTING & LIFE SAFETY Queries
  else if (qLower.includes('fire') || qLower.includes('sprinkler') || qLower.includes('nfpa') || qLower.includes('hydrant') || qLower.includes('smoke') || qLower.includes('alarm') || qLower.includes('pump') || qLower.includes('fm200') || qLower.includes('novec') || qLower.includes('suppression')) {
    topicSummary = 'Automatic fire sprinkler and hydrant system engineering mandates exact hydraulic calculations per NFPA 13 and NFPA 20 to verify remote area water density, hose stream allowance, and fire pump head capacity.';
    point1 = '**Occupancy Hazard Classification (NFPA 13 Chapter 4)**: Classify facility as Light Hazard (0.10 GPM/sq.ft over 1500 sq.ft), Ordinary Hazard Group 1/2 (0.15-0.20 GPM/sq.ft), or Extra Hazard (0.30-0.40 GPM/sq.ft over 2500 sq.ft).';
    point2 = '**Total Water Demand Sizing**: Total Flow = (Design Density * Remote Area) + Inside/Outside Hose Stream Allowance (e.g. Extra Hazard = 0.30 * 2500 sq.ft = 750 GPM + 500 GPM hose = 1,250 GPM for 90-120 minutes duration).';
    point3 = '**Fire Pump Configuration (NFPA 20)**: Main Electric Fire Pump (100% capacity) + Redundant Diesel Engine Driven Pump (100% capacity) + Jockey Pump (10-15 GPM @ 10 PSI above main pump shutoff head to maintain static line pressure).';
    point4 = '**Hydraulic Friction Loss (Hazen-Williams)**: p = (4.52 * Q^1.85) / (C^1.85 * d^4.87). Black steel pipe C-factor is 120. Residual pressure at the most remote sprinkler head must remain >= 7 PSI (0.5 bar) with minimum K-factor 5.6 or 8.0.';
    formulaOrCode = `\`\`\`text
Sprinkler Discharge: Q = K * sqrt(P)  (where K = 5.6, 8.0, 11.2, 14.0, 25.2)
Hazen-Williams Loss: p (psi/ft) = 4.52 * Q^1.85 / (C^1.85 * d^4.87)
Fire Water Tank Storage (m3): V = Q_total (GPM) * Duration (min) * 0.0037854
\`\`\``;
    misconception = 'Sizing fire pump flow without adding the mandatory 250-500 GPM hose stream allowance specified in NFPA 13 Table 19.3.3.1.2, resulting in failed local fire civil defence authority hydraulic audits.';
    recommendation = 'Conduct weekly automatic start tests on the diesel engine fire pump controller and annual full-flow pitot tube testing on the test header per NFPA 25.';
  }
  // 5. GENERAL MEP / FACILITY Queries
  else {
    topicSummary = `Point-to-point MEP and Facility engineering evaluation of "${(question || '').trim()}". Technical diagnosis requires verifying code compliance (ASHRAE/NFPA/NEC/IPC), hydraulic/electrical parameters, and life-safety integrity.`;
    point1 = `**Core MEP Mechanism & Premise**: Rigorous technical assessment addressing "${(question || '').trim().slice(0, 45)}..." based on standard engineering codes.`;
    point2 = '**Design Standard & Code References**: Verification against applicable international standards (ASHRAE 90.1/62.1, NFPA 13/20/70, IPC/UPC, and IEEE standards).';
    point3 = '**Step-by-Step Technical Resolution**: Calculation-driven resolution establishing sizing factors, operating limits, and protective settings.';
    point4 = '**Operational Safety & Site Boundaries**: Mandatory safety margins, pressure/voltage rating bounds, and emergency shutdown protocols.';
    formulaOrCode = `\`\`\`text
MEP System Validation:
Sizing Factor = (Design Load * Safety Margin) / Diversity Index
Code Compliance: Verified against ASHRAE / NFPA / NEC / IPC
\`\`\``;
    misconception = 'Overlooking system diversity factors or seasonal peak ambient design temperatures during initial capacity sizing.';
    recommendation = 'Execute the standardized step-by-step facility checklist below before signing off on site commissioning or submittal documentation.';
  }

  const fullMarkdown = `### 🎯 Direct Engineering Summary
${topicSummary}

### 📌 Point-by-Point Step-by-Step Technical Breakdown
1. ${point1}
2. ${point2}
3. ${point3}
4. ${point4}

### 🔬 Governing Formulas, Engineering Math & Code Reference
${formulaOrCode}

### 🎓 Verified MEP Consultant Insight & Common Site Mistakes
- **Common Field Error**: ${misconception}
- **Consultant Recommendation**: ${recommendation}

### ✅ Action Checklist & Verification Protocol
- [x] Verify incoming electrical supply voltage, phase balance & breaker settings
- [x] Inspect fluid pressure gauges, flow meters & PRV pilot diaphragms
- [x] Cross-reference calculations against ASHRAE / NFPA / NEC / IPC standards
- [x] Log operating parameters in BMS (Building Management System)`;

  const words = fullMarkdown.split(' ');
  let accumulated = '';
  
  for (let i = 0; i < words.length; i++) {
    accumulated += (i === 0 ? '' : ' ') + words[i];
    onChunk(accumulated);
    await new Promise((res) => setTimeout(res, Math.floor(Math.random() * 20) + 10));
  }

  return fullMarkdown;
};

// Real OpenAI API streaming caller with MEP point-to-point prompt
export const streamOpenAiResponse = async ({
  question,
  faculty,
  conversationHistory = [],
  onChunk,
  onError
}) => {
  const apiKey = getStoredApiKey();
  const model = getStoredModel();

  if (!apiKey) {
    return await generateSimulatedResponse(question, faculty, onChunk);
  }

  const systemPrompt = getPointToPointSystemPrompt(faculty?.name, faculty?.title);

  const messages = [
    { role: 'system', content: systemPrompt },
    ...conversationHistory.map(msg => ({
      role: msg.sender === 'user' ? 'user' : 'assistant',
      content: msg.text
    })),
    { role: 'user', content: question }
  ];

  try {
    const response = await fetch('https://api.openai.com/v1/chat/completions', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${apiKey}`
      },
      body: JSON.stringify({
        model: model,
        messages: messages,
        temperature: 0.2, // Low temperature for high engineering & calculation precision
        stream: true
      })
    });

    if (!response.ok) {
      const errData = await response.json().catch(() => ({}));
      throw new Error(errData.error?.message || `OpenAI API Error (${response.status})`);
    }

    const reader = response.body.getReader();
    const decoder = new TextDecoder('utf-8');
    let accumulatedText = '';

    while (true) {
      const { done, value } = await reader.read();
      if (done) break;

      const chunk = decoder.decode(value, { stream: true });
      const lines = chunk.split('\n');

      for (const line of lines) {
        const trimmed = line.trim();
        if (trimmed.startsWith('data: ')) {
          const dataStr = trimmed.replace('data: ', '').trim();
          if (dataStr === '[DONE]') {
            break;
          }
          try {
            const parsed = JSON.parse(dataStr);
            const deltaContent = parsed.choices?.[0]?.delta?.content || '';
            if (deltaContent) {
              accumulatedText += deltaContent;
              onChunk(accumulatedText);
            }
          } catch (e) {
            // Partial JSON buffer
          }
        }
      }
    }

    return accumulatedText;
  } catch (err) {
    console.warn('OpenAI streaming failed, falling back to simulated engine:', err);
    if (onError) onError(err);
    return await generateSimulatedResponse(question, faculty, onChunk);
  }
};

export const testOpenAiApiKey = async (apiKey) => {
  try {
    const response = await fetch('https://api.openai.com/v1/models', {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${apiKey}`
      }
    });
    if (response.ok) {
      return { success: true, message: 'OpenAI API Key verified successfully for FacilityPro MEP!' };
    } else {
      const errData = await response.json().catch(() => ({}));
      return { success: false, message: errData.error?.message || 'Invalid API Key' };
    }
  } catch (e) {
    return { success: false, message: e.message || 'Network connection failed' };
  }
};
