# Shanti Nagar Foundation — Agent Operational Guidelines & Rules

## MANDATORY RULES (Must Follow on Every Prompt)
1. **Strict Context Adherence:** Always read, respect, and align with the project documentation:
   - [`docs/project_overview.md`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/docs/project_overview.md) (Client Requirements)
   - [`docs/database_design.md`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/docs/database_design.md) (ERD & Database Schema)
   - [`docs/architecture.md`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/docs/architecture.md) (System Flow & MVC Layout)
   - [`docs/project_context.md`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/docs/project_context.md) (Business Rules, Branding & NGO Context)
   - [`docs/tasks.md`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/docs/tasks.md) (Task List & Progress Tracking)
   - [`.agents/skills/laravel-best-practices/SKILL.md`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/.agents/skills/laravel-best-practices/SKILL.md) (Code Quality & Security)

2. **Immediate Documentation Synchronization:**
   - If any database table, column, model relation, or architectural flow changes, **IMMEDIATELY update** `docs/database_design.md`, `docs/architecture.md`, `docs/tasks.md`, and relevant seeders without exception.

3. **Domain & Localization Standards:**
   - The project is strictly for **"Shanti Nagar Foundation / Santi Nagar Association"** (Grassroots Bangladeshi NGO).
   - Use currency symbol `৳` (BDT), Bangladeshi contact points (Shanti Nagar, Dhaka), and authentic humanitarian project topics (hospital aid, orphan kits, winter relief, safe tube-wells).
   - Never insert generic foreign placeholder content or unrelated commercial retail/marathon templates.

4. **Code Quality & Best Practices:**
   - Keep controllers thin and models strictly casted.
   - Use idempotent seeders (`updateOrCreate` / `firstOrCreate`).
   - Maintain mobile responsiveness and prevent template design breaks.

