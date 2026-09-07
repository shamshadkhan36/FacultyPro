import React from 'react';
import { categories } from '../data/categories';
import { 
  Laptop, 
  Atom, 
  Stethoscope, 
  Scale, 
  Cpu, 
  TrendingUp, 
  FlaskConical, 
  BookOpen, 
  Sparkles,
  MoreHorizontal
} from 'lucide-react';

const categoryIconMap = {
  all: Sparkles,
  cs: Laptop,
  physics: Atom,
  medical: Stethoscope,
  law: Scale,
  engineering: Cpu,
  business: TrendingUp,
  chemistry: FlaskConical,
  humanities: BookOpen,
};

export const CategoryPills = ({ selectedCategory, onSelectCategory }) => {
  return (
    <div className="bg-white border-b border-slate-200/80 py-4 shadow-xs sticky top-16 sm:top-20 z-30">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center gap-2 sm:gap-3 overflow-x-auto pb-1 sm:pb-0 no-scrollbar scroll-smooth">
          {categories.map((cat) => {
            const Icon = categoryIconMap[cat.id] || Sparkles;
            const isSelected = selectedCategory === cat.id;

            return (
              <button
                key={cat.id}
                onClick={() => onSelectCategory(cat.id)}
                className={`flex items-center gap-2 px-4 py-2 rounded-full text-xs sm:text-sm font-semibold whitespace-nowrap transition-all duration-150 cursor-pointer border shrink-0 ${
                  isSelected
                    ? 'bg-[#0077c8] text-white border-[#0077c8] shadow-md shadow-blue-500/20 scale-105'
                    : 'bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-slate-900 border-slate-200/90'
                }`}
              >
                <Icon className={`w-4 h-4 ${isSelected ? 'text-white' : 'text-slate-500'}`} />
                <span>{cat.name}</span>
              </button>
            );
          })}

          <button
            onClick={() => onSelectCategory('all')}
            className="flex items-center gap-1.5 px-3.5 py-2 rounded-full text-xs sm:text-sm font-semibold whitespace-nowrap bg-slate-50 text-slate-700 hover:bg-slate-100 border border-slate-200 shrink-0 cursor-pointer"
          >
            <MoreHorizontal className="w-4 h-4 text-slate-500" />
            <span>More</span>
          </button>
        </div>
      </div>
    </div>
  );
};

export default CategoryPills;
