/* =====================================================================
   ALTITUDE 3D — Wilderness-Zoom Transition + Three.js Mountain
   ===================================================================== */
import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

/* =============================================================
   DOM REFS
   ============================================================= */
const card      = document.getElementById('altitudeExploreCard');
const zoomOvl   = document.getElementById('alt3dZoomOverlay');
const zoomText  = document.getElementById('alt3dZoomText');
const overlay   = document.getElementById('alt3dOverlay');
const cv        = document.getElementById('alt3dCanvas');
const closeBtn  = document.getElementById('alt3dClose');
const infoCard  = document.getElementById('alt3dInfo');
const lblCont   = document.getElementById('alt3dLabels');
const hintEl    = document.getElementById('alt3dHint');

/* Info card fields */
const ciNum   = document.getElementById('ciNum');
const ciName  = document.getElementById('ciName');
const ciPhase = document.getElementById('ciPhase');
const ciDur   = document.getElementById('ciDur');
const ciDesc  = document.getElementById('ciDesc');
const btnPrev = document.getElementById('ciBtnPrev');
const btnNext = document.getElementById('ciBtnNext');
const btnOvw  = document.getElementById('ciBtnOverview');

if (!card || !overlay || !cv) {
  console.warn('[altitude3d] missing DOM elements');
}

/* =============================================================
   STATE
   ============================================================= */
let sceneReady = false;
let active = -1, zoomed = false;
let R, scene, cam, oc, G;
const pinHits = [], flags = [];

/* Hero state — module scope so zoomToFlag / overviewCamera can access */
let hero, heroStage = -1, heroAnimState = 'idle', heroAnimTime = 0;
let stageCams = [];
let hStick, hMapMesh, heroFlagGroup;
let confettiGroup = null, confettiParts = [];
let trailCurve = null;
const stageTValues = [0.04, 0.31, 0.74, 1.0]; /* t on trailCurve for each stage */
let heroTrailT = stageTValues[0];

/* -- Stage data -- */
const S = [
  { id:'01', n:'Trailhead', p:'Pre-Incubation', d:'Month 1',
    x:'The starting point. Teams undergo orientation, needs assessment, and initial mentoring to prepare for the climb ahead.',
    pos: null },
  { id:'02', n:'Basecamp', p:'Incubation Phase', d:'Months 2-4',
    x:'Deep work begins. Startups access labs, receive technical mentorship, develop prototypes, and validate their business models.',
    pos: null },
  { id:'03', n:'Ascent', p:'Post-Incubation', d:'Months 5-6',
    x:'Scaling up. Teams refine products, connect with investors, and prepare for market entry with continued support.',
    pos: null },
  { id:'04', n:'Summit', p:'Graduation & Beyond', d:'Post-Program',
    x:'The peak. Startups graduate as market-ready ventures, joining the ASOG-TBI alumni network with ongoing advisory access.',
    pos: null },
];

/* =============================================================
   WILDERNESS-ZOOM TRANSITION
   ============================================================= */

function spawnParticles() {
  for (let i = 0; i < 15; i++) {
    const p = document.createElement('div');
    p.className = 'alt3d-particle';
    p.style.left = Math.random() * 100 + '%';
    p.style.top  = Math.random() * 100 + '%';
    zoomOvl.appendChild(p);
    gsap.fromTo(p,
      { opacity: 0, y: 0 },
      { opacity: Math.random() * .3 + .1,
        y: -(Math.random() * 120 + 60),
        duration: Math.random() * 1 + .6,
        delay: Math.random() * .4,
        ease: 'power1.out',
        onComplete() { p.remove(); }
      }
    );
  }
}

function openWildernessZoom() {
  document.body.style.overflow = 'hidden';
  zoomOvl.classList.add('active');
  const tl = gsap.timeline();
  tl.to(zoomOvl, { opacity: 1, duration: .4, ease: 'power2.inOut' })
    .call(spawnParticles, [], '<+=.05')
    .fromTo('#alt3dMtnFar',  { y: '20%' }, { y: '0%', duration: .8, ease: 'power2.out' }, '<')
    .fromTo('#alt3dMtnMid',  { y: '28%' }, { y: '0%', duration: .8, ease: 'power2.out' }, '<+=.05')
    .fromTo('#alt3dMtnNear', { y: '35%' }, { y: '0%', duration: .8, ease: 'power2.out' }, '<+=.05')
    .to(zoomText, { opacity: 1, y: 0, duration: .45, ease: 'power2.out' }, '-=.4')
    .call(() => {
      if (!sceneReady) initScene();
      overlay.classList.add('active');
    }, [], '+=.3')
    .to(overlay, { opacity: 1, duration: .5, ease: 'power2.inOut' }, '+=.02')
    .to(zoomOvl, { opacity: 0, duration: .35, ease: 'power2.in' }, '-=.25')
    .call(() => {
      zoomOvl.classList.remove('active');
      zoomText.style.opacity = 0;
    });
}

function closeOverlay() {
  if (zoomed) overviewCamera();
  const tl = gsap.timeline();
  tl.to(overlay, { opacity: 0, duration: .45, ease: 'power2.in' })
    .call(() => {
      overlay.classList.remove('active');
      document.body.style.overflow = '';
    });
}

if (card) {
  card.addEventListener('click', openWildernessZoom);
  card.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openWildernessZoom(); } });
}
if (closeBtn) closeBtn.addEventListener('click', closeOverlay);


/* =============================================================
   THREE.JS SCENE — Cartoonish grassland mountain
   ============================================================= */

