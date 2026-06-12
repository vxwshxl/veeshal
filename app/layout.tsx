import type { Metadata, Viewport } from 'next';

export const metadata: Metadata = {
  metadataBase: new URL('https://veeshal.me'),
  title: 'Veeshal D. Bodosa - Crafting Code & Cinematics',
  description:
    'Portfolio of Veeshal D. Bodosa - A creative developer and video editor blending code and cinematics to craft immersive digital experiences.',
  keywords:
    'Veeshal D. Bodosa, Web Developer, Video Editor, Portfolio, React Native, Flutter, Cinematics, Creative Developer, India',
  authors: [{ name: 'Veeshal D. Bodosa' }],
  robots: 'index, follow',
  manifest: '/site.webmanifest',
  icons: {
    icon: [
      { url: '/favicon-96x96.png', type: 'image/png', sizes: '96x96' },
      { url: '/favicon.svg', type: 'image/svg+xml' },
    ],
    shortcut: '/favicon.ico',
    apple: { url: '/apple-touch-icon.png', sizes: '180x180' },
  },
};

export const viewport: Viewport = {
  themeColor: '#111110',
  width: 'device-width',
  initialScale: 1,
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en">
      <head>
        <link
          href="https://api.fontshare.com/v2/css?f[]=clash-display@500,600,700&f[]=general-sans@400,500,600,700&display=swap"
          rel="stylesheet"
        />
        <link
          href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,400;0,500;0,700;1,400;1,500&display=swap"
          rel="stylesheet"
        />
        <noscript>
          {/* eslint-disable-next-line react/no-danger */}
          <style
            dangerouslySetInnerHTML={{
              __html:
                '.page{opacity:1!important}.loader,.cursor-dot,.cursor-ring{display:none!important}body.is-loading{overflow:auto;height:auto}',
            }}
          />
        </noscript>
      </head>
      <body>
        {children}
      </body>
    </html>
  );
}
