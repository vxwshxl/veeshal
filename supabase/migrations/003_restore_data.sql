-- 003_restore_data.sql
-- Data restored from db_cluster-28-08-2026@07-36-34.backup.gz
-- Run AFTER 001_init.sql (it creates the tables, RLS and the 'media' bucket).
-- This supersedes 002_seed.sql. Safe to re-run: tables are truncated first.
-- Paste the whole file into Supabase Dashboard -> SQL Editor -> Run.

truncate table public.blogs, public.chaicode_items, public.featured_projects, public.gallery, public.projects, public.site_settings, public.skills, public.social_links, public.timeline_events restart identity;

-- public.blogs: 23 rows
insert into public.blogs (id, title, slug, category, date_label, image, excerpt, content_html, is_static, sort, published) overriding system value values
  ('2', 'The Magic of this, call(), apply(), and bind() in JavaScript', 'the-magic-of-this-call-apply-bind-in-javascript', 'JavaScript', '15 Mar 2026', 'https://media2.dev.to/dynamic/image/width=1000,height=420,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2F2z8d8uo9p763mb5mc1rn.webp', null, null, 't', '1', 't'),
  ('3', 'Function Declaration vs Function Expression: What’s the Difference?', 'function-declaration-vs-function-expression', 'JavaScript', '15 Mar 2026', 'https://blog.thitainfo.com/_next/image?url=https%3A%2F%2Fcdn.hashnode.com%2Fuploads%2Fcovers%2F6185effafd5d634d0169926f%2Fc896a9b8-0227-4b9a-9323-6d48e02e2427.png&w=3840&q=75', null, null, 't', '2', 't'),
  ('4', 'JavaScript Arrays 101', 'javascript-arrays-101', 'JavaScript', '15 Mar 2026', 'https://media2.dev.to/dynamic/image/width=1280,height=720,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2Ftqo1rab6eznma8tzwzcl.webp', null, null, 't', '3', 't'),
  ('5', 'Understanding Object-Oriented Programming in JavaScript', 'understanding-oop-in-javascript', 'JavaScript', '15 Mar 2026', 'https://miro.medium.com/0*wgDCQoZtprrPg272.jpg', null, null, 't', '4', 't'),
  ('6', 'Understanding Objects in JavaScript', 'understanding-objects-in-javascript', 'JavaScript', '15 Mar 2026', 'https://blog.thitainfo.com/_next/image?url=https%3A%2F%2Fcdn.hashnode.com%2Fuploads%2Fcovers%2F6185effafd5d634d0169926f%2F5e436a36-838c-42ca-8340-8fb929ad9fc8.png&w=3840&q=75', null, null, 't', '5', 't'),
  ('7', 'Understanding Variables and Data Types in JavaScript', 'understanding-variables-and-data-types-in-javascript', 'JavaScript', '15 Mar 2026', 'https://miro.medium.com/v2/resize:fit:1400/format:webp/1*qvAJkRLtYnnVFTScPjgWPA.jpeg', null, null, 't', '6', 't'),
  ('8', 'Control Flow in JavaScript: If, Else, and Switch Explained', 'control-flow-in-javascript', 'JavaScript', '15 Mar 2026', 'https://miro.medium.com/v2/resize:fit:1400/format:webp/1*ej4NUhE3AOp0DVBJR3WA5w.png', null, null, 't', '7', 't'),
  ('9', 'Arrow Functions in JavaScript: A Simpler Way to Write Functions', 'arrow-functions-in-javascript', 'JavaScript', '15 Mar 2026', 'https://miro.medium.com/v2/resize:fit:1400/format:webp/0*-OKyZav_Yo-3ZIrb', null, null, 't', '8', 't'),
  ('10', 'Array Methods You Must Know', 'array-methods-you-must-know', 'JavaScript', '15 Mar 2026', 'https://miro.medium.com/v2/resize:fit:1400/1*-1JKUVOs2X9xkmIb-KmKKA.jpeg', null, null, 't', '9', 't'),
  ('11', 'Emmet for HTML: A Beginner’s Guide to Writing Faster Markup', 'emmet-for-html', 'HTML & CSS', '27 Jan 2026', 'https://www.alphr.com/wp-content/uploads/2023/10/emmet-nedir-ve-ne-ise-yarar-1280x720.jpg', null, null, 't', '10', 't'),
  ('12', 'CSS Selectors 101: Targeting Elements with Precision', 'css-selectors-101', 'HTML & CSS', '25 Jan 2026', 'https://media2.dev.to/dynamic/image/width=1000,height=420,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2Fnl1rxl108tb77t4ch3g3.png', null, null, 't', '11', 't'),
  ('13', 'Understanding HTML Tags and Elements', 'understanding-html-tags-and-elements', 'HTML & CSS', '24 Jan 2026', 'https://i.ytimg.com/vi/mekRKzHByEQ/maxresdefault.jpg', null, null, 't', '12', 't'),
  ('14', 'How a Browser Works: A Beginner-Friendly Guide', 'how-a-browser-works', 'HTML & CSS', '23 Jan 2026', 'https://ineasysteps.com/wp-content/uploads/2021/11/How-to-web-browsers-work-image.jpg', null, null, 't', '13', 't'),
  ('15', 'TCP Working: 3-Way Handshake & Reliable Communication', 'tcp-working', 'Software development', '22 Jan 2026', 'https://i.ytimg.com/vi/_inkLnDbia0/sddefault.jpg', null, null, 't', '14', 't'),
  ('16', 'TCP vs UDP: When to Use What', 'tcp-vs-udp', 'Software development', '21 Jan 2026', 'https://miro.medium.com/v2/resize:fit:1400/format:webp/1*ZPtAG6N2qQB_iIFzEtPP7Q.png', null, null, 't', '15', 't'),
  ('17', 'Understanding Network Devices', 'understanding-network-devices', 'Software development', '20 Jan 2026', 'https://media2.dev.to/dynamic/image/width=1280,height=720,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2F9uj3ypmyimbvite0dgu2.jpeg', null, null, 't', '16', 't'),
  ('18', 'How DNS Resolution Works', 'how-dns-resolution-works', 'Software development', '19 Jan 2026', 'https://media.geeksforgeeks.org/wp-content/uploads/20250801171021517035/address_resolution_in_dns.webp', null, null, 't', '17', 't'),
  ('19', 'Getting Started with cURL', 'getting-started-with-curl', 'Software development', '18 Jan 2026', 'https://curl.se/logo/curl-logo.svg', null, null, 't', '18', 't'),
  ('20', 'DNS Record Types Explained', 'dns-record-types-explained', 'Software development', '17 Jan 2026', 'https://www.cloudflare.com/img/learning/dns/what-is-dns/dns-lookup-diagram.png', null, null, 't', '19', 't'),
  ('21', 'Why Version Control Exists: The Pendrive Problem', 'why-version-control-exists', 'Software development', '16 Jan 2026', 'https://media2.dev.to/dynamic/image/width=1280,height=720,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2Fmjsud8ijzeytlosc6w49.png', null, null, 't', '20', 't'),
  ('22', 'Inside Git: How It Works and the Role of the .git Folder', 'inside-git-how-it-works', 'Software development', '16 Jan 2026', 'https://camo.githubusercontent.com/79c5248e3ba42801c55213b83f56bc8e0d39ebf6834498e56e9733f0fa87ccf4/68747470733a2f2f6d69726f2e6d656469756d2e636f6d2f76322f726573697a653a6669743a313430302f312a36536278616a4d6468536639365073507972545a47672e706e67', null, null, 't', '21', 't'),
  ('23', 'Git for Beginners: Basics and Essential Commands', 'git-for-beginners', 'Software development', '13 Jan 2026', 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/blogs/git-for-beginners/working-dir.png', null, null, 't', '22', 't'),
  ('1', 'JavaScript Operators: The Basics You Need to Know', 'javascript-operators-basics', 'JavaScript', '15 Mar 2026', 'https://media2.dev.to/dynamic/image/width=1000,height=420,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2Fgd13jf7crx0nffnb0szj.jpg', null, null, 't', '0', 't');

-- public.chaicode_items: 3 rows
insert into public.chaicode_items (id, title, category, date_label, image, link, sort, visible) overriding system value values
  ('3', 'HTML Resume Page Assignment', 'Web Development', '30 Jan 2026', 'https://veeshal.me/assets/vee-img.webp', 'resume.html', '2', 't'),
  ('1', 'Mintlify - The Intelligent Documentation Platform', 'Web Development', '06 Feb 2026', 'https://raw.githubusercontent.com/vxwshxl/veeshal/refs/heads/main/public/chaicode/mintlify/assets/mintlify.webp', 'mintlify', '0', 't'),
  ('2', 'Cursor', 'Web Development', '04 Feb 2026', 'https://raw.githubusercontent.com/vxwshxl/veeshal/refs/heads/main/public/chaicode/cursor/assets/cursor.webp', 'cursor', '1', 't');

-- public.featured_projects: 11 rows
insert into public.featured_projects (id, info, name, tag, url, video, image, hover_src, sort, visible) overriding system value values
  ('2', 'E-COMMERCE Tool', 'FlopShop', 'Web Development/PWA', 'https://flopshop.vercel.app', null, null, 'assets/projects/12.webp', '1', 't'),
  ('3', 'A.I. Tool', 'CrewSpace AI', 'Extension', 'https://crewspace-ai.vercel.app', null, null, 'assets/projects/11.webp', '2', 't'),
  ('4', 'Education', 'Kokrajhar University', 'Web & App Development', 'https://ku-app.in', null, null, 'assets/projects/2.webp', '3', 't'),
  ('5', 'Travel', 'Trip to Darjeeling', 'Video Editing', 'https://www.youtube.com/watch?v=gNVz83QSoY4', null, null, 'assets/projects/4.webp', '4', 't'),
  ('6', 'Travel', 'Andaman & Nicobar Islands', 'Video Editing', 'https://www.youtube.com/watch?v=gBvocwLObFQ', null, null, 'assets/projects/5.webp', '5', 't'),
  ('7', 'Event', 'GOOGLE DEV GROUP - 2025', 'Video Editing', null, 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/GDG.mp4', null, 'assets/projects/6.webp', '6', 't'),
  ('8', 'Event', 'Open Mic RGU - 2025', 'Video Editing', null, 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/open-mic.mp4', null, 'assets/projects/7.webp', '7', 't'),
  ('9', 'Event', 'Badminton Tournament', 'Banner Editing', null, null, 'assets/projects/8.webp', 'assets/projects/8.webp', '8', 't'),
  ('10', 'Tool', 'BODOअख्रां Pvt. Ltd. Logo', 'Logo Design', null, null, 'assets/projects/9.webp', 'assets/projects/9.webp', '9', 't'),
  ('11', 'Local Shop', 'My Tea', 'Banner Editing', null, null, 'assets/projects/10.webp', 'assets/projects/10.webp', '10', 't'),
  ('1', 'A.I. Tool', 'Bodo Okhrang', 'Web Development', 'https://bodookhrang.com', null, null, 'assets/projects/1.webp', '0', 't');

-- public.gallery: 6 rows
insert into public.gallery (id, image_url, alt, sort, visible) overriding system value values
  ('1', 'assets/portfolio/1.webp', 'Portfolio 1', '0', 't'),
  ('2', 'assets/portfolio/2.webp', 'Portfolio 2', '1', 't'),
  ('3', 'assets/portfolio/3.webp', 'Portfolio 3', '2', 't'),
  ('4', 'assets/portfolio/4.webp', 'Portfolio 4', '3', 't'),
  ('5', 'assets/portfolio/5.webp', 'Portfolio 5', '4', 't'),
  ('6', 'assets/portfolio/6.webp', 'Portfolio 6', '5', 't');

-- public.projects: 12 rows
insert into public.projects (id, title, cat, cat_label, img, description, role, stack, year, action, url, video, image, sort, visible) overriding system value values
  ('1', 'Bodo Okhrang', 'development', 'A.I. Tool — Web Development', 'assets/projects/1.webp', 'An <strong>AI-powered Anglo-Bodo dictionary</strong> and language platform built for the Bodo community. Instant word lookup, smart suggestions and a clean reading experience — now serving <strong>50,000+ visitors every month</strong> and growing.', 'Full-stack Developer', 'PHP · MySQL · JS · AI', '2024 — live', 'visit live site', 'https://bodookhrang.com', null, null, '0', 't'),
  ('2', 'FlopShop', 'development', 'E-commerce — PWA', 'assets/projects/12.webp', 'A modern <strong>e-commerce progressive web app</strong> — installable, offline-friendly and fast on any device. Snappy product browsing, cart flow and a checkout experience that feels native.', 'Designer & Developer', 'React · PWA · Vercel', '2025 — live', 'visit live site', 'https://flopshop.vercel.app', null, null, '1', 't'),
  ('3', 'CrewSpace AI', 'development', 'A.I. Tool — Browser Extension', 'assets/projects/11.webp', 'A <strong>browser extension</strong> that brings AI assistance straight into your workspace — summarise, draft and organise without ever leaving the tab you are working in.', 'Creator & Developer', 'JS · Extension APIs · AI', '2025 — live', 'visit live site', 'https://crewspace-ai.vercel.app', null, null, '2', 't'),
  ('4', 'Kokrajhar University', 'development', 'Education — Web & App', 'assets/projects/2.webp', 'The digital front door for <strong>Kokrajhar University</strong> — a website and companion app giving students notices, resources and campus information in one organised, mobile-first place.', 'Web & App Developer', 'PHP · MySQL · React Native', '2024 — live', 'visit live site', 'https://ku-app.in', null, null, '3', 't'),
  ('5', 'Swrzee Enterprise', 'development', 'Enterprise — Web Development', 'assets/projects/3.webp', 'A clean, credible <strong>business website</strong> for Swrzee Enterprise — product showcase, company story and contact flows designed to convert visitors into customers.', 'Designer & Developer', 'PHP · CSS · JS', '2024 — live', 'visit live site', 'https://swrzee.in', null, null, '4', 't'),
  ('6', 'Trip to Darjeeling', 'video', 'Travel Film — Video Editing', 'assets/projects/4.webp', 'A <strong>cinematic travel film</strong> through the hills of Darjeeling — tea gardens, toy trains and misty ridgelines, cut to rhythm with colour grading that keeps the mountain mood intact.', 'Editor & Colorist', 'Premiere · DaVinci', '2024', 'watch the film', 'https://www.youtube.com/watch?v=gNVz83QSoY4', null, null, '5', 't'),
  ('7', 'Andaman & Nicobar Islands', 'video', 'Travel Film — Video Editing', 'assets/projects/5.webp', 'Island hopping, turquoise water and slow sunsets — a <strong>travel edit</strong> built around pacing: fast cuts on the boats, long breaths on the beaches.', 'Editor & Colorist', 'Premiere · DaVinci', '2024', 'watch the film', 'https://www.youtube.com/watch?v=gBvocwLObFQ', null, null, '6', 't'),
  ('8', 'Google Dev Group — 2025', 'video', 'Event — Video Editing', 'assets/projects/6.webp', 'Official <strong>aftermovie for the Google Developer Group 2025</strong> event — talks, crowd energy and behind-the-scenes moments compressed into a tight, high-energy recap.', 'Editor', 'Premiere · CapCut', '2025', 'watch the film', null, 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/GDG.mp4', null, '7', 't'),
  ('9', 'Open Mic RGU — 2025', 'video', 'Event — Video Editing', 'assets/projects/7.webp', 'An <strong>event recap</strong> of Open Mic at RGU — raw performances, audience reactions and stage lights, edited to keep the live-room feeling on screen.', 'Editor', 'Premiere · CapCut', '2025', 'watch the film', null, 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/open-mic.mp4', null, '8', 't'),
  ('10', 'Badminton Tournament', 'design', 'Event — Banner Design', 'assets/projects/8.webp', 'A bold <strong>tournament banner</strong> — strong type hierarchy, action photography and a layout that reads clearly from across a hall or in a feed.', 'Designer', 'Figma · Canva', '2024', 'view the design', null, null, 'assets/projects/8.webp', '9', 't'),
  ('11', 'BODOअख्रां Pvt. Ltd. Logo', 'design', 'Brand — Logo Design', 'assets/projects/9.webp', 'Identity work for <strong>BODOअख्रां Pvt. Ltd.</strong> — a mark that blends Devanagari character with a modern wordmark, built to hold up from favicon to billboard.', 'Brand Designer', 'Figma · Krita', '2024', 'view the design', null, null, 'assets/projects/9.webp', '10', 't'),
  ('12', 'My Tea', 'design', 'Local Shop — Banner Design', 'assets/projects/10.webp', 'A warm, appetising <strong>storefront banner</strong> for a local tea shop — friendly type, rich colour and a layout that makes you want a cup immediately.', 'Designer', 'Canva · Krita', '2024', 'view the design', null, null, 'assets/projects/10.webp', '11', 't');

-- public.site_settings: 4 rows
insert into public.site_settings (key, value, updated_at) values
  ('resume_url', '"RESUME - VEESHAL.pdf"', '2026-06-12 02:32:32.819306+00'),
  ('hero', '{"copy": "Welcome to a visual journey that blends code & creativity, where every edit tells a story. Engineered with precision & crafted with passion.", "eyebrow": "creative developer — video editor", "title_1": "code", "title_2": "cinema"}', '2026-06-12 02:32:33.35979+00'),
  ('stats', '[{"link": "projects", "label": "Developed Live", "value": 5, "suffix": "", "link_text": "Coding Projects"}, {"link": "projects", "label": "Edited High-Quality", "value": 15, "suffix": "", "link_text": "Video Projects"}, {"link": "https://bodookhrang.com", "label": "Monthly Visitors for", "value": 50, "suffix": "k", "link_text": "Bodo Okhrang"}]', '2026-06-12 02:32:33.53954+00'),
  ('contact_email', '"work@veeshal.me"', '2026-06-12 03:05:42.52993+00');

-- public.skills: 14 rows
insert into public.skills (id, name, icon_url, sort, visible) overriding system value values
  ('1', 'React Native', 'assets/skills/react-native.png', '0', 't'),
  ('2', 'Flutter', 'assets/skills/flutter.png', '1', 't'),
  ('3', 'Tailwind CSS', 'assets/skills/tailwind.png', '2', 't'),
  ('4', 'Expo', 'assets/skills/expo.png', '3', 't'),
  ('5', 'PHP', 'assets/skills/php.png', '4', 't'),
  ('6', 'MySQL', 'assets/skills/mysql.png', '5', 't'),
  ('7', 'PostgreSQL', 'assets/skills/postgreSQL.png', '6', 't'),
  ('8', 'Adobe Premiere', 'assets/skills/premiere.png', '7', 't'),
  ('9', 'DaVinci Resolve', 'assets/skills/davinci.png', '8', 't'),
  ('10', 'CapCut', 'assets/skills/capcut.png', '9', 't'),
  ('11', 'Figma', 'assets/skills/figma.png', '10', 't'),
  ('12', 'Krita', 'assets/skills/krita.png', '11', 't'),
  ('13', 'Canva', 'assets/skills/canva.png', '12', 't'),
  ('14', 'Jitter', 'assets/skills/jitter.png', '13', 't');

-- public.social_links: 6 rows
insert into public.social_links (id, label, url, sort, visible) overriding system value values
  ('1', 'yt', 'https://www.youtube.com/@vxwshxl', '0', 't'),
  ('2', 'ig', 'https://www.instagram.com/vxwshxl', '1', 't'),
  ('3', 'git', 'https://github.com/vxwshxl', '2', 't'),
  ('4', 'in', 'https://www.linkedin.com/in/vxwshxl', '3', 't'),
  ('5', 'x', 'https://x.com/vxwshxl', '4', 't'),
  ('6', 'fb', 'https://www.facebook.com/vxwshxl', '5', 't');

-- public.timeline_events: 4 rows
insert into public.timeline_events (id, title, description, tag, date_label, images, sort, visible) overriding system value values
  ('1', 'AI & Innovation at NEGC 2026, USTM', 'AI & Innovation... Awarded competition conducted during North East Graduate Congress-2026 held at University of Science & Technology Meghalaya from 26th–28th March, 2026.', 'Winner', '26-28 Mar 2026', '["https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/AI%20%26%20Inno%202026%20-%201st.webp", "https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/AI%20%26%20Inno%20-%201.webp", "https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/AI%20%26%20Inno%20-%202.webp"]', '0', 't'),
  ('2', 'Prajukti 2026 GCU Hackathon', 'Prajukti 2026 GCU Hackathon held during GCU Varsity Week: EUPHUISM 2026 (Roots and Resilience) from 11th to 14th March, 2026.', 'Winner', '11-14 Mar 2026', '["https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/Prajukti%202026%20-%201st.webp", "https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/Prajukti%20-%201.webp", "https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/Prajukti%20-%202.webp"]', '1', 't'),
  ('3', 'Codestellation, under CodeWar 7.0 at AEC', 'This Hackathon was held by Assam Engineering College (AEC) under CodeWar 7.0 part of Pyrokinesis 2026 organised by Coding Club, AEC named as Codestellation on 26 Feb 2026.', 'First Runner Up', '26 Feb 2026', '["https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/CodeWar%202026%20-%202nd.webp", "https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/CodeWar%20-%201.webp", "https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/CodeWar%20-%202.webp"]', '2', 't'),
  ('4', 'Ideathon — Where Ideas Compile', 'First place at the Ideathon competition — a stage where raw ideas meet real execution. Pitched a solution that stood out from the crowd and brought home the win. The beginning of the grind.', 'Winner', '27 NOV 2024', '["https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/achievement/Idea%20Comp%202024%20-%201st.webp"]', '3', 't');

-- Reset identity sequences so the next insert does not collide
SELECT pg_catalog.setval('public.blogs_id_seq', 23, true);
SELECT pg_catalog.setval('public.chaicode_items_id_seq', 3, true);
SELECT pg_catalog.setval('public.featured_projects_id_seq', 11, true);
SELECT pg_catalog.setval('public.gallery_id_seq', 6, true);
SELECT pg_catalog.setval('public.projects_id_seq', 12, true);
SELECT pg_catalog.setval('public.skills_id_seq', 14, true);
SELECT pg_catalog.setval('public.social_links_id_seq', 6, true);
SELECT pg_catalog.setval('public.timeline_events_id_seq', 4, true);
