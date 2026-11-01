import type { WorkItem } from '@/lib/projects';
import { ToolLogo } from './TechStack';

/**
 * Project cards and the popup each one opens.
 *
 * Both are rendered on the server: every card is a button naming its
 * <dialog> (`data-work-open`), and public/js/workDialogs.js only calls
 * showModal(). A closed dialog is display:none, so its images and video
 * aren't fetched until it opens.
 */

function Glyph({ cat }: { cat: WorkItem['cat'] }) {
  if (cat === 'video') {
    return (
      <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5.5v13l10.5-6.5z" fill="currentColor" /></svg>
    );
  }
  if (cat === 'design') {
    return (
      <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
        <path d="M12 19l7-7 3 3-7 7-3-3z" /><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z" /><path d="M2 2l7.586 7.586" /><circle cx="11" cy="11" r="2" />
      </svg>
    );
  }
  return (
    <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round">
      <polyline points="16 18 22 12 16 6" /><polyline points="8 6 2 12 8 18" />
    </svg>
  );
}

function Icon({ item }: { item: WorkItem }) {
  return item.icon ? <img src={item.icon} alt="" loading="lazy" /> : <Glyph cat={item.cat} />;
}

/** The card: banner on top (left clean, it carries its own brand), then icon, category, name and host. */
export function WorkCard({ item, eager }: { item: WorkItem; eager?: boolean }) {
  return (
    <button type="button" className="work-card" data-work-open={item.id} aria-haspopup="dialog">
      <span className={'work-media' + (item.contain ? ' is-contain' : '')}>
        <img src={item.media} alt="" loading={eager ? 'eager' : 'lazy'} decoding="async" />
      </span>
      <span className="work-row">
        <span className="work-icon"><Icon item={item} /></span>
        <span className="work-text">
          <span className="work-kicker">{item.chip}</span>
          <span className="work-name">{item.name}</span>
          <span className="work-sub">{item.host ?? item.tag}</span>
        </span>
        <span className="work-go" aria-hidden="true">
          {item.cat === 'video' ? <Glyph cat="video" /> : <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.2" strokeLinecap="round"><path d="M7 17L17 7M8 7h9v9" /></svg>}
        </span>
      </span>
    </button>
  );
}

export function WorkGrid({ items }: { items: WorkItem[] }) {
  return (
    <>
      <ul className="work-grid">
        {items.map((item, i) => (
          <li key={item.id} className="work-item">
            <WorkCard item={item} eager={i < 3} />
          </li>
        ))}
      </ul>
      {items.map((item) => <WorkDialog key={item.id} item={item} />)}
    </>
  );
}

const Arrow = () => <span className="arr">→</span>;

/** The primary action: the live site, the film, or the design at full size. */
function PrimaryAction({ item }: { item: WorkItem }) {
  if (item.url) {
    return <a href={item.url} target="_blank" rel="noreferrer" className="btn-pill wd-primary">{item.action} <Arrow /></a>;
  }
  if (item.video) {
    return <button type="button" className="btn-pill wd-primary" data-work-play="">{item.action} <Arrow /></button>;
  }
  if (item.image) {
    return <a href={item.image} target="_blank" rel="noreferrer" className="btn-pill wd-primary">open full size <Arrow /></a>;
  }
  return null;
}

export function WorkDialog({ item }: { item: WorkItem }) {
  const titleId = `${item.id}-title`;
  const toolCount = item.stack.reduce((n, g) => n + g.tools.length, 0);

  return (
    <dialog id={item.id} className="work-dialog" aria-labelledby={titleId}>
      <div className="wd-sheet">
        {/* Sticky: the way out and the way in stay in reach while the sheet scrolls. */}
        <div className="wd-bar">
          <span className="wd-bar-name">
            <span className="wd-bar-icon"><Icon item={item} /></span>
            <span className="wd-bar-text">{item.name}</span>
          </span>
          <PrimaryAction item={item} />
          <button type="button" className="wd-close" data-work-close="" aria-label="Close">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.2" strokeLinecap="round"><path d="M6 6l12 12M18 6L6 18" /></svg>
          </button>
        </div>

        <div className={'wd-media' + (item.contain ? ' is-contain' : '')}>
          {item.video ? (
            <video controls playsInline preload="none" poster={item.media}>
              <source src={item.video} type="video/mp4" />
            </video>
          ) : (
            <img src={item.image ?? item.media} alt={item.name} loading="lazy" decoding="async" />
          )}
        </div>

        <div className="wd-body">
          <div className="wd-main">
            <div className="wd-head">
              <span className="wd-icon"><Icon item={item} /></span>
              <div className="wd-head-text">
                <p className="wd-kicker">{item.label}</p>
                <h2 id={titleId} className="wd-title">{item.name}</h2>
                {item.host ? (
                  <a className="wd-host" href={item.url!} target="_blank" rel="noreferrer">{item.host} ↗</a>
                ) : null}
              </div>
            </div>

            {item.desc ? <p className="wd-desc" dangerouslySetInnerHTML={{ __html: item.desc }} /> : null}

            <dl className="wd-meta">
              {item.role ? <div><dt>role</dt><dd>{item.role}</dd></div> : null}
              {item.year ? <div><dt>year</dt><dd>{item.year}</dd></div> : null}
              {item.platforms.length ? (
                <div className="wd-meta-wide">
                  <dt>ships as</dt>
                  <dd>
                    <ul className="wd-platforms">
                      {item.platforms.map((p) => <li key={p}>{p}</li>)}
                    </ul>
                  </dd>
                </div>
              ) : null}
            </dl>

            {item.features.length ? (
              <section className="wd-section">
                <h3 className="wd-label">what it does</h3>
                <ul className="wd-features">
                  {item.features.map((f) => <li key={f}>{f}</li>)}
                </ul>
              </section>
            ) : null}
          </div>

          {toolCount ? (
            <section className="wd-section wd-stack">
              <h3 className="wd-label">
                {item.cat === 'development' ? 'tech stack' : 'toolkit'}{' '}
                <span className="wd-count">{String(toolCount).padStart(2, '0')}</span>
              </h3>
              {item.stack.map((group) => (
                <div key={group.title} className="wd-group">
                  {item.stack.length > 1 ? <h4>{group.title}</h4> : null}
                  <ul>
                    {group.tools.map((tool) => (
                      <li key={tool.name}>
                        <span className="stack-tool-logo"><ToolLogo tool={tool} /></span>
                        <span className="stack-tool-text">
                          <span className="stack-tool-name">{tool.name}</span>
                          {tool.note ? <span className="stack-tool-note">{tool.note}</span> : null}
                        </span>
                      </li>
                    ))}
                  </ul>
                </div>
              ))}
            </section>
          ) : null}
        </div>

      </div>
    </dialog>
  );
}
