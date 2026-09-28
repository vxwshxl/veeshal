-- 011_octavate_hackathon.sql
-- Run AFTER 010_okhrang_details.sql. Safe to re-run: both statements are
-- skipped once the OCTAVATE row exists.
-- Paste into Supabase Dashboard -> SQL Editor -> Run.
--
-- Adds the OCTAVATE hackathon (First Runner Up, 10-12 Aug 2026) to the top of
-- the timeline and pushes the existing events down one slot.

update public.timeline_events set sort = sort + 1
where not exists (
  select 1 from public.timeline_events where title = 'OCTAVATE Hackathon, NEST Cluster at IIT Guwahati'
);

insert into public.timeline_events (title, description, tag, date_label, images, sort, visible)
select
  'OCTAVATE Hackathon, NEST Cluster at IIT Guwahati',
  'Hackathon held during OCTAVATE, the NEST Cluster Tech Conclave organised by the North Eastern Science and Technology Cluster at Indian Institute of Technology Guwahati from 10th to 12th August, 2026.',
  'First Runner Up',
  '10-12 Aug 2026',
  '["https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/NEST%20-%200.webp", "https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/NEST%20-%201.webp", "https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/NEST%20-%202.webp"]'::jsonb,
  0,
  true
where not exists (
  select 1 from public.timeline_events where title = 'OCTAVATE Hackathon, NEST Cluster at IIT Guwahati'
);
