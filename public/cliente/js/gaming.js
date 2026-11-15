'use strict';
const GAMING_RELEASES = [
 {name:'Grand Theft Auto VI', alias:'gta 6 gta vi', studio:'Rockstar Games', genre:'Acción · Mundo abierto', platforms:'PS5 · Xbox Series X|S', badge:'Preventa', video:'VQRLujxTm3c', url:'https://www.rockstargames.com/VI', description:'Dos protagonistas. Una nueva historia. Descubre Vice City y el mundo de Leonida.', action:'Ver preventa oficial'},
 {name:'Cyberpunk 2077', alias:'cyberpunk night city', studio:'CD PROJEKT RED', genre:'RPG · Mundo abierto', platforms:'PC · PlayStation · Xbox', badge:'Disponible', video:'UnA7tepsc7s', url:'https://www.cyberpunk.net/', description:'Tu próxima historia comienza en Night City. Explora una ciudad donde cada decisión deja huella.', action:'Explorar juego'},
 {name:'ELDEN RING', alias:'elden ring souls', studio:'FromSoftware', genre:'RPG · Fantasía oscura', platforms:'PC · PlayStation · Xbox', badge:'Disponible', video:'qqiC88f9ogU', url:'https://en.bandainamcoent.eu/elden-ring/elden-ring', description:'Las Tierras Intermedias te esperan. Forja tu camino en un mundo de leyendas, desafíos y descubrimientos.', action:'Explorar juego'}
];