function initScene() {
  if (sceneReady) return;
  sceneReady = true;

  /* Renderer */
  R = new THREE.WebGLRenderer({ canvas: cv, antialias: true });
  R.setPixelRatio(Math.min(devicePixelRatio, 2));
  R.setSize(window.innerWidth, window.innerHeight);
  R.shadowMap.enabled = true;
  R.shadowMap.type = THREE.PCFSoftShadowMap;
  R.toneMapping = THREE.ACESFilmicToneMapping;
  R.toneMappingExposure = 1.2;

  /* Scene */
  scene = new THREE.Scene();
  scene.background = new THREE.Color(0x87ceeb);
  scene.fog = new THREE.Fog(0x87ceeb, 25, 55);

  /* Camera — cinematic hiking perspective, closer to trail */
  cam = new THREE.PerspectiveCamera(36, window.innerWidth / window.innerHeight, 0.1, 200);
  cam.position.set(10, 5.5, 13);

  oc = new OrbitControls(cam, cv);
  oc.enableDamping = true; oc.dampingFactor = 0.06;
  oc.minDistance = 5; oc.maxDistance = 22;
  oc.maxPolarAngle = Math.PI / 2.1;
  oc.target.set(0, 2.0, 0); oc.update();

  /* Lights */
  scene.add(new THREE.HemisphereLight(0xdceef8, 0x8ab0c4, 0.7));
  scene.add(new THREE.AmbientLight(0xffffff, 0.4));
  const sun = new THREE.DirectionalLight(0xfffaf0, 1.4);
  sun.position.set(7, 16, 9);
  sun.castShadow = true;
  sun.shadow.mapSize.set(1024, 1024);
  sun.shadow.camera.far = 45;
  sun.shadow.camera.left = -14; sun.shadow.camera.right = 14;
  sun.shadow.camera.top = 18; sun.shadow.camera.bottom = -4;
  sun.shadow.bias = -0.0005;
  scene.add(sun);
  const fill = new THREE.DirectionalLight(0xb0d0e0, 0.35);
  fill.position.set(-5, 5, -3);
  scene.add(fill);

  /* === Materials — warm cartoonish palette === */
  const mGrass    = new THREE.MeshStandardMaterial({ color: 0x5a9e3e, roughness: 0.85 });
  const mGrassD   = new THREE.MeshStandardMaterial({ color: 0x3d7a28, roughness: 0.85 });
  const mDirt     = new THREE.MeshStandardMaterial({ color: 0xc4a46c, roughness: 0.95 });
  const mRock     = new THREE.MeshStandardMaterial({ color: 0x8a8070, roughness: 0.9 });
  const mRockD    = new THREE.MeshStandardMaterial({ color: 0x6e655a, roughness: 0.9 });
  const mTrunk    = new THREE.MeshStandardMaterial({ color: 0x6b4226, roughness: 0.85 });
  const mLeaf1    = new THREE.MeshStandardMaterial({ color: 0x2d6b1a, roughness: 0.8 });
  const mLeaf2    = new THREE.MeshStandardMaterial({ color: 0x4a8c2a, roughness: 0.8 });
  const mLeaf3    = new THREE.MeshStandardMaterial({ color: 0x60a836, roughness: 0.8 });
  const mFlower1  = new THREE.MeshStandardMaterial({ color: 0xf7d75a, roughness: 0.6 });
  const mFlower2  = new THREE.MeshStandardMaterial({ color: 0xe86040, roughness: 0.6 });
  const mFlower3  = new THREE.MeshStandardMaterial({ color: 0xd05aba, roughness: 0.6 });
  const mSkin     = new THREE.MeshStandardMaterial({ color: 0xf0c8a0, roughness: 0.7 });
  const mShirt1   = new THREE.MeshStandardMaterial({ color: 0xe85050, roughness: 0.7 });
  const mShirt2   = new THREE.MeshStandardMaterial({ color: 0x3588d0, roughness: 0.7 });
  const mShirt3   = new THREE.MeshStandardMaterial({ color: 0xf0a030, roughness: 0.7 });
  const mPants    = new THREE.MeshStandardMaterial({ color: 0x3a4a5a, roughness: 0.8 });
  const mBackpack = new THREE.MeshStandardMaterial({ color: 0xc06030, roughness: 0.75 });
  const mRed      = new THREE.MeshStandardMaterial({ color: 0xe85040, roughness: 0.45, side: THREE.DoubleSide });
  const mGold     = new THREE.MeshStandardMaterial({ color: 0xF8AF21, roughness: 0.35, metalness: 0.25 });

  /* Master group */
  G = new THREE.Group();
  scene.add(G);

  /* =============================================================
     CARTOONISH GRASSLAND MOUNTAIN — pointed peaks, dirt trail,
     lush green with hikers. No snow, stylized & beautiful.
     ============================================================= */

  /* ====== BASE GROUND — flat circular grassy plate ====== */
  const ground = new THREE.Mesh(
    new THREE.CylinderGeometry(9.0, 9.2, 0.4, 64), mGrassD);
  ground.position.y = -0.20; ground.receiveShadow = true; G.add(ground);
  /* Rim */
  const gRim = new THREE.Mesh(
    new THREE.TorusGeometry(9.1, 0.18, 12, 64), mDirt);
  gRim.rotation.x = Math.PI / 2; gRim.position.y = 0.0; G.add(gRim);

  /* -- Helper: smooth natural mountain peak — no rings, organic shape -- */
  function mtnPeak(baseR, height, segs, mat) {
    segs = segs || 48;
    const pts = [];
    const N = 80;
    for (let i = 0; i <= N; i++) {
      const t = i / N;
      /* Natural mountain profile: wide base, smooth concave taper to pointed summit */
      /* pow(0.7) gives a natural slope, small sin adds organic surface bumps */
      let r = baseR * Math.pow(1 - t, 0.7) * (1.0 + 0.03 * Math.sin(t * Math.PI * 6));
      /* Slightly wider at very base for natural foot */
      if (t < 0.08) r += baseR * 0.05 * (1 - t / 0.08);
      pts.push(new THREE.Vector2(Math.max(r, 0.002), t * height));
    }
    /* Rounded summit tip */
    pts.push(new THREE.Vector2(0.001, height + 0.02));
    const geo = new THREE.LatheGeometry(pts, segs);
    const m = new THREE.Mesh(geo, mat);
    m.castShadow = true; m.receiveShadow = true;
    return m;
  }

  /* -- Helper: rolling hill — half-ellipsoid blob -- */
  function hill(rx, ry, rz, mat) {
    const geo = new THREE.SphereGeometry(1, 48, 32, 0, Math.PI * 2, 0, Math.PI / 2);
    const m = new THREE.Mesh(geo, mat);
    m.scale.set(rx, ry, rz);
    m.castShadow = true; m.receiveShadow = true;
    return m;
  }

  /* ====== MOUNTAIN PEAKS — smooth natural mountains ====== */
  /* Main peak — tallest, center-back */
  const pk1 = mtnPeak(3.5, 7.0, 48, mGrass);
  pk1.position.set(0.3, 0, -1.5);
  G.add(pk1);

  /* Left peak removed per request */

  /* Right peak — shorter, pulled forward for depth */
  const pk3 = mtnPeak(2.5, 4.2, 36, mGrass);
  pk3.position.set(3.8, 0, 0.5);
  G.add(pk3);

  /* Far back small peak */
  const pk4 = mtnPeak(2.0, 3.5, 28, mGrassD);
  pk4.position.set(-1.5, 0, -3.5);
  G.add(pk4);

  /* Rocky patches near upper slopes — natural detail without rings */
  function slopeRocks(cx, cy, cz, count, spread, size) {
    for (let i = 0; i < count; i++) {
      const a = Math.random() * Math.PI * 2;
      const d = Math.random() * spread;
      const r = new THREE.Mesh(
        new THREE.DodecahedronGeometry(size * (0.4 + Math.random() * 0.6), 0),
        Math.random() > 0.5 ? mRock : mRockD
      );
      r.position.set(cx + Math.cos(a) * d, cy + Math.random() * size * 0.5, cz + Math.sin(a) * d);
      r.rotation.set(Math.random() * Math.PI, Math.random() * Math.PI, 0);
      r.castShadow = true; r.receiveShadow = true;
      G.add(r);
    }
  }
  /* Removed upper-slope loose rocks to avoid any floating artifacts */

  /* -- Rocky ridges near peaks — adds realism -- */
  function rockCluster(x, y, z, s) {
    for (let i = 0; i < 4; i++) {
      const r = new THREE.Mesh(
        new THREE.DodecahedronGeometry(s * (0.3 + Math.random() * 0.4), 0),
        Math.random() > 0.5 ? mRock : mRockD
      );
      r.position.set(
        x + (Math.random() - 0.5) * s * 1.5,
        y + Math.random() * s * 0.3,
        z + (Math.random() - 0.5) * s * 1.5
      );
      r.rotation.set(Math.random() * Math.PI, Math.random() * Math.PI, 0);
      r.castShadow = true; r.receiveShadow = true;
      G.add(r);
    }
  }
  /* Removed decorative rock clusters to ensure no detached/floating rocks */

  /* -- Green rolling hills — flattened so trail stays visible -- */
  const h1 = hill(6.5, 1.4, 5.5, mGrass);
  h1.position.set(0.5, 0, 3.5); G.add(h1);

  const h2 = hill(5.0, 1.2, 4.5, mGrassD);
  h2.position.set(-1.5, 0, 1.0); G.add(h2);

  const h3 = hill(4.0, 1.2, 3.5, mGrass);
  h3.position.set(3.5, 0, 1.5); G.add(h3);

  const h4 = hill(3.5, 1.8, 3.5, mGrassD);
  h4.position.set(-2.8, 0, -0.5); G.add(h4);

  const h5 = hill(4.0, 1.5, 3.8, mGrass);
  h5.position.set(2.5, 0, -0.3); G.add(h5);

  const h6 = hill(3.0, 1.0, 2.5, mGrassD);
  h6.position.set(-4.0, 0, 2.5); G.add(h6);

  const h7 = hill(2.5, 0.8, 2.0, mGrass);
  h7.position.set(5.0, 0, 3.0); G.add(h7);

  /* Terrain height estimation — grounds objects to hill surface */
  function terrainY(x, z) {
    let maxH = 0.05;
    [[0.5,3.5,6.5,1.4,5.5],[-1.5,1.0,5.0,1.2,4.5],[3.5,1.5,4.0,1.2,3.5],
     [-2.8,-0.5,3.5,1.8,3.5],[2.5,-0.3,4.0,1.5,3.8],[-4.0,2.5,3.0,1.0,2.5],
     [5.0,3.0,2.5,0.8,2.0]].forEach(([cx,cz,rx,ry,rz]) => {
      const dx = (x-cx)/rx, dz = (z-cz)/rz, d2 = dx*dx+dz*dz;
      if (d2 < 1) maxH = Math.max(maxH, ry * Math.sqrt(1-d2));
    });
    return maxH;
  }

  /* ====== DIRT TRAIL — hiking path ON mountain surface ====== */
  /* Lower y values = terrainY(x,z)+0.06 to sit on hills.
     Upper points computed on pk1 LatheGeometry: at height y,
     surface radius r = 3.5 * pow(1-y/7, 0.7). Trail placed at
     that radius from pk1 center (0.3, -1.5), with +0.05 y offset. */
  const trailPts = [
    new THREE.Vector3( 5.8,  0.50,  5.8),   // inside base edge
    new THREE.Vector3( 5.0,  0.92,  5.5),   // trailhead — on h1 surface
    new THREE.Vector3( 3.8,  1.10,  5.2),   // gentle rise
    new THREE.Vector3( 2.4,  1.28,  4.8),   // on h1
    new THREE.Vector3( 1.0,  1.40,  4.4),   // across front — h1 crest
    new THREE.Vector3(-0.5,  1.42,  3.8),   // heading left
    new THREE.Vector3(-1.9,  1.40,  3.72),  // approaching basecamp
    new THREE.Vector3(-2.7,  1.43,  3.60),  // basecamp lead-in
    new THREE.Vector3(-3.15, 1.48,  3.35),  // basecamp marker zone
    /* Smooth continuous turn from stage 2 into mountain climb */
    new THREE.Vector3(-3.05, 1.56,  2.95),
    new THREE.Vector3(-2.75, 1.64,  2.55),
    new THREE.Vector3(-2.35, 1.72,  2.20),
    new THREE.Vector3(-1.90, 1.80,  1.90),
    new THREE.Vector3(-1.40, 1.90,  1.62),
    new THREE.Vector3(-0.92, 1.98,  1.34),
    new THREE.Vector3(-0.42, 2.03,  1.06),
    new THREE.Vector3( 0.02, 2.08,  0.84),  // clean hand-off to circular staircase
  ];

  /* Stair-like mountain climb — circular wrap around the main peak */
  {
    const cx = 0.3, cz = -1.5, bR = 3.5, H = 7.0;
    const start = trailPts[trailPts.length - 1];
    const startAng = Math.atan2(start.z - cz, start.x - cx);
    const stepCount = 36;
    const turns = 1.16;
    const startY = 2.05;
    const endY = 6.95;

    for (let i = 0; i < stepCount; i++) {
      const t = i / (stepCount - 1);
      const e = t * t * (3 - 2 * t); /* smoothstep for cleaner curvature */
      const ang = startAng + e * Math.PI * 2 * turns;
      const y = startY + (endY - startY) * e;
      const surfaceR = bR * Math.pow(Math.max(1 - y / H, 0), 0.7);
      const r = Math.max(0.26, surfaceR + 0.62 - 0.18 * e);
      const x = cx + Math.cos(ang) * r;
      const z = cz + Math.sin(ang) * r;

      trailPts.push(new THREE.Vector3(
        x,
        y,
        z
      ));
    }

    /* Final summit point (kept to preserve existing summit flag placement logic) */
    trailPts.push(new THREE.Vector3(0.30, 7.05, -1.50));
  }

  /* ── Project trail points OUTSIDE pk1 mountain surface ──
     The LatheGeometry peak at (0.3, 0, -1.5) with baseR=3.5, height=7
     has surface radius r(y) = 3.5 * pow(1-y/7, 0.7). Many upper trail
     control points sit INSIDE that surface, so the rendered mountain
     hides the path. We push each offending point radially outward until
     it is POP units beyond the surface.                                  */
  {
    const cx = 0.3, cz = -1.5, bR = 3.5, H = 7.0, POP = 0.65;
    trailPts.forEach(p => {
      if (p.y < 1.5) return;                        // lower trail is on hills
      const dx = p.x - cx, dz = p.z - cz;
      const d  = Math.sqrt(dx * dx + dz * dz);
      if (d < 0.05) return;                         // summit tip — skip
      const sr = bR * Math.pow(Math.max(1 - p.y / H, 0), 0.7);
      const need = sr + POP;
      if (d < need) {
        const s = need / d;
        p.x = cx + dx * s;
        p.z = cz + dz * s;
      }
    });
  }

  trailCurve = new THREE.CatmullRomCurve3(trailPts, false, 'centripetal', 0.4);

  /* ====== DIRT TRAIL SURFACE — thin ribbon that hugs terrain ====== */
  /* Only the top face is generated (no side walls). The surface sits
     just above the mountain geometry so it reads as a packed-dirt path
     rather than a raised boardwalk. */
  const TRAIL_HW = 0.36;   /* half-width of trail */
  const TRAIL_H  = 0.02;   /* very thin — no visible walls */
  const TRAIL_LIFT = 0.14;  /* raised well above mountain surface */
  const TRAIL_SEGS = 400;
  const STAIR_START_T = 0.58;
  const _up = new THREE.Vector3(0, 1, 0); /* shared up vector */

  /* pk1 surface projection helper — pushes any XZ point outside pk1 */
  const _pk1cx = 0.3, _pk1cz = -1.5, _pk1bR = 3.5, _pk1H = 7.0, _pk1POP = 0.65;
  function projectOutsidePk1(x, y, z) {
    if (y < 1.2) return { x, z };  /* lower trail sits on hills, skip */
    const dx = x - _pk1cx, dz = z - _pk1cz;
    const d  = Math.sqrt(dx * dx + dz * dz);
    if (d < 0.05) return { x, z }; /* summit tip */
    const sr = _pk1bR * Math.pow(Math.max(1 - y / _pk1H, 0), 0.7);
    const need = sr + _pk1POP;
    if (d < need) {
      const s = need / d;
      return { x: _pk1cx + dx * s, z: _pk1cz + dz * s };
    }
    return { x, z };
  }

  function buildTrailSurface(curve, segs, hw, lift, mat) {
    const verts = [], uvs = [], idxs = [];
    /* Ribbon — 2 verts per ring, project EVERY vertex outside pk1 */
    for (let i = 0; i <= segs; i++) {
      const t = i / segs;
      const pt = curve.getPoint(t);
      const tang = curve.getTangent(t);
      const side = new THREE.Vector3().crossVectors(tang, _up).normalize();
      const y = pt.y + lift;
      /* Left and right edge vertices */
      let lx = pt.x + side.x * -hw, lz = pt.z + side.z * -hw;
      let rx = pt.x + side.x *  hw, rz = pt.z + side.z *  hw;
      /* Project both vertices outside pk1 mountain surface */
      const projL = projectOutsidePk1(lx, y, lz);
      const projR = projectOutsidePk1(rx, y, rz);
      verts.push(projL.x, y, projL.z, projR.x, y, projR.z);
      uvs.push(0, t, 1, t);
      if (i < segs) {
        const a = i * 2;
        idxs.push(a, a+2, a+1,  a+1, a+2, a+3);
      }
    }
    const geo = new THREE.BufferGeometry();
    geo.setAttribute('position', new THREE.Float32BufferAttribute(verts, 3));
    geo.setAttribute('uv', new THREE.Float32BufferAttribute(uvs, 2));
    geo.setIndex(idxs);
    geo.computeVertexNormals();
    const mesh = new THREE.Mesh(geo, mat);
    mesh.receiveShadow = true;
    return mesh;
  }

  /* Trail surface material — warm sandy dirt, aggressive polygonOffset to beat mountain z-fight */
  const mTrailSlab = new THREE.MeshStandardMaterial({
    color: 0xb79f6f, roughness: 0.94, side: THREE.DoubleSide,
    polygonOffset: true, polygonOffsetFactor: -4, polygonOffsetUnits: -4
  });
  /* Darker border material — subtle edge tint */
  const mTrailBorder = new THREE.MeshStandardMaterial({
    color: 0x8f7b4f, roughness: 0.96, side: THREE.DoubleSide,
    polygonOffset: true, polygonOffsetFactor: -3, polygonOffsetUnits: -3
  });

  /* Outer border — slightly wider, sits just below main surface */
  const trailBorder = buildTrailSurface(trailCurve, Math.floor(TRAIL_SEGS * STAIR_START_T), TRAIL_HW + 0.12, TRAIL_LIFT - 0.005, mTrailBorder);
  trailBorder.renderOrder = 10;
  G.add(trailBorder);

  /* Main trail surface — dirt-coloured walkable path */
  const trailSlab = buildTrailSurface(trailCurve, Math.floor(TRAIL_SEGS * STAIR_START_T), TRAIL_HW, TRAIL_LIFT, mTrailSlab);
  trailSlab.renderOrder = 11;
  G.add(trailSlab);

  /* Stone staircase for upper climb — no railings, integrated with terrain */
  const mStepStone = new THREE.MeshStandardMaterial({ color: 0x8f836f, roughness: 0.94, metalness: 0.02 });
  const upVec = new THREE.Vector3(0, 1, 0);
  const stairCount = 34;
  for (let i = 0; i < stairCount; i++) {
    const t = STAIR_START_T + ((i + 0.5) / stairCount) * (1 - STAIR_START_T);
    const pt = trailCurve.getPoint(t);
    const tang = trailCurve.getTangent(t).normalize();
    const yaw = Math.atan2(tang.x, tang.z);

    const w = 0.95 - 0.20 * (i / stairCount);
    const d = 0.42;
    const h = 0.11;
    const step = new THREE.Mesh(new THREE.BoxGeometry(w, h, d), mStepStone);
    step.position.set(pt.x, pt.y + 0.06, pt.z);
    step.rotation.y = yaw;
    step.castShadow = true;
    step.receiveShadow = true;
    G.add(step);

    /* Tiny side chips so steps feel terrain-carved, not floating blocks */
    if (i % 2 === 0) {
      const side = new THREE.Vector3().crossVectors(tang, upVec).normalize();
      for (const s of [-1, 1]) {
        const chip = new THREE.Mesh(new THREE.DodecahedronGeometry(0.035 + Math.random() * 0.02, 0), mRockD);
        chip.position.set(
          pt.x + side.x * (w * 0.5 + 0.04) * s,
          pt.y + 0.035,
          pt.z + side.z * (w * 0.5 + 0.04) * s
        );
        chip.castShadow = true;
        chip.receiveShadow = true;
        G.add(chip);
      }
    }
  }

  /* Edge stones — sparse small pebbles along trail for definition */
  const mEdgeStone = new THREE.MeshStandardMaterial({ color: 0x9a8a6a, roughness: 0.95 });
  for (let t = 0.06; t < STAIR_START_T; t += 0.035) {
    /* Only place stones on the lower/middle trail, not upper switchbacks */
    const pt = trailCurve.getPoint(t);
    const tang = trailCurve.getTangent(t);
    const perp = new THREE.Vector3().crossVectors(tang, _up).normalize();
    for (const sd of [-1, 1]) {
      if (Math.random() > 0.45) continue; /* quite sparse */
      const stone = new THREE.Mesh(
        new THREE.DodecahedronGeometry(0.03 + Math.random() * 0.03, 0), mEdgeStone);
      stone.position.set(
        pt.x + perp.x * (TRAIL_HW + 0.08) * sd,
        pt.y + TRAIL_LIFT + 0.01,
        pt.z + perp.z * (TRAIL_HW + 0.08) * sd
      );
      stone.rotation.set(Math.random() * 2, Math.random() * 2, 0);
      stone.receiveShadow = true;
      G.add(stone);
    }
  }

  /* Footstep marks — subtle impressions on the trail surface */
  const mFootprint = new THREE.MeshStandardMaterial({
    color: 0x9a8050, roughness: 1.0, transparent: true, opacity: 0.35
  });
  const fpGeo = new THREE.CylinderGeometry(0.05, 0.06, 0.005, 6);
  for (let t = 0.06; t < STAIR_START_T; t += 0.03) {
    const pt = trailCurve.getPoint(t);
    const tang = trailCurve.getTangent(t);
    const sd = (Math.floor(t * 40) % 2 === 0) ? 1 : -1;
    const perp = new THREE.Vector3().crossVectors(tang, _up).normalize();
    const fp = new THREE.Mesh(fpGeo, mFootprint);
    fp.position.set(
      pt.x + perp.x * 0.10 * sd,
      pt.y + TRAIL_LIFT + 0.005,
      pt.z + perp.z * 0.10 * sd
    );
    fp.scale.set(0.8, 1, 1.4);
    fp.rotation.y = Math.atan2(tang.x, tang.z);
    fp.receiveShadow = true;
    G.add(fp);
  }

  /* ====== STAGE POSITIONS — grounded on trail / peak surface ====== */
  S[0].pos = trailCurve.getPoint(stageTValues[0]).clone();
  S[1].pos = trailCurve.getPoint(stageTValues[1]).clone();
  S[2].pos = trailCurve.getPoint(stageTValues[2]).clone();
  S[3].pos = trailCurve.getPoint(stageTValues[3]).clone();

  /* ====== FLAGS — brown poles with red pennants (gold on summit) ====== */
  function mkFlag(pos, stageIdx) {
    const g = new THREE.Group();
    const isSummit = stageIdx === 3;
    const poleH = isSummit ? 1.4 : 1.0;
    const flagMat = isSummit ? mGold : mRed;

    const pole = new THREE.Mesh(
      new THREE.CylinderGeometry(0.04, 0.06, poleH, 8), mTrunk);
    pole.position.y = poleH / 2;
    pole.castShadow = true; g.add(pole);

    const ball = new THREE.Mesh(
      new THREE.SphereGeometry(0.06, 10, 8), mTrunk);
    ball.position.y = poleH + 0.03; g.add(ball);

    const fs = new THREE.Shape();
    fs.moveTo(0, 0);
    fs.lineTo(0.42, 0.08);
    fs.lineTo(0, 0.24);
    fs.closePath();
    const fl = new THREE.Mesh(new THREE.ShapeGeometry(fs), flagMat);
    fl.position.set(0.04, poleH - 0.26, 0.015);
    fl.castShadow = true;
    g.add(fl);
    flags.push(fl);

    g.position.copy(pos);
    G.add(g);

    const ht = new THREE.Mesh(
      new THREE.SphereGeometry(0.9, 8, 6),
      new THREE.MeshBasicMaterial({ visible: false })
    );
    ht.position.copy(pos); ht.position.y += 0.6;
    G.add(ht); pinHits.push(ht);
  }

  S.forEach((s, i) => {
    s.hitIdx = i;
    mkFlag(s.pos, i);
    pinHits[i].userData.idx = i;
  });

  /* ====== TREES — cartoonish pines (no snow) ====== */
  function mkTree(x, y, z, h, variant) {
    const g = new THREE.Group();
    const leafMats = [mLeaf1, mLeaf2, mLeaf3];
    const mat = leafMats[variant % 3];
    const th = h * 0.25;

    /* Trunk */
    const trunk = new THREE.Mesh(
      new THREE.CylinderGeometry(h * 0.04, h * 0.07, th, 6), mTrunk);
    trunk.position.y = th / 2;
    trunk.castShadow = true; g.add(trunk);

    /* 3 foliage layers for fuller look */
    const c1 = new THREE.Mesh(new THREE.ConeGeometry(h * 0.35, h * 0.38, 8), mat);
    c1.position.y = th + h * 0.17;
    c1.castShadow = true; g.add(c1);

    const c2 = new THREE.Mesh(new THREE.ConeGeometry(h * 0.28, h * 0.32, 8), mat);
    c2.position.y = th + h * 0.40;
    c2.castShadow = true; g.add(c2);

    const c3 = new THREE.Mesh(new THREE.ConeGeometry(h * 0.18, h * 0.26, 8), mat);
    c3.position.y = th + h * 0.60;
    c3.castShadow = true; g.add(c3);

    g.position.set(x, terrainY(x, z), z);
    G.add(g);
  }

  /* Dense forest — auto-grounded to terrain surface */
  /* -- BEHIND peaks (tall background forest visible above peaks) -- */
  mkTree(-2.0, 0.10, -5.5, 2.80, 0);
  mkTree( 1.5, 0.10, -5.0, 2.60, 1);
  mkTree(-4.0, 0.10, -4.5, 2.40, 2);
  mkTree( 3.5, 0.10, -4.8, 2.30, 0);
  mkTree( 0.0, 0.10, -6.0, 2.70, 1);
  mkTree(-5.5, 0.10, -3.5, 2.10, 2);
  mkTree( 5.0, 0.10, -3.5, 2.00, 0);
  mkTree(-3.0, 0.10, -5.8, 2.20, 1);
  mkTree( 2.5, 0.10, -5.5, 2.30, 2);
  mkTree(-1.0, 0.10, -6.5, 2.50, 0);
  mkTree( 3.0, 0.10, -6.0, 2.40, 1);
  /* -- Left side — tall silhouette framing -- */
  mkTree(-6.0, 0.10, 0.0, 1.50, 0);
  mkTree(-6.5, 0.10, 1.5, 1.40, 1);
  mkTree(-5.5, 0.10, 2.5, 1.20, 2);
  mkTree(-6.2, 0.10, -1.5, 1.60, 0);
  mkTree(-7.0, 0.10, 3.0, 1.30, 1);
  /* -- Right side — tall silhouette framing -- */
  mkTree( 6.0, 0.10, 0.5, 1.45, 1);
  mkTree( 6.5, 0.10, 1.8, 1.35, 2);
  mkTree( 6.2, 0.10, -1.0, 1.55, 0);
  mkTree( 7.0, 0.10, 3.0, 1.25, 1);
  /* -- Front hills — relocated away from trail corridor -- */
  mkTree(-4.2, 0.10, 4.5, 0.85, 0);
  mkTree( 0.3, 0.10, 6.5, 0.82, 1);
  mkTree(-0.5, 0.10, 6.2, 0.78, 2);
  mkTree( 4.8, 0.10, 3.2, 0.72, 0);
  mkTree(-4.0, 0.10, 3.2, 0.68, 1);
  mkTree(-2.5, 0.10, 6.5, 0.65, 0);
  mkTree( 1.0, 0.10, 7.0, 0.70, 1);
  mkTree( 5.2, 0.10, 3.5, 0.58, 2);
  mkTree(-3.5, 0.10, 5.5, 0.60, 0);
  mkTree(-0.8, 0.10, 7.2, 0.52, 1);
  /* -- Between peaks — mid elevation, away from trail -- */
  mkTree(-3.8, 0.10, 1.2, 0.52, 0);
  mkTree( 2.8, 0.10, 1.2, 0.48, 1);
  mkTree(-4.2, 0.10, 0.5, 0.42, 2);
  mkTree( 4.2, 0.10, 0.5, 0.40, 0);
  /* -- Thinning at higher elevation -- */
  mkTree(-2.5, 0.10, -0.5, 0.38, 0);
  mkTree( 2.5, 0.10, -0.8, 0.35, 1);
  mkTree(-1.0, 0.10, -1.5, 0.32, 2);
  mkTree( 1.5, 0.10, -1.5, 0.30, 0);

  /* ====== GROUND COVER BUSHES — layered vegetation for forest depth ====== */
  function mkBush(x, y, z, s, variant) {
    const leafMats = [mLeaf1, mLeaf2, mLeaf3];
    const mat = leafMats[variant % 3];
    const g = new THREE.Group();
    for (let i = 0; i < 3 + Math.floor(Math.random() * 3); i++) {
      const puff = new THREE.Mesh(
        new THREE.SphereGeometry(s * (0.5 + Math.random() * 0.5), 8, 6),
        mat
      );
      puff.position.set(
        (Math.random() - 0.5) * s * 1.2,
        s * 0.3 + Math.random() * s * 0.2,
        (Math.random() - 0.5) * s * 1.2
      );
      puff.scale.y = 0.6;
      puff.castShadow = true;
      g.add(puff);
    }
    g.position.set(x, terrainY(x, z), z);
    G.add(g);
  }
  /* Bushes along forest floor — relocated away from trail corridor */
  mkBush(-1.5, 0.0, 5.8, 0.25, 0);
  mkBush( 0.8, 0.0, 6.5, 0.22, 1);
  mkBush(-4.5, 0.0, 3.5, 0.28, 2);
  mkBush( 2.5, 0.0, 6.0, 0.24, 0);
  mkBush(-4.5, 0.0, 1.8, 0.20, 1);
  mkBush( 4.5, 0.0, 2.0, 0.22, 2);
  mkBush(-2.5, 0.0, 6.8, 0.18, 0);
  mkBush( 1.5, 0.0, 7.2, 0.20, 1);
  mkBush(-5.0, 0.0, 3.0, 0.22, 2);
  mkBush( 5.0, 0.0, 3.0, 0.20, 0);
  mkBush(-3.0, 0.0, -2.0, 0.26, 1);
  mkBush( 3.0, 0.0, -2.0, 0.24, 2);
  mkBush( 0.0, 0.0, -3.5, 0.22, 0);
  mkBush(-4.0, 0.0, -1.0, 0.20, 1);
  mkBush( 4.0, 0.0, -1.0, 0.18, 2);

  /* ====== FLOWERS — small clusters of colour on the grass ====== */
  function mkFlower(x, y, z, mat) {
    const g = new THREE.Group();
    const stem = new THREE.Mesh(
      new THREE.CylinderGeometry(0.015, 0.015, 0.12, 4), mLeaf2);
    stem.position.y = 0.06; g.add(stem);
    const head = new THREE.Mesh(
      new THREE.SphereGeometry(0.06, 8, 6), mat);
    head.position.y = 0.14; g.add(head);
    g.position.set(x, terrainY(x, z), z);
    G.add(g);
  }
  const flowerMats = [mFlower1, mFlower2, mFlower3];
  const flowerSpots = [
    [-1.5,0.05,3.5], [0.8,0.05,3.8], [-2.8,0.05,3.8], [2.5,0.05,4.2],
    [-0.3,0.05,4.0], [3.5,0.05,4.8], [-3.8,0.05,3.5], [1.8,0.05,4.5],
    [-1.0,0.05,5.0], [0.5,0.05,5.5], [-2.2,0.05,5.2], [3.0,0.05,3.5],
    [-4.2,0.05,2.5], [4.5,0.05,3.8], [-0.8,0.05,2.8], [1.2,0.05,2.8],
    [-3.0,0.05,2.0], [2.0,0.05,1.8], [-1.5,0.05,1.5], [0.0,0.05,2.0],
  ];
  flowerSpots.forEach((p, i) => mkFlower(p[0], p[1], p[2], flowerMats[i % 3]));

  /* ====== FOREST FLOOR — moss patches + ground cover for layered depth ====== */
  const mMoss1 = new THREE.MeshStandardMaterial({ color: 0x2a5520, roughness: 0.95 });
  const mMoss2 = new THREE.MeshStandardMaterial({ color: 0x3a6828, roughness: 0.95 });
  const mGroundCov = new THREE.MeshStandardMaterial({
    color: 0x4a6a35, roughness: 0.9, transparent: true, opacity: 0.65
  });
  function mkMoss(x, z, s) {
    const m = new THREE.Mesh(
      new THREE.SphereGeometry(s, 8, 5, 0, Math.PI*2, 0, Math.PI/2),
      Math.random() > 0.5 ? mMoss1 : mMoss2
    );
    m.position.set(x, terrainY(x, z) + 0.01, z);
    m.scale.y = 0.25;
    m.receiveShadow = true;
    G.add(m);
  }
  function mkGroundPatch(x, z, r) {
    const p = new THREE.Mesh(new THREE.CircleGeometry(r, 12), mGroundCov);
    p.position.set(x, terrainY(x, z) + 0.01, z);
    p.rotation.x = -Math.PI / 2;
    p.receiveShadow = true;
    G.add(p);
  }
  /* Moss mounds near trees and rocks */
  [[-2.8,3.5],[-1.5,4.5],[1.2,3.8],[3.0,4.0],[-3.8,2.5],[2.2,2.5],
   [-0.5,5.0],[4.0,3.5],[-4.5,1.5],[0.5,4.8],[-2.0,2.0],[1.5,1.5],
   [-3.2,4.5],[2.8,3.0],[-0.8,3.2],[1.8,5.2]].forEach(([x,z]) =>
    mkMoss(x, z, 0.12 + Math.random() * 0.18));
  /* Dark ground patches — gives forest floor texture variation */
  [[-1.0,4.0,0.5],[2.0,3.5,0.4],[-3.0,3.0,0.45],[0.0,5.0,0.35],
   [3.5,2.5,0.3],[-4.0,4.0,0.4],[1.5,5.5,0.3],[-2.5,5.0,0.35],
   [-1.5,2.5,0.3],[3.0,1.5,0.25],[0.5,3.0,0.4],[-4.5,3.5,0.3]].forEach(([x,z,r]) =>
    mkGroundPatch(x, z, r));

  /* ====== STARTUP FOUNDERS — stylized professionals on the trail ====== */
  const hikerData = [];
  const mBlazer1  = new THREE.MeshStandardMaterial({ color: 0x1e3a5f, roughness: 0.7 }); /* navy */
  const mBlazer2  = new THREE.MeshStandardMaterial({ color: 0x3a3a3a, roughness: 0.7 }); /* charcoal */
  const mBlazer3  = new THREE.MeshStandardMaterial({ color: 0x5a3a2a, roughness: 0.7 }); /* brown */
  const mWhiteShirt = new THREE.MeshStandardMaterial({ color: 0xf0ede8, roughness: 0.6 });
  const mTie      = new THREE.MeshStandardMaterial({ color: 0xc0392b, roughness: 0.5 }); /* red tie */
  const mBriefcase = new THREE.MeshStandardMaterial({ color: 0x5a3a20, roughness: 0.75 }); /* leather */
  const mSlacks   = new THREE.MeshStandardMaterial({ color: 0x2c2c3a, roughness: 0.8 }); /* dark */
  const mShoe     = new THREE.MeshStandardMaterial({ color: 0x2a2018, roughness: 0.8 });
  const mHair1    = new THREE.MeshStandardMaterial({ color: 0x2a1a0a, roughness: 0.85 });
  const mHair2    = new THREE.MeshStandardMaterial({ color: 0x4a3018, roughness: 0.85 });

  function mkFounder(x, y, z, blazerMat, hairMat, faceDir) {
    const g = new THREE.Group();
    /* Body — blazer */
    const body = new THREE.Mesh(
      new THREE.CapsuleGeometry(0.12, 0.22, 6, 8), blazerMat);
    body.position.y = 0.30; body.castShadow = true; g.add(body);
    /* Shirt collar — visible at neckline */
    const collar = new THREE.Mesh(
      new THREE.CylinderGeometry(0.08, 0.10, 0.04, 8), mWhiteShirt);
    collar.position.y = 0.43; g.add(collar);
    /* Tie */
    const tie = new THREE.Mesh(
      new THREE.BoxGeometry(0.03, 0.12, 0.02), mTie);
    tie.position.set(0, 0.32, 0.10); g.add(tie);
    /* Head */
    const head = new THREE.Mesh(
      new THREE.SphereGeometry(0.10, 10, 8), mSkin);
    head.position.y = 0.55; head.castShadow = true; g.add(head);
    /* Hair — full visible hairstyle */
    const hair = new THREE.Mesh(
      new THREE.SphereGeometry(0.11, 10, 8, 0, Math.PI * 2, 0, Math.PI * 0.6), hairMat);
    hair.position.y = 0.58; hair.scale.set(1.08, 0.85, 1.05); g.add(hair);
    const hairBack = new THREE.Mesh(
      new THREE.SphereGeometry(0.08, 8, 6), hairMat);
    hairBack.position.set(0, 0.60, -0.03); hairBack.scale.set(1.1, 0.5, 0.9); g.add(hairBack);
    /* Legs — slacks */
    const legL = new THREE.Mesh(
      new THREE.CapsuleGeometry(0.04, 0.14, 4, 6), mSlacks);
    legL.position.set(-0.05, 0.10, 0); g.add(legL);
    const legR = new THREE.Mesh(
      new THREE.CapsuleGeometry(0.04, 0.14, 4, 6), mSlacks);
    legR.position.set(0.05, 0.10, 0); g.add(legR);
    /* Shoes */
    const shoeL = new THREE.Mesh(new THREE.BoxGeometry(0.06, 0.03, 0.09), mShoe);
    shoeL.position.set(-0.05, 0.02, 0.01); g.add(shoeL);
    const shoeR = new THREE.Mesh(new THREE.BoxGeometry(0.06, 0.03, 0.09), mShoe);
    shoeR.position.set(0.05, 0.02, 0.01); g.add(shoeR);
    /* Briefcase — carried at side */
    const bc = new THREE.Mesh(
      new THREE.BoxGeometry(0.10, 0.08, 0.03), mBriefcase);
    bc.position.set(0.15, 0.18, 0.04); bc.castShadow = true; g.add(bc);
    /* Briefcase handle */
    const bcH = new THREE.Mesh(
      new THREE.TorusGeometry(0.025, 0.005, 6, 8, Math.PI), mBriefcase);
    bcH.position.set(0.15, 0.23, 0.04); bcH.rotation.z = Math.PI; g.add(bcH);

    g.position.set(x, y + 0.18, z);
    g.rotation.y = faceDir;
    G.add(g);
    hikerData.push({ group: g, legL, legR, baseY: y + 0.18 });
    return g;
  }

  /* Place founders along trail curve — grounded on trail surface */
  const blazerMats = [mBlazer1, mBlazer2, mBlazer3];
  const hairMats = [mHair1, mHair2, mHair1];
  [0.06, 0.14, 0.22, 0.38, 0.52, 0.64, 0.80].forEach((t, i) => {
    const pt = trailCurve.getPoint(t);
    const tang = trailCurve.getTangent(t);
    const faceAngle = Math.atan2(tang.x, tang.z);
    mkFounder(pt.x, pt.y + 0.02, pt.z, blazerMats[i % 3], hairMats[i % 3], faceAngle);
  });

  /* ====== HERO — startup CEO protagonist, larger + detailed ====== */
  const mHeroBlazer = new THREE.MeshStandardMaterial({ color: 0x1a2e4a, roughness: 0.65 }); /* dark navy */
  const mHeroWhite = new THREE.MeshStandardMaterial({ color: 0xf5f0ea, roughness: 0.55 });
  const mHeroTie = new THREE.MeshStandardMaterial({ color: 0xF8AF21, roughness: 0.4 }); /* gold tie */
  const mHeroSlacks = new THREE.MeshStandardMaterial({ color: 0x1e2a38, roughness: 0.75 });
  const mHeroShoe = new THREE.MeshStandardMaterial({ color: 0x2a1810, roughness: 0.8 });
  const mHeroHair = new THREE.MeshStandardMaterial({ color: 0x1a0e05, roughness: 0.85 });
  const mHeroBrief = new THREE.MeshStandardMaterial({ color: 0x6a3a18, roughness: 0.7 }); /* leather */
  const mStick = new THREE.MeshStandardMaterial({ color: 0x8a6a3a, roughness: 0.9 });

  hero = new THREE.Group();
  /* Body — blazer */
  const hBody = new THREE.Mesh(new THREE.CapsuleGeometry(0.18, 0.30, 8, 10), mHeroBlazer);
  hBody.position.y = 0.42; hBody.castShadow = true; hero.add(hBody);
  /* Shirt collar */
  const hCollar = new THREE.Mesh(new THREE.CylinderGeometry(0.12, 0.14, 0.05, 10), mHeroWhite);
  hCollar.position.y = 0.60; hero.add(hCollar);
  /* Tie */
  const hTie = new THREE.Mesh(new THREE.BoxGeometry(0.04, 0.16, 0.02), mHeroTie);
  hTie.position.set(0, 0.44, 0.14); hero.add(hTie);
  /* Head */
  const hHead = new THREE.Mesh(new THREE.SphereGeometry(0.15, 12, 10), mSkin);
  hHead.position.y = 0.78; hHead.castShadow = true; hero.add(hHead);
  /* Hair — full styled hair, clearly visible */
  const hHairMain = new THREE.Mesh(
    new THREE.SphereGeometry(0.16, 12, 10, 0, Math.PI * 2, 0, Math.PI * 0.6), mHeroHair);
  hHairMain.position.y = 0.82; hHairMain.scale.set(1.08, 0.85, 1.05); hero.add(hHairMain);
  /* Hair side volume */
  const hHairSide = new THREE.Mesh(
    new THREE.SphereGeometry(0.12, 10, 8), mHeroHair);
  hHairSide.position.set(0, 0.84, -0.04); hHairSide.scale.set(1.15, 0.55, 0.9); hero.add(hHairSide);
  /* Hair top tuft for style */
  const hHairTop = new THREE.Mesh(
    new THREE.SphereGeometry(0.08, 8, 6), mHeroHair);
  hHairTop.position.set(0.02, 0.90, 0.04); hHairTop.scale.set(1.2, 0.6, 1.0); hero.add(hHairTop);
  /* Left arm */
  const hArmL = new THREE.Mesh(new THREE.CapsuleGeometry(0.05, 0.18, 4, 6), mHeroBlazer);
  hArmL.position.set(-0.22, 0.48, 0); hArmL.rotation.z = 0.25; hero.add(hArmL);
  /* Right arm */
  const hArmR = new THREE.Mesh(new THREE.CapsuleGeometry(0.05, 0.18, 4, 6), mHeroBlazer);
  hArmR.position.set(0.22, 0.48, 0); hArmR.rotation.z = -0.25; hero.add(hArmR);
  /* Legs — slacks */
  const hLegL = new THREE.Mesh(new THREE.CapsuleGeometry(0.06, 0.20, 4, 6), mHeroSlacks);
  hLegL.position.set(-0.08, 0.13, 0); hero.add(hLegL);
  const hLegR = new THREE.Mesh(new THREE.CapsuleGeometry(0.06, 0.20, 4, 6), mHeroSlacks);
  hLegR.position.set(0.08, 0.13, 0); hero.add(hLegR);
  /* Dress shoes */
  const hShoeL = new THREE.Mesh(new THREE.BoxGeometry(0.08, 0.04, 0.12), mHeroShoe);
  hShoeL.position.set(-0.08, 0.02, 0.02); hero.add(hShoeL);
  const hShoeR = new THREE.Mesh(new THREE.BoxGeometry(0.08, 0.04, 0.12), mHeroShoe);
  hShoeR.position.set(0.08, 0.02, 0.02); hero.add(hShoeR);
  /* Briefcase — carried at right side */
  const hBrief = new THREE.Mesh(new THREE.BoxGeometry(0.16, 0.12, 0.04), mHeroBrief);
  hBrief.position.set(0.26, 0.22, 0.06); hBrief.castShadow = true; hero.add(hBrief);
  const hBriefH = new THREE.Mesh(
    new THREE.TorusGeometry(0.035, 0.008, 6, 8, Math.PI), mHeroBrief);
  hBriefH.position.set(0.26, 0.29, 0.06); hBriefH.rotation.z = Math.PI; hero.add(hBriefH);
  /* Walking stick — placeholder, hidden when not used */
  hStick = new THREE.Mesh(new THREE.CylinderGeometry(0.015, 0.02, 0.9, 6), mStick);
  hStick.position.set(0.28, 0.35, 0.08); hStick.rotation.z = -0.15;
  hStick.visible = false; hero.add(hStick);

  /* Business plan — canvas texture with visible content, shown at stage 2 */
  const planCanvas = document.createElement('canvas');
  planCanvas.width = 256; planCanvas.height = 192;
  const ctx = planCanvas.getContext('2d');
  /* Background */
  ctx.fillStyle = '#f5f0e0'; ctx.fillRect(0, 0, 256, 192);
  /* Header */
  ctx.fillStyle = '#1a2e4a'; ctx.font = 'bold 16px sans-serif';
  ctx.fillText('BUSINESS PLAN', 20, 28);
  /* Horizontal rule */
  ctx.strokeStyle = '#F8AF21'; ctx.lineWidth = 2;
  ctx.beginPath(); ctx.moveTo(20, 36); ctx.lineTo(236, 36); ctx.stroke();
  /* Section lines */
  ctx.fillStyle = '#3a4a5a'; ctx.font = '10px sans-serif';
  const lines = ['Market Analysis', 'Target Customers', 'Revenue Model',
    'Growth Strategy', 'Team & Advisors', 'Financial Projections'];
  lines.forEach((l, li) => {
    const yy = 52 + li * 22;
    ctx.fillStyle = '#1a2e4a'; ctx.font = 'bold 9px sans-serif';
    ctx.fillText(l, 20, yy);
    ctx.fillStyle = '#8a8a8a'; ctx.font = '8px sans-serif';
    ctx.fillRect(20, yy + 4, 120 + Math.random() * 80, 1.5);
    ctx.fillRect(20, yy + 9, 80 + Math.random() * 60, 1.5);
  });
  /* Chart icon */
  ctx.strokeStyle = '#F8AF21'; ctx.lineWidth = 2;
  ctx.beginPath(); ctx.moveTo(180, 120); ctx.lineTo(195, 90);
  ctx.lineTo(210, 100); ctx.lineTo(230, 60); ctx.stroke();
  /* Logo placeholder */
  ctx.fillStyle = '#F8AF21'; ctx.beginPath();
  ctx.arc(230, 26, 8, 0, Math.PI * 2); ctx.fill();

  const planTex = new THREE.CanvasTexture(planCanvas);
  const mPlan = new THREE.MeshStandardMaterial({
    map: planTex, roughness: 0.5, side: THREE.DoubleSide
  });
  const hMapGeo = new THREE.PlaneGeometry(0.34, 0.25);
  hMapMesh = new THREE.Mesh(hMapGeo, mPlan);
  hMapMesh.position.set(-0.32, 0.55, 0.18);
  hMapMesh.rotation.set(-0.3, 0.4, 0);
  hMapMesh.visible = false;
  hero.add(hMapMesh);

  /* Mini flag — hidden by default, shown in stage 4 summit */
  heroFlagGroup = new THREE.Group();
  const hfPole = new THREE.Mesh(new THREE.CylinderGeometry(0.02, 0.025, 0.6, 6), mStick);
  hfPole.position.y = 0.3; heroFlagGroup.add(hfPole);
  const hfShape = new THREE.Shape();
  hfShape.moveTo(0,0); hfShape.lineTo(0.22,0.05); hfShape.lineTo(0,0.14); hfShape.closePath();
  const hfFlag = new THREE.Mesh(new THREE.ShapeGeometry(hfShape), mGold);
  hfFlag.position.set(0.025, 0.42, 0.01); heroFlagGroup.add(hfFlag);
  heroFlagGroup.visible = false;
  heroFlagGroup.position.set(-0.25, 0, 0.15);
  hero.add(heroFlagGroup);

  /* Start hero at trailhead — grounded on trail slab surface */
  hero.position.copy(S[0].pos);
  hero.position.y += 0.20;
  heroTrailT = stageTValues[0];
  hero.scale.setScalar(1.3);
  G.add(hero);

  /* Hero animation state — reinitialize (declared at module scope) */
  heroStage = -1;
  heroAnimState = 'idle';
  heroAnimTime = 0;

  /* Stage-specific camera angles — top-side-left perspective along trail */
  stageCams = [
    { offset: new THREE.Vector3(-3.0, 2.5, 3.5), lookUp: 0.3 },  // trailhead: left-above
    { offset: new THREE.Vector3(-2.5, 2.5, 3.5), lookUp: 0.3 },  // basecamp: left-above — adjusted for farther pos
    { offset: new THREE.Vector3(-3.0, 3.0, 3.5), lookUp: 0.4 },  // ascent: left-above
    { offset: new THREE.Vector3(-3.5, 3.5, 4.0), lookUp: 0.5 },  // summit: left-above panoramic
  ];

  /* ====== CLOUDS — puffy cartoonish clouds ====== */
  const cloudMat = new THREE.MeshStandardMaterial({
    color: 0xffffff, roughness: 0.9, transparent: true, opacity: 0.85
  });
  const clouds = [];
  function mkCloud(x, y, z, s) {
    const g = new THREE.Group();
    const puffs = [
      { x: 0, y: 0, z: 0, r: s },
      { x: s * 0.7, y: s * 0.15, z: 0, r: s * 0.7 },
      { x: -s * 0.65, y: s * 0.1, z: 0, r: s * 0.65 },
      { x: s * 0.3, y: s * 0.35, z: 0, r: s * 0.5 },
      { x: -s * 0.2, y: s * 0.3, z: s * 0.2, r: s * 0.45 },
    ];
    puffs.forEach(p => {
      const m = new THREE.Mesh(new THREE.SphereGeometry(p.r, 12, 10), cloudMat);
      m.position.set(p.x, p.y, p.z);
      m.scale.y = 0.5;
      g.add(m);
    });
    g.position.set(x, y, z);
    G.add(g);
    clouds.push(g);
    return g;
  }
  mkCloud(-5, 9.0, -3, 1.2);
  mkCloud(6, 9.5, -2, 1.0);
  mkCloud(-2, 10, -5, 0.9);
  mkCloud(4, 8.5, 2, 0.8);
  mkCloud(0, 10, -7, 1.1);

  /* ====== LABELS (HTML floating) ====== */
  S.forEach((s, i) => {
    const el = document.createElement('div');
    el.className = 'alt3d-flag-label';
    el.innerHTML = `<span data-i="${i}">${s.id} \u00b7 ${s.n}</span>`;
    lblCont.appendChild(el);
    s.el = el;
    el.querySelector('span').addEventListener('click', () => zoomToFlag(i));
  });

  /* Dots */
  const dotCont = document.getElementById('alt3dDots');
  dotCont.querySelectorAll('.alt3d-dot').forEach(d =>
    d.addEventListener('click', () => zoomToFlag(parseInt(d.dataset.i)))
  );

  /* Click / hover on canvas */
  const ray = new THREE.Raycaster();
  const ms = new THREE.Vector2();

  cv.addEventListener('pointermove', e => {
    ms.x = (e.clientX / window.innerWidth) * 2 - 1;
    ms.y = -(e.clientY / window.innerHeight) * 2 + 1;
    ray.setFromCamera(ms, cam);
    cv.style.cursor = ray.intersectObjects(pinHits).length ? 'pointer' : 'grab';
  });

  cv.addEventListener('click', e => {
    ms.x = (e.clientX / window.innerWidth) * 2 - 1;
    ms.y = -(e.clientY / window.innerHeight) * 2 + 1;
    ray.setFromCamera(ms, cam);
    const h = ray.intersectObjects(pinHits);
    if (h.length) zoomToFlag(h[0].object.userData.idx);
  });

  /* Keyboard */
  document.addEventListener('keydown', e => {
    if (!overlay.classList.contains('active')) return;
    if (e.key === 'Escape') { if (zoomed) overviewCamera(); else closeOverlay(); }
    if (e.key === 'ArrowRight' && zoomed && active < S.length - 1) { hideInfoCard(); setTimeout(() => zoomToFlag(active + 1), 300); }
    if (e.key === 'ArrowLeft' && zoomed && active > 0) { hideInfoCard(); setTimeout(() => zoomToFlag(active - 1), 300); }
  });

  /* Navigation buttons */
  if (btnPrev) btnPrev.addEventListener('click', () => { if (active > 0) { hideInfoCard(); setTimeout(() => zoomToFlag(active - 1), 300); } });
  if (btnNext) btnNext.addEventListener('click', () => { if (active < S.length - 1) { hideInfoCard(); setTimeout(() => zoomToFlag(active + 1), 300); } });
  if (btnOvw) btnOvw.addEventListener('click', overviewCamera);

  /* Entrance animation */
  G.scale.setScalar(0);
  G.rotation.y = -0.4;
  gsap.to(G.scale, { x: 1, y: 1, z: 1, duration: 1.4, ease: 'elastic.out(1,0.65)', delay: 0.15 });
  gsap.to(G.rotation, { y: 0, duration: 1.4, ease: 'power3.out', delay: 0.15 });

  /* Resize */
  window.addEventListener('resize', onResize);

  /* ====== RENDER LOOP ====== */
  const ck = new THREE.Clock();

  (function anim() {
    requestAnimationFrame(anim);
    if (!overlay.classList.contains('active')) return;

    const et = ck.getElapsedTime();
    if (!zoomed) G.rotation.y += 0.0012;

    /* Flag flutter */
    flags.forEach((f, i) => {
      f.rotation.y = -0.3 + Math.sin(et * 2.8 + i * 1.4) * 0.15;
    });

    /* Hiker walking animation — legs swing */
    hikerData.forEach((h, i) => {
      const swing = Math.sin(et * 3.0 + i * 2.1) * 0.25;
      h.legL.rotation.x = swing;
      h.legR.rotation.x = -swing;
      h.group.position.y = h.baseY + Math.abs(Math.sin(et * 3.0 + i * 2.1)) * 0.03;
    });

    /* Hero animation based on state */
    heroAnimTime += 0.016;
    if (heroAnimState === 'walking') {
      const ws = Math.sin(et * 5.0) * 0.35;
      hLegL.rotation.x = ws;
      hLegR.rotation.x = -ws;
      hArmL.rotation.x = -ws * 0.6;
      hArmR.rotation.x = ws * 0.6;
      hero.position.y += Math.abs(Math.sin(et * 5.0)) * 0.004;
    } else if (heroAnimState === 'idle') {
      hLegL.rotation.x *= 0.9;
      hLegR.rotation.x *= 0.9;
      hArmL.rotation.x *= 0.9;
      hArmR.rotation.x *= 0.9;
      /* Gentle breathing */
      hBody.scale.y = 1.0 + Math.sin(et * 1.5) * 0.02;
    } else if (heroAnimState === 'looking') {
      /* Looking at map — head turns side to side */
      hHead.rotation.y = Math.sin(et * 0.8) * 0.5;
      hArmL.rotation.x = -0.8; /* holding map out */
      hArmL.rotation.z = 0.3;
      hBody.scale.y = 1.0 + Math.sin(et * 1.2) * 0.015;
    } else if (heroAnimState === 'climbing') {
      /* Slower, heavier steps */
      const cs = Math.sin(et * 2.0) * 0.2;
      hLegL.rotation.x = cs;
      hLegR.rotation.x = -cs;
      hArmL.rotation.x = -cs * 0.4;
      hArmR.rotation.x = cs * 0.4;
      /* Heavy breathing — bigger body swell */
      hBody.scale.y = 1.0 + Math.sin(et * 2.5) * 0.04;
      hBody.scale.x = 1.0 + Math.sin(et * 2.5) * 0.015;
    } else if (heroAnimState === 'celebrating') {
      /* Standing tall at summit with gentle fist-pump */
      const jmp = Math.max(0, Math.sin(et * 4.0)) * 0.12;
      hero.position.y = S[3].pos.y + 0.20 + jmp;
      hArmL.rotation.z = 1.2 + Math.sin(et * 3.0) * 0.3;
      hArmR.rotation.z = -1.2 - Math.sin(et * 3.0) * 0.3;
      hArmL.rotation.x *= 0.9;
      hArmR.rotation.x *= 0.9;
      hLegL.rotation.x = Math.sin(et * 4.0) * 0.15;
      hLegR.rotation.x = -Math.sin(et * 4.0) * 0.15;
      hBody.scale.y = 1.0 + Math.sin(et * 2.0) * 0.02;
    }

    /* Cloud drift */
    clouds.forEach((c, i) => {
      c.position.x += Math.sin(et * 0.15 + i * 1.5) * 0.002;
      c.position.z += Math.cos(et * 0.1 + i * 2.0) * 0.001;
    });

    /* Confetti animation */
    if (confettiParts.length > 0) {
      const cdt = 0.016;
      confettiParts = confettiParts.filter(p => {
        p.vy += p.gravity * cdt;
        p.mesh.position.x += p.vx * cdt;
        p.mesh.position.y += p.vy * cdt;
        p.mesh.position.z += p.vz * cdt;
        p.mesh.rotation.x += p.rotX * cdt;
        p.mesh.rotation.y += p.rotY * cdt;
        p.life -= cdt;
        if (p.life < 0.5) p.mesh.material.opacity = p.life / 0.5;
        return p.life > 0;
      });
      if (confettiParts.length === 0) clearConfetti();
    }

    oc.update();
    updateLabels();
    R.render(scene, cam);
  })();
}

