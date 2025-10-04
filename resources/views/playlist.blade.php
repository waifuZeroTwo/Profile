<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>sleep playlist · zero</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Midnight Glass Styles -->
    <style>
        :root{
            --ink:#0b0c12; --ink-2:#121320;
            --mist:#b8b9c6; --hush:#dcdcef;
            --lilac:#a09bff; --rose:#ffa5c8; --glow:#9ad5ff;
            --card: rgba(18,19,32,.55); --glass: rgba(255,255,255,.06);
            --ring: 0 0 0 3px rgba(160,155,255,.35);
            --radius: 20px; --shadow: 0 20px 60px -20px rgba(3,8,30,.8);
            --speed: 28s;
        }
        *{box-sizing:border-box}
        html,body{height:100%}
        body{
            margin:0; color:var(--mist);
            font-family:"Instrument Sans", ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            background: radial-gradient(1200px 800px at 20% -10%, #1a1b2f 0%, #0b0c12 60%) fixed;
            overflow-x:hidden; -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale;
        }

        /* layered starfield */
        .stars,.stars:before,.stars:after{content:"";position:fixed;inset:0;background-repeat:repeat;pointer-events:none}
        .stars{
            background-image:
                radial-gradient(1px 1px at 20% 30%, rgba(154,213,255,.7) 0 60%, transparent 61%),
                radial-gradient(1px 1px at 70% 80%, rgba(255,165,200,.65) 0 60%, transparent 61%),
                radial-gradient(1px 1px at 40% 60%, rgba(255,255,255,.6) 0 60%, transparent 61%);
            background-size: 600px 600px, 700px 700px, 500px 500px;
            animation: drift var(--speed) linear infinite; opacity:.5;
        }
        .stars:before{
            background-image:
                radial-gradient(1px 1px at 30% 10%, rgba(160,155,255,.7) 0 60%, transparent 61%),
                radial-gradient(1px 1px at 80% 50%, rgba(255,255,255,.6) 0 60%, transparent 61%);
            background-size: 900px 900px, 800px 800px;
            animation: drift calc(var(--speed) * 1.6) linear infinite reverse; opacity:.35;
        }
        .stars:after{
            background-image: radial-gradient(1px 1px at 50% 40%, rgba(154,213,255,.8) 0 60%, transparent 61%);
            background-size: 1000px 1000px;
            animation: drift calc(var(--speed) * 2.2) linear infinite; opacity:.25;
        }
        @keyframes drift{from{transform:translateY(0)}to{transform:translateY(-300px)}}
        @media (prefers-reduced-motion:reduce){.stars,.stars:before,.stars:after{animation:none}}

        /* layout */
        .shell{min-height:100dvh;display:grid;grid-template-rows:auto 1fr auto;padding:28px 20px}
        /* stripped header (no auth/login) */
        header{max-width:1040px;margin-inline:auto;width:100%;height:8px}

        main{max-width:1040px;margin:24px auto;width:100%;display:grid;gap:18px}
        .hero{
            position:relative;overflow:hidden;border-radius:clamp(16px,2vw,28px);
            background: linear-gradient(160deg, rgba(255,255,255,.04), rgba(255,255,255,.02)), var(--card);
            box-shadow:var(--shadow);padding:clamp(24px,3.5vw,44px);border:1px solid rgba(255,255,255,.12);
            backdrop-filter:blur(10px);isolation:isolate
        }
        .veil{position:absolute;inset:-30% -10% auto -10%;height:70%;background:
            radial-gradient(600px 300px at 20% 40%, rgba(160,155,255,.35) 0%, transparent 60%),
            radial-gradient(500px 250px at 80% 20%, rgba(255,165,200,.22) 0%, transparent 60%);
            filter:blur(20px);z-index:-1;pointer-events:none}
        h1{margin:0;font-weight:600;line-height:1.15;font-size:clamp(28px,3.2vw,54px);color:var(--hush);letter-spacing:.2px}
        .tag{display:inline-flex;align-items:center;gap:8px;padding:6px 10px;border-radius:999px;border:1px dashed rgba(255,255,255,.18);background:rgba(255,255,255,.03);font-size:12px;color:#d0d1e4;text-transform:uppercase;letter-spacing:.25em}
        .lead{color:var(--mist);max-width:62ch;margin:14px 0 0;font-size:clamp(14px,1.4vw,18px);opacity:.9}
        .actions{display:flex;flex-wrap:wrap;gap:10px;margin-top:22px}
        .btn{--bg:rgba(160,155,255,.16);--bd:rgba(160,155,255,.4);--fg:#e9e9ff;display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:12px 16px;border-radius:999px;border:1px solid var(--bd);color:var(--fg);background:var(--bg);text-decoration:none;font-weight:600;font-size:14px;letter-spacing:.2px;transition:transform .1s ease,background .25s ease,border .25s ease,box-shadow .25s ease;box-shadow:0 12px 30px -18px rgba(160,155,255,.8)}
        .btn:hover{transform:translateY(-1px);background:rgba(160,155,255,.24)}
        .btn:focus-visible{outline:none;box-shadow:var(--ring)}
        .btn.alt{--bg:rgba(255,165,200,.15);--bd:rgba(255,165,200,.5);--fg:#fff1f6;box-shadow:0 12px 32px -18px rgba(255,165,200,.8)}
        .btn.ghost{--bg:rgba(255,255,255,.06);--bd:rgba(255,255,255,.22);--fg:#e8e9f7;box-shadow:none}
        .link{color:var(--hush);padding:0 6px;border-radius:10px;border:1px solid transparent;text-decoration:none}

        .grid{display:grid;gap:18px;grid-template-columns:1fr}
        @media (min-width:960px){.grid{grid-template-columns:1.6fr .9fr}}

        .card{background:linear-gradient(180deg, rgba(255,255,255,.04), rgba(255,255,255,.02)), var(--card);border:1px solid rgba(255,255,255,.1);border-radius:var(--radius);padding:20px;box-shadow:var(--shadow);backdrop-filter:blur(8px)}
        .card h2{margin:0 0 8px;color:var(--hush);font-size:clamp(18px,1.6vw,22px);font-weight:600;letter-spacing:.2px}
        .card p{margin:8px 0 0;line-height:1.6;opacity:.95}

        .pills{display:grid;gap:10px;margin-top:10px;grid-template-columns:repeat(auto-fit,minmax(180px,1fr))}
        .pill{display:flex;align-items:center;gap:10px;padding:12px 14px;border-radius:14px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);box-shadow:inset 0 1px 0 rgba(255,255,255,.12);font-size:14px}
        .dot{width:8px;height:8px;border-radius:999px;box-shadow:0 0 10px 2px currentColor}
        .lilac{color:var(--lilac)} .rose{color:var(--rose)} .glow{color:var(--glow)}

        .rows{display:grid;gap:10px}
        .row{display:flex;gap:10px;align-items:flex-start}
        .k{min-width:130px;opacity:.75;font-size:12px;text-transform:uppercase;letter-spacing:.22em}
        .v{flex:1}

        /* player tabs */
        .tabs{display:flex;gap:8px;flex-wrap:wrap;margin-top:10px}
        .tab{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border:1px solid rgba(255,255,255,.16);background:rgba(255,255,255,.06);border-radius:999px;cursor:pointer;user-select:none;font-weight:600}
        .tab[aria-selected="true"]{border-color:rgba(160,155,255,.45);background:rgba(160,155,255,.22);color:#ecebff}

        .player{aspect-ratio:16/9;border-radius:18px;overflow:hidden;border:1px solid rgba(255,255,255,.12);background:#0d0f1a}
        iframe{display:block;width:100%;height:100%;border:0}

        footer{display:flex;justify-content:center;gap:12px;padding:18px 0;opacity:.8;font-size:12px}

        .toggle{inline-size:40px;block-size:40px;display:inline-grid;place-items:center;border-radius:12px;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.04);color:#e7e7ff;cursor:pointer;transition:transform .1s ease,background .25s ease,border .25s ease}
        .toggle:hover{transform:translateY(-1px);background:rgba(255,255,255,.08)}
        .toggle:focus-visible{outline:none;box-shadow:var(--ring)}

        ::selection{background:rgba(160,155,255,.28);color:white}
    </style>
</head>
<body>
<div class="stars" aria-hidden="true"></div>

<div class="shell">
    <header></header>

    <main>
        <!-- HERO -->
        <section class="hero">
            <div class="veil" aria-hidden="true"></div>
            <span class="tag">afterglow / sleep</span>
            <h1>sleep playlist</h1>
            <p class="lead">
                ease into nightfall with curated ambient—lilac reverb, soft tape hiss, and gentle rain. headphones on, lights low.
            </p>
            <div class="actions">
                <a class="btn" href="#player">Open Player</a>
                <a class="btn alt" href="#notes">Listening Notes</a>
                <a class="btn ghost" href="{{ route('journal') }}">Dream Journal</a>
                <button class="toggle" type="button" title="toggle soft rain lines" aria-pressed="false" id="rainToggle">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 19l2-4m3 4l2-4m3 4l2-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M6 10a6 6 0 1112 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </section>

        <!-- PLAYER + FEATURED -->
        <section class="grid" id="player" aria-label="playlist player and features">
            <article class="card">
                <h2>player</h2>
                <div class="tabs" role="tablist" aria-label="choose source">
                    <button class="tab" role="tab" aria-selected="true" aria-controls="pane-spotify" id="tab-spotify">Spotify</button>
                    <button class="tab" role="tab" aria-selected="false" aria-controls="pane-youtube" id="tab-youtube">YouTube</button>
                    <a class="tab" href="{{ route('messages') }}" role="link">Moonlight Message</a>
                </div>

                <!-- Spotify -->
                <div id="pane-spotify" class="player" role="tabpanel" aria-labelledby="tab-spotify">
                    <!-- Replace the src with your actual Spotify playlist/embed -->
                    <iframe
                        title="Sleep — Spotify"
                        loading="lazy"
                        src="https://open.spotify.com/embed/playlist/37i9dQZF1DWZdL3c9RoJ8T?utm_source=generator&theme=0"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture">
                    </iframe>
                </div>

                <!-- YouTube -->
                <div id="pane-youtube" class="player" role="tabpanel" aria-labelledby="tab-youtube" hidden>
                    <!-- Replace the src with your actual YouTube playlist/embed -->
                    <iframe
                        title="Sleep — YouTube"
                        loading="lazy"
                        src="https://www.youtube.com/embed/videoseries?list=PL55713C70BA91BD6E"
                        allow="autoplay; encrypted-media; picture-in-picture; web-share">
                    </iframe>
                </div>
            </article>

            <aside class="card" aria-label="featured waves">
                <h2>featured waves</h2>
                <div class="pills" role="list">
                    <div class="pill" role="listitem"><span class="dot rose"></span> opal echoes — glimmers under rain</div>
                    <div class="pill" role="listitem"><span class="dot lilac"></span> moonlit loops — airy synth chords</div>
                    <div class="pill" role="listitem"><span class="dot glow"></span> twilight pulses — low warm thrum</div>
                    <div class="pill" role="listitem"><span class="dot lilac"></span> stellar bloom — strings into hush</div>
                </div>
                <p style="margin-top:10px;opacity:.9">
                    tip: set volume just above silence; let breathing sync with the pads.
                </p>
            </aside>
        </section>

        <!-- TONIGHT'S TRACKLIST + NOTES -->
        <section class="card" id="notes">
            <h2>tonight’s atmosphere</h2>
            <div class="rows">
                <div class="row"><div class="k">energy</div><div class="v">tender + expansive, fog over neon skylines</div></div>
                <div class="row"><div class="k">highlight</div><div class="v">track 04 dissolves into distant train field-recording</div></div>
                <div class="row"><div class="k">afterglow</div><div class="v">let the last note fade before turning toward dreams</div></div>
            </div>
            <p style="margin-top:12px">
                ritual: dim lights · phone on focus · three slow breaths · press play.
            </p>
        </section>

        <!-- SMALL PRINT -->
        <section class="card" aria-label="info">
            <h2>credits & links</h2>
            <p>
                curated by <strong style="color:var(--hush)">zero</strong>.
                if a link fails, switch tab above. want a track added? send a clear ask (context beats “hi”).<br>
                site: <a class="link" href="https://zerotwolove.nl" target="_blank" rel="noopener">zerotwolove.nl</a> ·
                discord: <span class="link" style="padding:0;border:none">zerotwo.02</span>
            </p>
        </section>
    </main>

    <footer>
        <span>made at an unreasonable hour</span> ·
        <span>sleep gently</span>
    </footer>
</div>

<script>
    // tabs: spotify / youtube
    (function(){
        const tabs = Array.from(document.querySelectorAll('.tab[role="tab"]'));
        const panes = {
            spotify: document.getElementById('pane-spotify'),
            youtube: document.getElementById('pane-youtube')
        };
        function select(which){
            tabs.forEach(t => t.setAttribute('aria-selected', String(t.id === 'tab-'+which)));
            Object.keys(panes).forEach(k => panes[k].hidden = (k !== which));
        }
        tabs.forEach(t => t.addEventListener('click', () => {
            if (t.id === 'tab-spotify') select('spotify');
            if (t.id === 'tab-youtube') select('youtube');
        }, {passive:true}));
    })();

    // toggle visual rain lines (no audio)
    (function(){
        const btn = document.getElementById('rainToggle');
        if(!btn) return;
        btn.addEventListener('click', () => {
            const on = btn.getAttribute('aria-pressed') === 'true';
            btn.setAttribute('aria-pressed', String(!on));
            document.body.style.background = !on
                ? 'radial-gradient(1200px 800px at 20% -10%, #1a1b2f 0%, #0b0c12 60%), repeating-linear-gradient(180deg, rgba(160,155,255,.05) 0 2px, transparent 2px 4px)'
                : 'radial-gradient(1200px 800px at 20% -10%, #1a1b2f 0%, #0b0c12 60%)';
        }, {passive:true});
    })();
</script>
</body>
</html>
