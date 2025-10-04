<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>moonlight messages · zero</title>

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
            --lilac:#a09bff; --rose:#ffa5c8; --glow:#9ad5ff; --tint:#cbb9ff;
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

        /* form */
        .form{display:grid;gap:12px;margin-top:8px}
        .row{display:grid;gap:8px}
        label{font-size:12px;text-transform:uppercase;letter-spacing:.22em;opacity:.8}
        .field{
            display:flex;align-items:center;gap:10px;
            background:rgba(255,255,255,.06);
            border:1px solid rgba(255,255,255,.12);
            border-radius:14px;padding:12px 14px
        }
        .field:focus-within{border-color:rgba(160,155,255,.45);box-shadow:var(--ring)}
        input, select, textarea{
            width:100%; border:0; outline:0; background:transparent; color:#e8e9f7; font:inherit
        }
        textarea{min-height:140px;resize:vertical}
        .meta{display:flex;justify-content:space-between;align-items:center;font-size:12px;opacity:.8}
        .pill{display:inline-flex;gap:8px;align-items:center;padding:8px 12px;border-radius:999px;border:1px solid rgba(255,255,255,.16);background:rgba(255,255,255,.06);cursor:pointer;user-select:none}
        .dot{width:8px;height:8px;border-radius:999px;box-shadow:0 0 10px 2px currentColor}
        .lilac{color:var(--lilac)} .rose{color:var(--rose)} .glow{color:var(--glow)} .tint{color:var(--tint)}

        .template-list{display:grid;gap:10px;margin-top:10px}
        .template{display:flex;gap:10px;align-items:flex-start;padding:12px;border-radius:14px;border:1px dashed rgba(255,255,255,.16);background:rgba(255,255,255,.04)}
        .template button{margin-left:auto}

        footer{display:flex;justify-content:center;gap:12px;padding:18px 0;opacity:.8;font-size:12px}

        .toggle{inline-size:40px;block-size:40px;display:inline-grid;place-items:center;border-radius:12px;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.04);color:#e7e7ff;cursor:pointer;transition:transform .1s ease,background .25s ease,border .25s ease}
        .toggle:hover{transform:translateY(-1px);background:rgba(255,255,255,.08)}
        .toggle:focus-visible{outline:none;box-shadow:var(--ring)}

        .link{color:var(--hush);padding:0 6px;border-radius:10px;border:1px solid transparent;text-decoration:none}
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
            <span class="tag">midnight / messages</span>
            <h1>moonlight messages</h1>
            <p class="lead">
                whisper a note into the dusk. soft gradients carry it—slow, kind, with just enough glow to be found.
            </p>
            <div class="actions">
                <a class="btn" href="#send">Compose</a>
                <a class="btn alt" href="#templates">Use a Template</a>
                <a class="btn ghost" href="{{ route('playlist') }}">Sleep Playlist</a>
                <a class="btn" href="{{ route('journal') }}">Dream Journal</a>
                <button class="toggle" type="button" title="toggle soft rain" aria-pressed="false" id="rainToggle">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 19l2-4m3 4l2-4m3 4l2-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M6 10a6 6 0 1112 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </section>

        <!-- COMPOSE + STATUS -->
        <section class="grid" id="send">
            <!-- Compose card -->
            <article class="card" aria-label="compose a message">
                <h2>send a whisper</h2>

                <form method="POST" action="{{ route('messages.store') }}" class="form" novalidate>
                    @csrf

                    <div class="row">
                        <label for="to">recipient</label>
                        <div class="field">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zM3 21a9 9 0 1118 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <input id="to" name="to" type="text" placeholder="e.g. @dawn or email" required autocomplete="off">
                        </div>
                    </div>

                    <div class="row">
                        <label for="topic">topic</label>
                        <div class="field">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <select id="topic" name="topic">
                                <option value="gratitude">gratitude</option>
                                <option value="check-in">check-in</option>
                                <option value="affirmation">affirmation</option>
                                <option value="invite">invite</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <label for="subject">subject</label>
                        <div class="field">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 6h16M4 12h10M4 18h7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <input id="subject" name="subject" type="text" placeholder="a tiny title (optional)" maxlength="80">
                        </div>
                    </div>

                    <div class="row">
                        <label for="body">message</label>
                        <div class="field" style="align-items:flex-start">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-top:2px" aria-hidden="true"><path d="M21 7L9 19l-6-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <textarea id="body" name="body" placeholder="write something kind…" maxlength="800" required></textarea>
                        </div>
                        <div class="meta">
                            <div style="display:flex;gap:8px;flex-wrap:wrap">
                                <span class="pill" data-chip="🌙"><span class="dot lilac"></span> moonsoft</span>
                                <span class="pill" data-chip="💌"><span class="dot rose"></span> gentle</span>
                                <span class="pill" data-chip="🫶"><span class="dot glow"></span> supportive</span>
                                <span class="pill" data-chip="✨"><span class="dot tint"></span> hopeful</span>
                            </div>
                            <span id="count">0 / 800</span>
                        </div>
                    </div>

                    <div class="actions" style="margin-top:6px">
                        <button class="btn alt" type="submit">Send</button>
                        <button class="btn ghost" type="button" id="previewBtn">Preview</button>
                        <button class="btn" type="reset">Clear</button>
                    </div>

                    <output id="preview" style="display:none;margin-top:12px">
                        <div class="template" aria-live="polite">
                            <strong style="color:var(--hush)">preview</strong>
                            <div id="previewText" style="white-space:pre-wrap;opacity:.95"></div>
                            <button class="btn" type="button" id="closePreview">close</button>
                        </div>
                    </output>
                </form>
            </article>

            <!-- Status / Tips -->
            <aside class="card" aria-label="signal status">
                <h2>signal status</h2>
                <div class="template-list" style="margin:8px 0 6px">
                    <div class="template">
                        <strong>mood</strong>
                        <div>open-hearted with shimmering anticipation</div>
                    </div>
                    <div class="template">
                        <strong>delivery</strong>
                        <div>messages glide out at local midnight with a soft chime</div>
                    </div>
                    <div class="template">
                        <strong>etiquette</strong>
                        <div>include the question in your first line—context beats “hi”</div>
                    </div>
                </div>
                <p style="font-size:12px;opacity:.8">
                    heads-up: replies can be slow; honesty > speed. be kind to sleepy humans.
                </p>
            </aside>
        </section>

        <!-- TEMPLATES + SHORTCUTS -->
        <section class="card" id="templates" aria-label="message templates">
            <h2>message templates</h2>
            <div class="template-list">
                <div class="template">
                    <span class="pill"><span class="dot rose"></span> stardust gratitude</span>
                    <div>
                        <p style="margin:4px 0 0">
                            “thinking of you tonight—thank you for <em>[specific thing]</em>. you make the heavy parts lighter.”
                        </p>
                    </div>
                    <button class="btn" data-insert="thinking of you tonight—thank you for [specific thing]. you make the heavy parts lighter.">insert</button>
                </div>
                <div class="template">
                    <span class="pill"><span class="dot lilac"></span> moonbeam check-in</span>
                    <div>
                        <p style="margin:4px 0 0">
                            “hey, doing a gentle check-in. how’s your energy? want a short call or just quiet company?”
                        </p>
                    </div>
                    <button class="btn" data-insert="hey, doing a gentle check-in. how’s your energy? want a short call or just quiet company?">insert</button>
                </div>
                <div class="template">
                    <span class="pill"><span class="dot glow"></span> aurora affirmation</span>
                    <div>
                        <p style="margin:4px 0 0">
                            “remember: you’re allowed to rest. you’re allowed to take up space. breathing with you.”
                        </p>
                    </div>
                    <button class="btn" data-insert="remember: you’re allowed to rest. you’re allowed to take up space. breathing with you.">insert</button>
                </div>
                <div class="template">
                    <span class="pill"><span class="dot tint"></span> nebula invite</span>
                    <div>
                        <p style="margin:4px 0 0">
                            “tea + rain playlist sometime this week? tue/wed night works. no pressure, just cozy.”
                        </p>
                    </div>
                    <button class="btn" data-insert="tea + rain playlist sometime this week? tue/wed night works. no pressure, just cozy.">insert</button>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="card" aria-label="contact">
            <h2>moonlight, continued</h2>
            <p>always down to meet good humans—slow burn. start with context, not just “hi”.</p>
            <div class="actions" style="margin-top:12px">
                <a class="btn alt" href="{{ route('playlist') }}">sleep playlist</a>
                <a class="btn ghost" href="{{ route('journal') }}">dream journal</a>
                <a class="btn" href="{{ route('messages') }}">back to inbox</a>
            </div>
        </section>
    </main>

    <footer>
        <span>made at an unreasonable hour</span> ·
        <span>be gentle with yourself</span>
    </footer>
