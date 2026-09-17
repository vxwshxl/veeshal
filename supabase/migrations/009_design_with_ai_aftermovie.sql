-- 009_design_with_ai_aftermovie.sql
-- Run AFTER 008_okhrang_projects.sql. Safe to re-run: the inserts are guarded
-- on their R2 video URL and the ordering is an absolute assignment, so the
-- result is the same however many times it is pasted.
-- Paste into Supabase Dashboard -> SQL Editor -> Run.
--
-- The Design with A.I. GDG aftermovie joins /projects as entry 11 and the
-- homepage featured list right above Trip to Darjeeling. Andaman & Nicobar
-- Islands moves to the very end of both lists.

-- 1 ---------------------------------------------------------------- /projects
insert into public.projects (title, cat, cat_label, img, description, role, stack, year, action, url, video, image, sort, visible)
select
  'Design with A.I. — GDG Aftermovie',
  'video',
  'Event Aftermovie — Video Editing',
  'assets/projects/17.webp',
  'Official <strong>aftermovie for <em>Design with A.I.</em></strong> — the GDG on Campus session at Assam Royal Global University on <em>thinking like a designer and building with A.I.</em> <strong>Shot on the day and cut end to end</strong>: drone passes over campus, a packed seminar hall, Gemini and Stitch up on the big screen and quick-fire interviews with the people in the room, closed on the group photo.',
  'Shooter & Editor',
  'Final Cut Pro',
  '2026',
  'watch the film',
  null,
  'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/design-with-ai-aftermovie.mp4',
  null,
  10,
  true
where not exists (
  select 1 from public.projects
  where video = 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/design-with-ai-aftermovie.mp4'
);

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
  ('Design with A.I. — GDG Aftermovie',  10),
  ('Trip to Darjeeling',                 11),
  ('Google Dev Group — 2025',            12),
  ('Open Mic RGU — 2025',                13),
  ('Badminton Tournament',               14),
  ('BODOअख्रां Pvt. Ltd. Logo',          15),
  ('My Tea',                             16),
  ('Andaman & Nicobar Islands',          17)
) as o(title, sort)
where p.title = o.title and p.sort is distinct from o.sort;

-- 2 ------------------------------------------------------ featured (homepage)
insert into public.featured_projects (info, name, tag, url, video, image, hover_src, sort, visible)
select 'Event', 'Design with A.I. - GDG Aftermovie', 'Video Editing', null,
       'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/design-with-ai-aftermovie.mp4',
       null, 'assets/projects/17.webp', 7, true
where not exists (
  select 1 from public.featured_projects
  where video = 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/design-with-ai-aftermovie.mp4'
);

update public.featured_projects as f set sort = o.sort
from (values
  ('Bodo Okhrang Tech Pvt. Ltd.',         0),
  ('Okhrang',                             1),
  ('SchoolERP by Bodo Okhrang',           2),
  ('FlopShop',                            3),
  ('CrewSpace AI',                        4),
  ('Kokrajhar University',                5),
  ('Jery Brahma - That’s What You Face',  6),
  ('Design with A.I. - GDG Aftermovie',   7),
  ('Trip to Darjeeling',                  8),
  ('GOOGLE DEV GROUP - 2025',             9),
  ('Open Mic RGU - 2025',                10),
  ('Badminton Tournament',               11),
  ('BODOअख्रां Pvt. Ltd. Logo',          12),
  ('My Tea',                             13),
  ('Andaman & Nicobar Islands',          14)
) as o(name, sort)
where f.name = o.name and f.sort is distinct from o.sort;
