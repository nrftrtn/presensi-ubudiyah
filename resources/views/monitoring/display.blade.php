<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Monitoring Presensi Ubudiyah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>

       *{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{

    background:
    radial-gradient(circle at top,#17356d 0%,#08111f 45%,#050912 100%);

    color:white;

    min-height:100vh;

    overflow-x:hidden;

    overflow-y:hidden;

    padding-bottom:50px;

}
/* ================= HEADER ================= */

.topbar{

     min-height:120px;
    height:auto;
    padding:15px 40px;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;

    background:rgba(18,37,77,.55);

    backdrop-filter:blur(20px);

    border-bottom:1px solid rgba(255,255,255,.08);

}

.logo-box{

    display:flex;

    align-items:center;

    gap:20px;

}

.logo{

      width:70px;
    height:70px;


    border-radius:50%;

    background:white;

    display:flex;

    justify-content:center;

    align-items:center;

}

.logo img{

    width:50px;

}

.logo-box h1{

    font-size:38px;

    font-weight:800;

    letter-spacing:1px;

}

.logo-box p{

    font-size:18px;

    opacity:.9;

}

.header-right{

    text-align:right;
    display:flex;
    flex-direction:column;
    align-items:flex-end;
    gap:8px;
    min-width:280px;

}

.clock{

    font-size:48px;

    line-height:1;

    color:#34d399;

    font-weight:700;

}

.tanggal{

    ffont-size:18px;
    margin-top:4px;

    opacity:.9;

}

.live{

    display:flex;

    align-items:center;

    gap:10px;

    padding:10px 20px;

    background:#ff3b30;

    border-radius:30px;

    margin-bottom:12px;

    font-weight:700;

}

.live span{

    width:14px;

    height:14px;

    border-radius:50%;

    background:white;

    animation:blink 1s infinite;

}

@keyframes blink{

0%{opacity:1;}

50%{opacity:.2;}

100%{opacity:1;}

}

/* ================= CARD ================= */

.cards{

    display:grid;

    grid-template-columns:repeat(3,1fr);

    gap:18px;

    padding:18px;

}

.card{

    border:none;

    border-radius:24px;

    color:white;

    padding:30px;

    height:145px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    position:relative;

    overflow-x:hidden;
    overflow-y:hidden;

    transition:.3s;

}

.card:hover{

    transform:translateY(-6px);

}

.card::before{

    content:'';

    position:absolute;

    width:170px;

    height:170px;

    background:rgba(255,255,255,.10);

    border-radius:50%;

    right:-45px;

    top:-45px;

}

.card h4{

    font-size:24px;

    font-weight:600;

}

.card h2{

    font-size:58px;

    margin-top:15px;

    font-weight:800;

}

.card i{

    font-size:72px;

    opacity:.28;

}

.hadir-card{

    background:linear-gradient(135deg,#16a34a,#10b981);

}

.terlambat-card{

    background:linear-gradient(135deg,#f59e0b,#fb923c);

}

.alpha-card{

    background:linear-gradient(135deg,#ef4444,#ff3d71);

}

/* ================= CONTENT ================= */

.content{

    display:grid;

    grid-template-columns:2fr 1fr;

    gap:18px;

    padding:0 18px;

}

.left-panel,
.right-panel{

    background:rgba(255,255,255,.06);

    border-radius:22px;

    overflow:hidden;

    backdrop-filter:blur(15px);

}

.panel-title{

    height:72px;

    display:flex;

    align-items:center;

    gap:15px;

    padding:0 25px;

    font-size:30px;

    font-weight:700;

    background:rgba(35,57,104,.9);

}

/* ================= TABLE ================= */

table{

    width:100%;

    color:white;

}

thead{

    background:#26374f;

}

thead th{

    padding:16px;

    font-size:23px;

}

tbody td{

    padding:18px;

    font-size:22px;

}

tbody tr:nth-child(even){

    background:rgba(255,255,255,.04);

}

tbody tr{

    transition:.25s;

}

tbody tr:hover{

    background:rgba(255,255,255,.08);

}

/* ================= STATUS ================= */

.status{

    padding:7px 18px;

    border-radius:20px;

    font-weight:700;

}

.hadir{

    background:#16a34a;

}

.terlambat{

    background:#f59e0b;

    color:black;

}

/* ================= BELUM ABSEN ================= */

#alphaList{

    height:calc(100vh - 390px);;

    overflow:hidden;

    padding:15px;

}

.alpha-item{

    background:rgba(255,255,255,.06);

    border-radius:15px;

    padding:18px;

    margin-bottom:15px;

    font-size:22px;

    display:flex;

    align-items:center;

    gap:12px;

}

.alpha-item i{

    color:#ff5f74;

}

/* ================= POPUP ================= */

.popup{

    position:fixed;

    inset:0;

    background:rgba(0,0,0,.55);

    display:none;

    justify-content:center;

    align-items:center;

    z-index:999;

}

.popup-content{

    width:540px;

    background:white;

    color:#222;

    border-radius:28px;

    text-align:center;

    padding:40px;

    animation:zoom .4s;

}

.popup-content i{

    color:#16a34a;

    font-size:90px;

}

.popup-content h2{

    margin:20px 0;

    font-weight:800;

}

.popup-content h3{

    font-size:36px;

    color:#2563eb;

}

.popup-content p{

    font-size:24px;

}

.popup-content span{

    font-size:28px;

    font-weight:bold;

}

@keyframes zoom{

from{

transform:scale(.5);

opacity:0;

}

to{

transform:scale(1);

opacity:1;

}

}

/* ================= RUNNING TEXT ================= */

.running{

    position:fixed;

    bottom:0;

    width:100%;

    height:40px;

    background:#07111f;

    overflow:hidden;

    display:flex;

    align-items:center;

    border-top:1px solid rgba(255,255,255,.08);

}

.marquee{

    white-space:nowrap;

    font-size:22px;

    font-weight:600;

    animation:marquee 28s linear infinite;

}

@keyframes marquee{

0%{

transform:translateX(100%);

}

100%{

transform:translateX(-100%);

}

}

/* ================= ANIMASI ANGKA ================= */

.animateNumber{

    animation:pop .35s;

}

@keyframes pop{

0%{

transform:scale(.6);

}

60%{

transform:scale(1.25);

}

100%{

transform:scale(1);

}

}
    </style>

</head>

<body>

    <!-- HEADER -->

    <header class="topbar">

        <div class="logo-box">

            <div class="logo">

                <img src="{{ asset('images/ubudiyah.png') }}" alt="Logo">

            </div>

            <div>

                <h1>MONITORING PRESENSI KEGIATAN UBUDIYAH</h1>

                <p>Pondok Pesantren Annuqayah</p>

            </div>

        </div>

        <div class="header-right">

            <div class="live">
                <span></span>
                LIVE RFID
            </div>

            <div id="clock" class="clock">
                00:00:00
            </div>

            <div id="tanggal" class="tanggal">
                -
            </div>

        </div>

    </header>


    <!-- CARD -->

    <section class="cards">

        <div class="card hadir-card">

            <div>

                <h4>Hadir</h4>

                <h2 id="hadirCount">0</h2>

            </div>

            <i class="fa-solid fa-user-check"></i>

        </div>

        <div class="card terlambat-card">

            <div>

                <h4>Terlambat</h4>

                <h2 id="terlambatCount">0</h2>

            </div>

            <i class="fa-solid fa-clock"></i>

        </div>

        <div class="card alpha-card">

            <div>

                <h4>Belum Absen</h4>

                <h2 id="alphaCount">0</h2>

            </div>

            <i class="fa-solid fa-user-xmark"></i>

        </div>

    </section>


    <!-- CONTENT -->

    <section class="content">

        <!-- ABSENSI TERBARU -->

        <div class="left-panel">

            <div class="panel-title">

                <i class="fa-solid fa-clipboard-list"></i>

                Absensi Terbaru

            </div>

            <table>

                <thead>

                    <tr>

                        <th>Nama</th>

                        <th>Kegiatan</th>

                        <th>Status</th>

                        <th>Jam</th>

                    </tr>

                </thead>

                <tbody id="absensiTable">

                </tbody>

            </table>

        </div>


        <!-- BELUM ABSEN -->

        <div class="right-panel">

            <div class="panel-title">

                <i class="fa-solid fa-users"></i>

                Santri Belum Absen

            </div>

            <div id="alphaList">

            </div>

        </div>

    </section>


    <!-- POPUP RFID -->

    <div id="popup" class="popup">

        <div class="popup-content">

            <i class="fa-solid fa-circle-check"></i>

            <h2>RFID TERDETEKSI</h2>

            <h3 id="popupNama"></h3>

            <p id="popupKegiatan"></p>

            <span id="popupJam"></span>

        </div>

    </div>


    <!-- RUNNING TEXT -->

    <div class="running">

        <div class="marquee">

            📡 Monitoring Realtime • Sistem Presensi RFID Pondok Pesantren Annuqayah • Selamat Datang • Monitoring Presensi Ubudiyah • RFID Aktif • Data Ditampilkan Secara Realtime • Monitoring Realtime •

        </div>

    </div>



   <script>

let lastNewestID = null;

// =============================
// JAM DIGITAL
// =============================

function updateClock(){

    const now = new Date();

    document.getElementById("clock").innerHTML =
        now.toLocaleTimeString("id-ID");

    document.getElementById("tanggal").innerHTML =
        now.toLocaleDateString("id-ID",{
            weekday:"long",
            day:"numeric",
            month:"long",
            year:"numeric"
        });

}

setInterval(updateClock,1000);

updateClock();


// =============================
// ANIMASI ANGKA
// =============================

function animateNumber(id){

    const el=document.getElementById(id);

    el.classList.remove("animateNumber");

    void el.offsetWidth;

    el.classList.add("animateNumber");

}


// =============================
// LOAD DATA
// =============================

async function loadData(){

try{

const response=await fetch("/monitoring/data");

const data=await response.json();


// =============================
// CARD
// =============================

document.getElementById("hadirCount").innerHTML=data.hadir.length;

document.getElementById("terlambatCount").innerHTML=data.terlambat.length;

document.getElementById("alphaCount").innerHTML=data.alpha.length;

animateNumber("hadirCount");

animateNumber("terlambatCount");

animateNumber("alphaCount");


// =============================
// GABUNG HADIR + TERLAMBAT
// =============================

let semua=[];

data.hadir.forEach(item=>{

semua.push({

id:item.id,

nama:item.santri.nama,

kegiatan:item.kegiatan.nama_kegiatan,

status:"Hadir",

jam:item.jam_absen

});

});

data.terlambat.forEach(item=>{

semua.push({

id:item.id,

nama:item.santri.nama,

kegiatan:item.kegiatan.nama_kegiatan,

status:"Terlambat",

jam:item.jam_absen

});

});


// =============================
// SORT TERBARU
// =============================

semua.sort((a,b)=>b.id-a.id);


// =============================
// TABLE
// =============================

let html="";

semua.slice(0,10).forEach(item=>{

html+=`

<tr>

<td>${item.nama}</td>

<td>${item.kegiatan}</td>

<td>

<span class="status ${item.status=="Hadir" ? "hadir":"terlambat"}">

${item.status}

</span>

</td>

<td>${item.jam}</td>

</tr>

`;

});

document.getElementById("absensiTable").innerHTML=html;


// =============================
// DATA BARU RFID
// =============================

if(lastNewestID===null && semua.length){

lastNewestID=semua[0].id;

}

if(semua.length){

if(lastNewestID!=semua[0].id){

lastNewestID=semua[0].id;

showPopup(semua[0]);

}

}


// =============================
// BELUM ABSEN
// =============================

let alphaHTML="";

data.alpha.forEach(item=>{

alphaHTML+=`

<div class="alpha-item">

<i class="fa-solid fa-user-clock"></i>

${item.santri.nama}

</div>

`;

});

document.getElementById("alphaList").innerHTML=alphaHTML;


}catch(error){

console.log(error);

}

}


// =============================
// REFRESH
// =============================

loadData();

setInterval(loadData,2000);

</script>

<script>

// ===========================================
// POPUP RFID
// ===========================================

function showPopup(data){

    document.getElementById("popupNama").innerHTML =
        data.nama;

    document.getElementById("popupKegiatan").innerHTML =
        data.kegiatan;

    document.getElementById("popupJam").innerHTML =
        data.jam;

    const popup=document.getElementById("popup");

    popup.style.display="flex";

    playBeep();

    setTimeout(()=>{

        popup.style.display="none";

    },3000);

}


// ===========================================
// BEEP RFID
// ===========================================

function playBeep(){

    const ctx=new(window.AudioContext||window.webkitAudioContext)();

    const osc=ctx.createOscillator();

    const gain=ctx.createGain();

    osc.type="sine";

    osc.frequency.value=900;

    osc.connect(gain);

    gain.connect(ctx.destination);

    osc.start();

    gain.gain.setValueAtTime(0.2,ctx.currentTime);

    gain.gain.exponentialRampToValueAtTime(
        0.001,
        ctx.currentTime+0.25
    );

    osc.stop(ctx.currentTime+0.25);

}


// ===========================================
// AUTO SCROLL BELUM ABSEN
// ===========================================

let scrollPos=0;

function autoScrollAlpha(){

    const box=document.getElementById("alphaList");

    if(!box) return;

    scrollPos++;

    box.scrollTop=scrollPos;

    if(scrollPos>=box.scrollHeight-box.clientHeight){

        scrollPos=0;

    }

}

setInterval(autoScrollAlpha,35);


// ===========================================
// ANIMASI LIVE
// ===========================================

setInterval(()=>{

    const live=document.querySelector(".live");

    live.style.opacity=".4";

    setTimeout(()=>{

        live.style.opacity="1";

    },500);

},1000);


// ===========================================
// ANIMASI ROW TERBARU
// ===========================================

function highlightNewest(){

    const row=document.querySelector("#absensiTable tr");

    if(!row) return;

    row.style.transition=".4s";

    row.style.background="#16a34a";

    row.style.color="white";

    setTimeout(()=>{

        row.style.background="";

        row.style.color="";

    },1500);

}

setInterval(highlightNewest,2200);


// ===========================================
// AUTO GANTI WARNA HEADER
// ===========================================

const colors=[

"#0f2f59",

"#17356d",

"#103b6d",

"#0c4a6e"

];

let colorIndex=0;

setInterval(()=>{

    colorIndex++;

    if(colorIndex>=colors.length){

        colorIndex=0;

    }

    document.querySelector(".topbar").style.background=

    colors[colorIndex];

},5000);


// ===========================================
// ANIMASI CARD
// ===========================================

setInterval(()=>{

    document.querySelectorAll(".card").forEach(card=>{

        card.style.transform="scale(1.03)";

        setTimeout(()=>{

            card.style.transform="scale(1)";

        },300);

    });

},4000);


// ===========================================
// JIKA TIDAK ADA DATA
// ===========================================

function checkEmpty(){

    const table=document.getElementById("absensiTable");

    if(table.innerHTML.trim()==""){

        table.innerHTML=`

        <tr>

        <td colspan="4"

        style="text-align:center;
        padding:30px;
        color:#ddd;">

        Belum ada data presensi hari ini

        </td>

        </tr>

        `;

    }

}

setInterval(checkEmpty,1000);

</script>
</body>

</html>