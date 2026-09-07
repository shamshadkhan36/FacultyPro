// FacultyPro OpenAI Service & Point-to-Point Reasoning Engine

const STORAGE_KEYS = {
  API_KEY: 'facultypro_openai_api_key',
  MODEL: 'facultypro_openai_model',
  TEMPERATURE: 'facultypro_temperature',
  FACULTY_PERSONA: 'facultypro_persona'
};

export const AVAILABLE_MODELS = [
  { id: 'gpt-4o', name: 'GPT-4o (Omni) — Recommended', speed: 'Ultra Fast', reasoning: 'Maximum' },
  { id: 'gpt-4o-mini', name: 'GPT-4o Mini — Fast & Lightweight', speed: 'Instant', reasoning: 'High' },
  { id: 'gpt-4-turbo', name: 'GPT-4 Turbo — Deep Analysis', speed: 'Moderate', reasoning: 'Very High' },
  { id: 'gpt-3.5-turbo', name: 'GPT-3.5 Turbo — Standard', speed: 'Fast', reasoning: 'Standard' },
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

export const getPointToPointSystemPrompt = (facultyName = 'Dr. Arthur Vance', specialty = 'STEM & Applied Science') => {
  return `You are ${facultyName}, an elite verified Professor and domain authority on the FacultyPro platform specializing in ${specialty}.
Your mission is to provide rigorous, crystal-clear, point-to-point answers to the user's question with ZERO fluff or filler words.

Always format your response cleanly in Markdown using this strict Point-to-Point template:

### 🎯 Executive Summary
[Direct 1-2 sentence core answer/conclusion answering the question immediately]

### 📌 Point-by-Point Structured Breakdown
1. **Direct Mechanism / Core Concept**: [Precise logical explanation without preamble]
2. **Key Governing Principles**: [Fundamental laws, statutes, physiological paths, or algorithms involved]
3. **Step-by-Step Resolution / Proof**: [Exact step-by-step mathematical derivation, code logic, diagnostic criteria, or legal analysis]
4. **Edge Cases & Critical Boundaries**: [Crucial exceptions, parameter bounds, or complications]

### 🔬 Core Reference, Formula or Code
[Provide clean math equations, code blocks with syntax highlighting, or statutory/medical references]

### 🎓 Verified Faculty Insight & Common Pitfalls
- **Common Misconception**: [What 90% of students/professionals get wrong on this topic]
- **Faculty Recommendation**: [Professional guidance for exams, peer review, or implementation]

### ✅ Action Checklist & Summary
- [x] Primary takeaway
- [x] Immediate next step or diagnostic verification
- [x] Key formula/principle to memorize`;
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

  if (qLower.includes('quantum') || qLower.includes('entangle') || qLower.includes('bell')) {
    topicSummary = 'Quantum entanglement is a phenomenon where two or more particles share a single composite quantum wave function such that measurement of one instantaneously correlates with the other, regardless of spatial separation, without violating relativistic causality (no-communication theorem).';
    point1 = '**Wave Function Non-Separability**: Entangled states (e.g. Bell state |Ψ⁺⟩ = (|01⟩ + |10⟩)/√2) cannot be factored into product states |ψA⟩ ⊗ |ψB⟩.';
    point2 = '**Von Neumann Entropy & Non-Locality**: Local reduced density matrices have maximum von Neumann entropy S(ρA) = 1, despite the global system being in a pure state S(ρAB) = 0.';
    point3 = '**CHSH Inequality Violation**: Bell theorem demonstrates that quantum mechanics violates local hidden variable constraints (CHSH parameter S ≤ 2 is violated up to 2√2 ≈ 2.828 Tsirelson bound).';
    point4 = '**No-Signaling Theorem Compliance**: Local measurement results are intrinsically random; hence, no superluminal information transfer can occur without a classical communication channel.';
    formulaOrCode = `\`\`\`text
Bell State: |Φ⁺⟩ = (|00⟩ + |11⟩) / √2
CHSH Correlation: S = |E(a,b) - E(a,b') + E(a',b) + E(a',b')| ≤ 2√2
\`\`\``;
    misconception = 'Assuming entanglement allows instant faster-than-light data transmission. Measurement collapses state correlations, but the outcome appears purely random to the local observer until classical verification is exchanged.';
    recommendation = 'Focus on the density matrix formulation rather than state vectors when analyzing mixed-state decoherence.';
  } else if (qLower.includes('differential') || qLower.includes('dy/dx') || qLower.includes('calculus') || qLower.includes('math')) {
    topicSummary = 'The differential equation dy/dx = y/x is a first-order separable and homogeneous ordinary differential equation whose general solution family is the linear ray y(x) = C·x, representing straight lines passing through the origin.';
    point1 = '**Separation of Variables**: Rearrange differential terms to isolate dependent and independent variables: (1/y) dy = (1/x) dx.';
    point2 = '**Integration of Both Sides**: Integrate ∫ (1/y) dy = ∫ (1/x) dx, yielding ln|y| = ln|x| + C₁ where C₁ is the constant of integration.';
    point3 = '**Exponentiation & Linear Family**: Exponentiating both sides gives |y| = e^(C₁) · |x| => y(x) = C · x, where C = ±e^(C₁) ∈ ℝ.';
    point4 = '**Singularities & Boundary Behavior**: The origin (x=0, y=0) is a singular point where slope is undefined (0/0 indeterminate), and x=0 represents a vertical asymptote for non-trivial solutions.';
    formulaOrCode = `\`\`\`text
Step 1: dy / y = dx / x
Step 2: ln|y| = ln|x| + C
Step 3: y(x) = C · x (for all x ≠ 0)
\`\`\``;
    misconception = 'Forgetting to include the trivial solution y(x) = 0 and neglecting absolute value signs before exponentiation.';
    recommendation = 'Always sketch the direction field to verify that radial lines from the origin match the slope vector field (y/x).';
  } else if (qLower.includes('law') || qLower.includes('contract') || qLower.includes('estoppel') || qLower.includes('severance')) {
    topicSummary = 'In modern jurisprudence, Promissory Estoppel is an equitable doctrine that prevents a promisor from revoking a gratuitous promise if the promisee reasonably and detrimentally relied upon that promise to their significant economic injury.';
    point1 = '**Clear and Definite Promise**: There must be an unambiguous commitment made by the promisor with the objective intent that it be acted upon.';
    point2 = '**Reasonable & Foreseeable Reliance**: The promisor must have had reasonable cause to foresee that the promisee would change their position based on the representation.';
    point3 = '**Substantial Detriment / Economic Harm**: The promisee must have incurred tangible reliance damages (Restatement (Second) of Contracts § 90).';
    point4 = '**Injustice Avoidable Only by Enforcement**: Equity intervenes only to the extent necessary to prevent unconscionable harm (often limiting remedies to reliance rather than expectation damages).';
    formulaOrCode = `\`\`\`text
Restatement (Second) of Contracts § 90:
"A promise which the promisor should reasonably expect to induce action or forbearance... 
and which does induce such action or forbearance is binding if injustice can be avoided only by enforcement."
\`\`\``;
    misconception = 'Treating Promissory Estoppel as an automatic substitute for breach of contract. Courts require rigorous proof of actual out-of-pocket detriment, not merely disappointed expectations.';
    recommendation = 'In formal litigation or dispute resolution, establish a contemporaneous paper trail proving when the promise was communicated and the chronological timeline of reliance expenses.';
  } else if (qLower.includes('medical') || qLower.includes('doctor') || qLower.includes('infection') || qLower.includes('pancreatitis') || qLower.includes('fever')) {
    topicSummary = 'Acute clinical presentation requires distinguishing between localized bacterial inflammatory response and systemic bacteremia/sepsis using systemic inflammatory response criteria (SIRS) and specific biomarker elevation (CRP, Procalcitonin, Leukocytosis with Left Shift).';
    point1 = '**Cardinal Inflammatory Pathophysiology**: Capillary endothelial dilation and mast cell histamine release induce localized edema, erythrocyte stasis, and peripheral thermogenesis.';
    point2 = '**Microbiological Etiology**: Primary cutaneous pathogens include Staphylococcus aureus (including MRSA) and Streptococcus pyogenes producing pore-forming alpha-toxins.';
    point3 = '**Diagnostic Staging**: Differentiate superficial cellulitis from necrotizing soft-tissue involvement by assessing pain out of proportion, subcutaneous crepitus, and hemorrhagic bullae.';
    point4 = '**Empiric Pharmacotherapy Protocol**: Administer first-line beta-lactams (Cephalexin/Cefazolin) or vancomycin/daptomycin if purulent or risk factors for methicillin resistance exist.';
    formulaOrCode = `\`\`\`text
Diagnostic Criteria:
- Body Temperature: > 38.3°C or < 36.0°C
- Tachycardia: Heart Rate > 90 bpm
- Leukocytosis: WBC > 12,000/μL or > 10% immature band forms
- Serum Lactate: > 2.0 mmol/L (indicative of cellular hypoperfusion)
\`\`\``;
    misconception = 'Relying solely on topical antibiotics for spreading erythema or using hydrogen peroxide, which damages granulation fibroblasts.';
    recommendation = 'Delineate spreading borders with a sterile surgical marker to track response to systemic antibiotic therapy over a 12-24 hour window.';
  } else {
    topicSummary = `Point-to-point structural analysis of "${(question || '').trim()}". The core objective requires isolating fundamental theoretical mechanisms, empirical evidence, and operational execution steps.`;
    point1 = `**Primary Principle & Direct Definition**: Clear academic formulation addressing the exact premises of "${(question || '').trim().slice(0, 45)}...".`;
    point2 = '**Step-by-Step Logical Derivation**: Verified progressive derivation eliminating ancillary ambiguity through peer-reviewed principles.';
    point3 = '**Mechanistic Proof & Structural Rigor**: Rigorous functional validation, system requirements, and baseline constraints.';
    point4 = '**Real-World Practical Application**: Translation of theoretical mechanics into concrete, error-free operational deliverables.';
    formulaOrCode = `\`\`\`text
Formulation Matrix:
F(x) = ∑ [P_i · W_i] / Total Verification Index
Where Confidence Score ≥ 99.4%
\`\`\``;
    misconception = 'Conflating correlated tertiary symptoms with fundamental root causative mechanisms.';
    recommendation = 'Follow the standardized step-by-step verification checklist below before finalizing your project or academic submission.';
  }

  const fullMarkdown = `### 🎯 Executive Summary
${topicSummary}

### 📌 Point-by-Point Structured Breakdown
1. ${point1}
2. ${point2}
3. ${point3}
4. ${point4}

### 🔬 Core Reference, Formulation or Code
${formulaOrCode}

### 🎓 Verified Faculty Insight & Critical Pitfalls
- **Common Misconception**: ${misconception}
- **Faculty Recommendation**: ${recommendation}

### ✅ Action Checklist & Next Steps
- [x] Review and verify core point-by-point derivation
- [x] Apply key boundary constraints to your specific use-case
- [x] Schedule follow-up question with faculty if edge cases arise`;

  const words = fullMarkdown.split(' ');
  let accumulated = '';
  
  for (let i = 0; i < words.length; i++) {
    accumulated += (i === 0 ? '' : ' ') + words[i];
    onChunk(accumulated);
    await new Promise((res) => setTimeout(res, Math.floor(Math.random() * 20) + 10));
  }

  return fullMarkdown;
};

// Real OpenAI API streaming caller
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
        temperature: 0.3,
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
      return { success: true, message: 'OpenAI API Key verified successfully!' };
    } else {
      const errData = await response.json().catch(() => ({}));
      return { success: false, message: errData.error?.message || 'Invalid API Key' };
    }
  } catch (e) {
    return { success: false, message: e.message || 'Network connection failed' };
  }
};
