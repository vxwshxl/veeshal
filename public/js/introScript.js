(function(__run){ if (document.readyState !== 'loading') __run(); else document.addEventListener('DOMContentLoaded', __run); })(function() {
    const frame = document.querySelector('.reel-frame');
    const stage = document.getElementById('imageContainer');
    const video = document.getElementById('introVideo');
    const videoContainer = document.getElementById('videoContainer');
    const playBtn = document.getElementById('playBtn');
    const pauseBtn = document.getElementById('pauseBtn');
    const playIcon = document.getElementById('playIcon');
    const pauseIcon = document.getElementById('pauseIcon');

    if (!frame || !stage || !video || !videoContainer) return;

    const slides = Array.from(stage.querySelectorAll('.reel-slide'));
    if (!slides.length) return;

    const wipe = stage.querySelector('.reel-wipe');
    const slugEls = Array.from(document.querySelectorAll('[data-reel-slug]'));
    const chips = Array.from(frame.querySelectorAll('.reel-chip'));

    // must match --reel-dwell in v2.css so the chip countdown lands on the cut
    const DWELL = 4600;
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    let current = Math.max(0, slides.findIndex((s) => s.classList.contains('is-active')));
    let timer = null;
    let held = false;      // pointer/focus is on the frame — hold this poster
    let inView = true;     // the reel is on screen
    let tabVisible = !document.hidden;

    /* ---------------- poster loop ---------------- */

    function playing() {
        return !video.paused && !video.ended;
    }

    function canCycle() {
        return !reduceMotion && !playing() && !held && inView && tabVisible && slides.length > 1;
    }

    function stopTimer() {
        clearTimeout(timer);
        timer = null;
    }

    function restartTimer() {
        stopTimer();
        if (canCycle()) timer = setTimeout(() => goTo(current + 1), DWELL);
    }

    function syncVideoSrc() {
        if (playing()) return; // never yank the source out from under a playing film
        const src = slides[current].dataset.video || '';
        if (src && video.getAttribute('src') !== src) {
            video.setAttribute('src', src); // preload="none", so this costs nothing yet
        }
    }

    function paintMeta() {
        const title = slides[current].dataset.title;
        if (title) slugEls.forEach((el) => { el.textContent = title; });
        chips.forEach((chip, i) => {
            const active = i === current;
            chip.classList.toggle('is-active', active);
            chip.setAttribute('aria-current', active ? 'true' : 'false');
        });
    }

    function goTo(index) {
        const next = ((index % slides.length) + slides.length) % slides.length;
        const prev = current;
        current = next;

        // drop every state class, flush, then re-apply so the CSS cuts restart
        slides.forEach((s) => s.classList.remove('is-active', 'is-leaving'));
        chips.forEach((c) => c.classList.remove('is-active'));
        if (wipe) wipe.classList.remove('is-sweeping');
        void stage.offsetWidth;

        if (prev !== next) slides[prev].classList.add('is-leaving');
        slides[next].classList.add('is-active');
        if (wipe && !reduceMotion && prev !== next) wipe.classList.add('is-sweeping');

        paintMeta();
        syncVideoSrc();
        restartTimer();
    }

    /* ---------------- playback ---------------- */

    function updateButtonIcon() {
        const on = playing();
        if (playIcon) playIcon.style.display = on ? 'none' : 'block';
        if (pauseIcon) pauseIcon.style.display = on ? 'block' : 'none';
    }

    function showVideo() {
        stage.style.display = 'none';
        videoContainer.style.display = 'block';
    }

    function showThumbnail() {
        stage.style.display = 'block';
        videoContainer.style.display = 'none';
    }

    // plays whichever film is on screen right now
    function playVideo() {
        if (playing()) return;
        stopTimer();
        syncVideoSrc();
        if (!video.getAttribute('src')) return;
        showVideo();
        video.muted = false;
        const attempt = video.play();
        if (!attempt || !attempt.catch) return;
        attempt.catch(() => {
            // autoplay policy blocked the unmuted start — fall back to muted
            video.muted = true;
            video.play().catch(() => {
                updateButtonIcon();
                showThumbnail();
                document.body.classList.remove('reel-playing');
                restartTimer();
            });
        });
    }

    function pauseVideo() {
        video.pause();
    }

    function togglePlayPause() {
        if (playing()) pauseVideo();
        else playVideo();
    }

    /* ---------------- wiring ---------------- */

    if (playBtn) playBtn.addEventListener('click', (e) => { e.stopPropagation(); playVideo(); });
    if (pauseBtn) pauseBtn.addEventListener('click', togglePlayPause);
    stage.addEventListener('click', playVideo);
    video.addEventListener('click', togglePlayPause);

    chips.forEach((chip) => {
        chip.addEventListener('click', () => {
            const target = Number(chip.dataset.reelGo);
            if (Number.isNaN(target)) return;
            if (target === current) { playVideo(); return; }
            goTo(target);
        });
    });

    video.addEventListener('play', () => {
        stopTimer();
        updateButtonIcon();
        showVideo();
        document.body.classList.add('reel-playing');
    });

    video.addEventListener('pause', () => {
        updateButtonIcon();
        showThumbnail();
        document.body.classList.remove('reel-playing');
        restartTimer(); // the poster loop picks back up where it left off
    });

    video.addEventListener('ended', () => {
        video.currentTime = 0;
        updateButtonIcon();
        showThumbnail();
        document.body.classList.remove('reel-playing');
        goTo(current + 1); // film's over — hand the loop to the next one
    });

    // the picker doubles as the pause control: hovering or tabbing into it
    // holds the current poster. The frame itself keeps cutting, so a mouse
    // resting on the film still gets the loop.
    const picker = frame.querySelector('.reel-picker');

    function hold(on) {
        held = on;
        frame.classList.toggle('is-held', on);
        if (on) stopTimer();
        else restartTimer();
    }

    if (picker) {
        picker.addEventListener('pointerenter', () => hold(true));
        picker.addEventListener('pointerleave', () => hold(false));
        picker.addEventListener('focusin', () => hold(true));
        picker.addEventListener('focusout', () => hold(false));
    }

    document.addEventListener('visibilitychange', () => {
        tabVisible = !document.hidden;
        if (tabVisible) restartTimer();
        else stopTimer();
    });

    if ('IntersectionObserver' in window) {
        new IntersectionObserver((entries) => {
            inView = entries[0].isIntersecting;
            if (inView) restartTimer();
            else stopTimer();
        }, { threshold: 0.15 }).observe(frame);
    }

    paintMeta();
    syncVideoSrc();
    restartTimer();
});
