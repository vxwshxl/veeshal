-- 012_dreams_nbss.sql
-- Run AFTER 011_octavate_hackathon.sql. Safe to re-run: the inserts are guarded
-- on title/name and the ordering is an absolute assignment.
-- Paste into Supabase Dashboard -> SQL Editor -> Run.
--
-- Two client builds join the list right after SchoolERP: DREAMS Bodoland
-- (construction: website, CRM and client portal) and NBSS Kokrajhar (security
-- agency: website, operations portal and Android app). Their banners are the
-- sites' own 1200x630 share cards (assets/work/*-banner.webp). The platforms,
-- features and tech stack in each project's popup live in lib/work.ts.
-- Also: the Jery Brahma music video was cut in Final Cut Pro only.

-- 1 ---------------------------------------------------------------- /projects
insert into public.projects (title, cat, cat_label, img, description, role, stack, year, action, url, video, image, sort, visible)
select
  'DREAMS Bodoland',
  'development',
  'Construction — Website · CRM · Portal',
  'assets/work/dreams-banner.webp',
  'The website and operations system of <strong>DREAMS Bodoland Pvt. Ltd.</strong>, a construction and real-estate company in Kokrajhar. A <strong>scroll-driven marketing site</strong> up front; behind one Google sign-in, a <strong>construction CRM</strong> where staff run leads, estimates, sites, wages and bills, and a <strong>client portal</strong> where every client follows their own project from survey to handover.',
  'Full-stack Developer',
  'Next.js · Supabase · GSAP',
  '2026 — live',
  'visit live site',
  'https://dreamsbodoland.com',
  null,
  null,
  3,
  true
where not exists (select 1 from public.projects where title = 'DREAMS Bodoland');

insert into public.projects (title, cat, cat_label, img, description, role, stack, year, action, url, video, image, sort, visible)
select
  'NBSS Kokrajhar',
  'development',
  'Security Agency — Web & App',
  'assets/work/nbss-banner.webp',
  'The website, operations portal and <strong>Android app</strong> of <strong>National Bodo Security Service</strong>, a private security agency in Kokrajhar. Guards start duty and raise an <strong>SOS</strong> from the app, supervisors watch <strong>live posts on a map</strong>, clients see their own site, and recruitment runs on the web.',
  'Full-stack Developer',
  'Next.js · Expo · Supabase',
  '2026 — live',
  'visit live site',
  'https://nbsskokrajhar.com',
  null,
  null,
  4,
  true
where not exists (select 1 from public.projects where title = 'NBSS Kokrajhar');

update public.projects as p set sort = o.sort
from (values
  ('Bodo Okhrang Tech Pvt. Ltd.',         0),
  ('Okhrang',                             1),
  ('SchoolERP',                           2),
  ('DREAMS Bodoland',                     3),
  ('NBSS Kokrajhar',                      4),
  ('FlopShop',                            5),
  ('CrewSpace AI',                        6),
  ('Kokrajhar University',                7),
  ('Swrzee Enterprise',                   8),
  ('Treasures',                           9),
  ('Highest in the Room',                10),
  ('Jery Brahma — That’s What You Face', 11),
  ('Trip to Darjeeling',                 12),
  ('Design with A.I. — GDG Aftermovie',  13),
  ('Andaman & Nicobar Islands',          14),
  ('Google Dev Group — 2025',            15),
  ('Open Mic RGU — 2025',                16),
  ('Badminton Tournament',               17),
  ('BODOअख्रां Pvt. Ltd. Logo',          18),
  ('My Tea',                             19)
) as o(title, sort)
where p.title = o.title and p.sort is distinct from o.sort;

update public.projects set stack = 'Final Cut Pro'
where title = 'Jery Brahma — That’s What You Face';

-- 2 ------------------------------------------------------ featured (homepage)
insert into public.featured_projects (info, name, tag, url, video, image, hover_src, sort, visible)
select 'Construction', 'DREAMS Bodoland', 'Web Development & CRM', 'https://dreamsbodoland.com', null, null, 'assets/work/dreams-banner.webp', 3, true
where not exists (select 1 from public.featured_projects where name = 'DREAMS Bodoland');

insert into public.featured_projects (info, name, tag, url, video, image, hover_src, sort, visible)
select 'Security', 'NBSS Kokrajhar', 'Web & App Development', 'https://nbsskokrajhar.com', null, null, 'assets/work/nbss-banner.webp', 4, true
where not exists (select 1 from public.featured_projects where name = 'NBSS Kokrajhar');

update public.featured_projects as f set sort = o.sort
from (values
  ('Bodo Okhrang Tech Pvt. Ltd.',         0),
  ('Okhrang',                             1),
  ('SchoolERP by Bodo Okhrang',           2),
  ('DREAMS Bodoland',                     3),
  ('NBSS Kokrajhar',                      4),
  ('FlopShop',                            5),
  ('CrewSpace AI',                        6),
  ('Kokrajhar University',                7),
  ('Jery Brahma - That’s What You Face',  8),
  ('Design with A.I. - GDG Aftermovie',   9),
  ('Trip to Darjeeling',                 10),
  ('Andaman & Nicobar Islands',          11),
  ('GOOGLE DEV GROUP - 2025',            12),
  ('Open Mic RGU - 2025',                13),
  ('Badminton Tournament',               14),
  ('BODOअख्रां Pvt. Ltd. Logo',          15),
  ('My Tea',                             16)
) as o(name, sort)
where f.name = o.name and f.sort is distinct from o.sort;
