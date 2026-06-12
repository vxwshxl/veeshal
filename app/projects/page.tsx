import type { Metadata } from 'next';
import '@/styles/css/v2.css';
import '@/styles/css/projectsPage.css';
import { sbFetch, sbAsset } from '@/lib/supabase';
import { ASSET_VERSION } from '@/lib/version';
import Scripts from '../Scripts';
import Loader from '../components/Loader';
import Chrome from '../components/Chrome';
import SiteHeader from '../components/SiteHeader';

export const revalidate = 120;

export const metadata: Metadata = {
  title: 'Projects — Veeshal D. Bodosa',
  description:
    'All projects by Veeshal D. Bodosa — web development, video editing and design work, each one in detail.',
  alternates: { canonical: 'https://veeshal.me/projects' },
  openGraph: {
    type: 'website',
    url: 'https://veeshal.me/projects',
    title: 'Projects — Veeshal D. Bodosa',
    description: 'Every build and every cut — the full garage of projects, in detail.',
    images: ['https://veeshal.me/assets/vee-og.webp'],
  },
};

type Project = {
  title: string; cat: string; cat_label: string; img: string; desc: string;
  role: string; stack: string; year: string; action: string;
  url?: string | null; video?: string | null; image?: string | null;
};

const FALLBACK: Project[] = [
  { title: 'Bodo Okhrang', cat: 'development', cat_label: 'A.I. Tool — Web Development', img: '/assets/projects/1.webp', desc: 'An <strong>AI-powered Anglo-Bodo dictionary</strong> and language platform built for the Bodo community. Instant word lookup, smart suggestions and a clean reading experience — now serving <strong>50,000+ visitors every month</strong> and growing.', role: 'Full-stack Developer', stack: 'PHP · MySQL · JS · AI', year: '2024 — live', action: 'visit live site', url: 'https://bodookhrang.com' },
  { title: 'FlopShop', cat: 'development', cat_label: 'E-commerce — PWA', img: '/assets/projects/12.webp', desc: 'A modern <strong>e-commerce progressive web app</strong> — installable, offline-friendly and fast on any device. Snappy product browsing, cart flow and a checkout experience that feels native.', role: 'Designer & Developer', stack: 'React · PWA · Vercel', year: '2025 — live', action: 'visit live site', url: 'https://flopshop.vercel.app' },
  { title: 'CrewSpace AI', cat: 'development', cat_label: 'A.I. Tool — Browser Extension', img: '/assets/projects/11.webp', desc: 'A <strong>browser extension</strong> that brings AI assistance straight into your workspace — summarise, draft and organise without ever leaving the tab you are working in.', role: 'Creator & Developer', stack: 'JS · Extension APIs · AI', year: '2025 — live', action: 'visit live site', url: 'https://crewspace-ai.vercel.app' },
  { title: 'Kokrajhar University', cat: 'development', cat_label: 'Education — Web & App', img: '/assets/projects/2.webp', desc: 'The digital front door for <strong>Kokrajhar University</strong> — a website and companion app giving students notices, resources and campus information in one organised, mobile-first place.', role: 'Web & App Developer', stack: 'PHP · MySQL · React Native', year: '2024 — live', action: 'visit live site', url: 'https://ku-app.in' },
  { title: 'Swrzee Enterprise', cat: 'development', cat_label: 'Enterprise — Web Development', img: '/assets/projects/3.webp', desc: 'A clean, credible <strong>business website</strong> for Swrzee Enterprise — product showcase, company story and contact flows designed to convert visitors into customers.', role: 'Designer & Developer', stack: 'PHP · CSS · JS', year: '2024 — live', action: 'visit live site', url: 'https://swrzee.in' },
  { title: 'Trip to Darjeeling', cat: 'video', cat_label: 'Travel Film — Video Editing', img: '/assets/projects/4.webp', desc: 'A <strong>cinematic travel film</strong> through the hills of Darjeeling — tea gardens, toy trains and misty ridgelines, cut to rhythm with colour grading that keeps the mountain mood intact.', role: 'Editor & Colorist', stack: 'Premiere · DaVinci', year: '2024', action: 'watch the film', url: 'https://www.youtube.com/watch?v=gNVz83QSoY4' },
  { title: 'Andaman & Nicobar Islands', cat: 'video', cat_label: 'Travel Film — Video Editing', img: '/assets/projects/5.webp', desc: 'Island hopping, turquoise water and slow sunsets — a <strong>travel edit</strong> built around pacing: fast cuts on the boats, long breaths on the beaches.', role: 'Editor & Colorist', stack: 'Premiere · DaVinci', year: '2024', action: 'watch the film', url: 'https://www.youtube.com/watch?v=gBvocwLObFQ' },
  { title: 'Google Dev Group — 2025', cat: 'video', cat_label: 'Event — Video Editing', img: '/assets/projects/6.webp', desc: 'Official <strong>aftermovie for the Google Developer Group 2025</strong> event — talks, crowd energy and behind-the-scenes moments compressed into a tight, high-energy recap.', role: 'Editor', stack: 'Premiere · CapCut', year: '2025', action: 'watch the film', video: 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/GDG.mp4' },
  { title: 'Open Mic RGU — 2025', cat: 'video', cat_label: 'Event — Video Editing', img: '/assets/projects/7.webp', desc: 'An <strong>event recap</strong> of Open Mic at RGU — raw performances, audience reactions and stage lights, edited to keep the live-room feeling on screen.', role: 'Editor', stack: 'Premiere · CapCut', year: '2025', action: 'watch the film', video: 'https://pub-fe9b85f97c6a4773bbf0ceb5f53c430b.r2.dev/open-mic.mp4' },
  { title: 'Badminton Tournament', cat: 'design', cat_label: 'Event — Banner Design', img: '/assets/projects/8.webp', desc: 'A bold <strong>tournament banner</strong> — strong type hierarchy, action photography and a layout that reads clearly from across a hall or in a feed.', role: 'Designer', stack: 'Figma · Canva', year: '2024', action: 'view the design', image: '/assets/projects/8.webp' },
  { title: 'BODOअख्रां Pvt. Ltd. Logo', cat: 'design', cat_label: 'Brand — Logo Design', img: '/assets/projects/9.webp', desc: 'Identity work for <strong>BODOअख्रां Pvt. Ltd.</strong> — a mark that blends Devanagari character with a modern wordmark, built to hold up from favicon to billboard.', role: 'Brand Designer', stack: 'Figma · Krita', year: '2024', action: 'view the design', image: '/assets/projects/9.webp' },
  { title: 'My Tea', cat: 'design', cat_label: 'Local Shop — Banner Design', img: '/assets/projects/10.webp', desc: 'A warm, appetising <strong>storefront banner</strong> for a local tea shop — friendly type, rich colour and a layout that makes you want a cup immediately.', role: 'Designer', stack: 'Canva · Krita', year: '2024', action: 'view the design', image: '/assets/projects/10.webp' },
];

const pad2 = (n: number) => String(n).padStart(2, '0');

export default async function Projects() {
  let projects = FALLBACK;
  const rows = await sbFetch<any>('projects', 'select=*&visible=eq.true&order=sort');
  if (rows) {
    projects = rows.map((r) => ({
      title: r.title, cat: r.cat, cat_label: r.cat_label, img: sbAsset(r.img),
      desc: r.description, role: r.role, stack: r.stack, year: r.year, action: r.action,
      url: r.url, video: r.video, image: r.image ? sbAsset(r.image) : null,
    }));
  }

  const counts: Record<string, number> = { all: projects.length, development: 0, video: 0, design: 0 };
  for (const p of projects) counts[p.cat]++;

  return (
    <>
      <script dangerouslySetInnerHTML={{ __html: "document.body.classList.add('is-loading');" }} />
      <Loader />
      <Chrome />

      <div className="page">
        <SiteHeader active="projects" base="/" />

        <section className="garage-hero">
          <div className="hero-ghost" aria-hidden="true">the garage — the garage</div>
          <h1 className="garage-title">
            <span className="line"><span className="word">all</span></span>
            <span className="line"><span className="word amp" style={{ color: 'var(--amber)', fontStyle: 'italic' }}>projects</span><span className="word">,</span></span>
            <span className="line"><span className="word">in detail.</span></span>
          </h1>
          <div className="garage-sub">
            <p>
              Every build and every cut — web platforms, apps, travel films, event recaps
              and design work. Each entry below is the full story: what it is, what I did,
              and what it shipped with.
            </p>
            <span className="garage-count mono">
              <span className="amber">{pad2(counts.all)}</span> entries — &apos;24 to &apos;26
            </span>
          </div>
        </section>

        <div className="filter-bar">
          <span className="lbl">filter /</span>
          <button className="filter-btn active" data-filter="all">all <span className="n">{counts.all}</span></button>
          <button className="filter-btn" data-filter="development">development <span className="n">{counts.development}</span></button>
          <button className="filter-btn" data-filter="video">video <span className="n">{counts.video}</span></button>
          <button className="filter-btn" data-filter="design">design <span className="n">{counts.design}</span></button>
        </div>

        <div className="cases">
          {projects.map((p, i) => {
            const num = pad2(i + 1);
            const dataAttrs: Record<string, string> = {};
            if (p.url) dataAttrs['data-url'] = p.url;
            else if (p.video) dataAttrs['data-video'] = p.video;
            else if (p.image) dataAttrs['data-image'] = p.image;
            return (
              <article className="case" data-cat={p.cat} key={i}>
                <span className="case-num">{num}</span>
                <div className="case-media" data-open-case="" {...dataAttrs}>
                  <img src={p.img} alt={p.title} loading="lazy" />
                  <span className="case-chip" dangerouslySetInnerHTML={{ __html: p.cat_label }} />
                </div>
                <div className="case-body">
                  <p className="case-kicker">{num} / {p.cat}</p>
                  <h2 className="case-title" dangerouslySetInnerHTML={{ __html: p.title }} />
                  <p className="case-desc" dangerouslySetInnerHTML={{ __html: p.desc }} />
                  <dl className="case-meta">
                    <div><dt>role</dt><dd dangerouslySetInnerHTML={{ __html: p.role }} /></div>
                    <div><dt>toolkit</dt><dd dangerouslySetInnerHTML={{ __html: p.stack }} /></div>
                    <div><dt>year</dt><dd dangerouslySetInnerHTML={{ __html: p.year }} /></div>
                  </dl>
                  <div className="case-actions">
                    {p.url ? (
                      <a href={p.url} target="_blank" className="btn-pill" dangerouslySetInnerHTML={{ __html: `${p.action} <span class="arr">→</span>` }} />
                    ) : (
                      <button className="btn-pill" data-open-case="" {...dataAttrs} dangerouslySetInnerHTML={{ __html: `${p.action} <span class="arr">→</span>` }} />
                    )}
                  </div>
                </div>
              </article>
            );
          })}
        </div>

        <section className="garage-outro">
          <h2 className="ot">got an idea that belongs<br />in this <span className="amber">garage?</span></h2>
          <a href="/#contact" className="btn-pill">let&apos;s build it together <span className="arr">→</span></a>
        </section>

        <footer className="site-footer">
          <div className="footer-bottom" style={{ borderTop: 'none', paddingTop: 0 }}>
            <span>© 2026 veeshal d. bodosa</span>
            <span>engineered with precision — crafted with passion</span>
            <span><a href="/">back to home →</a></span>
          </div>
        </footer>
      </div>

      <div id="mediaModal" className="media-modal">
        <div className="media-content">
          <span id="closeMedia" className="close-btn">&times;</span>
          <video id="popupVideo" controls>
            <source src="" type="video/mp4" />
            Your browser does not support HTML5 video.
          </video>
          <img id="popupImage" src="" alt="Popup Image" />
        </div>
      </div>

      <Scripts src={['/js/loader.js', '/js/projectsPage.js']} version={ASSET_VERSION} />
    </>
  );
}
