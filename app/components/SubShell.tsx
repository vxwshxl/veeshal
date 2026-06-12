import Loader from './Loader';
import Chrome from './Chrome';
import SiteHeader from './SiteHeader';
import SiteFooter from './SiteFooter';

/**
 * The shared subpage skeleton used by timeline / blogs / chaicode / errors:
 * #home.home > .homeContainer { loader + chrome + site_header + content }, then
 * site_footer inside #home (mirrors blogs/includes/header.php + footer.php).
 */
export default function SubShell({
  active = '',
  children,
}: {
  active?: string;
  children: React.ReactNode;
}) {
  return (
    <>
      <div id="home" className="home">
        <div className="homeContainer">
          <Loader />
          <Chrome />
          <SiteHeader active={active} base="/" />
          {children}
        </div>
        <SiteFooter base="/" />
      </div>
      <div id="toast-container"></div>
    </>
  );
}
