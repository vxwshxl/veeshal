import {
  siAndroid,
  siCloudflare,
  siCss,
  siDavinciresolve,
  siExpo,
  siFigma,
  siGooglechrome,
  siGooglegemini,
  siGoogle,
  siGsap,
  siHostinger,
  siJavascript,
  siKrita,
  siLeaflet,
  siMaplibre,
  siNextdotjs,
  siNginx,
  siPhp,
  siPm2,
  siPostgresql,
  siPwa,
  siRadixui,
  siRazorpay,
  siReact,
  siReactquery,
  siShadcnui,
  siSupabase,
  siTailwindcss,
  siTurborepo,
  siTypescript,
  siVercel,
  siXyflow,
  siZod,
  siZoho,
} from 'simple-icons';
import type { Tool } from '@/app/components/TechStack';

/**
 * What the project cards and their popups show beyond the Supabase rows.
 *
 * Supabase (`featured_projects`, `projects`) still owns which projects appear,
 * their order and their copy; this file adds what a CMS row can't hold: the
 * share-card banner, the app icon, the platforms and the tech stack drawn as
 * logos. Each entry is keyed by the row's link (see `workKey`), which is the
 * same in both tables. Stacks are read from each project's package.json.
 *
 * A row with no entry here still gets a card and a popup: its banner is the
 * row's own image and its tools are parsed from the `stack` text.
 */

export type StackGroup = { title: string; tools: Tool[] };

export type WorkDetail = {
  /** 1200×630 share card. */
  banner: string;
  icon: string;
  /** What ships: "Website", "Android app", "Staff portal"… */
  platforms: string[];
  features: string[];
  stack: StackGroup[];
};

const T = {
  next: { name: 'Next.js', icon: siNextdotjs },
  react: { name: 'React', icon: siReact },
  ts: { name: 'TypeScript', icon: siTypescript },
  tailwind: { name: 'Tailwind CSS', icon: siTailwindcss },
  shadcn: { name: 'shadcn/ui', icon: siShadcnui },
  radix: { name: 'Radix UI', icon: siRadixui },
  zod: { name: 'Zod', icon: siZod },
  gsap: { name: 'GSAP', icon: siGsap },
  leaflet: { name: 'Leaflet', icon: siLeaflet, note: 'Maps' },
  turbo: { name: 'Turborepo', icon: siTurborepo },
  expo: { name: 'Expo', icon: siExpo },
  rn: { name: 'React Native', icon: siReact },
  query: { name: 'TanStack Query', icon: siReactquery },
  maplibre: { name: 'MapLibre', icon: siMaplibre, note: 'Live map' },
  android: { name: 'Android', icon: siAndroid },
  supabase: { name: 'Supabase', icon: siSupabase, note: 'Self-hosted' },
  supabaseCloud: { name: 'Supabase', icon: siSupabase },
  postgres: { name: 'PostgreSQL', icon: siPostgresql },
  r2: { name: 'Cloudflare', icon: siCloudflare, note: 'R2 storage' },
  razorpay: { name: 'Razorpay', icon: siRazorpay },
  zepto: { name: 'ZeptoMail', icon: siZoho, note: 'by Zoho' },
  google: { name: 'Google', icon: siGoogle, note: 'Sign-in' },
  sarvam: { name: 'Sarvam AI', note: 'Chat & translate' },
  gemini: { name: 'Gemini', icon: siGooglegemini },
  groq: { name: 'Groq', note: 'Inference' },
  xyflow: { name: 'React Flow', icon: siXyflow, note: 'Canvas' },
  chrome: { name: 'Chrome', icon: siGooglechrome, note: 'Manifest V3' },
  js: { name: 'JavaScript', icon: siJavascript },
  pwa: { name: 'PWA', icon: siPwa, note: 'Installable' },
  vercel: { name: 'Vercel', icon: siVercel },
  hostinger: { name: 'Hostinger', icon: siHostinger, note: 'VPS' },
  nginx: { name: 'NGINX', icon: siNginx },
  pm2: { name: 'PM2', icon: siPm2 },
} satisfies Record<string, Tool>;

