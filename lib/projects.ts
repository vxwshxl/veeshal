import { sbAsset, sbFetch } from '@/lib/supabase';
import { toolsFromStack, WORK, workKey, type StackGroup } from '@/lib/work';

/**
 * The two project lists, read from Supabase with hardcoded fallbacks, and the
 * card + popup model both pages render (`WorkItem`).
 *
 * `featured_projects` is the home page's short list; `projects` holds the full
 * write-up for every entry. A featured row borrows its write-up from the
 * `projects` row with the same link (`workKey`).
 */

export type FeaturedRow = {
  info: string; name: string; tag: string;
  url?: string | null; video?: string | null; image?: string | null; hover_src: string;
};

export type ProjectRow = {
  title: string; cat: string; cat_label: string; img: string; desc: string;
  role: string; stack: string; year: string; action: string;
  url?: string | null; video?: string | null; image?: string | null;
};

export const PROJECTS_FALLBACK: ProjectRow[] = [
  { title: 'Bodo Okhrang Tech Pvt. Ltd.', cat: 'development', cat_label: 'Company — Web Development', img: '/assets/projects/14.webp', desc: 'The company site for <strong>Bodo Okhrang Tech Pvt. Ltd.</strong> — a software company from Kokrajhar building <strong>language A.I., ERPs and apps for Northeast India</strong>. One home for Okhrang, SchoolERP, the Kokrajhar University LMS and the client work behind them.', role: 'Founder & Developer', stack: 'Next.js · Tailwind', year: '2024 — live', action: 'visit live site', url: 'https://bodookhrang.com' },
  { title: 'Okhrang', cat: 'development', cat_label: 'A.I. Tool — Language Platform', img: '/assets/projects/15.webp', desc: 'An <strong>AI language platform for Northeast India</strong> — translate, chat and look words up in <strong>Bodo, Assamese, Manipuri, Khasi, Nepali, Bengali, Hindi and English</strong>. OkhranGPT, the OkhranGTR translator, the OkhranGSB Bodo dictionary and OkhranGTA text to speech, in one place.', role: 'Full-stack Developer', stack: 'Next.js · Supabase · Sarvam', year: '2024 — live', action: 'visit live site', url: 'https://okhrang.com' },
  { title: 'SchoolERP', cat: 'development', cat_label: 'Education — ERP · Web & App', img: '/assets/projects/16.webp', desc: '<strong>SchoolERP by Bodo Okhrang</strong> — a school’s own management system, branded and secured as theirs. <strong>24 modules</strong> across admissions, academics, attendance, examinations, fees, bus tracking and communication, on the web and in a companion app.', role: 'Full-stack Developer', stack: 'Next.js · Expo · Supabase', year: '2026 — live', action: 'visit live site', url: 'https://schoolerp.okhrang.com' },
  { title: 'DREAMS Bodoland', cat: 'development', cat_label: 'Construction — Website · CRM · Portal', img: 'assets/work/dreams-banner.webp', desc: 'The website and operations system of <strong>DREAMS Bodoland Pvt. Ltd.</strong>, a construction and real-estate company in Kokrajhar. A <strong>scroll-driven marketing site</strong> up front; behind one Google sign-in, a <strong>construction CRM</strong> where staff run leads, estimates, sites, wages and bills, and a <strong>client portal</strong> where every client follows their own project from survey to handover.', role: 'Full-stack Developer', stack: 'Next.js · Supabase · GSAP', year: '2026 — live', action: 'visit live site', url: 'https://dreamsbodoland.com' },
  { title: 'NBSS Kokrajhar', cat: 'development', cat_label: 'Security Agency — Web & App', img: 'assets/work/nbss-banner.webp', desc: 'The website, operations portal and <strong>Android app</strong> of <strong>National Bodo Security Service</strong>, a private security agency in Kokrajhar. Guards start duty and raise an <strong>SOS</strong> from the app, supervisors watch <strong>live posts on a map</strong>, clients see their own site, and recruitment runs on the web.', role: 'Full-stack Developer', stack: 'Next.js · Expo · Supabase', year: '2026 — live', action: 'visit live site', url: 'https://nbsskokrajhar.com' },
  { title: 'FlopShop', cat: 'development', cat_label: 'E-commerce — PWA', img: '/assets/projects/12.webp', desc: 'A modern <strong>e-commerce progressive web app</strong> — installable, offline-friendly and fast on any device. Snappy product browsing, cart flow and a checkout experience that feels native.', role: 'Designer & Developer', stack: 'React · PWA · Vercel', year: '2025 — live', action: 'visit live site', url: 'https://flopshop.vercel.app' },
  { title: 'CrewSpace AI', cat: 'development', cat_label: 'A.I. Tool — Browser Extension', img: '/assets/projects/11.webp', desc: 'A <strong>browser extension</strong> that brings AI assistance straight into your workspace — summarise, draft and organise without ever leaving the tab you are working in.', role: 'Creator & Developer', stack: 'JS · Extension APIs · AI', year: '2025 — live', action: 'visit live site', url: 'https://crewspace-ai.vercel.app' },
  { title: 'Kokrajhar University', cat: 'development', cat_label: 'Education — Web & App', img: '/assets/projects/2.webp', desc: 'The digital front door for <strong>Kokrajhar University</strong> — a website and companion app giving students notices, resources and campus information in one organised, mobile-first place.', role: 'Web & App Developer', stack: 'React · PWA · Supabase', year: '2024 — live', action: 'visit live site', url: 'https://ku-app.in' },
  { title: 'Swrzee Enterprise', cat: 'development', cat_label: 'Enterprise — Web Development', img: '/assets/projects/3.webp', desc: 'A clean, credible <strong>business website</strong> for Swrzee Enterprise — product showcase, company story and contact flows designed to convert visitors into customers.', role: 'Designer & Developer', stack: 'PHP · CSS · JS', year: '2024 — live', action: 'visit live site', url: 'https://swrzee.in' },
  { title: 'Treasures', cat: 'video', cat_label: 'Showreel — Video Editing', img: '/assets/treasures.webp', desc: 'A <strong>quiet cinematic short</strong> that runs on a single question — <em>how’s your little hobby going?</em> — cut for mood rather than pace, with a grade that lets the slow moments breathe. One of the two films opening the <strong>’26 showreel</strong>.', role: 'Editor & Colorist', stack: 'Final Cut Pro', year: '2026', action: 'watch the film', video: 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/treasures.mp4' },
  { title: 'Highest in the Room', cat: 'video', cat_label: 'Showreel — Video Editing', img: '/assets/hitr.webp', desc: 'A <strong>cinematic short cut to the track it is named for</strong> — pacing locked to the beat, <strong>edited and colour graded</strong> end to end so one tone carries from the first frame to the last. The second film opening the <strong>’26 showreel</strong>.', role: 'Editor & Colorist', stack: 'Final Cut Pro', year: '2026', action: 'watch the film', video: 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/HITR.mp4' },
  { title: 'Jery Brahma — That’s What You Face', cat: 'video', cat_label: 'Music Video — Video Editing', img: '/assets/projects/13.webp', desc: 'The <strong>official music video</strong> for Jery Brahma’s <em>That’s What You Face</em> (ft. Loyal B) — <strong>edited and colour graded</strong> end to end, cut to the rhythm of the track with a grade that holds one mood from the first frame to the last.', role: 'Editor & Colorist', stack: 'Final Cut Pro', year: '2026', action: 'watch the video', url: 'https://www.youtube.com/watch?v=AQIcq3OWTNs' },
  { title: 'Design with A.I. — GDG Aftermovie', cat: 'video', cat_label: 'Event Aftermovie — Video Editing', img: '/assets/projects/17.webp', desc: 'Official <strong>aftermovie for <em>Design with A.I.</em></strong> — the GDG on Campus session at Assam Royal Global University on <em>thinking like a designer and building with A.I.</em> <strong>Shot on the day and cut end to end</strong>: drone passes over campus, a packed seminar hall, Gemini and Stitch up on the big screen and quick-fire interviews with the people in the room, closed on the group photo.', role: 'Shooter & Editor', stack: 'Final Cut Pro', year: '2026', action: 'watch the film', video: 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/design-with-ai-aftermovie.mp4' },
  { title: 'Trip to Darjeeling', cat: 'video', cat_label: 'Travel Film — Video Editing', img: '/assets/projects/4.webp', desc: 'A <strong>cinematic travel film</strong> through the hills of Darjeeling — tea gardens, toy trains and misty ridgelines, cut to rhythm with colour grading that keeps the mountain mood intact.', role: 'Editor & Colorist', stack: 'Premiere · DaVinci', year: '2024', action: 'watch the film', url: 'https://www.youtube.com/watch?v=gNVz83QSoY4' },
  { title: 'Google Dev Group — 2025', cat: 'video', cat_label: 'Event — Video Editing', img: '/assets/projects/6.webp', desc: 'Official <strong>aftermovie for the Google Developer Group 2025</strong> event — talks, crowd energy and behind-the-scenes moments compressed into a tight, high-energy recap.', role: 'Editor', stack: 'Premiere · CapCut', year: '2025', action: 'watch the film', video: 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/GDG.mp4' },
  { title: 'Open Mic RGU — 2025', cat: 'video', cat_label: 'Event — Video Editing', img: '/assets/projects/7.webp', desc: 'An <strong>event recap</strong> of Open Mic at RGU — raw performances, audience reactions and stage lights, edited to keep the live-room feeling on screen.', role: 'Editor', stack: 'Premiere · CapCut', year: '2025', action: 'watch the film', video: 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/open-mic.mp4' },
  { title: 'Badminton Tournament', cat: 'design', cat_label: 'Event — Banner Design', img: '/assets/projects/8.webp', desc: 'A bold <strong>tournament banner</strong> — strong type hierarchy, action photography and a layout that reads clearly from across a hall or in a feed.', role: 'Designer', stack: 'Figma · Canva', year: '2024', action: 'view the design', image: '/assets/projects/8.webp' },
  { title: 'BODOअख्रां Pvt. Ltd. Logo', cat: 'design', cat_label: 'Brand — Logo Design', img: '/assets/projects/9.webp', desc: 'Identity work for <strong>BODOअख्रां Pvt. Ltd.</strong> — a mark that blends Devanagari character with a modern wordmark, built to hold up from favicon to billboard.', role: 'Brand Designer', stack: 'Figma · Krita', year: '2024', action: 'view the design', image: '/assets/projects/9.webp' },
  { title: 'My Tea', cat: 'design', cat_label: 'Local Shop — Banner Design', img: '/assets/projects/10.webp', desc: 'A warm, appetising <strong>storefront banner</strong> for a local tea shop — friendly type, rich colour and a layout that makes you want a cup immediately.', role: 'Designer', stack: 'Canva · Krita', year: '2024', action: 'view the design', image: '/assets/projects/10.webp' },
  { title: 'Andaman & Nicobar Islands', cat: 'video', cat_label: 'Travel Film — Video Editing', img: '/assets/projects/5.webp', desc: 'Island hopping, turquoise water and slow sunsets — a <strong>travel edit</strong> built around pacing: fast cuts on the boats, long breaths on the beaches.', role: 'Editor & Colorist', stack: 'Premiere · DaVinci', year: '2024', action: 'watch the film', url: 'https://www.youtube.com/watch?v=gBvocwLObFQ' },
];

export const FEATURED_FALLBACK: FeaturedRow[] = [
    { info: 'Company', name: 'Bodo Okhrang Tech Pvt. Ltd.', tag: 'Web Development', url: 'https://bodookhrang.com', video: null, image: null, hover_src: 'assets/projects/14.webp' },
    { info: 'A.I. Tool', name: 'Okhrang', tag: 'Web Development', url: 'https://okhrang.com', video: null, image: null, hover_src: 'assets/projects/15.webp' },
    { info: 'Education', name: 'SchoolERP by Bodo Okhrang', tag: 'Web & App Development', url: 'https://schoolerp.okhrang.com', video: null, image: null, hover_src: 'assets/projects/16.webp' },
  { info: 'Construction', name: 'DREAMS Bodoland', tag: 'Web Development & CRM', url: 'https://dreamsbodoland.com', video: null, image: null, hover_src: 'assets/work/dreams-banner.webp' },
  { info: 'Security', name: 'NBSS Kokrajhar', tag: 'Web & App Development', url: 'https://nbsskokrajhar.com', video: null, image: null, hover_src: 'assets/work/nbss-banner.webp' },
    { info: 'E-COMMERCE Tool', name: 'FlopShop', tag: 'Web Development/PWA', url: 'https://flopshop.vercel.app', video: null, image: null, hover_src: 'assets/projects/12.webp' },
    { info: 'A.I. Tool', name: 'CrewSpace AI', tag: 'Extension', url: 'https://crewspace-ai.vercel.app', video: null, image: null, hover_src: 'assets/projects/11.webp' },
    { info: 'Education', name: 'Kokrajhar University', tag: 'Web & App Development', url: 'https://ku-app.in', video: null, image: null, hover_src: 'assets/projects/2.webp' },
    { info: 'Music Video', name: 'Jery Brahma - That’s What You Face', tag: 'Video Editing', url: 'https://www.youtube.com/watch?v=AQIcq3OWTNs', video: null, image: null, hover_src: 'assets/projects/13.webp' },
    { info: 'Event', name: 'Design with A.I. - GDG Aftermovie', tag: 'Video Editing', url: null, video: 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/design-with-ai-aftermovie.mp4', image: null, hover_src: 'assets/projects/17.webp' },
    { info: 'Travel', name: 'Trip to Darjeeling', tag: 'Video Editing', url: 'https://www.youtube.com/watch?v=gNVz83QSoY4', video: null, image: null, hover_src: 'assets/projects/4.webp' },
    { info: 'Event', name: 'GOOGLE DEV GROUP - 2025', tag: 'Video Editing', url: null, video: 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/GDG.mp4', image: null, hover_src: 'assets/projects/6.webp' },
    { info: 'Event', name: 'Open Mic RGU - 2025', tag: 'Video Editing', url: null, video: 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/open-mic.mp4', image: null, hover_src: 'assets/projects/7.webp' },
    { info: 'Event', name: 'Badminton Tournament', tag: 'Banner Editing', url: null, video: null, image: 'assets/projects/8.webp', hover_src: 'assets/projects/8.webp' },
    { info: 'Tool', name: 'BODOअख्रां Pvt. Ltd. Logo', tag: 'Logo Design', url: null, video: null, image: 'assets/projects/9.webp', hover_src: 'assets/projects/9.webp' },
    { info: 'Local Shop', name: 'My Tea', tag: 'Banner Editing', url: null, video: null, image: 'assets/projects/10.webp', hover_src: 'assets/projects/10.webp' },
    { info: 'Travel', name: 'Andaman & Nicobar Islands', tag: 'Video Editing', url: 'https://www.youtube.com/watch?v=gBvocwLObFQ', video: null, image: null, hover_src: 'assets/projects/5.webp' },
];

export async function getProjects(): Promise<ProjectRow[]> {
  const rows = await sbFetch<any>('projects', 'select=*&visible=eq.true&order=sort');
  if (!rows) return PROJECTS_FALLBACK;
  return rows.map((r) => ({
    title: r.title, cat: r.cat, cat_label: r.cat_label, img: r.img,
    desc: r.description, role: r.role, stack: r.stack, year: r.year, action: r.action,
    url: r.url, video: r.video, image: r.image,
  }));
}

export async function getFeatured(): Promise<FeaturedRow[]> {
  return (await sbFetch<FeaturedRow>('featured_projects', 'select=*&visible=eq.true&order=sort')) ?? FEATURED_FALLBACK;
}

export type WorkItem = {
  id: string;
  name: string;
  /** Short category above the name on the card ("Education"). */
  chip: string;
  /** Longer label for the popup ("Education — ERP · Web & App"). */
  label: string;
  /** Under the name on the card when there is no site to show. */
  tag: string;
  cat: 'development' | 'video' | 'design';
  url: string | null;
  video: string | null;
  image: string | null;
  media: string;
  /** Posters and portrait designs are shown whole rather than cropped. */
  contain: boolean;
  icon: string | null;
  host: string | null;
  desc: string | null;
  role: string | null;
  year: string | null;
  action: string;
  platforms: string[];
  features: string[];
  stack: StackGroup[];
};

const isYouTube = (url: string) => /(^|\.)youtube\.com|youtu\.be/.test(url);

function inferCat(tag: string): WorkItem['cat'] {
  if (/video/i.test(tag)) return 'video';
  if (/design|banner|logo/i.test(tag)) return 'design';
  return 'development';
}

/** One card + popup, from a featured row, a project row, or both. */
export function workItem(
  { featured, project }: { featured?: FeaturedRow; project?: ProjectRow },
  index: number,
): WorkItem {
  const row = (featured ?? project)!;
  const key = workKey(row);
  const detail = WORK[key];
  const url = row.url || null;
  const tag = featured?.tag ?? project?.cat_label.split('—').pop()?.trim() ?? '';
  const cat = (project?.cat as WorkItem['cat']) ?? inferCat(tag);
  const media = detail?.banner ?? (project?.img || featured?.hover_src || '');
  const slug = key.replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '').slice(-40);

  return {
    id: `work-${index}-${slug}`,
    name: featured?.name ?? project!.title,
    chip: featured?.info ?? project!.cat_label.split('—')[0].trim(),
    label: project?.cat_label ?? `${featured!.info} — ${featured!.tag}`,
    tag,
    cat,
    url,
    video: row.video || null,
    image: row.image ? sbAsset(row.image) : null,
    media: sbAsset(media),
    contain: Boolean(row.image),
    icon: detail ? sbAsset(detail.icon) : null,
    host: url && !isYouTube(url) ? url.replace(/^https?:\/\//, '').replace(/^www\./, '').replace(/\/$/, '') : null,
    desc: project?.desc ?? null,
    role: project?.role ?? null,
    year: project?.year ?? null,
    action: project?.action ?? (url ? (isYouTube(url) ? 'watch on youtube' : 'visit live site') : row.video ? 'watch the film' : 'view the design'),
    platforms: detail?.platforms ?? [],
    features: detail?.features ?? [],
    stack: detail?.stack ?? (project?.stack ? [{ title: 'Toolkit', tools: toolsFromStack(project.stack) }] : []),
  };
}

/** Home: the featured list, each joined to its full write-up. */
export async function featuredWork(): Promise<WorkItem[]> {
  const [featured, projects] = await Promise.all([getFeatured(), getProjects()]);
  const byKey = new Map(projects.map((p) => [workKey(p), p]));
  return featured.map((f, i) => workItem({ featured: f, project: byKey.get(workKey(f)) }, i));
}

/** /projects: every entry. */
export async function allWork(): Promise<WorkItem[]> {
  return (await getProjects()).map((p, i) => workItem({ project: p }, i));
}
