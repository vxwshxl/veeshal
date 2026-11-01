import type { Metadata } from 'next';
import '@/styles/css/v2.css';
import '@/styles/css/projectsPage.css';
import '@/styles/css/work.css';
import { allWork, type WorkItem } from '@/lib/projects';
import { ASSET_VERSION } from '@/lib/version';
import Scripts from '../Scripts';
import Loader from '../components/Loader';
import Chrome from '../components/Chrome';
import SiteHeader from '../components/SiteHeader';
import { ToolLogo } from '../components/TechStack';
import { WorkDialog } from '../components/Work';

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

const pad2 = (n: number) => String(n).padStart(2, '0');

export default async function Projects() {
  const projects = await allWork();

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
          {projects.map((p, i) => (
            <Case key={p.id} item={p} num={pad2(i + 1)} />
          ))}
        </div>

        <section className="garage-outro">
          <h2 className="ot">got an idea that belongs<br />in this <span className="amber">garage?</span></h2>
          <a href="/#contact" className="btn-pill">let&apos;s build it together <span className="arr">→</span></a>
        </section>

        <footer className="site-footer">
          <div className="footer-bottom" style={{ borderTop: 'none', paddingTop: 0 }}>
            <span>© 2026 veeshal d. bodosa</span>
            <span className="footer-sign">engineered with <em>precision</em>, crafted with <em>passion</em>.</span>
            <span><a href="/">back to home →</a></span>
          </div>
        </footer>
      </div>

      {projects.map((p) => <WorkDialog key={p.id} item={p} />)}

      <Scripts src={['/js/loader.js', '/js/projectsPage.js', '/js/workDialogs.js']} version={ASSET_VERSION} />
    </>
  );
}

/** Up to this many logos in a case's toolkit row; the popup lists them all. */
const TOOLKIT_MAX = 6;

function Case({ item, num }: { item: WorkItem; num: string }) {
  const tools = [...new Map(item.stack.flatMap((g) => g.tools).map((t) => [t.name, t])).values()];
  const more = tools.length - TOOLKIT_MAX;
  const play = item.video ? { 'data-work-play': '' } : {};

  return (
    <article className="case" data-cat={item.cat}>
      <span className="case-num">{num}</span>
      <button type="button" className={'case-media' + (item.contain ? ' is-contain' : '')} data-work-open={item.id} aria-haspopup="dialog" aria-label={`${item.name}: details`} {...play}>
        <img src={item.media} alt="" loading="lazy" />
      </button>
      <div className="case-body">
        {/* The label sits here, not on the banner, which carries its own brand. */}
        <p className="case-kicker"><span>{num} / <span dangerouslySetInnerHTML={{ __html: item.label }} /></span></p>
        <h2 className="case-title" dangerouslySetInnerHTML={{ __html: item.name }} />
        {item.desc ? <p className="case-desc" dangerouslySetInnerHTML={{ __html: item.desc }} /> : null}
        <dl className="case-meta">
          {item.role ? <div><dt>role</dt><dd dangerouslySetInnerHTML={{ __html: item.role }} /></div> : null}
          {item.platforms.length ? <div><dt>ships as</dt><dd>{item.platforms.join(' · ')}</dd></div> : null}
          {item.year ? <div><dt>year</dt><dd dangerouslySetInnerHTML={{ __html: item.year }} /></div> : null}
        </dl>
        {tools.length ? (
          <ul className="case-tools" aria-label="Toolkit">
            {tools.slice(0, TOOLKIT_MAX).map((t) => (
              <li key={t.name}><span className="case-tool-logo"><ToolLogo tool={t} /></span>{t.name}</li>
            ))}
            {more > 0 ? <li className="case-tools-more">+{more} more</li> : null}
          </ul>
        ) : null}
        <div className="case-actions">
          {item.url ? (
            <>
              <a href={item.url} target="_blank" rel="noreferrer" className="btn-pill">{item.action} <span className="arr">→</span></a>
              <button type="button" className="btn-pill btn-ghost" data-work-open={item.id}>details &amp; stack</button>
            </>
          ) : (
            <button type="button" className="btn-pill" data-work-open={item.id} {...play}>{item.action} <span className="arr">→</span></button>
          )}
        </div>
      </div>
    </article>
  );
}
