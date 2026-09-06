-- 006_toolkit_swap_and_stats.sql
-- Run AFTER 005_project_order.sql. Safe to re-run: every statement is either an
-- absolute assignment or guarded, so the result is the same however many times
-- it is pasted.
-- Paste into Supabase Dashboard -> SQL Editor -> Run.
--
-- 1. The Bodo Okhrang visitor stat drops from +50k to +5k.
-- 2. The about-section logo marquee swaps Adobe Premiere and DaVinci Resolve
--    out for Final Cut Pro and Supabase. Supabase joins the data block right
--    after PostgreSQL; Final Cut Pro heads the video-editing block.

-- ---------------------------------------------------------------- stats
update public.site_settings
set value = '[{"link": "projects", "label": "Developed Live", "value": 5, "suffix": "", "link_text": "Coding Projects"}, {"link": "projects", "label": "Edited High-Quality", "value": 15, "suffix": "", "link_text": "Video Projects"}, {"link": "https://bodookhrang.com", "label": "Monthly Visitors for", "value": 5, "suffix": "k", "link_text": "Bodo Okhrang"}]'::jsonb,
    updated_at = now()
where key = 'stats';

-- ---------------------------------------------------------------- skills
delete from public.skills where name in ('Adobe Premiere', 'DaVinci Resolve');

insert into public.skills (name, icon_url, sort, visible)
select 'Supabase', 'assets/skills/supabase.png', 7, true
where not exists (select 1 from public.skills where name = 'Supabase');

insert into public.skills (name, icon_url, sort, visible)
select 'Final Cut Pro', 'assets/skills/final-cut-pro.png', 8, true
where not exists (select 1 from public.skills where name = 'Final Cut Pro');

update public.skills as s set icon_url = o.icon_url, sort = o.sort
from (values
  ('React Native',   'assets/skills/react-native.png',   0),
  ('Flutter',        'assets/skills/flutter.png',        1),
  ('Tailwind CSS',   'assets/skills/tailwind.png',       2),
  ('Expo',           'assets/skills/expo.png',           3),
  ('PHP',            'assets/skills/php.png',            4),
  ('MySQL',          'assets/skills/mysql.png',          5),
  ('PostgreSQL',     'assets/skills/postgreSQL.png',     6),
  ('Supabase',       'assets/skills/supabase.png',       7),
  ('Final Cut Pro',  'assets/skills/final-cut-pro.png',  8),
  ('CapCut',         'assets/skills/capcut.png',         9),
  ('Figma',          'assets/skills/figma.png',         10),
  ('Krita',          'assets/skills/krita.png',         11),
  ('Canva',          'assets/skills/canva.png',         12),
  ('Jitter',         'assets/skills/jitter.png',        13)
) as o(name, icon_url, sort)
where s.name = o.name
  and (s.icon_url is distinct from o.icon_url or s.sort is distinct from o.sort);
