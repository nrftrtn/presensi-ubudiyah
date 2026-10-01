@extends('layouts.app')

@section('content')

<div class="card border-0 shadow-sm rounded-4 p-4">

    <!-- Tombol Tambah Kamar -->
    <div class="d-flex justify-content-end mb-4">

        <a href="/kamar/create"
           class="btn btn-success">

            <i class="fa fa-plus"></i>
            Tambah Kamar

        </a>

    </div>


    <!-- Tabel Data Kamar -->
    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle mb-0">

            <thead class="table-success">

                <tr>

                    <th>No</th>

                    <th>Nama Kamar</th>

                    <th>Blok</th>

                    <th width="170">Aksi</th>

                </tr>

            </thead>


            <tbody>

                @forelse($kamars as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $item->nama_kamar }}
                        </td>

                        <td>
                            {{ $item->blok }}
                        </td>

                        <td>

                            <a href="/kamar/edit/{{ $item->id }}"
                               class="btn btn-warning btn-sm">

                                <i class="fa fa-pen"></i>
                                Edit

                            </a>


                            <a href="/kamar/delete/{{ $item->id }}"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus kamar?')">

                                <i class="fa fa-trash"></i>
                                Hapus

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="text-center text-muted py-4">

                            <i class="fa fa-inbox fa-2x mb-2 d-block"></i>

                            Data kamar belum tersedia

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection


<style>

    /* Tabel */

    table td,
    table th {

        vertical-align: middle;

    }


    /* Tombol */

    .btn {

        border-radius: 8px;

    }


    /* Input / Select jika nanti digunakan */

    .form-control,
    .form-select {

        border-radius: 8px;

    }


    /* Hover tabel */

    table tbody tr:hover {

        background-color: #f5f5f5;

        transition: 0.2s;

    }

</style>