<?php if ($hint) : ?>
    <a href="#" class="lms-quiz__hint">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
            <defs>
                <style>.cls-1, .cls-2, .cls-3 {
                        fill: none;
                        stroke: <?= $textColor ?>;
                        stroke-linecap: round;
                        stroke-width: 3px;
                    }
                    .cls-1, .cls-2 {
                        stroke-miterlimit: 10;
                    }
                    .cls-1, .cls-3 {
                        fill-rule: evenodd;
                    }
                    .cls-3 {
                        stroke-linejoin: round;
                    }</style>
            </defs>
            <title>Help</title>
            <g id="Home">
                <path class="cls-1" d="M34.42,30.58a5.58,5.58,0,1,1,8.17,4.94A4.79,4.79,0,0,0,40,39.75v1"/>
                <circle class="cls-2" cx="40" cy="46.65" r="0.35"/>
                <path class="cls-3"
                      d="M53.28,54.59H45l-5,7-5-7H26.72a5.52,5.52,0,0,1-5.52-5.52V22.51A5.52,5.52,0,0,1,26.72,17H53.28a5.52,5.52,0,0,1,5.52,5.51V49.07A5.52,5.52,0,0,1,53.28,54.59Z"/>
            </g>
        </svg>
    </a>
<?php endif; ?>