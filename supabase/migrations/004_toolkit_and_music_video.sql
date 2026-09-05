-- 004_toolkit_and_music_video.sql
-- Run AFTER 003_restore_data.sql. Safe to re-run (guarded inserts, idempotent updates).
-- Paste into Supabase Dashboard -> SQL Editor -> Run.
--
-- 1. Toolkit corrections: Bodo Okhrang and Kokrajhar University are React/PWA/Supabase now.
-- 2. New video project: Jery Brahma — That's What You Face (official music video).

-- 1 ---------------------------------------------------------------------------
update public.projects set stack = 'React · PWA · Supabase · AI' where title = 'Bodo Okhrang';
update public.projects set stack = 'React · PWA · Supabase'      where title = 'Kokrajhar University';

-- 2 ---------------------------------------------------------------------------
-- Slot it at the end of the video block, ahead of the design entries.
do $$
begin
  if not exists (select 1 from public.projects where url = 'https://www.youtube.com/watch?v=AQIcq3OWTNs') then
    update public.projects set sort = sort + 1 where sort >= 9;

    insert into public.projects (title, cat, cat_label, img, description, role, stack, year, action, url, video, image, sort)
    values (
      'Jery Brahma — That’s What You Face',
      'video',
      'Music Video — Video Editing',
      'assets/projects/13.webp',
      'The <strong>official MV</strong> for Jery Brahma’s <em>That’s What You Face</em> (ft. Loyal B) — <strong>edited & colour graded</strong> end to end, cut to the rhythm of the track with a grade that holds one mood from the first frame to the last.',
      'Editor & Colorist',
      'Final Cut Pro',
      '2026',
      'WATCH THE MV',
      'https://www.youtube.com/watch?v=AQIcq3OWTNs',
      null,
      null,
      9
    );
  end if;
end $$;

do $$
begin
  if not exists (select 1 from public.featured_projects where url = 'https://www.youtube.com/watch?v=AQIcq3OWTNs') then
    update public.featured_projects set sort = sort + 1 where sort >= 8;

    insert into public.featured_projects (info, name, tag, url, video, image, hover_src, sort)
    values (
      'Music Video',
      'Jery Brahma - That’s What You Face',
      'Video Editing',
      'https://www.youtube.com/watch?v=AQIcq3OWTNs',
      null,
      null,
      'assets/projects/13.webp',
      8
    );
  end if;
end $$;
