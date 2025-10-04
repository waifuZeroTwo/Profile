<!-- Safe Space · Nightglass section (no Tailwind) -->
<section class="panel safe-space" aria-labelledby="safe-space-title">
    <style>
        .panel{position:relative;overflow:hidden;border-radius:24px;padding:22px;background:rgba(26,21,51,.9);backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,.10);box-shadow:0 25px 60px -30px rgba(10,6,30,.95);isolation:isolate}
        .panel:before{content:"";position:absolute;inset:0;background:radial-gradient(1000px 500px at 50% 0%, rgba(148,118,255,.25), transparent 65%);pointer-events:none}
        .safe-grid{position:relative;display:grid;gap:20px}
        @media (min-width:1024px){.safe-grid{grid-template-columns:1.15fr .85fr}}

        .eyebrow{font:600 11px/1.6 system-ui,-apple-system,Segoe UI,Roboto,Inter,Arial,sans-serif;letter-spacing:.35em;text-transform:uppercase;color:rgba(255,255,255,.6);margin:0}
        #safe-space-title{color:#fff;font:600 clamp(20px,2.2vw,28px)/1.25 Inter,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;margin:.35rem 0 0}
        .lead{color:rgba(255,255,255,.8);font-size:14px;line-height:1.7;max-width:66ch;margin:12px 0 0}

        .list{display:grid;gap:10px;margin:14px 0 0}
        @media (min-width:520px){.list{grid-template-columns:1fr 1fr}}
        .li{display:flex;gap:12px;align-items:flex-start;padding:12px;border-radius:18px;border:1px solid rgba(255,255,255,.10);background:rgba(255,255,255,.06);color:rgba(255,255,255,.85);font-size:14px}
        .dot{flex:0 0 auto;width:10px;height:10px;border-radius:999px;margin-top:3px;box-shadow:0 0 8px 2px currentColor}
        .rose{color:#ff8fc7}.indigo{color:#5f64ff}.lilac{color:#c4a6ff}.amber{color:#ffdda6}

        .card{border:1px solid rgba(255,255,255,.10);background:rgba(32,25,68,.75);border-radius:22px;padding:18px;box-shadow:inset 0 1px 0 rgba(255,255,255,.18)}
        .card h3{margin:0;color:rgba(255,255,255,.65);font:600 12px/1.6 system-ui,-apple-system,Segoe UI,Roboto,Inter,Arial,sans-serif;letter-spacing:.25em;text-transform:uppercase}
        .card p{margin:8px 0 0;color:rgba(255,255,255,.75);font-size:14px;line-height:1.6}

        .links{margin:14px 0 0;display:grid;gap:10px}
        .link{display:inline-flex;align-items:center;gap:10px;padding:9px 14px;border-radius:999px;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.06);color:#d6cbff;text-decoration:none;transition:.2s}
        .link:hover{border-color:#ff8fc7;background:rgba(255,143,199,.15);color:#fff;transform:translateY(-1px)}
        .link:focus-visible{outline:2px solid #ff8fc7;outline-offset:2px}
        .spark{font-size:12px;color:rgba(255,255,255,.7);transform:translateX(0);transition:transform .2s}
        .link:hover .spark{transform:translateX(2px)}
    </style>

    <div class="safe-grid">
        <div>
            <header>
                <p class="eyebrow">Safe Space Promise</p>
                <h2 id="safe-space-title">We hold quiet, courageous conversations.</h2>
            </header>

            <p class="lead">
                Our circle is rooted in consent, curiosity, and gentle accountability. We listen with soft edges,
                speak from lived experience, and honor the pauses that let every voice feel heard. This dusk-lit
                corner of the internet is an invitation to arrive exactly as you are.
            </p>

            <ul class="list" role="list">
                <li class="li">
                    <span class="dot rose" aria-hidden="true"></span>
                    <span>Compassion-first reflections that slow down reaction into response.</span>
                </li>
                <li class="li">
                    <span class="dot indigo" aria-hidden="true"></span>
                    <span>Consent-forward storytelling — no advice unless asked and welcomed.</span>
                </li>
                <li class="li">
                    <span class="dot lilac" aria-hidden="true"></span>
                    <span>Boundaries that protect energy, timelines, and our collective nervous systems.</span>
                </li>
                <li class="li">
                    <span class="dot amber" aria-hidden="true"></span>
                    <span>Celebrations of softness, rest, and the brave act of needing support.</span>
                </li>
            </ul>
        </div>

        <aside aria-labelledby="urgent-support self-serve-comforts" style="display:grid;gap:16px">
            <div class="card" id="urgent-support">
                <h3>Urgent support</h3>
                <p>If you or someone you love needs immediate care, please reach out to the resources below.</p>
                <nav class="links" aria-label="crisis resources">
                    <a class="link" href="https://988lifeline.org/" target="_blank" rel="noopener">
                        <span class="spark" aria-hidden="true">☀︎</span>
                        U.S. &amp; Canada: 988 Lifeline
                    </a>
                    <a class="link" href="https://www.samaritans.org/how-we-can-help/contact-samaritan/" target="_blank" rel="noopener">
                        <span class="spark" aria-hidden="true">☀︎</span>
                        UK &amp; Ireland: Samaritans 116 123
                    </a>
                    <a class="link" href="https://www.lifeline.org.au/" target="_blank" rel="noopener">
                        <span class="spark" aria-hidden="true">☀︎</span>
                        Australia: Lifeline 13 11 14
                    </a>
                </nav>
            </div>

            <div class="card" id="self-serve-comforts">
                <h3>Self-serve comforts</h3>
                <p>Ground your body and breath with practices you can reach for at any hour.</p>
                <nav class="links" aria-label="comfort resources">
                    <a class="link" href="https://insighttimer.com/meditation" target="_blank" rel="noopener">
                        <span class="spark" aria-hidden="true">☀︎</span>
                        Dusk meditations for tender evenings
                    </a>
                    <a class="link" href="https://diyjournaling.com/journal-prompts/" target="_blank" rel="noopener">
                        <span class="spark" aria-hidden="true">☀︎</span>
                        Gentle journal prompts for slow mornings
                    </a>
                    <a class="link" href="https://open.spotify.com/playlist/37i9dQZF1DX4sWSpwq3LiO" target="_blank" rel="noopener">
                        <span class="spark" aria-hidden="true">☀︎</span>
                        Soft synth rain &amp; lullaby playlist
                    </a>
                </nav>
            </div>
        </aside>
    </div>
</section>