const VPS: Tool[] = [T.hostinger, T.nginx, T.pm2];

export const WORK: Record<string, WorkDetail> = {
  'bodookhrang.com': {
    banner: 'assets/work/bodookhrang-banner.webp',
    icon: 'assets/work/bodookhrang.webp',
    platforms: ['Website'],
    features: [
      'Every product opens from its own share card in the hero',
      'Services, tech stack, process and team on one page',
      'Contact form that lands in the support inbox',
      'Scroll-driven motion in pure CSS',
    ],
    stack: [
      { title: 'Website', tools: [T.next, T.react, T.ts, T.tailwind, T.zod] },
      { title: 'Email & hosting', tools: [T.zepto, ...VPS] },
    ],
  },
  'okhrang.com': {
    banner: 'assets/work/okhrang-banner.webp',
    icon: 'assets/work/okhrang.webp',
    platforms: ['Web app', 'Android app', 'Store', 'Admin console'],
    features: [
      'OkhranGPT: chat in eight Northeast languages',
      'OkhranGTR: translation between all of them',
      'OkhranGSB: the Bodo dictionary',
      'Transliteration and text to speech',
      'A storefront with online payments',
      'Public profiles for every user',
    ],
    stack: [
      { title: 'Web app', tools: [T.next, T.react, T.ts, T.tailwind, T.radix, T.zod] },
      { title: 'Language A.I.', tools: [T.sarvam] },
      { title: 'Backend', tools: [T.supabase, T.postgres, T.r2, T.razorpay] },
      { title: 'Android & hosting', tools: [T.android, ...VPS] },
    ],
  },
  'schoolerp.okhrang.com': {
    banner: 'assets/work/schoolerp-banner.webp',
    icon: 'assets/work/schoolerp.webp',
    platforms: ['Web app', 'Android app', 'A subdomain per school'],
    features: [
      'Admissions to transfer certificate on one student record',
      'Attendance, examinations and report cards',
      'Fees, library and certificates',
      'Transport with live bus GPS',
      'A native app per school for students, parents and teachers',
      '30+ modules in all',
    ],
    stack: [
      { title: 'Web app', tools: [T.next, T.react, T.ts, T.tailwind, T.shadcn, T.gsap, T.leaflet, T.zod] },
      { title: 'Mobile app', tools: [T.expo, T.rn, T.query, T.android] },
      { title: 'Backend', tools: [T.supabase, T.postgres, T.r2, T.turbo] },
      { title: 'Hosting', tools: VPS },
    ],
  },
  'dreamsbodoland.com': {
    banner: 'assets/work/dreams-banner.webp',
    icon: 'assets/work/dreams.webp',
    platforms: ['Website', 'Staff CRM', 'Client portal'],
    features: [
      'A scroll-driven site for a Kokrajhar construction company',
      'Leads, estimates, sites, wages and bills for the staff',
      'Every client follows their own project, from survey to handover',
      'One Google sign-in, with roles deciding who sees what',
      'Excel exports of the books',
    ],
    stack: [
      { title: 'Website', tools: [T.next, T.react, T.ts, T.tailwind, T.gsap, T.radix] },
      { title: 'CRM & portal', tools: [T.supabase, T.postgres, T.google, T.r2, T.zod] },
      { title: 'Hosting', tools: VPS },
    ],
  },
  'nbsskokrajhar.com': {
    banner: 'assets/work/nbss-banner.webp',
    icon: 'assets/work/nbss.webp',
    platforms: ['Website', 'Operations portal', 'Android app'],
    features: [
      'Guards start and end duty from the app',
      'One-tap SOS that rings every supervisor',
      'Supervisors watch live posts on a map',
      'Clients see their own site and guards',
      'Careers and recruitment on the website',
    ],
    stack: [
      { title: 'Website & portal', tools: [T.next, T.react, T.ts, T.tailwind, T.shadcn, T.gsap, T.leaflet, T.zod] },
      { title: 'Mobile app', tools: [T.expo, T.rn, T.maplibre, T.android] },
      { title: 'Backend', tools: [T.supabase, T.postgres, T.r2] },
      { title: 'Hosting', tools: VPS },
    ],
  },
  'flopshop.vercel.app': {
    banner: 'assets/projects/12.webp',
    icon: 'assets/work/flopshop.webp',
    platforms: ['Installable PWA', 'Admin console', 'Delivery view'],
    features: [
      'A hostel snack shop for late-night orders',
      'Students order, delivery partners deliver',
      'Admins run stock, orders and sales charts',
      'Push notifications when an order moves',
    ],
    stack: [
      { title: 'App', tools: [T.next, T.react, T.ts, T.tailwind, T.zod, T.pwa] },
      { title: 'Backend & hosting', tools: [T.supabaseCloud, T.postgres, T.vercel] },
    ],
  },
  'crewspace-ai.vercel.app': {
    banner: 'assets/projects/11.webp',
    icon: 'assets/work/crewspace.webp',
    platforms: ['Web dashboard', 'Chrome extension'],
    features: [
      'Design an agent on a drag-and-drop canvas',
      'The extension runs it in a side panel on any page',
      'It clicks, types, scrolls, navigates and translates for you',
      'Role, model, tools and memory set per agent',
    ],
    stack: [
      { title: 'Dashboard', tools: [T.next, T.react, T.ts, T.tailwind, T.shadcn, T.xyflow] },
      { title: 'Extension', tools: [T.chrome, T.js] },
      { title: 'A.I. & backend', tools: [T.gemini, T.groq, T.supabaseCloud, T.vercel] },
    ],
  },
  'ku-app.in': {
    banner: 'assets/projects/2.webp',
    icon: 'assets/work/ku.webp',
    platforms: ['Web app', 'Installable PWA'],
    features: [
      'Leave management for university staff',
      'Departments, class routines and the academic calendar',
      'Notifications to staff',
      'Access controlled by role',
    ],
    stack: [
      { title: 'Web app', tools: [T.next, T.react, T.ts, T.tailwind, T.shadcn, T.zod, T.pwa] },
      { title: 'Backend', tools: [T.supabaseCloud, T.postgres, T.r2] },
      { title: 'Hosting', tools: VPS },
    ],
  },
};