document.addEventListener('DOMContentLoaded', () => {
 const stage = document.getElementById('launchSlides');
 if (!stage) return;
 stage.innerHTML = GAMING_RELEASES.map((g,i) => `<article class="launch-slide" role="group" aria-roledescription="diapositiva" aria-label="${i+1} de 3: ${g.name}" ${i ? 'hidden' : ''}>
  <img class="launch-art" src="https://i.ytimg.com/vi/${g.video}/maxresdefault.jpg" alt="" ${i ? 'loading="lazy"' : 'fetchpriority="high"'}>
  <div class="launch-copy"><span class="launch-badge">${g.badge === 'Preventa' ? '◷' : '✦'} ${g.badge}</span><h2>${g.name}</h2><p>${g.description}</p><div class="launch-meta">${g.genre}<br>${g.platforms}</div><div class="launch-actions"><button type="button" class="btn btn-brand" data-trailer="${i}"><i class="fas fa-play me-2" aria-hidden="true"></i>Ver tráiler</button><a class="btn btn-outline-light" href="${g.url}" target="_blank" rel="noopener">${g.action} ↗</a></div></div></article>`).join('');
 const slides = [...stage.children];
 const dots = [...document.querySelectorAll('[data-slide]')];
 let current = 0;
 function show(index) {
  current = (index + slides.length) % slides.length;
  slides.forEach((s,i) => {s.hidden = i !== current;});
  dots.forEach((d,i) => d.setAttribute('aria-current', String(i === current)));
  document.getElementById('launchCount').textContent = `0${current+1} / 03`;
 }
 document.getElementById('launchPrev').addEventListener('click', () => show(current-1));
 document.getElementById('launchNext').addEventListener('click', () => show(current+1));
 dots.forEach(d => d.addEventListener('click', () => show(Number(d.dataset.slide))));
 stage.addEventListener('keydown', e => { if(e.key === 'ArrowRight' || e.key === 'ArrowLeft') {e.preventDefault(); show(current + (e.key === 'ArrowRight' ? 1 : -1));} });
 let touchX = null;
 stage.addEventListener('touchstart', e => {touchX=e.changedTouches[0].clientX;}, {passive:true});
 stage.addEventListener('touchend', e => {if(touchX!==null && Math.abs(e.changedTouches[0].clientX-touchX)>60) show(current+(e.changedTouches[0].clientX<touchX?1:-1)); touchX=null;}, {passive:true});
 function selectTrailer(index, scroll = true) {
  const g = GAMING_RELEASES[index];
  const frame = document.getElementById('gameTrailer');
  frame.src = `https://www.youtube-nocookie.com/embed/${g.video}?rel=0`;
  frame.title = `Tráiler oficial de ${g.name}`;
  document.getElementById('trailerTitle').textContent=g.name;
  document.getElementById('trailerStudio').textContent=`Tráiler oficial · ${g.studio}`;
  document.getElementById('trailerExternal').href=`https://www.youtube.com/watch?v=${g.video}`;
  if(scroll) {document.getElementById('trailers').scrollIntoView({behavior:matchMedia('(prefers-reduced-motion: reduce)').matches?'instant':'smooth'}); document.getElementById('trailerTitle').focus({preventScroll:true});}
 }
 stage.addEventListener('click', e => {const b=e.target.closest('[data-trailer]'); if(b) selectTrailer(Number(b.dataset.trailer));});
 const input=document.getElementById('gamingSearch');
 const list=document.getElementById('gamingResults');
 const status=document.getElementById('gamingSearchStatus');
 let matches=[], active=-1;
 const normalize=s=>s.normalize('NFD').replace(/[\u0300-\u036f]/g,'').toLowerCase();
 function close(){list.hidden=true; input.setAttribute('aria-expanded','false'); input.removeAttribute('aria-activedescendant'); active=-1;}
 function choose(index){ const item=matches[index]; if(!item)return; input.value=item.name; close(); if(item.game!==undefined){show(item.game); stage.scrollIntoView({block:'center'}); stage.focus({preventScroll:true});}else location.href=`product-details.html?id=${encodeURIComponent(item.id)}`; }
 function search(){
  const q=normalize(input.value.trim()); active=-1; input.removeAttribute('aria-activedescendant');
  if(!q){close();status.textContent='';return;}
  matches=[...GAMING_RELEASES.map((g,i)=>({...g,game:i,category:g.badge})),...PRODUCTS].filter(p=>normalize(`${p.name} ${p.alias||''} ${p.category} ${p.genre||''}`).includes(q)).slice(0,7);
  list.replaceChildren();
  matches.forEach((p,i)=>{const row=document.createElement('div');row.id=`gamingOption${i}`;row.setAttribute('role','option');row.setAttribute('aria-selected','false');row.textContent=p.name;const sub=document.createElement('small');sub.textContent=p.game!==undefined?`${p.badge} · ${p.platforms}`:'Producto · TechNova';row.append(sub);row.addEventListener('click',()=>choose(i));list.append(row);});
  if(!matches.length){const p=document.createElement('p');p.textContent='No encontramos resultados. Prueba con GTA, RPG o gaming.';list.append(p);}
  list.hidden=false;input.setAttribute('aria-expanded','true');status.textContent=`${matches.length} resultados disponibles.`;
 }
 list.addEventListener('mousedown', e => e.preventDefault());
 input.addEventListener('input',search); input.addEventListener('focus',()=>{if(input.value.trim()) search();});
 input.addEventListener('keydown',e=>{
  if(e.key==='Escape'){close();return;}
  if(e.key==='ArrowDown'||e.key==='ArrowUp'){e.preventDefault();if(list.hidden)search();if(!matches.length)return;active=(active+(e.key==='ArrowDown'?1:-1)+matches.length)%matches.length;[...list.children].forEach((el,i)=>el.setAttribute('aria-selected',String(i===active)));input.setAttribute('aria-activedescendant',`gamingOption${active}`);list.children[active].scrollIntoView({block:'nearest'});}
  if(e.key==='Enter'){e.preventDefault();if(!list.hidden)choose(active<0?0:active);}
 });
 document.addEventListener('click',e=>{if(!e.target.closest('.gaming-search'))close();});
 document.querySelector('.gaming-search').addEventListener('focusout',e=>{if(!e.currentTarget.contains(e.relatedTarget))close();});
 show(0);
});
