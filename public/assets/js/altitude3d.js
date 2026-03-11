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

  /* Left peak — medium */
  const pk2 = mtnPeak(2.8, 5.2, 40, mGrassD);
  pk2.position.set(-3.2, 0, 0.5);
  G.add(pk2);

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
  /* Scattered rocks on upper slopes */
  slopeRocks(0.3, 5.5, -1.2, 6, 0.8, 0.25);
  slopeRocks(0.3, 6.5, -1.4, 4, 0.5, 0.20);
  slopeRocks(-3.2, 3.8, 0.6, 4, 0.6, 0.18);
  slopeRocks(3.8, 3.0, 0.6, 3, 0.5, 0.15);

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
  rockCluster(0.3, 5.5, -1.5, 0.6);   // near main summit
  rockCluster(-3.2, 3.8, 0.5, 0.5);   // near pk2
  rockCluster(3.8, 3.0, 0.5, 0.4);    // near pk3
  rockCluster(1.5, 0.1, 4.0, 0.35);   // trailhead area
  rockCluster(-2.0, 0.6, 2.5, 0.3);   // grounded
  rockCluster(2.0, 0.1, 5.5, 0.25);   // trail edge
  rockCluster(-1.0, 0.1, 5.0, 0.2);   // trail edge
  rockCluster(0.0, 0.1, 6.5, 0.3);    // near plate edge

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
    new THREE.Vector3( 6.5,  0.12,  6.5),   // plate edge entry
    new THREE.Vector3( 5.0,  0.92,  5.5),   // trailhead — on h1 surface
    new THREE.Vector3( 3.2,  1.28,  5.0),   // gentle rise — on h1
    new THREE.Vector3( 1.0,  1.43,  4.5),   // across front — h1 crest
    new THREE.Vector3(-1.0,  1.42,  3.8),   // heading left
    new THREE.Vector3(-2.5,  1.35,  2.8),   // basecamp — pk2/h1 ridge
    /* Transition from hills onto pk1 front face */
    new THREE.Vector3(-1.5,  1.45,  2.0),   // saddle between pk2 and pk1
    new THREE.Vector3(-0.71, 1.55,  1.28),  // pk1 lower slope, front-left
    /* Switchback trail climbing pk1 — on surface */
    new THREE.Vector3( 0.30, 2.05,  1.27),  // front center
    new THREE.Vector3( 1.18, 2.55,  0.92),  // switchback right
    new THREE.Vector3( 0.30, 3.05,  0.87),  // back to front
    new THREE.Vector3(-0.26, 3.55,  0.59),  // switchback left
    new THREE.Vector3( 0.64, 4.05,  0.41),  // ascent — on pk1 surface
    new THREE.Vector3( 0.15, 4.55,  0.19),  // heading left
    new THREE.Vector3( 0.50, 5.05, -0.05),  // narrowing
    new THREE.Vector3( 0.20, 5.55, -0.31),  // upper slope
    new THREE.Vector3( 0.38, 6.05, -0.60),  // approaching summit
    new THREE.Vector3( 0.30, 6.55, -0.95),  // near summit ridge
    new THREE.Vector3( 0.30, 7.05, -1.50),  // summit peak
  ];
  const trailCurve = new THREE.CatmullRomCurve3(trailPts, false, 'centripetal', 0.5);

  /* Trail materials — polygonOffset prevents z-fighting on mountain surface */
  const mTrailCore = new THREE.MeshStandardMaterial({
    color: 0xc4a46c, roughness: 0.95,
    polygonOffset: true, polygonOffsetFactor: -2, polygonOffsetUnits: -2
  });
  const mTrailEdge = new THREE.MeshStandardMaterial({
    color: 0xa08040, roughness: 1.0,
    polygonOffset: true, polygonOffsetFactor: -1, polygonOffsetUnits: -1
  });

  /* Build flat ribbon mesh along curve — looks like real dirt path */
  function buildFlatTrail(curve, segments, halfW, mat) {
    const verts = [], uvs = [], idxs = [];
    for (let i = 0; i <= segments; i++) {
      const t = i / segments;
      const pt = curve.getPoint(t);
      const tang = curve.getTangent(t);
      /* Perpendicular in XZ plane (flat) */
      const perp = new THREE.Vector3(-tang.z, 0, tang.x).normalize();
      /* Slight upward normal tilt so ribbon conforms to slope */
      const up = new THREE.Vector3(0, 1, 0);
      const side = new THREE.Vector3().crossVectors(tang, up).normalize();

      const L = pt.clone().add(side.clone().multiplyScalar(-halfW));
      const R = pt.clone().add(side.clone().multiplyScalar( halfW));
      /* Push ribbon slightly above surface */
      L.y = pt.y + 0.03;
      R.y = pt.y + 0.03;

      verts.push(L.x, L.y, L.z, R.x, R.y, R.z);
      uvs.push(0, t, 1, t);

      if (i < segments) {
        const a = i * 2, b = a + 1, c = a + 2, d = a + 3;
        idxs.push(a, c, b, b, c, d);
      }
    }
    const geo = new THREE.BufferGeometry();
    geo.setAttribute('position', new THREE.Float32BufferAttribute(verts, 3));
    geo.setAttribute('uv', new THREE.Float32BufferAttribute(uvs, 2));
    geo.setIndex(idxs);
    geo.computeVertexNormals();
    const mesh = new THREE.Mesh(geo, mat);
    mesh.receiveShadow = true;
    mesh.castShadow = false;
    return mesh;
  }

  /* Core trail — flat dirt ribbon */
  const trail = buildFlatTrail(trailCurve, 250, 0.35, mTrailCore);
  trail.renderOrder = 2;
  G.add(trail);

  /* Trail edges — wider darker border */
  const trailBed = buildFlatTrail(trailCurve, 250, 0.55, mTrailEdge);
  trailBed.renderOrder = 1;
  G.add(trailBed);

  /* Trail edge stones — small rocks along path borders for definition */
  const mEdgeStone = new THREE.MeshStandardMaterial({ color: 0x9a8a6a, roughness: 0.95 });
  for (let t = 0.04; t < 0.96; t += 0.018) {
    const pt = trailCurve.getPoint(t);
    const tang = trailCurve.getTangent(t);
    const perp = new THREE.Vector3(-tang.z, 0, tang.x).normalize();
    for (const side of [-1, 1]) {
      const stone = new THREE.Mesh(
        new THREE.DodecahedronGeometry(0.06 + Math.random() * 0.04, 0),
        mEdgeStone
      );
      stone.position.set(
        pt.x + perp.x * 0.50 * side,
        pt.y - 0.04,
        pt.z + perp.z * 0.50 * side
      );
      stone.rotation.set(Math.random() * 2, Math.random() * 2, 0);
      stone.receiveShadow = true;
      stone.renderOrder = 2;
      G.add(stone);
    }
  }

  /* ====== FOOTSTEP MARKS — pressed into the dirt trail ====== */
  const mFootprint = new THREE.MeshStandardMaterial({
    color: 0x8a7040, roughness: 1.0, transparent: true, opacity: 0.5
  });
  const fpGeo = new THREE.CylinderGeometry(0.06, 0.07, 0.02, 6);
  for (let t = 0.05; t < 0.95; t += 0.025) {
    const pt = trailCurve.getPoint(t);
    const tang = trailCurve.getTangent(t);
    const side = (Math.floor(t * 40) % 2 === 0) ? 1 : -1;
    const perp = new THREE.Vector3(-tang.z, 0, tang.x).normalize();
    const fp = new THREE.Mesh(fpGeo, mFootprint);
    fp.position.set(
      pt.x + perp.x * 0.08 * side,
      pt.y - 0.01,
      pt.z + perp.z * 0.08 * side
    );
    fp.scale.set(0.8, 1, 1.3);
    fp.rotation.y = Math.atan2(tang.x, tang.z);
    fp.receiveShadow = true;
    G.add(fp);
  }

  /* ====== STAGE POSITIONS — grounded on trail / peak surface ====== */
  S[0].pos = new THREE.Vector3( 5.0,  0.92,  5.5);   // Trailhead — on hill surface
  S[1].pos = new THREE.Vector3(-2.5,  1.35,  2.8);   // Basecamp — pk2/h1 ridge
  S[2].pos = new THREE.Vector3( 0.64, 4.05,  0.41);  // Ascent — on pk1 surface
  S[3].pos = new THREE.Vector3( 0.30, 7.10, -1.50);  // Summit — at peak top

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
  /* -- Front hills — grounded at base plate level -- */
  mkTree(-3.0, 0.10, 3.8, 0.85, 0);
  mkTree( 1.5, 0.10, 4.0, 0.82, 1);
  mkTree(-1.2, 0.10, 3.5, 0.78, 2);
  mkTree( 3.2, 0.10, 4.5, 0.72, 0);
  mkTree(-4.0, 0.10, 3.2, 0.68, 1);
  mkTree(-2.0, 0.10, 4.8, 0.65, 0);
  mkTree( 2.0, 0.10, 5.0, 0.70, 1);
  mkTree( 4.2, 0.10, 5.0, 0.58, 2);
  mkTree(-3.5, 0.10, 5.0, 0.60, 0);
  mkTree( 0.0, 0.10, 6.0, 0.52, 1);
  /* -- Between peaks — mid elevation -- */
  mkTree(-2.8, 0.10, 1.5, 0.52, 0);
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
  /* Bushes along trail edges and forest floor */
  mkBush(-1.5, 0.0, 4.2, 0.25, 0);
  mkBush( 0.8, 0.0, 4.5, 0.22, 1);
  mkBush(-3.5, 0.0, 2.8, 0.28, 2);
  mkBush( 2.5, 0.0, 3.5, 0.24, 0);
  mkBush(-4.5, 0.0, 1.8, 0.20, 1);
  mkBush( 4.5, 0.0, 2.0, 0.22, 2);
  mkBush(-2.0, 0.0, 5.5, 0.18, 0);
  mkBush( 1.0, 0.0, 5.8, 0.20, 1);
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

  /* ====== HIKERS — simple cartoonish figures on the trail ====== */
  const hikerData = [];
  function mkHiker(x, y, z, shirtMat, faceDir) {
    const g = new THREE.Group();
    /* Body */
    const body = new THREE.Mesh(
      new THREE.CapsuleGeometry(0.12, 0.22, 6, 8), shirtMat);
    body.position.y = 0.30; body.castShadow = true; g.add(body);
    /* Head */
    const head = new THREE.Mesh(
      new THREE.SphereGeometry(0.10, 10, 8), mSkin);
    head.position.y = 0.55; head.castShadow = true; g.add(head);
    /* Legs */
    const legL = new THREE.Mesh(
      new THREE.CapsuleGeometry(0.04, 0.14, 4, 6), mPants);
    legL.position.set(-0.05, 0.10, 0); g.add(legL);
    const legR = new THREE.Mesh(
      new THREE.CapsuleGeometry(0.04, 0.14, 4, 6), mPants);
    legR.position.set(0.05, 0.10, 0); g.add(legR);
    /* Backpack */
    const bp = new THREE.Mesh(
      new THREE.BoxGeometry(0.14, 0.16, 0.10, 1, 1, 1), mBackpack);
    bp.position.set(0, 0.34, -0.10); bp.castShadow = true; g.add(bp);

    g.position.set(x, y, z);
    g.rotation.y = faceDir;
    G.add(g);
    hikerData.push({ group: g, legL, legR, baseY: y });
    return g;
  }

  /* Place hikers along trail curve — properly grounded on trail surface */
  const hikerShirts = [mShirt1, mShirt2, mShirt3];
  [0.06, 0.14, 0.22, 0.38, 0.52, 0.64, 0.80].forEach((t, i) => {
    const pt = trailCurve.getPoint(t);
    const tang = trailCurve.getTangent(t);
    const faceAngle = Math.atan2(tang.x, tang.z);
    mkHiker(pt.x, pt.y + 0.02, pt.z, hikerShirts[i % 3], faceAngle);
  });

  /* ====== HERO HIKER — main protagonist, larger + detailed ====== */
  const mHat = new THREE.MeshStandardMaterial({ color: 0x5a3a1a, roughness: 0.8 });
  const mBoot = new THREE.MeshStandardMaterial({ color: 0x4a3520, roughness: 0.85 });
  const mStick = new THREE.MeshStandardMaterial({ color: 0x8a6a3a, roughness: 0.9 });
  const mHeroShirt = new THREE.MeshStandardMaterial({ color: 0x2a7a4a, roughness: 0.7 });
  const mHeroPants = new THREE.MeshStandardMaterial({ color: 0x4a4035, roughness: 0.8 });
  const mHeroPack = new THREE.MeshStandardMaterial({ color: 0xb85530, roughness: 0.7 });
  const mMap = new THREE.MeshStandardMaterial({ color: 0xf0e8c8, roughness: 0.6, side: THREE.DoubleSide });

  hero = new THREE.Group();
  /* Body */
  const hBody = new THREE.Mesh(new THREE.CapsuleGeometry(0.18, 0.30, 8, 10), mHeroShirt);
  hBody.position.y = 0.42; hBody.castShadow = true; hero.add(hBody);
  /* Head */
  const hHead = new THREE.Mesh(new THREE.SphereGeometry(0.15, 12, 10), mSkin);
  hHead.position.y = 0.78; hHead.castShadow = true; hero.add(hHead);
  /* Hat — wide brim explorer hat */
  const hHatBrim = new THREE.Mesh(new THREE.CylinderGeometry(0.22, 0.24, 0.03, 12), mHat);
  hHatBrim.position.y = 0.88; hero.add(hHatBrim);
  const hHatTop = new THREE.Mesh(new THREE.CylinderGeometry(0.10, 0.13, 0.10, 10), mHat);
  hHatTop.position.y = 0.94; hero.add(hHatTop);
  /* Left arm */
  const hArmL = new THREE.Mesh(new THREE.CapsuleGeometry(0.05, 0.18, 4, 6), mHeroShirt);
  hArmL.position.set(-0.22, 0.48, 0); hArmL.rotation.z = 0.25; hero.add(hArmL);
  /* Right arm */
  const hArmR = new THREE.Mesh(new THREE.CapsuleGeometry(0.05, 0.18, 4, 6), mHeroShirt);
  hArmR.position.set(0.22, 0.48, 0); hArmR.rotation.z = -0.25; hero.add(hArmR);
  /* Legs */
  const hLegL = new THREE.Mesh(new THREE.CapsuleGeometry(0.06, 0.20, 4, 6), mHeroPants);
  hLegL.position.set(-0.08, 0.13, 0); hero.add(hLegL);
  const hLegR = new THREE.Mesh(new THREE.CapsuleGeometry(0.06, 0.20, 4, 6), mHeroPants);
  hLegR.position.set(0.08, 0.13, 0); hero.add(hLegR);
  /* Boots */
  const hBootL = new THREE.Mesh(new THREE.BoxGeometry(0.08, 0.05, 0.12), mBoot);
  hBootL.position.set(-0.08, 0.02, 0.02); hero.add(hBootL);
  const hBootR = new THREE.Mesh(new THREE.BoxGeometry(0.08, 0.05, 0.12), mBoot);
  hBootR.position.set(0.08, 0.02, 0.02); hero.add(hBootR);
  /* Backpack */
  const hPack = new THREE.Mesh(new THREE.BoxGeometry(0.22, 0.28, 0.14), mHeroPack);
  hPack.position.set(0, 0.48, -0.16); hPack.castShadow = true; hero.add(hPack);
  /* Backpack flap */
  const hFlap = new THREE.Mesh(new THREE.BoxGeometry(0.22, 0.04, 0.16), mHeroPack);
  hFlap.position.set(0, 0.63, -0.16); hero.add(hFlap);
  /* Walking stick — in right hand */
  hStick = new THREE.Mesh(new THREE.CylinderGeometry(0.015, 0.02, 0.9, 6), mStick);
  hStick.position.set(0.28, 0.35, 0.08); hStick.rotation.z = -0.15; hero.add(hStick);
  /* Map — hidden by default, shown in stage 2 */
  const hMapGeo = new THREE.PlaneGeometry(0.28, 0.20);
  hMapMesh = new THREE.Mesh(hMapGeo, mMap);
  hMapMesh.position.set(-0.30, 0.55, 0.15);
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

  /* Start hero at trailhead */
  hero.position.copy(S[0].pos);
  hero.position.y += 0.02;
  hero.scale.setScalar(1.3);
  G.add(hero);

  /* Hero animation state — reinitialize (declared at module scope) */
  heroStage = -1;
  heroAnimState = 'idle';
  heroAnimTime = 0;

  /* Stage-specific camera angles — top-side-left perspective along trail */
  stageCams = [
    { offset: new THREE.Vector3(-3.0, 2.5, 3.5), lookUp: 0.3 },  // trailhead: left-above
    { offset: new THREE.Vector3(-3.5, 2.5, 3.0), lookUp: 0.3 },  // basecamp: left-above
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
      /* Jump celebration at summit */
      const jmp = Math.max(0, Math.sin(et * 4.0)) * 0.35;
      hero.position.y = S[3].pos.y + 0.02 + jmp;
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
  hStick.visible = true;
  clearConfetti();

  /* Animate hero walking to the flag position */
  const heroTarget = S[i].pos.clone();
  heroTarget.y += 0.02;
  const faceDirX = heroTarget.x - hero.position.x;
  const faceDirZ = heroTarget.z - hero.position.z;
  const faceAngle = Math.atan2(faceDirX, faceDirZ);

  heroAnimState = 'walking';
  gsap.to(hero.rotation, { y: faceAngle, duration: 0.3, ease: 'power2.out' });
  gsap.to(hero.position, {
    x: heroTarget.x, y: heroTarget.y, z: heroTarget.z,
    duration: 1.6, ease: 'power2.inOut',
    onComplete() {
      /* Stage-specific idle animation */
      if (i === 0) {
        heroAnimState = 'idle'; // standing at trailhead
      } else if (i === 1) {
        heroAnimState = 'looking'; // reading map at basecamp
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
  hStick.visible = true;
  hero.rotation.x = 0;
  clearConfetti();
  gsap.to(hero.position, { x: S[0].pos.x, y: S[0].pos.y + 0.02, z: S[0].pos.z, duration: 1.0, ease: 'power2.inOut' });
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