/* =============================================================
   CAMERA
   ============================================================= */
const OVP = new THREE.Vector3(10, 5.5, 13);
const OVT = new THREE.Vector3(0, 2.0, 0);

/* Confetti system for summit celebration */
function spawnConfetti(pos) {
  clearConfetti();
  confettiGroup = new THREE.Group();
  confettiParts = [];
  const colors = [0xe85040, 0xF8AF21, 0x3588d0, 0x4CAF50, 0xff69b4, 0xffffff];
  for (let j = 0; j < 80; j++) {
    const mat = new THREE.MeshBasicMaterial({
      color: colors[j % colors.length], side: THREE.DoubleSide,
      transparent: true, opacity: 1.0
    });
    const m = new THREE.Mesh(
      new THREE.PlaneGeometry(0.06 + Math.random() * 0.06, 0.04 + Math.random() * 0.04), mat);
    m.position.copy(pos);
    m.position.y += 1.0;
    confettiGroup.add(m);
    confettiParts.push({
      mesh: m,
      vx: (Math.random() - 0.5) * 4,
      vy: 3 + Math.random() * 5,
      vz: (Math.random() - 0.5) * 4,
      rotX: (Math.random() - 0.5) * 8,
      rotY: (Math.random() - 0.5) * 6,
      gravity: -5 - Math.random() * 3,
      life: 3.0 + Math.random() * 2.0
    });
  }
  G.add(confettiGroup);
}
function clearConfetti() {
  if (confettiGroup) {
    G.remove(confettiGroup);
    confettiGroup.traverse(c => {
      if (c.geometry) c.geometry.dispose();
      if (c.material) c.material.dispose();
    });
    confettiGroup = null;
  }
  confettiParts = [];
}

