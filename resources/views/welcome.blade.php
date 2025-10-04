<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>sleep / profile · zero</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

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

        /* stars */
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
        /* stripped header (no login) */
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

        /* etiquette block */
        .etiquette{display:grid;gap:14px}
        .etiquette .bad,.etiquette .good{
            border:1px solid rgba(255,255,255,.12);
            border-left:6px solid;
            border-radius:16px;
            padding:14px 16px;
            background:var(--glass);
            box-shadow:var(--shadow);
        }
        .etiquette .bad{ border-left-color:#ff6b6b22; }
        .etiquette .good{ border-left-color:#7dffa922; }
        .etiquette pre{
            margin:8px 0 0; white-space:pre-wrap; word-break:break-word;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono","Courier New", monospace;
            font-size:13px; line-height:1.5; color:#e6e8ff;
            background: rgba(0,0,0,.25); padding:10px; border-radius:12px; border:1px solid rgba(255,255,255,.08);
        }

        footer{display:flex;justify-content:center;gap:12px;padding:18px 0;opacity:.8;font-size:12px}

        .toggle{inline-size:40px;block-size:40px;display:inline-grid;place-items:center;border-radius:12px;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.04);color:#e7e7ff;cursor:pointer;transition:transform .1s ease,background .25s ease,border .25s ease}
        .toggle:hover{transform:translateY(-1px);background:rgba(255,255,255,.08)}
        .toggle:focus-visible{outline:none;box-shadow:var(--ring)}

        .copy{
            display:inline-flex;align-items:center;gap:8px;padding:10px 12px;border-radius:999px;border:1px solid rgba(255,255,255,.18);
            background:rgba(255,255,255,.06);cursor:pointer;user-select:none
        }
        .copy:focus-visible{outline:none;box-shadow:var(--ring)}

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
            <span class="tag">midnight / safe space</span>
            <h1>hi, i’m romeo—most call me <strong style="color:var(--hush)">zero</strong>.</h1>
            <p class="lead" id="ageText">loading age…</p>
            <p class="lead">
                developer, language magpie, room-gremlin. soft social battery: i thrive 1–4 people at a time.
                i’m not an everyday texter; trust is built slow. always down to meet good humans.
            </p>
            <div class="actions">
                <a class="btn" href="#about">About</a>
                <a class="btn alt" href="#langs">Languages</a>
                <a class="btn ghost" href="#rig">Tech / Rig</a>
                <a class="btn" href="#reach">Reach me</a>
                <button class="toggle" type="button" title="toggle soft rain" aria-pressed="false" id="rainToggle">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 19l2-4m3 4l2-4m3 4l2-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M6 10a6 6 0 1112 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </section>

        <!-- ABOUT + MOOD -->
        <section class="grid" id="about">
            <article class="card">
                <h2>about me</h2>
                <div class="rows">
                    <div class="row">
                        <div class="k">names</div>
                        <div class="v">romeo / zero (zero for most, romeo for close friends)</div>
                    </div>
                    <div class="row">
                        <div class="k">dev stack</div>
                        <div class="v">html · css · javascript · c# · c++ · python (+ a handful of strays)</div>
                    </div>
                    <div class="row">
                        <div class="k">roots</div>
                        <div class="v">born & raised partly in the netherlands; lived in lebanon from age 5–12; back in the netherlands since</div>
                    </div>
                    <div class="row">
                        <div class="k">travel</div>
                        <div class="v">first solo trip: japan (jun ’24). then usa (may ’25) to meet new friends from gta rp. would do it again.</div>
                    </div>
                    <div class="row">
                        <div class="k">beliefs</div>
                        <div class="v">atheistic. curious about culture & language; not currently religious.</div>
                    </div>
                    <div class="row">
                        <div class="k">social energy</div>
                        <div class="v">small-group creature (max 4). bigger crowds turn me quiet. dm me; replies may be slow but honest.</div>
                    </div>
                    <div class="row">
                        <div class="k">now</div>
                        <div class="v">a little depressed sometimes; focused on work, study, and learning. nights are for code, games, and rain sounds.</div>
                    </div>
                </div>
            </article>

            <aside class="card" aria-label="current mood">
                <h2>current atmosphere</h2>
                <div class="rows">
                    <div class="row"><div class="k">feeling</div><div class="v">heavy but present; taking it gently</div></div>
                    <div class="row"><div class="k">listening</div><div class="v">wuwa ost, lo-fi, rain + soft piano</div></div>
                    <div class="row"><div class="k">single-player</div><div class="v">silent hill f · hollow knight: silksong · etc.</div></div>
                    <div class="row"><div class="k">multiplayer</div><div class="v">wuthering waves · valorant (ex-genshin ar60)</div></div>
                </div>
                <p style="margin-top:12px;font-size:12px;opacity:.75">
                    p.s. rough nights happen. reach out to a friend, a helpline, or brew tea and breathe—whatever keeps you here.
                </p>
            </aside>
        </section>

        <!-- LANGUAGES -->
        <section class="card" id="langs">
            <h2>languages</h2>
            <div class="pills" role="list">
                <div class="pill" role="listitem"><span class="dot lilac"></span> english — primary</div>
                <div class="pill" role="listitem"><span class="dot glow"></span> dutch — primary</div>
                <div class="pill" role="listitem"><span class="dot rose"></span> french — semi-fluent</div>
                <div class="pill" role="listitem"><span class="dot lilac"></span> arabic — conversational (speaking)</div>
                <div class="pill" role="listitem"><span class="dot glow"></span> japanese — learning (JLPT N5)</div>
            </div>
        </section>

        <!-- TECH / RIG -->
        <section class="card" id="rig">
            <h2>tech & setup</h2>
            <div class="rows">
                <div class="row"><div class="k">pc</div><div class="v">ryzen 9 7900x · asus rog strix b650e-f · rog strix thor 1200w · radeon rx 9070xt</div></div>
                <div class="row"><div class="k">vibe</div><div class="v">messy room, many figures + manga, snacks within reach. tech loves me back.</div></div>
                <div class="row"><div class="k">server</div><div class="v">collecting parts; build in progress.</div></div>
            </div>
        </section>

        <!-- REACH ME -->
        <section class="card" id="reach">
            <h2>reach me</h2>
            <div class="rows" style="margin-bottom:10px">
                <div class="row">
                    <div class="k">discord</div>
                    <div class="v">
                        <span id="discordHandle">zerotwo.02</span>
                        <button class="copy" id="copyDiscord" aria-label="copy discord handle">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <rect x="9" y="9" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.5"/>
                                <rect x="4" y="4" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                            copy
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="k">site</div>
                    <div class="v">
                        <a href="https://zerotwolove.nl" target="_blank" rel="noopener noreferrer" class="link" style="padding:0;border:none">
                            zerotwolove.nl
                        </a>
                    </div>
                </div>
            </div>

            <div class="etiquette">
                <div class="bad">
                    <strong>❌ don’t do this</strong>
                    <pre>Keith — 2:15 PM: hi
Tim — 2:19 PM: ...?
Keith — 2:20 PM: what time was that thing again?
Tim — 2:20 PM: 3:30</pre>
                    <p style="margin-top:8px;opacity:.85">
                        one-word openers slow things down and make folks wait. just ask the thing. 🙃
                    </p>
                </div>
                <div class="good">
                    <strong>✅ do this instead</strong>
                    <pre>Dawn — 2:15 PM: hey! what time was that thing?
Tim — 2:15 PM: 3:30
Dawn — 2:15 PM: legend, thanks!</pre>
                    <p style="margin-top:8px;opacity:.9">
                        pleasantries are great—<em>plus</em> the actual question. i reply better to clear asks than to “hi”.</p>
                    <p style="margin-top:6px;opacity:.9">
                        examples:
                        <br>• “yo zero, free this week to duo in valorant? tue or wed night works?”
                        <br>• “hi! curious how you set up your 7900x undervolt—mind sharing?”
                        <br>• “hey, i’m learning jp too (n5). want to practice 10 min voice sometime?”
                    </p>
                </div>
            </div>
        </section>

        <!-- CONTACT CTA -->
        <section class="card" id="contact">
            <h2>moonlight messages</h2>
            <p>always interested in meeting new people & making friends—slow burn. start with context, not just “hi”.</p>
            <div class="actions" style="margin-top:14px">
                <a class="btn alt" href="#reach">discord details</a>
                <a class="btn ghost" href="https://zerotwolove.nl" target="_blank" rel="noopener noreferrer">waifu site</a>
            </div>
        </section>
    </main>

    <footer>
        <span>made at an unreasonable hour</span> ·
        <span>be gentle with yourself</span>
    </footer>
</div>

<script>
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

    // dynamic age & countdown to next birthday (Oct 11, 2003)
    (function(){
        const target = document.getElementById('ageText');
        if(!target) return;
        const birth = new Date(Date.UTC(2003, 9, 11)); // 9 = October
        const today = new Date();
        function atNoon(d){return new Date(d.getFullYear(), d.getMonth(), d.getDate(), 12, 0, 0)}
        const now = atNoon(today);

        function yearsOld(on){
            let y = on.getFullYear() - birth.getFullYear();
            const hadBirthday = (on.getMonth() > 9) || (on.getMonth() === 9 && on.getDate() >= 11);
            if(!hadBirthday) y -= 1;
            return y;
        }
        function nextBirthdayAfter(on){
            const y = on.getMonth() > 9 || (on.getMonth() === 9 && on.getDate() > 11)
                ? on.getFullYear() + 1 : on.getFullYear();
            return new Date(y, 9, 11, 12, 0, 0);
        }

        const age = yearsOld(now);
        const nextB = nextBirthdayAfter(now);
        const msPerDay = 24*60*60*1000;
        const days = Math.ceil((atNoon(nextB) - now) / msPerDay);

        if(days === 0){
            target.textContent = `i’m ${age + 1} — birthday today (oct 11).`;
        } else {
            const s = days === 1 ? "day" : "days";
            target.textContent = `i’m ${age} — turning ${age + 1} on oct 11 (${days} ${s}).`;
        }
    })();

    // copy discord handle
    (function(){
        const btn = document.getElementById('copyDiscord');
        const span = document.getElementById('discordHandle');
        if(!btn || !span) return;
        btn.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(span.textContent.trim());
                btn.innerHTML = 'copied ✓';
                setTimeout(()=>{ btn.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <rect x="9" y="9" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.5"/>
              <rect x="4" y="4" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.5"/>
            </svg> copy`; }, 1200);
            } catch(e){
                btn.innerHTML = 'press ⌘/Ctrl+C';
                setTimeout(()=>{ btn.innerHTML = 'copy'; }, 1500);
            }
        }, {passive:true});
    })();
</script>
</body>
</html>
