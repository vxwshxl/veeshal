-- 010_okhrang_details.sql
-- Run AFTER 009_design_with_ai_aftermovie.sql. Safe to re-run: both statements
-- are absolute assignments keyed on title.
-- Paste into Supabase Dashboard -> SQL Editor -> Run.
--
-- The company site dates from 2024, and Okhrang's toolkit lists Sarvam, not Gemini.

update public.projects set year = '2024 — live'
where title = 'Bodo Okhrang Tech Pvt. Ltd.';

update public.projects set stack = 'Next.js · Supabase · Sarvam'
where title = 'Okhrang';
