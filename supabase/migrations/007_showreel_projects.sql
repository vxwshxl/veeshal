-- 007_showreel_projects.sql
-- Run AFTER 006_toolkit_swap_and_stats.sql. Safe to re-run: the inserts are
-- guarded on their R2 video URL and the ordering is an absolute assignment,
-- so the result is the same however many times it is pasted.
-- Paste into Supabase Dashboard -> SQL Editor -> Run.
--
-- The two '26 showreel films join /projects as entries 06 and 07. Everything
-- from the music video down shifts one place, keeping the video block
-- contiguous and the design entries at the tail.

-- 1 ------------------------------------------------------------- new entries
insert into public.projects (title, cat, cat_label, img, description, role, stack, year, action, url, video, image, sort, visible)
select
  'Treasures',
  'video',
  'Showreel — Video Editing',
  'assets/treasures.webp',
  'A <strong>quiet cinematic short</strong> that runs on a single question — <em>how’s your little hobby going?</em> — cut for mood rather than pace, with a grade that lets the slow moments breathe. One of the two films opening the <strong>’26 showreel</strong>.',
  'Editor & Colorist',
  'Final Cut Pro',
  '2026',
  'watch the film',
  null,
  'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/treasures.mp4',
  null,
  5,
  true
where not exists (
  select 1 from public.projects
  where video = 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/treasures.mp4'
);

insert into public.projects (title, cat, cat_label, img, description, role, stack, year, action, url, video, image, sort, visible)
select
  'Hunt in the Rain',
  'video',
  'Showreel — Video Editing',
  'assets/hitr.webp',
  'A <strong>rain-soaked cinematic short</strong> — cut in wet light, with the tension carried by the edit and the grade rather than the dialogue. <strong>Edited and colour graded</strong> end to end, and the second film opening the <strong>’26 showreel</strong>.',
  'Editor & Colorist',
  'Final Cut Pro',
  '2026',
  'watch the film',
  null,
  'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/HITR.mp4',
  null,
  6,
  true
where not exists (
  select 1 from public.projects
  where video = 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/HITR.mp4'
);

-- 2 ---------------------------------------------------------------- ordering
update public.projects as p set sort = o.sort
from (values
  ('Bodo Okhrang',                        0),
  ('FlopShop',                            1),
  ('CrewSpace AI',                        2),
  ('Kokrajhar University',                3),
  ('Swrzee Enterprise',                   4),
  ('Treasures',                           5),
  ('Hunt in the Rain',                    6),
  ('Jery Brahma — That’s What You Face',  7),
  ('Trip to Darjeeling',                  8),
  ('Andaman & Nicobar Islands',           9),
  ('Google Dev Group — 2025',            10),
  ('Open Mic RGU — 2025',                11),
  ('Badminton Tournament',               12),
  ('BODOअख्रां Pvt. Ltd. Logo',          13),
  ('My Tea',                             14)
) as o(title, sort)
where p.title = o.title and p.sort is distinct from o.sort;