function zoomToFlag(i) {
  gsap.killTweensOf(cam.position);
  gsap.killTweensOf(oc.target);
  active = i; zoomed = true;
  overlay.classList.add('zoomed');
  oc.enabled = false;

  const wp = new THREE.Vector3();
  pinHits[i].getWorldPosition(wp);

  /* Stage-specific camera positioning */
  const sc = stageCams[i];
  const cp = new THREE.Vector3(
    wp.x + sc.offset.x,
    wp.y + sc.offset.y,
    wp.z + sc.offset.z
  );
  const lk = wp.clone(); lk.y += sc.lookUp;

  gsap.to(cam.position, { x: cp.x, y: cp.y, z: cp.z, duration: 1.4, ease: 'power2.inOut' });
  gsap.to(oc.target, { x: lk.x, y: lk.y, z: lk.z, duration: 1.4, ease: 'power2.inOut' });

  /* Move hero to this stage */
  heroStage = i;
  heroAnimTime = 0;
  hMapMesh.visible = false;
  heroFlagGroup.visible = false;
  hStick.visible = false;
  clearConfetti();

  /* Animate hero walking ALONG the trail curve between stages */
  let startT = Number.isFinite(heroTrailT) ? heroTrailT : stageTValues[0];
  startT = Math.max(0, Math.min(1, startT));
  const endT = stageTValues[i];
  const walkObj = { t: startT };
  const stopPos = S[i].pos;

  heroAnimState = 'walking';
  gsap.to(walkObj, {
    t: endT, duration: 2.0, ease: 'power1.inOut',
    onUpdate() {
      if (!trailCurve) return;
      const pt = trailCurve.getPoint(walkObj.t);
      hero.position.set(pt.x, pt.y + 0.20, pt.z);
      heroTrailT = walkObj.t;
      /* Face along trail tangent direction */
      const tang = trailCurve.getTangent(walkObj.t);
      const dir = endT > startT ? 1 : -1;
      hero.rotation.y = Math.atan2(tang.x * dir, tang.z * dir);
    },
    onComplete() {
      heroTrailT = endT;
      /* Exact stop at stage flag marker */
      hero.position.set(stopPos.x, stopPos.y + 0.20, stopPos.z);
      const endTang = trailCurve ? trailCurve.getTangent(endT) : null;
      if (endTang) {
        const dir = endT >= startT ? 1 : -1;
        hero.rotation.y = Math.atan2(endTang.x * dir, endTang.z * dir);
      }

      /* Stage-specific idle animation */
      if (i === 0) {
        heroAnimState = 'idle'; // standing at trailhead
        hStick.visible = false;
      } else if (i === 1) {
        heroAnimState = 'looking'; // reading business plan at basecamp
        hStick.visible = false;
        hMapMesh.visible = true;
      } else if (i === 2) {
        heroAnimState = 'climbing'; // tired, climbing
        hero.rotation.x = 0.15; // leaning forward
      } else if (i === 3) {
        heroAnimState = 'celebrating'; // jump + confetti at summit
        hStick.visible = false;
        heroFlagGroup.visible = false;
        /* Launch confetti celebration */
        spawnConfetti(S[3].pos);
      }
    }
  });

  document.querySelectorAll('.alt3d-dot').forEach((d, j) => d.classList.toggle('active', j === i));
  showInfoCard(i);
}

