<!-- Overlay — enlarged card + backdrop -->
<div id="ibOverlay" class="ib-overlay fixed inset-0 flex items-center justify-center">
    <div class="ib-backdrop absolute inset-0" id="ibBackdrop"></div>
    <div class="ib-modal relative flex items-center justify-center w-full h-full">

        <div id="ibBigCard" class="ib-big-card relative shrink-0">
            <div id="ibBigInner" class="ib-big-inner w-full h-full rounded-2xl cursor-pointer relative">

                <!-- Big Front — navy -->
                <div class="ib-big-front absolute inset-0 rounded-2xl overflow-hidden flex flex-col items-center justify-center" id="ibBigFront">
                    <div class="ib-frame absolute pointer-events-none"></div>
                    <div class="ib-frame-inner absolute pointer-events-none"></div>
                    <div class="ib-diamond absolute pointer-events-none tl"></div>
                    <div class="ib-diamond absolute pointer-events-none tr"></div>
                    <div class="ib-diamond absolute pointer-events-none bl"></div>
                    <div class="ib-diamond absolute pointer-events-none br"></div>
                    <div class="ib-dots absolute inset-0 pointer-events-none"></div>
                    <span id="bfNum" class="ib-bf-num absolute"></span>
                    <div class="ib-bf-portrait flex items-center justify-center relative">
                        <div id="bfLogo" class="ib-bf-logo flex items-center justify-center"></div>
                    </div>
                    <div class="ib-bf-divider shrink-0 relative"></div>
                    <div class="ib-bf-nameplate text-center relative">
                        <h3 id="bfName" class="ib-bf-name"></h3>
                        <p id="bfFounder" class="ib-bf-founder"></p>
                        <span id="bfCohort" class="ib-bf-cohort block"></span>
                    </div>
                </div>

                <!-- Big Back — white / team -->
                <div class="ib-big-back absolute inset-0 rounded-2xl overflow-hidden flex flex-col items-center justify-center text-center" id="ibBigBack">
                    <div class="ib-frame absolute pointer-events-none"></div>
                    <div class="ib-frame-inner absolute pointer-events-none"></div>
                    <div class="ib-diamond absolute pointer-events-none tl"></div>
                    <div class="ib-diamond absolute pointer-events-none tr"></div>
                    <div class="ib-diamond absolute pointer-events-none bl"></div>
                    <div class="ib-diamond absolute pointer-events-none br"></div>
                    <div class="text-center relative z-10">
                        <span class="ib-bb-label block">The Team</span>
                        <p id="bbName" class="ib-bb-name"></p>
                    </div>
                    <div class="ib-bb-divider shrink-0 relative"></div>
                    <div id="bbTeam" class="ib-bb-team w-full flex flex-col items-center overflow-y-auto relative"></div>
                </div>

            </div>
        </div>

    </div>
</div>
