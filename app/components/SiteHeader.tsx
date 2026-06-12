// Port of partials/site_header.php. base is "/" site-root; active highlights a tab.
export default function SiteHeader({ active = '', base = '/' }: { active?: string; base?: string }) {
  const root = base;
  return (
    <header className="site-header">
      <a className="brand" href={root}><img src={`${root}assets/logo.svg`} alt="vee logo" /></a>
      <nav>
        <ul>
          <li><a href={root} className={active === 'home' ? 'active' : undefined}>Home</a></li>
          <li><a href={`${root}#intro`}>Intro</a></li>
          <li><a href={`${root}projects`} className={active === 'projects' ? 'active' : undefined}>Projects</a></li>
          <li><a href={`${root}timeline`} className={active === 'timeline' ? 'active' : undefined}>Timeline</a></li>
          <li><a href={`${root}chaicode`} className={active === 'chaicode' ? 'active' : undefined}>ChaiCode</a></li>
          <li><a href={`${root}blogs`} className={active === 'blogs' ? 'active' : undefined}>Blogs</a></li>
          <li><a href={`${root}#contact`}>Contact</a></li>
          <li><a href={`${root}#about`}>About</a></li>
        </ul>
      </nav>
      <div className="header-flag"><img src={`${root}assets/india.svg`} alt="Made in India" /></div>
    </header>
  );
}