function overviewCamera() {
  gsap.killTweensOf(cam.position);
  gsap.killTweensOf(oc.target);
  zoomed = false; active = -1;
  overlay.classList.remove('zoomed');

  gsap.to(cam.position, { x: OVP.x, y: OVP.y, z: OVP.z, duration: 1.2, ease: 'power2.inOut', onComplete() { oc.enabled = true; } });
  gsap.to(oc.target, { x: OVT.x, y: OVT.y, z: OVT.z, duration: 1.2, ease: 'power2.inOut' });

  /* Reset hero to trailhead */
  heroAnimState = 'idle';
  hMapMesh.visible = false;
  heroFlagGroup.visible = false;
  hStick.visible = false;
  hero.rotation.x = 0;
  clearConfetti();
  gsap.to(hero.position, { x: S[0].pos.x, y: S[0].pos.y + 0.20, z: S[0].pos.z, duration: 1.0, ease: 'power2.inOut' });
  gsap.to(hero.rotation, { y: -0.8, duration: 0.6, ease: 'power2.out' });

  document.querySelectorAll('.alt3d-dot').forEach(d => d.classList.remove('active'));
  hideInfoCard();
}

/* =============================================================
   INFO CARD
   ============================================================= */
function showInfoCard(i) {
  const s = S[i];
  ciNum.textContent   = 'Stage ' + s.id;
  ciName.textContent  = s.n;
  ciPhase.textContent = s.p;
  ciDur.textContent   = s.d;
  ciDesc.textContent  = s.x;
  btnPrev.disabled = i === 0;
  btnNext.disabled = i === S.length - 1;
  gsap.to(infoCard, { opacity: 1, x: 0, duration: 0.45, delay: 0.5, ease: 'power2.out',
    onStart() { infoCard.classList.add('vis'); } });
}
function hideInfoCard() {
  gsap.to(infoCard, { opacity: 0, x: 46, duration: 0.28, ease: 'power2.in',
    onComplete() { infoCard.classList.remove('vis'); } });
}

/* =============================================================
   LABELS
   ============================================================= */
const _v = new THREE.Vector3();
function updateLabels() {
  S.forEach((s, i) => {
    if (!s.el) return;
    pinHits[i].getWorldPosition(_v);
    _v.y += 1.0;
    const p = _v.clone().project(cam);
    if (p.z >= 1) { s.el.style.opacity = '0'; return; }
    s.el.style.left = ((p.x * .5 + .5) * window.innerWidth) + 'px';
    s.el.style.top  = ((-p.y * .5 + .5) * window.innerHeight) + 'px';
    s.el.style.transform = 'translate(-50%,-100%)';
    s.el.style.opacity = zoomed ? '0' : '1';
  });
}

/* =============================================================
   RESIZE
   ============================================================= */
function onResize() {
  if (!sceneReady) return;
  cam.aspect = window.innerWidth / window.innerHeight;
  cam.updateProjectionMatrix();
  R.setSize(window.innerWidth, window.innerHeight);
}
