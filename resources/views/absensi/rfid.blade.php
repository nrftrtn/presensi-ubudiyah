@extends('layouts.app')

@section('content')

<div class="rfid-wrapper">

    <div class="rfid-box">

        <h1 class="title">MESIN ABSENSI RFID</h1>

        <p class="subtitle">Tempelkan kartu RFID pada reader</p>

        <!-- STATUS -->
        <div id="status" class="status waiting">
            MENUNGGU SCAN...
        </div>

        <!-- HASIL -->
        <div id="nama" class="nama"></div>
        <div id="kegiatan" class="kegiatan"></div>
        <div id="jam" class="jam"></div>

        <!-- 🔥 TEST BUTTON -->
        <button onclick="sendRFID('RFID001')" class="btn btn-success mt-3">
            TEST RFID 001
        </button>

        <button onclick="sendRFID('RFID002')" class="btn btn-primary mt-3">
            TEST RFID 002
        </button>

    </div>

</div>

@endsection


@push('style')
<style>

.rfid-wrapper{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#0f172a;
    color:white;
}

.rfid-box{
    text-align:center;
    width:90%;
    max-width:650px;
    padding:50px;
    background:#111827;
    border-radius:20px;
    box-shadow:0 0 25px rgba(0,0,0,0.6);
}

.title{
    font-size:34px;
    font-weight:bold;
    margin-bottom:10px;
}

.subtitle{
    color:#94a3b8;
    margin-bottom:30px;
}

.status{
    font-size:28px;
    font-weight:bold;
    padding:18px;
    border-radius:10px;
    margin-bottom:25px;
}

.waiting{
    background:#334155;
}

.success{
    background:#16a34a;
}

.error{
    background:#dc2626;
}

.nama{
    font-size:32px;
    font-weight:bold;
    margin-top:15px;
}

.kegiatan{
    font-size:18px;
    color:#cbd5e1;
    margin-top:10px;
}

.jam{
    font-size:16px;
    color:#94a3b8;
    margin-top:10px;
}

</style>
@endpush


@push('script')
<script>

console.log("RFID SCRIPT LOADED");

function resetUI(){
    document.getElementById('status').className = 'status waiting';
    document.getElementById('status').innerText = 'MENUNGGU SCAN...';

    document.getElementById('nama').innerText = '';
    document.getElementById('kegiatan').innerText = '';
    document.getElementById('jam').innerText = '';
}

async function sendRFID(uid){

    try {
        let response = await fetch('/api/rfid/scan', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                uid_rfid: uid
            })
        });

        let data = await response.json();

        let statusBox = document.getElementById('status');

        if(data.status){

            statusBox.className = 'status success';
            statusBox.innerText = 'ABSENSI BERHASIL';

            document.getElementById('nama').innerText = data.nama;
            document.getElementById('kegiatan').innerText = data.kegiatan;
            document.getElementById('jam').innerText = data.jam;

        }else{

            statusBox.className = 'status error';
            statusBox.innerText = data.message;
        }

        setTimeout(resetUI, 3000);

    } catch (err) {
        console.log("ERROR:", err);
        alert("Gagal koneksi ke server");
    }
}

resetUI();

</script>
@endpush