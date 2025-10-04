<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>dream journal · zero</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Nightglass Styles -->
    <style>
        :root{
            --ink:#0b0c12; --ink-2:#141527; --hush:#eef0ff; --mist:#c8c9d9;
            --rose:#ff9fc6; --lilac:#a7a3ff; --amber:#ffd6a6; --glow:#9ad5ff;
            --card: rgba(18,19,39,.56); --film: rgba(255,255,255,.06);
            --radius: 20px; --ring: 0 0 0 3px rgba(167,163,255,.35);
            --shadow: 0 22px 60px -22px rgba(4,8,35,.85);
            --speed: 28s;
        }
        *{box-sizing:border-box}
        html,body{height:100%}
        body{
            margin:0; color:var(--mist);
            font-family:"Instrument Sans", ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            background:
                radial-gradient(1200px 800px at 20% -10%, #1a1b2f 0%, #0b0c12 60%) fixed;
            -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale; overflow-x:hidden;
        }

        /* soft stars */
        .stars,.stars:before,.stars:after{content:"";position:fixed;inset:0;background-repeat:repeat;pointer-events:none}
        .stars{
            background-image:
                radial-gradient(1px 1px at 25% 35%, rgba(154,213,255,.7) 0 60%, transparent 61%),
                radial-gradient(1px 1px at 70% 80%, rgba(255,165,200,.65) 0 60%, transparent 61%),
                radial-gradient(1px 1px at 45% 60%, rgba(255,255,255,.55) 0 60%, transparent 61%);
            background-size: 650px 650px, 720px 720px, 520px 520px;
            animation: drift var(--speed) linear infinite; opacity:.5;
        }
        .stars:before{
            background-image:
                radial-gradient(1px 1px at 18% 18%, rgba(167,163,255,.7) 0 60%, transparent 61%),
                radial-gradient(1px 1px at 82% 46%, rgba(255,255,255,.6) 0 60%, transparent 61%);
            background-size: 900px 900px, 800px 800px;
            animation: drift calc(var(--speed) * 1.6) linear infinite reverse; opacity:.35;
        }
        .stars:after{
            background-image: radial-gradient(1px 1px at 56% 42%, rgba(154,213,255,.75) 0 60%, transparent 61%);
            background-size: 1100px 1100px;
            animation: drift calc(var(--speed) * 2.2) linear infinite; opacity:.25;
        }
        @keyframes drift{from{transform:translateY(0)}to{transform:translateY(-320px)}}
        @media (prefers-reduced-motion:reduce){.stars,.stars:before,.stars:after{animation:none}}

        .shell{min-height:100dvh;display:grid;grid-template-rows:auto 1fr auto;padding:28px 20px}
        header{max-width:1040px;margin-inline:auto;width:100%;height:8px}

        main{max-width:1040px;margin:24px auto;width:100%;display:grid;gap:18px}

        /* hero */
        .hero{
            position:relative;overflow:hidden;border-radius:clamp(16px,2vw,28px);
            background: linear-gradient(160deg, rgba(255,255,255,.04), rgba(255,255,255,.02)), var(--card);
            border:1px solid rgba(255,255,255,.12); padding:clamp(24px,3.6vw,46px);
            backdrop-filter: blur(10px); box-shadow:var(--shadow); isolation:isolate;
        }
        .veil{position:absolute;inset:-35% -10% auto -10%;height:70%;background:
            radial-gradient(650px 320px at 20% 40%, rgba(167,163,255,.36) 0%, transparent 60%),
            radial-gradient(520px 260px at 85% 18%, rgba(255,165,200,.22) 0%, transparent 60%);
            filter:blur(22px);z-index:-1;pointer-events:none}
        .tag{display:inline-flex;align-items:center;gap:8px;padding:6px 10px;border-radius:999px;border:1px dashed rgba(255,255,255,.18);background:rgba(255,255,255,.03);font-size:12px;color:#dfe1ff;text-transform:uppercase;letter-spacing:.25em}
        h1{margin:10px 0 0;color:var(--hush);font-weight:600;line-height:1.12;font-size:clamp(28px,3.2vw,54px)}
        .lead{color:var(--mist);max-width:66ch;margin:14px 0 0;font-size:clamp(14px,1.4vw,18px);opacity:.92}
        .actions{display:flex;flex-wrap:wrap;gap:10px;margin-top:22px}
        .btn{--bg:rgba(167,163,255,.16);--bd:rgba(167,163,255,.42);--fg:#eef0ff;display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:12px 16px;border-radius:999px;border:1px solid var(--bd);color:var(--fg);background:var(--bg);text-decoration:none;font-weight:600;font-size:14px;letter-spacing:.2px;transition:.25s;box-shadow:0 12px 30px -18px rgba(167,163,255,.8)}
        .btn:hover{transform:translateY(-1px);background:rgba(167,163,255,.24)}
        .btn:focus-visible{outline:none;box-shadow:var(--ring)}
        .btn.alt{--bg:rgba(255,159,198,.16);--bd:rgba(255,159,198,.5)}
        .btn.ghost{--bg:rgba(255,255,255,.06);--bd:rgba(255,255,255,.22)}

        /* grid */
        .grid{display:grid;gap:18px;grid-template-columns:1fr}
        @media (min-width:960px){.grid{grid-template-columns:1.35fr .95fr}}

        .card{background:linear-gradient(180deg, rgba(255,255,255,.04), rgba(255,255,255,.02)), var(--card);border:1px solid rgba(255,255,255,.1);border-radius:var(--radius);padding:20px;box-shadow:var(--shadow);backdrop-filter:blur(8px)}
        .card h2{margin:0 0 8px;color:var(--hush);font-size:clamp(18px,1.6vw,22px);font-weight:600;letter-spacing:.2px}
        .card p{margin:8px 0 0;line-height:1.6;opacity:.95}

        /* form */
        .form{display:grid;gap:12px;margin-top:6px}
        .row{display:grid;gap:8px}
        label{font-size:12px;text-transform:uppercase;letter-spacing:.22em;opacity:.82}
        .field{display:flex;align-items:center;gap:10px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-radius:14px;padding:12px 14px}
        .field:focus-within{border-color:rgba(167,163,255,.45);box-shadow:var(--ring)}
        input, select, textarea{width:100%;border:0;outline:0;background:transparent;color:#eef0ff;font:inherit}
        textarea{min-height:160px;resize:vertical}
        .meta{display:flex;justify-content:space-between;align-items:center;font-size:12px;opacity:.85;flex-wrap:wrap;gap:10px}
        .chips{display:flex;gap:8px;flex-wrap:wrap}
        .chip{display:inline-flex;gap:8px;align-items:center;padding:8px 12px;border-radius:999px;border:1px solid rgba(255,255,255,.16);background:rgba(255,255,255,.06);cursor:pointer;user-select:none}
        .dot{width:8px;height:8px;border-radius:999px;box-shadow:0 0 10px 2px currentColor}
        .rose{color:var(--rose)} .lilac{color:var(--lilac)} .glow{color:var(--glow)} .amber{color:var(--amber)}

        .list{display:grid;gap:10px;margin-top:8px}
        .item{display:flex;gap:10px;align-items:flex-start;padding:12px;border-radius:14px;border:1px dashed rgba(255,255,255,.16);background:rgba(255,255,255,.04)}
        .item .title{color:var(--hush);font-weight:600}

        footer{display:flex;justify-content:center;gap:12px;padding:18px 0;opacity:.8;font-size:12px}
        ::selection{background:rgba(167,163,255,.28);color:white}
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
            <span class="tag">afterglow · journal</span>
            <h1>dream journal</h1>
            <p class="lead">
                gather your midnight recollections with gentle prompts and soft motion. a small place to keep what the morning forgets.
            </p>
            <div class="actions">
                <a class="btn" href="#compose">New Entry</a>
                <a class="btn alt" href="#prompts">Use Prompts</a>
                <a class="btn ghost" href="{{ route('playlist') }}">Sleep Playlist</a>
                <a class="btn" href="{{ route('messages') }}">Moonlight Messages</a>
            </div>
        </section>

        <!-- COMPOSE + SIDEBAR -->
        <section class="grid" id="compose">
            <!-- Compose -->
            <article class="card" aria-label="compose journal entry">
                <h2>tonight’s entry</h2>
                <form class="form" method="POST" action="{{ route('journal.store') }}" novalidate>
                    @csrf
                    <div class="row">
                        <label for="title">title</label>
                        <div class="field">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16M4 12h12M4 17h8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <input id="title" name="title" type="text" placeholder="a few glowing words…" maxlength="80">
                        </div>
                    </div>

                    <div class="row" style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                        <div>
                            <label for="mood">mood</label>
                            <div class="field">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 20a8 8 0 100-16 8 8 0 000 16z" stroke="currentColor" stroke-width="1.5"/><path d="M9 10h0M15 10h0M9 15c1.5 1 4.5 1 6 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                                <select id="mood" name="mood">
                                    <option>calm</option><option>wistful</option><option>curious</option><option>restless</option><option>light</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="quality">sleep quality</label>
                            <div class="field">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 18h16M4 18C4 9 20 9 20 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                                <input id="quality" name="quality" type="range" min="1" max="5" step="1" value="3" oninput="document.getElementById('qv').textContent=this.value">
                                <span id="qv" aria-live="polite">3</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="body">what you remember</label>
                        <div class="field" style="align-items:flex-start">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-top:2px" aria-hidden="true"><path d="M5 7l7 5 7-5M5 17l7 5 7-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            <textarea id="body" name="body" placeholder="scenes, textures, colors, sounds…" maxlength="2000" required></textarea>
                        </div>
                        <div class="meta">
                            <div class="chips">
                                <span class="chip" data-chip="#sound"><span class="dot glow"></span> sound</span>
                                <span class="chip" data-chip="#place"><span class="dot lilac"></span> place</span>
                                <span class="chip" data-chip="#feeling"><span class="dot rose"></span> feeling</span>
                                <span class="chip" data-chip="#symbol"><span class="dot amber"></span> symbol</span>
                            </div>
                            <span id="count">0 / 2000</span>
                        </div>
                    </div>

                    <div class="actions" style="margin-top:6px">
                        <button class="btn alt" type="submit">Save Entry</button>
                        <button class="btn ghost" type="button" id="previewBtn">Preview</button>
                        <button class="btn" type="reset">Clear</button>
                    </div>

                    <output id="preview" style="display:none;margin-top:12px">
                        <div class="item" aria-live="polite">
                            <strong class="title">preview</strong>
                            <div id="previewText" style="white-space:pre-wrap;opacity:.95"></div>
                            <button class="btn" type="button" id="closePreview">close</button>
                        </div>
                    </output>
                </form>
            </article>

            <!-- Sidebar: Prompts + Recents -->
            <aside class="card" id="prompts" aria-label="tonight's prompts">
                <h2>tonight’s prompts</h2>
                <div class="list">
                    <div class="item">
                        <strong class="title">scene</strong>
                        <div>where were you? note light, weather, textures underfoot.</div>
                        <button class="btn" data-insert="scene: [describe light / weather / textures]">insert</button>
                    </div>
                    <div class="item">
                        <strong class="title">company</strong>
                        <div>who appeared? name a gesture or sentence they carried.</div>
                        <button class="btn" data-insert="company: [who] — [gesture / phrase]">insert</button>
                    </div>
                    <div class="item">
                        <strong class="title">shift</strong>
                        <div>what changed suddenly? door, color, scale, gravity?</div>
                        <button class="btn" data-insert="shift: [what changed] · felt: [emotion]">insert</button>
                    </div>
                    <div class="item">
                        <strong class="title">echo</strong>
                        <div>what lingers now—image, sound, question?</div>
                        <button class="btn" data-insert="echo: [what remains in the body]">insert</button>
                    </div>
                </div>

                <h2 style="margin-top:16px">recent entries</h2>
                <div class="list">
                    <a class="item" href="{{ route('journal') }}">
                        <span class="title">starlit sketches</span>
                        <div>tracing last night’s stairwell & distant radio</div>
                    </a>
                    <a class="item" href="{{ route('journal') }}">
                        <span class="title">lavender horizons</span>
                        <div>wind-down notes & soft lightning on the ridge</div>
                    </a>
                    <a class="item" href="{{ route('journal') }}">
                        <span class="title">static between worlds</span>
                        <div>half-lucid corridor & a turning key</div>
                    </a>
                    <a class="item" href="{{ route('journal') }}">
                        <span class="title">soft affirmations</span>
                        <div>three lines for tomorrow’s dawn</div>
                    </a>
                </div>
            </aside>
        </section>

        <!-- MOOD ROW -->
        <section class="card" aria-label="journal mood">
            <h2>journal mood</h2>
            <div class="list" style="grid-template-columns:1fr 1fr 1fr;display:grid">
                <div class="item"><strong>theme</strong><div>iridescent nostalgia with fragments of cloudlight</div></div>
                <div class="item"><strong>focus</strong><div>gather sensory details & name the emotion underneath</div></div>
                <div class="item"><strong>soundtrack</strong><div>muted piano loops with distant thunder murmurs</div></div>
            </div>
            <div class="actions" style="margin-top:12px">
                <a class="btn alt" href="{{ route('playlist') }}">play the sleep mix</a>
                <a class="btn ghost" href="{{ route('messages') }}">send a moonlight message</a>
            </div>
        </section>
    </main>

    <footer>
        <span>made at an unreasonable hour</span> ·
        <span>dreams deserve gentle handling</span>
    </footer>
</div>

<script>
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

        // prompt inserts
        document.querySelectorAll('[data-insert]').forEach(btn=>{
            btn.addEventListener('click', ()=>{
                if(!body) return;
                const val = btn.getAttribute('data-insert');
                const s = body.selectionStart ?? body.value.length;
                const e = body.selectionEnd ?? body.value.length;
                body.setRangeText(val, s, e, 'end');
                body.dispatchEvent(new Event('input'));
                body.focus();
            }, {passive:true});
        });

        // tag chips
        document.querySelectorAll('.chip[data-chip]').forEach(chip=>{
            chip.addEventListener('click', ()=>{
                if(!body) return;
                const tag = chip.getAttribute('data-chip') + ' ';
                const s = body.selectionStart ?? body.value.length;
                const e = body.selectionEnd ?? body.value.length;
                body.setRangeText(tag, s, e, 'end');
                body.dispatchEvent(new Event('input'));
                body.focus();
            }, {passive:true});
        });

        // preview
        if(previewBtn && out && outText){
            previewBtn.addEventListener('click', ()=>{
                const title = (document.getElementById('title')?.value || '').trim();
                const mood = (document.getElementById('mood')?.value || '').trim();
                const q = (document.getElementById('quality')?.value || '').trim();
                const bodyVal = (body?.value || '').trim();
                const header = (title ? `title: ${title}\n` : '')
                    + (mood ? `mood: ${mood} · sleep: ${q}/5\n` : '');
                outText.textContent = header + (bodyVal || '—');
                out.style.display = 'block';
            }, {passive:true});
        }
        if(closePrev && out){ closePrev.addEventListener('click', ()=> out.style.display = 'none'); }
    })();
</script>
</body>
</html>
