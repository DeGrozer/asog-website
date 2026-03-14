<!-- Overlay — enlarged card + backdrop -->
<div id="ibOverlay" class="ib-overlay fixed inset-0 flex items-center justify-center">
    <div class="ib-backdrop absolute inset-0" id="ibBackdrop"></div>
    <div class="ib-modal relative flex items-center justify-center w-full h-full">

        <div id="ibBigCard" class="ib-big-card relative shrink-0">
            <div id="ibBigInner" class="ib-big-inner w-full h-full rounded-2xl cursor-pointer relative">

                <!-- Big Front — navy brand canvas -->
                <div class="ib-big-front absolute inset-0 rounded-2xl overflow-hidden flex flex-col items-center justify-center" id="ibBigFront">
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
                    <span class="ib-big-flip-hint">Click to see the team</span>
                </div>

                <!-- Big Back — clean team roster -->
                <div class="ib-big-back absolute inset-0 rounded-2xl overflow-hidden flex flex-col items-center justify-center text-center" id="ibBigBack">
                    <div class="text-center relative z-10">
                        <span class="ib-bb-label block">The Team</span>
                        <p id="bbName" class="ib-bb-name"></p>
                    </div>
                    <div class="ib-bb-divider shrink-0 relative"></div>
                    <div id="bbTeam" class="ib-bb-team w-full flex flex-col items-center relative"></div>
                    <span class="ib-big-flip-hint is-back">Click to flip back</span>
                </div>

            </div>
        </div>

    </div>
</div>
