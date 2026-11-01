/* ============================================================
   VEESHAL.ME — project popups (home + /projects)
   The cards and their <dialog>s are server-rendered; this only
   opens and closes them. Native showModal() gives the focus trap,
   Esc to close and focus back on the card.
   ============================================================ */
(function (run) { if (document.readyState !== 'loading') run(); else document.addEventListener('DOMContentLoaded', run); })(function () {
    const dialogs = document.querySelectorAll('dialog.work-dialog');
    if (!dialogs.length) return;

    function play(dialog) {
        const video = dialog.querySelector('video');
        if (video) video.play().catch(() => {});
    }

    document.addEventListener('click', (e) => {
        const opener = e.target.closest('[data-work-open]');
        if (opener) {
            const dialog = document.getElementById(opener.dataset.workOpen);
            if (!dialog) return;
            e.preventDefault();
            dialog.showModal();
            dialog.querySelector('.wd-sheet').scrollTop = 0;
            if (opener.hasAttribute('data-work-play')) play(dialog);
            return;
        }

        const player = e.target.closest('dialog [data-work-play]');
        if (player) {
            const dialog = player.closest('dialog');
            dialog.querySelector('.wd-sheet').scrollTo({ top: 0, behavior: 'smooth' });
            play(dialog);
            return;
        }

        const closer = e.target.closest('[data-work-close]');
        if (closer) closer.closest('dialog').close();
    });

    dialogs.forEach((dialog) => {
        /* The sheet fills the dialog, so a click landing on the dialog
           itself is a click on the backdrop. */
        dialog.addEventListener('click', (e) => {
            if (e.target === dialog) dialog.close();
        });
        dialog.addEventListener('close', () => {
            dialog.querySelectorAll('video').forEach((v) => v.pause());
        });
    });
});
