import {
  siAndroid,
  siApple,
  siCloudflare,
  siDocker,
  siExpo,
  siFigma,
  siFlutter,
  siGit,
  siGithub,
  siHostinger,
  siHuggingface,
  siKrita,
  siLeaflet,
  siMysql,
  siNextdotjs,
  siNginx,
  siNodedotjs,
  siPhp,
  siPm2,
  siPnpm,
  siPostgresql,
  siPrisma,
  siPython,
  siPytorch,
  siRazorpay,
  siReact,
  siShadcnui,
  siSupabase,
  siTailwindcss,
  siTurborepo,
  siTypescript,
  siUbuntu,
  siZod,
  siZoho,
  type SimpleIcon,
} from 'simple-icons';

/** A tool shows a Simple Icons mark, or a raster logo (`img`) when Simple Icons has none. */
export type Tool = { name: string; icon?: SimpleIcon; img?: string; note?: string };

export const STACK: { title: string; tools: Tool[] }[] = [
  {
    title: 'Web',
    tools: [
      { name: 'Next.js', icon: siNextdotjs },
      { name: 'React', icon: siReact },
      { name: 'TypeScript', icon: siTypescript },
      { name: 'Tailwind CSS', icon: siTailwindcss },
      { name: 'shadcn/ui', icon: siShadcnui },
      { name: 'Turborepo', icon: siTurborepo },
      { name: 'Zod', icon: siZod },
      { name: 'PHP', icon: siPhp },
    ],
  },
  {
    title: 'Mobile',
    tools: [
      { name: 'React Native', icon: siReact },
      { name: 'Expo', icon: siExpo },
      { name: 'Flutter', icon: siFlutter },
      { name: 'Android', icon: siAndroid },
      { name: 'iOS', icon: siApple },
    ],
  },
  {
    title: 'Backend & services',
    tools: [
      { name: 'Supabase', icon: siSupabase, note: 'Self-hosted' },
      { name: 'PostgreSQL', icon: siPostgresql },
      { name: 'MySQL', icon: siMysql },
      { name: 'Prisma', icon: siPrisma },
      { name: 'Node.js', icon: siNodedotjs },
      { name: 'Cloudflare', icon: siCloudflare, note: 'R2 storage' },
      { name: 'ZeptoMail', icon: siZoho, note: 'by Zoho' },
      { name: 'Razorpay', icon: siRazorpay },
      { name: 'Leaflet', icon: siLeaflet },
    ],
  },
  {
    title: 'Language A.I.',
    tools: [
      { name: 'Python', icon: siPython },
      { name: 'PyTorch', icon: siPytorch },
      { name: 'Hugging Face', icon: siHuggingface },
      { name: 'Sarvam AI' },
    ],
  },
  {
    title: 'Infrastructure',
    tools: [
      { name: 'Hostinger', icon: siHostinger, note: 'VPS' },
      { name: 'Docker', icon: siDocker },
      { name: 'Ubuntu', icon: siUbuntu },
      { name: 'NGINX', icon: siNginx },
      { name: 'PM2', icon: siPm2 },
      { name: 'pnpm', icon: siPnpm },
      { name: 'Git', icon: siGit },
      { name: 'GitHub', icon: siGithub },
    ],
  },
  {
    title: 'Design & video',
    tools: [
      { name: 'Figma', icon: siFigma },
      { name: 'Canva', img: 'assets/skills/canva.png' },
      { name: 'Krita', icon: siKrita },
      { name: 'Jitter', img: 'assets/skills/jitter.png' },
      { name: 'Final Cut Pro', img: 'assets/skills/final-cut-pro.png' },
      { name: 'CapCut', img: 'assets/skills/capcut.png' },
    ],
  },
];

export const STACK_TOOLS = STACK.flatMap((g) => g.tools);
/** Two drifting rows, split down the middle of the full list. */
const ROWS = [
  STACK_TOOLS.slice(0, Math.ceil(STACK_TOOLS.length / 2)),
  STACK_TOOLS.slice(Math.ceil(STACK_TOOLS.length / 2)),
];

/** Near-black and near-white brand marks vanish on one background — draw those in ink. */
function brandColor(icon: SimpleIcon) {
  const [r, g, b] = [0, 2, 4].map((o) => parseInt(icon.hex.slice(o, o + 2), 16) / 255);
  const luminance = 0.2126 * r + 0.7152 * g + 0.0722 * b;
  return luminance < 0.14 || luminance > 0.85 ? 'currentColor' : `#${icon.hex}`;
}

/** Decorative by default (the name sits beside it); `labelled` when the logo stands alone. */
export function ToolLogo({ tool, className, labelled }: { tool: Tool; className?: string; labelled?: boolean }) {
  const a11y = labelled ? { role: 'img', 'aria-label': tool.name } : { 'aria-hidden': true };
  if (tool.icon) {
    return (
      <svg {...a11y} viewBox="0 0 24 24" className={className} fill={brandColor(tool.icon)}>
        <path d={tool.icon.path} />
      </svg>
    );
  }
  if (tool.img) return <img src={`/${tool.img}`} alt={labelled ? tool.name : ''} className={className} />;
  // No public mark (e.g. Sarvam AI) — a plain spark in the site accent.
  return (
    <svg {...a11y} viewBox="0 0 24 24" className={className} fill="var(--amber-deep)">
      <path d="M12 2l2.2 6.6L21 11l-6.8 2.4L12 20l-2.2-6.6L3 11l6.8-2.4z" />
    </svg>
  );
}

/**
 * The tools behind the work. Two logo bands drift apart as the section scrolls
 * past (`.drift-*`), then every tool rises into its group (`.tool-in`). Both are
 * scroll-driven CSS; without `animation-timeline` the section is simply static.
 */
export default function TechStack() {
  return (
    <section id="stack" className="stack" data-nav-section>
      <div className="section-head">
        <div>
          <p className="section-kicker"><span className="idx">04</span> tech stack</p>
          <h2 className="section-title">
            <span className="word">tools</span> <span className="word">I</span>{' '}
            <span className="word amber">build with</span>
          </h2>
        </div>
        <p className="section-note">open, proven tools I run in production every day — so what you get is yours to keep.</p>
      </div>

      {/* Drifting bands — decoration; the grid below carries the same names. */}
      <div className="stack-bands" aria-hidden="true">
        {ROWS.map((row, r) => (
          <div key={r} className={`stack-band ${r === 0 ? 'drift-left' : 'drift-right'}`}>
            {[...row, ...row].map((tool, i) => (
              <span key={`${tool.name}-${i}`} className="stack-pill">
                <span className="stack-pill-logo"><ToolLogo tool={tool} /></span>
                {tool.name}
              </span>
            ))}
          </div>
        ))}
      </div>

      <div className="stack-grid">
        {STACK.map((group) => (
          <div key={group.title} className="stack-card">
            <div className="stack-card-head">
              <h3>{group.title}</h3>
              <span className="stack-count">{String(group.tools.length).padStart(2, '0')}</span>
            </div>
            <ul>
              {group.tools.map((tool, i) => (
                <li key={tool.name} className="tool-in" style={{ '--i': i } as React.CSSProperties}>
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
      </div>
    </section>
  );
}
