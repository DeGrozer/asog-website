/* ╔══════════════════════════════════════════════════════════════════════╗
   ║  ALTITUDE 3D — Wilderness-Zoom Transition + Three.js Mountain     ║
   ╚══════════════════════════════════════════════════════════════════════╝ */
import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

/* ════════════════════════════════════════════════════════════
   DOM REFS
   ════════════════════════════════════════════════════════════ */
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

/* ════════════════════════════════════════════════════════════
   STATE
   ════════════════════════════════════════════════════════════ */
let sceneReady = false;
let active = -1, zoomed = false;
let R, scene, cam, oc, G;
const pinHits = [], flags = [];

/* ── Stage data ── */
const S = [
  { id:'01', n:'Trailhead', p:'Pre-Incubation', d:'Month 1',
    x:'The starting point. Teams undergo orientation, needs assessment, and initial mentoring to prepare for the climb ahead.',
    pos: null },
  { id:'02', n:'Basecamp', p:'Incubation Phase', d:'Months 2–4',
    x:'Deep work begins. Startups access labs, receive technical mentorship, develop prototypes, and validate their business models.',
    pos: null },
  { id:'03', n:'Ascent', p:'Post-Incubation', d:'Months 5–6',
    x:'Scaling up. Teams refine products, connect with investors, and prepare for market entry with continued support.',
    pos: null },
  { id:'04', n:'Summit', p:'Graduation & Beyond', d:'Post-Program',
    x:'The peak. Startups graduate as market-ready ventures, joining the ASOG-TBI alumni network with ongoing advisory access.',
    pos: null },
];

/* ════════════════════════════════════════════════════════════
   WILDERNESS-ZOOM TRANSITION
   ════════════════════════════════════════════════════════════ */

/* Spawn snow-like particles inside the zoom overlay */
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
  /* Lock scroll */
  document.body.style.overflow = 'hidden';

  /* Phase 1 — zoom overlay appears from card */
  zoomOvl.classList.add('active');
  const tl = gsap.timeline();

  tl.to(zoomOvl, { opacity: 1, duration: .4, ease: 'power2.inOut' })
    .call(spawnParticles, [], '<+=.05')
    /* Mountains rise */
    .fromTo('#alt3dMtnFar',  { y: '20%' }, { y: '0%', duration: .8, ease: 'power2.out' }, '<')
    .fromTo('#alt3dMtnMid',  { y: '28%' }, { y: '0%', duration: .8, ease: 'power2.out' }, '<+=.05')
    .fromTo('#alt3dMtnNear', { y: '35%' }, { y: '0%', duration: .8, ease: 'power2.out' }, '<+=.05')
    /* Title */
    .to(zoomText, { opacity: 1, y: 0, duration: .45, ease: 'power2.out' }, '-=.4')
    /* Crossfade into 3D */
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

/* Card click */
if (card) {
  card.addEventListener('click', openWildernessZoom);
  card.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openWildernessZoom(); } });
}
if (closeBtn) closeBtn.addEventListener('click', closeOverlay);