/** The row's link, minus scheme, www and slashes: the same in both tables. */
export function workKey(r: { url?: string | null; video?: string | null; image?: string | null }): string {
  const raw = r.url || r.video || r.image || '';
  return raw
    .replace(/^https?:\/\//, '')
    .replace(/^www\./, '')
    .replace(/^\/+|\/+$/g, '')
    .toLowerCase();
}

/** Names the CMS writes in its `stack` text, mapped to a logo. */
const BY_NAME: Record<string, Tool> = {
  'next.js': T.next,
  react: T.react,
  tailwind: T.tailwind,
  supabase: T.supabaseCloud,
  sarvam: T.sarvam,
  expo: T.expo,
  pwa: T.pwa,
  vercel: T.vercel,
  js: T.js,
  php: { name: 'PHP', icon: siPhp },
  css: { name: 'CSS', icon: siCss },
  'final cut pro': { name: 'Final Cut Pro', img: 'assets/skills/final-cut-pro.png' },
  premiere: { name: 'Premiere Pro' },
  davinci: { name: 'DaVinci Resolve', icon: siDavinciresolve },
  capcut: { name: 'CapCut', img: 'assets/skills/capcut.png' },
  figma: { name: 'Figma', icon: siFigma },
  canva: { name: 'Canva', img: 'assets/skills/canva.png' },
  krita: { name: 'Krita', icon: siKrita },
};

/** "Premiere · DaVinci" → two tools. Unknown names keep the spark mark. */
export function toolsFromStack(stack: string | null | undefined): Tool[] {
  if (!stack) return [];
  return stack
    .split(/\s*[·,]\s*/)
    .filter(Boolean)
    .map((name) => BY_NAME[name.toLowerCase()] ?? { name });
}
