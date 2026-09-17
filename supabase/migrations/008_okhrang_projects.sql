-- 008_okhrang_projects.sql
-- Run AFTER 007_showreel_projects.sql. Safe to re-run: the renames are keyed on
-- the old title, the inserts are guarded on title, and the ordering is an
-- absolute assignment, so the result is the same however many times it is pasted.
-- Paste into Supabase Dashboard -> SQL Editor -> Run.
--
-- The Bodo Okhrang language platform now lives at okhrang.com and bodookhrang.com
-- is the company site, so the old entry becomes "Okhrang" and two entries join
-- it at the top: the company site and SchoolERP. Order: Bodo Okhrang Tech,
-- Okhrang, SchoolERP, FlopShop, then everything else shifts down. Banners are
-- each site's og.png, padded to the 16:10.5 card (assets/projects/14-16.webp).

-- 1 ---------------------------------------------------------------- /projects
update public.projects set
  title       = 'Okhrang',
  cat_label   = 'A.I. Tool — Language Platform',
  img         = 'assets/projects/15.webp',
  description = 'An <strong>AI language platform for Northeast India</strong> — translate, chat and look words up in <strong>Bodo, Assamese, Manipuri, Khasi, Nepali, Bengali, Hindi and English</strong>. OkhranGPT, the OkhranGTR translator, the OkhranGSB Bodo dictionary and OkhranGTA text to speech, in one place.',
  role        = 'Full-stack Developer',
  stack       = 'Next.js · Supabase · Gemini',
  year        = '2024 — live',
  url         = 'https://okhrang.com'
where title = 'Bodo Okhrang';

insert into public.projects (title, cat, cat_label, img, description, role, stack, year, action, url, video, image, sort, visible)
select
  'Bodo Okhrang Tech Pvt. Ltd.',
  'development',
  'Company — Web Development',
  'assets/projects/14.webp',
  'The company site for <strong>Bodo Okhrang Tech Pvt. Ltd.</strong> — a software company from Kokrajhar building <strong>language A.I., ERPs and apps for Northeast India</strong>. One home for Okhrang, SchoolERP, the Kokrajhar University LMS and the client work behind them.',
  'Founder & Developer',
  'Next.js · Tailwind',
  '2025 — live',
  'visit live site',
  'https://bodookhrang.com',
  null,
  null,
  0,
  true
where not exists (select 1 from public.projects where title = 'Bodo Okhrang Tech Pvt. Ltd.');

insert into public.projects (title, cat, cat_label, img, description, role, stack, year, action, url, video, image, sort, visible)
select
  'SchoolERP',
  'development',
  'Education — ERP · Web & App',
  'assets/projects/16.webp',
  '<strong>SchoolERP by Bodo Okhrang</strong> — a school’s own management system, branded and secured as theirs. <strong>24 modules</strong> across admissions, academics, attendance, examinations, fees, bus tracking and communication, on the web and in a companion app.',
  'Full-stack Developer',
  'Next.js · Expo · Supabase',
  '2026 — live',
  'visit live site',
  'https://schoolerp.okhrang.com',
  null,
  null,
  2,
  true
where not exists (select 1 from public.projects where title = 'SchoolERP');

update public.projects as p set sort = o.sort
from (values
  ('Bodo Okhrang Tech Pvt. Ltd.',         0),
  ('Okhrang',                             1),
  ('SchoolERP',                           2),
  ('FlopShop',                            3),
  ('CrewSpace AI',                        4),
  ('Kokrajhar University',                5),
  ('Swrzee Enterprise',                   6),
  ('Treasures',                           7),
  ('Highest in the Room',                 8),
  ('Jery Brahma — That’s What You Face',  9),
  ('Trip to Darjeeling',                 10),
  ('Andaman & Nicobar Islands',          11),
  ('Google Dev Group — 2025',            12),
  ('Open Mic RGU — 2025',                13),
  ('Badminton Tournament',               14),
  ('BODOअख्रां Pvt. Ltd. Logo',          15),
  ('My Tea',                             16)
) as o(title, sort)
where p.title = o.title and p.sort is distinct from o.sort;

-- 2 ------------------------------------------------------ featured (homepage)
update public.featured_projects set
  info      = 'A.I. Tool',
  name      = 'Okhrang',
  tag       = 'Web Development',
  url       = 'https://okhrang.com',
  hover_src = 'assets/projects/15.webp'
where name = 'Bodo Okhrang';

insert into public.featured_projects (info, name, tag, url, video, image, hover_src, sort, visible)
select 'Company', 'Bodo Okhrang Tech Pvt. Ltd.', 'Web Development', 'https://bodookhrang.com', null, null, 'assets/projects/14.webp', 0, true
where not exists (select 1 from public.featured_projects where name = 'Bodo Okhrang Tech Pvt. Ltd.');

insert into public.featured_projects (info, name, tag, url, video, image, hover_src, sort, visible)
select 'Education', 'SchoolERP by Bodo Okhrang', 'Web & App Development', 'https://schoolerp.okhrang.com', null, null, 'assets/projects/16.webp', 2, true
where not exists (select 1 from public.featured_projects where name = 'SchoolERP by Bodo Okhrang');

update public.featured_projects as f set sort = o.sort
from (values
  ('Bodo Okhrang Tech Pvt. Ltd.',         0),
  ('Okhrang',                             1),
  ('SchoolERP by Bodo Okhrang',           2),
  ('FlopShop',                            3),
  ('CrewSpace AI',                        4),
  ('Kokrajhar University',                5),
  ('Jery Brahma - That’s What You Face',  6),
  ('Trip to Darjeeling',                  7),
  ('Andaman & Nicobar Islands',           8),
  ('GOOGLE DEV GROUP - 2025',             9),
  ('Open Mic RGU - 2025',                10),
  ('Badminton Tournament',               11),
  ('BODOअख्रां Pvt. Ltd. Logo',          12),
  ('My Tea',                             13)
) as o(name, sort)
where f.name = o.name and f.sort is distinct from o.sort;