</div>

<script>
    // soft rain toggle (visual only)
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

    // character counter, template insert, chips to body
    (function(){
        const body = document.getElementById('body');
        const count = document.getElementById('count');
        const previewBtn = document.getElementById('previewBtn');
        const out = document.getElementById('preview');
        const outText = document.getElementById('previewText');
        const closePrev = document.getElementById('closePreview');

        if(body && count){
            const update = () => { count.textContent = `${body.value.length} / ${body.maxLength}`; };
            body.addEventListener('input', update, {passive:true});
            update();
        }

        document.querySelectorAll('[data-insert]').forEach(btn=>{
            btn.addEventListener('click', ()=>{
                const val = btn.getAttribute('data-insert');
                if(!body) return;
                const s = body.selectionStart ?? body.value.length;
                const e = body.selectionEnd ?? body.value.length;
                body.setRangeText(val, s, e, 'end');
                body.dispatchEvent(new Event('input'));
                body.focus();
            }, {passive:true});
        });

        document.querySelectorAll('.pill[data-chip]').forEach(p=>{
            p.addEventListener('click', ()=>{
                if(!body) return;
                const chip = p.getAttribute('data-chip') + ' ';
                const s = body.selectionStart ?? body.value.length;
                const e = body.selectionEnd ?? body.value.length;
                body.setRangeText(chip, s, e, 'end');
                body.dispatchEvent(new Event('input'));
                body.focus();
            }, {passive:true});
        });

        if(previewBtn && out && outText){
            previewBtn.addEventListener('click', ()=>{
                const subject = (document.getElementById('subject')?.value || '').trim();
                const to = (document.getElementById('to')?.value || '').trim();
                const msg = (body?.value || '').trim();
                const header = to ? `to: ${to}\n` : '';
                const subj = subject ? `subject: ${subject}\n` : '';
                outText.textContent = header + subj + (msg || '—');
                out.style.display = 'block';
            }, {passive:true});
        }
        if(closePrev && out){ closePrev.addEventListener('click', ()=> out.style.display = 'none'); }
    })();
</script>
</body>
</html>
