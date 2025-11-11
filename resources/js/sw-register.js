// Register service worker for PWA capabilities
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker
      .register('/sw.js', { scope: '/map' })
      .then(reg => console.log('SW registered (scope=/map):', reg))
      .catch(err => console.warn('SW registration failed:', err));
  });
}