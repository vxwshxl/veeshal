<!-- ===================== LOADER — pit-lane wheel burst (shared) ===================== -->
<div class="loader" aria-hidden="true">
    <div class="loader-road"></div>
    <div class="loader-streaks" id="loaderStreaks"></div>

    <div class="loader-wheel-wrap">
        <!-- motion-blur ghost (live mirror of the wheel below) -->
        <svg class="loader-wheel loader-wheel-ghost" viewBox="0 0 400 400">
            <use href="#lwWheel"></use>
        </svg>

        <svg class="loader-wheel" viewBox="0 0 400 400">
            <defs>
                <radialGradient id="lwRimGrad" cx="35%" cy="32%" r="80%">
                    <stop offset="0%" stop-color="#45454b" />
                    <stop offset="55%" stop-color="#26262a" />
                    <stop offset="100%" stop-color="#121214" />
                </radialGradient>
                <linearGradient id="lwSpokeGrad" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#4e4e54" />
                    <stop offset="100%" stop-color="#1b1b1e" />
                </linearGradient>
                <radialGradient id="lwDiscGrad" cx="50%" cy="50%" r="50%">
                    <stop offset="50%" stop-color="#2c2c2f" />
                    <stop offset="82%" stop-color="#404045" />
                    <stop offset="100%" stop-color="#232326" />
                </radialGradient>
                <!-- one twin-blade spoke, stamped 5x -->
                <g id="lwSpoke">
                    <path d="M191 178 L177 78 Q186 70 195 73 L198 178 Z" fill="url(#lwSpokeGrad)" />
                    <path d="M209 178 L223 78 Q214 70 205 73 L202 178 Z" fill="url(#lwSpokeGrad)" />
                </g>
            </defs>

            <g id="lwWheel">
                <!-- static layer: brake disc + amber caliper, seen through the spokes -->
                <circle cx="200" cy="200" r="118" fill="url(#lwDiscGrad)" />
                <circle cx="200" cy="200" r="106" fill="none" stroke="#1c1c1f" stroke-width="3"
                    stroke-dasharray="2 11" />
                <circle cx="200" cy="200" r="86" fill="none" stroke="#1c1c1f" stroke-width="3"
                    stroke-dasharray="2 9" />
                <path d="M319.6 144.2 A132 132 0 0 1 319.6 255.8 L290.6 242.3 A100 100 0 0 0 290.6 157.7 Z"
                    fill="#F9B646" />

                <!-- rotor: tire + rim + spokes (this part spins) -->
                <g id="lwRotor">
                    <!-- tire -->
                    <circle cx="200" cy="200" r="174" fill="none" stroke="#141414" stroke-width="46" />
                    <circle cx="200" cy="200" r="192" fill="none" stroke="#060606" stroke-width="8"
                        stroke-dasharray="15 11" />
                    <circle cx="200" cy="200" r="160" fill="none" stroke="#0b0b0b" stroke-width="12" />
                    <!-- race-tire paint marker -->
                    <circle cx="200" cy="42" r="5" fill="#F9B646" />

                    <!-- rim -->
                    <circle cx="200" cy="200" r="152" fill="none" stroke="#4d4d53" stroke-width="2.5" />
                    <circle cx="200" cy="200" r="141" fill="none" stroke="url(#lwRimGrad)" stroke-width="21" />

                    <!-- 5 twin spokes -->
                    <use href="#lwSpoke" />
                    <use href="#lwSpoke" transform="rotate(72 200 200)" />
                    <use href="#lwSpoke" transform="rotate(144 200 200)" />
                    <use href="#lwSpoke" transform="rotate(216 200 200)" />
                    <use href="#lwSpoke" transform="rotate(288 200 200)" />

                    <!-- hub, lug nuts, centre cap -->
                    <circle cx="200" cy="200" r="58" fill="#19191b" stroke="#2c2c30" stroke-width="2" />
                    <circle cx="200" cy="166" r="6" fill="#8e8e96" />
                    <circle cx="232.3" cy="189.5" r="6" fill="#8e8e96" />
                    <circle cx="220" cy="227.5" r="6" fill="#8e8e96" />
                    <circle cx="180" cy="227.5" r="6" fill="#8e8e96" />
                    <circle cx="167.7" cy="189.5" r="6" fill="#8e8e96" />
                    <circle cx="200" cy="200" r="29" fill="#111110" stroke="#F9B646" stroke-width="2" />
                    <text x="200" y="212" text-anchor="middle" font-family="'Clash Display', sans-serif"
                        font-size="34" font-weight="700" fill="#F9B646">V</text>
                </g>
            </g>
        </svg>
    </div>

    <div class="loader-meta">
        <span class="loader-brand">vee<span class="amber">.</span></span>
        <span class="loader-tag">code &amp; cinema — '26</span>
    </div>

    <div class="loader-line"><i></i></div>

    <div class="loader-speedo">
        <span class="loader-counter" id="loaderCounter">000</span>
        <span class="loader-unit">ignition / km·h</span>
    </div>
</div>