/* ════════════════════════════════════════════════════════════
   THREE.JS SCENE — (mirrored from test-3d-mountain.html)
   ════════════════════════════════════════════════════════════ */

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
  R.toneMappingExposure = 1.15;

  /* Scene */
  scene = new THREE.Scene();
  scene.background = new THREE.Color(0xc4dff0);
  scene.fog = new THREE.Fog(0xc4dff0, 35, 65);

  /* Camera */
  const OVP = new THREE.Vector3(14, 10, 16);
  const OVT = new THREE.Vector3(0, 2.5, 0);
  cam = new THREE.PerspectiveCamera(36, window.innerWidth / window.innerHeight, 0.1, 200);
  cam.position.copy(OVP);

  oc = new OrbitControls(cam, cv);
  oc.enableDamping = true; oc.dampingFactor = 0.06;
  oc.minDistance = 8; oc.maxDistance = 30;
  oc.maxPolarAngle = Math.PI / 2.1;
  oc.target.copy(OVT); oc.update();

  /* Lights */
  scene.add(new THREE.HemisphereLight(0xdceef8, 0x8ab0c4, 0.65));
  scene.add(new THREE.AmbientLight(0xffffff, 0.35));
  const sun = new THREE.DirectionalLight(0xfffaf0, 1.5);
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

  /* Materials */
  const mW  = new THREE.MeshStandardMaterial({ color: 0xeef2f5, roughness: 0.78 });
  const mT  = new THREE.MeshStandardMaterial({ color: 0x4a8da0, roughness: 0.68 });
  const mPl = new THREE.MeshStandardMaterial({ color: 0x9ac4d6, roughness: 0.6, metalness: 0.05 });
  const mPr = new THREE.MeshStandardMaterial({ color: 0x84b8cc, roughness: 0.5, metalness: 0.08 });
  const mBr = new THREE.MeshStandardMaterial({ color: 0x7a5836, roughness: 0.7, metalness: 0.1 });
  const mRd = new THREE.MeshStandardMaterial({ color: 0xe85040, roughness: 0.35, side: THREE.DoubleSide });
  const mGd = new THREE.MeshStandardMaterial({ color: 0xF8AF21, roughness: 0.3, metalness: 0.35 });
  const mG1 = new THREE.MeshStandardMaterial({ color: 0x3a5a20, roughness: 0.82 });
  const mG2 = new THREE.MeshStandardMaterial({ color: 0x4a6e2a, roughness: 0.82 });

  /* Master group */
  G = new THREE.Group();
  scene.add(G);

  /* ── Mountain peak builder ── */
  function buildPeak(bR, h, sf, seg) {
    seg = seg || 40;
    const snowLine = 1.0 - sf;
    function Rf(t) {
      return bR * Math.pow(Math.max(1 - t, 0), 0.65) * (1 + 0.1 * Math.sin(t * Math.PI));
    }
    const tPts = [];
    for (let i = 0; i <= 50; i++) {
      const t = (i / 50) * snowLine;
      tPts.push(new THREE.Vector2(Math.max(Rf(t), 0.001), t * h));
    }
    const tGeo = new THREE.LatheGeometry(tPts, seg);
    const tM = new THREE.Mesh(tGeo, mT); tM.castShadow = tM.receiveShadow = true;

    const sPts = [];
    const SN = 70;
    const joinR = Rf(snowLine);
    for (let i = 0; i <= SN; i++) {
      const f = i / SN;
      const t = snowLine + f * (1 - snowLine);
      const coneR = Rf(t);
      const drape = joinR * 0.22 * Math.pow(Math.max(1 - f, 0), 2.0);
      let r;
      if (f < 0.3) { r = coneR + drape; }
      else {
        const dF = (f - 0.3) / 0.7;
        const flatR = coneR + drape;
        const domeR = joinR * 0.5 * Math.cos(dF * Math.PI * 0.5);
        const blend = dF * dF * (3 - 2 * dF);
        r = flatR * (1 - blend) + domeR * blend;
      }
      sPts.push(new THREE.Vector2(Math.max(r, 0.01), t * h));
    }
    const capR = sPts[sPts.length - 1].x;
    const capY = sPts[sPts.length - 1].y;
    for (let i = 1; i <= 20; i++) {
      const a = (i / 20) * Math.PI * 0.5;
      sPts.push(new THREE.Vector2(Math.max(capR * Math.cos(a), 0.001), capY + capR * 0.6 * Math.sin(a)));
    }
    const sGeo = new THREE.LatheGeometry(sPts, seg);
    const sM = new THREE.Mesh(sGeo, mW); sM.castShadow = sM.receiveShadow = true;

    const grp = new THREE.Group(); grp.add(tM); grp.add(sM);
    return grp;
  }

  /* Hill */
  function hill(rx, ry, rz) {
    const g = new THREE.SphereGeometry(1, 36, 24, 0, Math.PI * 2, 0, Math.PI * 0.5);
    const m = new THREE.Mesh(g, mW); m.scale.set(rx, ry, rz);
    m.castShadow = m.receiveShadow = true; return m;
  }

  /* Base plate */
  const plate = new THREE.Mesh(new THREE.CylinderGeometry(8.2, 8.5, 0.3, 64), mPl);
  plate.position.y = -0.15; plate.receiveShadow = true; G.add(plate);
  const rim = new THREE.Mesh(new THREE.TorusGeometry(8.35, 0.22, 12, 64), mPr);
  rim.rotation.x = Math.PI / 2; rim.position.y = 0.0; G.add(rim);

  /* Peaks */
  const pk1 = buildPeak(3.4, 6.5, 0.50, 44); pk1.position.set(-0.5, 0, -1.8); G.add(pk1);
  const pk2 = buildPeak(3.0, 5.0, 0.50, 40); pk2.position.set(-3.5, 0, 0.0);  G.add(pk2);
  const pk3 = buildPeak(2.4, 4.2, 0.50, 36); pk3.position.set(2.8, 0, -1.4);  G.add(pk3);

  /* Hills */
  const fh = hill(5.0, 3.0, 4.2); fh.position.set(0.0, 0, 3.0); G.add(fh);
  const fb = hill(2.4, 1.8, 2.2); fb.position.set(3.2, 0, 2.4); G.add(fb);
  const br = hill(3.4, 2.4, 3.0); br.position.set(-0.5, 0, 0.8); G.add(br);
  const lB = hill(2.2, 1.6, 2.0); lB.position.set(-4.5, 0, 2.0); G.add(lB);
  const sp = hill(2.0, 1.0, 1.8); sp.position.set(1.2, 0, -0.2); G.add(sp);

  /* Trail */
  const TP = [
    new THREE.Vector3( 4.8, 0.2,  3.2), new THREE.Vector3( 3.4, 1.2,  3.2),
    new THREE.Vector3( 2.0, 2.2,  3.0), new THREE.Vector3( 0.5, 2.8,  2.8),
    new THREE.Vector3(-1.0, 2.7,  2.5), new THREE.Vector3(-2.5, 2.2,  1.8),
    new THREE.Vector3(-3.2, 2.6,  1.0), new THREE.Vector3(-3.4, 3.5,  0.2),
    new THREE.Vector3(-2.6, 3.6, -0.4), new THREE.Vector3(-1.4, 4.0, -0.8),
    new THREE.Vector3(-0.8, 5.0, -1.2), new THREE.Vector3(-0.5, 5.8, -1.6),
  ];
  const TC = new THREE.CatmullRomCurve3(TP);
  const dotN = 55;
  const dotG = new THREE.CylinderGeometry(0.09, 0.09, 0.03, 8);
  const dotMat = new THREE.MeshStandardMaterial({ color: 0xffffff, roughness: 0.5 });
  const dotI = new THREE.InstancedMesh(dotG, dotMat, dotN);
  dotI.castShadow = true;
  {
    const o = new THREE.Object3D();
    for (let i = 0; i < dotN; i++) {
      const t = (i + 0.5) / dotN;
      const p = TC.getPointAt(Math.min(t, 0.999));
      o.position.copy(p); o.scale.set(1, 1, 1); o.updateMatrix();
      dotI.setMatrixAt(i, o.matrix);
    }
    dotI.instanceMatrix.needsUpdate = true;
  }
  G.add(dotI);

  /* Stage positions */
  S[0].pos = new THREE.Vector3(2.0, 2.4, 3.0);
  S[1].pos = new THREE.Vector3(-1.0, 2.8, 2.5);
  S[2].pos = new THREE.Vector3(-3.2, 3.8, 0.0);
  S[3].pos = new THREE.Vector3(-0.5, 6.2, -1.6);

  /* Flags */
  function mkFlag(pos, isSummit) {
    const g = new THREE.Group();
    const ph = isSummit ? 1.0 : 0.7;
    const pole = new THREE.Mesh(new THREE.CylinderGeometry(0.03, 0.045, ph, 8), mBr);
    pole.position.y = ph / 2 - 0.08; pole.castShadow = true; g.add(pole);

    const fs = new THREE.Shape();
    fs.moveTo(0, 0); fs.lineTo(0.32, 0.09); fs.lineTo(0, 0.2); fs.closePath();
    const fl = new THREE.Mesh(new THREE.ShapeGeometry(fs), isSummit ? mGd : mRd);
    fl.position.set(0.04, ph * 0.55, 0); fl.castShadow = true; g.add(fl);
    flags.push(fl);

    if (isSummit) {
      const bl = new THREE.Mesh(new THREE.SphereGeometry(0.06, 10, 8), mGd);
      bl.position.y = ph - 0.02; bl.castShadow = true; g.add(bl);
    }
    g.position.copy(pos); G.add(g);

    const ht = new THREE.Mesh(
      new THREE.SphereGeometry(0.7, 8, 6),
      new THREE.MeshBasicMaterial({ visible: false })
    );
    ht.position.copy(pos); ht.position.y += 0.5;
    G.add(ht); pinHits.push(ht);
  }

  S.forEach((s, i) => {
    s.hitIdx = i;
    mkFlag(s.pos, i === S.length - 1);
    pinHits[i].userData.idx = i;
  });

  /* Trees */
  function mkTree(x, y, z, h, dark) {
    const g = new THREE.Group();
    const mat = dark ? mG1 : mG2;
    const th = h * 0.25;
    const trunk = new THREE.Mesh(new THREE.CylinderGeometry(h * 0.04, h * 0.06, th, 6), mBr);
    trunk.position.set(0, th / 2, 0); trunk.castShadow = true; g.add(trunk);
    const c1 = new THREE.Mesh(new THREE.ConeGeometry(h * 0.3, h * 0.4, 8), mat);
    c1.position.y = th + h * 0.18; c1.castShadow = true; g.add(c1);
    const c2 = new THREE.Mesh(new THREE.ConeGeometry(h * 0.22, h * 0.34, 8), mat);
    c2.position.y = th + h * 0.42; c2.castShadow = true; g.add(c2);
    const sw = new THREE.Mesh(new THREE.SphereGeometry(h * 0.14, 8, 6), mW);
    sw.scale.y = 0.55; sw.position.y = th + h * 0.56; g.add(sw);
    g.position.set(x, y, z); G.add(g);
  }

  mkTree(-2.2, 2.6, 2.8, 1.0, true);  mkTree(-0.8, 2.9, 3.2, 0.85, false);
  mkTree( 0.6, 2.7, 3.3, 0.9, true);  mkTree( 1.8, 2.0, 3.0, 0.8, false);
  mkTree( 3.0, 1.2, 2.5, 0.75, true);  mkTree(-3.6, 1.5, 2.0, 0.9, false);
  mkTree(-1.5, 2.5, 1.8, 0.8, true);  mkTree( 0.8, 2.1, 1.2, 0.7, false);
  mkTree(-2.8, 2.0, 1.2, 0.75, true);  mkTree( 1.5, 1.0, 0.5, 0.7, false);

  /* Labels */
  S.forEach((s, i) => {
    const el = document.createElement('div');
    el.className = 'alt3d-flag-label';
    el.innerHTML = `<span data-i="${i}">${s.id} · ${s.n}</span>`;
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
  if (btnOvw)  btnOvw.addEventListener('click', overviewCamera);

  /* Entrance animation */
  G.scale.setScalar(0);
  G.rotation.y = -0.4;
  gsap.to(G.scale, { x: 1, y: 1, z: 1, duration: 1.4, ease: 'elastic.out(1,0.65)', delay: 0.15 });
  gsap.to(G.rotation, { y: 0, duration: 1.4, ease: 'power3.out', delay: 0.15 });

  /* Resize */
  window.addEventListener('resize', onResize);

  /* Render loop */
  const ck = new THREE.Clock();
  (function anim() {
    requestAnimationFrame(anim);
    if (!overlay.classList.contains('active')) return;

    const et = ck.getElapsedTime();
    if (!zoomed) G.rotation.y += 0.0012;

    flags.forEach((f, i) => {
      f.rotation.y = -0.3 + Math.sin(et * 2.8 + i * 1.4) * 0.15;
    });

    oc.update();
    updateLabels();
    R.render(scene, cam);
  })();
}

/* ════════════════════════════════════════════════════════════
   CAMERA
   ════════════════════════════════════════════════════════════ */
const OVP = new THREE.Vector3(14, 10, 16);
const OVT = new THREE.Vector3(0, 2.5, 0);

function zoomToFlag(i) {
  gsap.killTweensOf(cam.position);
  gsap.killTweensOf(oc.target);
  active = i; zoomed = true;
  overlay.classList.add('zoomed');
  oc.enabled = false;

  const wp = new THREE.Vector3();
  pinHits[i].getWorldPosition(wp);

  const dir = new THREE.Vector3(wp.x, 0, wp.z).normalize();
  const cp = new THREE.Vector3(
    wp.x + dir.x * 3.5 + 1.5,
    wp.y + 1.5,
    wp.z + dir.z * 3.5 + 1.5
  );
  const lk = wp.clone(); lk.y += 0.2;

  gsap.to(cam.position, { x: cp.x, y: cp.y, z: cp.z, duration: 1.2, ease: 'power2.inOut' });
  gsap.to(oc.target, { x: lk.x, y: lk.y, z: lk.z, duration: 1.2, ease: 'power2.inOut' });

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

  document.querySelectorAll('.alt3d-dot').forEach(d => d.classList.remove('active'));
  hideInfoCard();
}

/* ════════════════════════════════════════════════════════════
   INFO CARD
   ════════════════════════════════════════════════════════════ */
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

/* ════════════════════════════════════════════════════════════
   LABELS
   ════════════════════════════════════════════════════════════ */
const _v = new THREE.Vector3();
function updateLabels() {
  S.forEach((s, i) => {
    if (!s.el) return;
    pinHits[i].getWorldPosition(_v);
    _v.y += 0.7;
    const p = _v.clone().project(cam);
    if (p.z >= 1) { s.el.style.opacity = '0'; return; }
    s.el.style.left = ((p.x * .5 + .5) * window.innerWidth) + 'px';
    s.el.style.top  = ((-p.y * .5 + .5) * window.innerHeight) + 'px';
    s.el.style.transform = 'translate(-50%,-100%)';
    s.el.style.opacity = zoomed ? '0' : '1';
  });
}

/* ════════════════════════════════════════════════════════════
   RESIZE
   ════════════════════════════════════════════════════════════ */
function onResize() {
  if (!sceneReady) return;
  cam.aspect = window.innerWidth / window.innerHeight;
  cam.updateProjectionMatrix();
  R.setSize(window.innerWidth, window.innerHeight);
}
