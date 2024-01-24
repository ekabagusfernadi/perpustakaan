{{-- @dd($anggota) --}}
@extends('layouts.admin')

@section("title", "Peminjaman")
@section("header", "Peminjaman")

@push("css")
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
{{-- select2 --}}
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
{{-- datepicker --}}
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<component id="controller">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-5">
                    <a href="#" v-on:click.prevent="tambahData()" class="btn bn-sm btn-primary pull-right">Tambah Transaksi</a>
                </div>
                <div class="col-md-2">
                    <select name="status" id="status" class="form-control" style="cursor: pointer;">
                        <option value="semua">Filter Status</option>
                        <option value="sudah">Sudah kembali</option>
                        <option value="belum">Belum kembali</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input id="datepicker" name="datepicker"/>
                </div>
                <div class="col-md-1">
                    {{-- <i class="far fa-times-circle" id="resetDatePicker"></i> --}}
                    <button class="btn btn-secondary" id="resetDatePicker">Clear</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="tableNich" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Nama Peminjam</th>
                        <th>Lama Pinjam (hari)</th>
                        <th>Total Buku</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>

        <!-- modal box -->
        <div class="modal fade" id="modal-nich">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form v-bind:action="actionUrl" method="POST" autocomplete="off" v-on:submit="submitForm($event, singleData.id)">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="!editStatus">Tambah Transaksi</h4>
                            <h4 class="modal-title" v-if="detailStatus">Detail Transaksi</h4>
                            <h4 class="modal-title" v-if="editStatus && !detailStatus">Ubah Transaksi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="id_anggota">Anggota</label>
                                    </div>
                                    
                                    <div class="col-md-10">
                                        <select name="id_anggota" id="id_anggota" class="form-control" required v-if="!detailStatus">
                                            <option value="" readonly>Pilih anggota...</option>
                                            @foreach ($anggota as $a)
                                                <option value="{{ $a->id }}" v-bind:selected="singleData.id_anggota == '{{ $a->id }}'">{{ $a->nama }}</option>
                                            @endforeach
                                        </select>
                                        <div v-else>
                                            @foreach ($anggota as $a)
                                                <p v-if="singleData.id_anggota == '{{ $a->id }}'">{{ $a->nama }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-10 select2-blue">
                                        <select name="anggota" id="anggota" class="form-control select2" data-dropdown-css-class="select2-blue" required>
                                            <option value="" readonly>Pilih anggota...</option>
                                            @foreach ($anggota as $a)
                                                <option value="{{ $a->id }}">{{ $a->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Tanggal</label>
                                    </div>
                                    
                                    <div class="col-md-10">
                                        <div class="row">
                                            <template v-if="!detailStatus">
                                                <div class="col-md-6">
                                                    <input id="datepickerModalStart" name="tgl_pinjam" placeholder="Dari..." v-bind:value="singleData.tgl_pinjam"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <input id="datepickerModalEnd" name="tgl_kembali" placeholder="Sampai..." v-bind:value="singleData.tgl_kembali"/>
                                                </div>
                                            </template>
                                            <template v-else>
                                                <template class="col-md-6">
                                                    <p>&ensp;@{{ singleData.tgl_pinjam }}</p>
                                                </template>
                                                &emsp;-&emsp;
                                                <template class="col-md-6">
                                                    <p>@{{ singleData.tgl_kembali }}</p>
                                                </template>
                                                {{-- <p>oke</p> --}}
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="buku">Buku</label>
                                    </div>
                                    
                                    {{-- <div class="col-md-10">
                                        <select name="buku" id="buku" class="form-control" required>
                                            <option value="" readonly>Pilih...</option>
                                            @foreach ($buku as $b)
                                                <option value="{{ $b->id }}">{{ $b->judul }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="col-md-10 select2-blue">
                                        <select name="id_buku[]" id="buku" class="form-control select2" data-dropdown-css-class="select2-blue" multiple="multiple" data-placeholder="Pilih buku..." style="width: 100%;" required>
                                            {{-- <option value="" readonly>Pilih...</option> --}}
                                            <?php $tes = [4,1,3,2]; ?>
                                            @foreach ($buku as $b)
                                                {{-- <option value="{{ $b->id }}" {{ $b->id == $tes ? 'selected' : '' }}>{{ $b->judul }}</option> --}}
                                                <option value="{{ $b->id }}" {{ in_array($b->id, $tes, TRUE) ? 'selected' : '' }}>{{ $b->judul }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" v-show="editStatus">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">Status</label>
                                    </div>
                                    
                                    <div class="col-md-10">
                                        <template v-if="!detailStatus">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="statusPeminjaman" id="inlineRadio2" value="option2" v-bind:checked="singleData.status == '0'">
                                                <label class="form-check-label" for="inlineRadio2">Belum dikembalikan</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="statusPeminjaman" id="inlineRadio1" value="option1" v-bind:checked="singleData.status == '1'">
                                                <label class="form-check-label" for="inlineRadio1">Sudah dikembalikan</label>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <p v-if="singleData.status == 0">Belum dikembalikan</p>
                                            <p v-if="singleData.status == 1">Sudah dikembalikan</p>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" v-if="!detailStatus">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- akhir modal box -->
    </component>

@endsection

@push("js")
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script>
    let actionUrl = "{{ url('data/peminjaman') }}";
    let columns = [
        {data: "tgl_pinjam", class: "text-center", orderable: true},
        {data: "tgl_kembali", class: "text-center", orderable: true},
        {render: function( index, row, data, meta ) {
            return data.anggota.nama;
        }, orderable: true, class: "text-center"},
        {render: function( index, row, data, meta ) {
            const selisih = new Date(data.tgl_kembali).getTime() - new Date(data.tgl_pinjam).getTime();
            return selisih/(1000 * 60 * 60 * 24) + " hari";
        }, orderable: true, class: "text-center"},
        {render: function( index, row, data, meta ) {
            return data.detail_peminjaman.reduce((acc, cur) => acc + cur.qty, 0);
        }, orderable: true, class: "text-center"},
        {render: function( index, row, data, meta ) {
            return data.buku.reduce((acc, cur) => acc + cur.harga_pinjam, 0);
        }, orderable: true, class: "text-center"},
        // {data: "tgl_kembali", class: "text-center", orderable: true},
        // {data: "status", class: "text-center", orderable: true},
        // {data: "email", class: "text-center", orderable: true},
        // {render: function( index, row, data, meta ) {
        //     return data.buku.judul;
        // }, orderable: false, class: "text-center"},
        {render: function( index, row, data, meta ) {
            if( data.status == 1 ) {
                return "Sudah kembali";
            } else {
                return "Belum kembali";
            }
        }, orderable: false, class: "text-center"},
        {render: function( index, row, data, meta ) {
            return `
                <div class="row">
                    <div class="col-6">
                        <a href="#" class="btn btn-success btn-sm" onclick="controller.detailData(event, ${meta.row})">
                            Detail
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-warning btn-sm" onclick="controller.ubahData(event, ${meta.row})">
                            Edit
                        </a>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col">
                        <a href="#" class="btn btn-danger btn-sm" onclick="controller.hapusData(event, ${data.id})">
                            &nbsp;&nbsp;Hapus Data&nbsp;&nbsp;
                        </a>
                    </div>
                </div>
            `
        }, orderable: false, width: "100px", class: "text-center"},
    ];
</script>
<script src="{{ asset('js/data.js') }}"></script>
<script type="text/javascript">
    //Initialize Select2 Elements
    $('.select2').select2()

    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
    $('#datepickerModalStart').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
    $('#datepickerModalEnd').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });

    $('select[name=status]').on('change', function() {
        status = $('select[name=status]').val();
        datepicker = $('input[name=datepicker]').val();
        console.log(datepicker);
        // if( status == "semua" ) {
        //     controller.table.ajax.url(actionUrl).load();
        // } else {
        //     controller.table.ajax.url(actionUrl + '?status=' + status).load();
        // }
        controller.table.ajax.url(actionUrl + '?status=' + status + '&datepicker=' + datepicker).load();
    });
    $('input[name=datepicker]').on('change', function() {
        status = $('select[name=status]').val();
        datepicker = $('input[name=datepicker]').val();
        
        controller.table.ajax.url(actionUrl + '?status=' + status + '&datepicker=' + datepicker).load();
    });
    $("#resetDatePicker").on("click", function() {
        $('select[name=status]').val("semua");
        $('input[name=datepicker]').val("");
        controller.table.ajax.url(actionUrl).load();
    });

</script>

@endpush