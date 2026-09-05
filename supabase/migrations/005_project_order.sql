-- 005_project_order.sql
-- Run AFTER 004_toolkit_and_music_video.sql. Safe to re-run: it assigns absolute
-- sort values, so the result is the same however many times you paste it.
-- Paste into Supabase Dashboard -> SQL Editor -> Run.
--
-- The music video leads the video block (position 06 on /projects); the travel
-- films and event recaps follow at 07/08/09/10. Design entries keep 11/12/13.

update public.projects as p set sort = o.sort
from (values
  ('Bodo Okhrang',                        0),
  ('FlopShop',                            1),
  ('CrewSpace AI',                        2),
  ('Kokrajhar University',                3),
  ('Swrzee Enterprise',                   4),
  ('Jery Brahma — That’s What You Face',  5),
  ('Trip to Darjeeling',                  6),
  ('Andaman & Nicobar Islands',           7),
  ('Google Dev Group — 2025',             8),
  ('Open Mic RGU — 2025',                 9),
  ('Badminton Tournament',               10),
  ('BODOअख्रां Pvt. Ltd. Logo',          11),
  ('My Tea',                             12)
) as o(title, sort)
where p.title = o.title and p.sort is distinct from o.sort;

update public.featured_projects as f set sort = o.sort
from (values
  ('Bodo Okhrang',                        0),
  ('FlopShop',                            1),
  ('CrewSpace AI',                        2),
  ('Kokrajhar University',                3),
  ('Jery Brahma - That’s What You Face',  4),
  ('Trip to Darjeeling',                  5),
  ('Andaman & Nicobar Islands',           6),
  ('GOOGLE DEV GROUP - 2025',             7),
  ('Open Mic RGU - 2025',                 8),
  ('Badminton Tournament',                9),
  ('BODOअख्रां Pvt. Ltd. Logo',          10),
  ('My Tea',                             11)
) as o(name, sort)
where f.name = o.name and f.sort is distinct from o.sort;
