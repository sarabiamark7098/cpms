/**
 * Session heartbeat + browser-close cleanup.
 *
 * - Sends a ping every 60 seconds to keep active_sessions.updated_at fresh.
 * - Sends a beacon on pagehide so the session row is deleted immediately
 *   when the browser/tab closes, allowing instant re-login from any device.
 *
 * The PING_URL path is relative to the subdirectory pages (encoder/, socialwork/, admin/).
 */
(function () {
    var PING_URL = '../php/session_ping.php';
    var INTERVAL = 60000; // 60 seconds

    // ── Heartbeat ────────────────────────────────────────────────────────────
    var timer = setInterval(function () {
        $.ajax({
            type: 'POST',
            url:  PING_URL,
            data: { action: 'ping' },
            error: function () {
                // Ping failed — could be session expired; stop the timer
                clearInterval(timer);
            }
        });
    }, INTERVAL);

    // ── Browser / tab close cleanup ──────────────────────────────────────────
    // pagehide fires on every unload (navigation + close).
    // The PHP heartbeat in session_timeout.php re-inserts the row on the
    // very next page load if this was just a navigation, so there is no gap.
    window.addEventListener('pagehide', function () {
        if (navigator.sendBeacon) {
            var data = new URLSearchParams({ action: 'end' });
            navigator.sendBeacon(PING_URL, data);
        }
    });
}());
