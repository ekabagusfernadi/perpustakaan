@extends('layouts.admin')

@section("title", "Anggota")
@section("header", "Anggota")

@push("css")
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
<component id="controller">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <a href="#" v-on:click.prevent="tambahData()" class="btn bn-sm btn-primary pull-right">Tambah Anggota</a>
                </div>
                <div class="col-md-2">
                    <select name="sex" id="sex" class="form-control" style="cursor: pointer;">
                        <option value="0">Semua Jenis Kelamin</option>
                        <option value="P">Perempuan</option>
                        <option value="L">Laki Laki</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="tableNich" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        
                        <th>Nama</th>
                        <th>Sex</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Email</th>
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
                            <h4 class="modal-title" v-if="!editStatus">Tambah Anggota</h4>
                            <h4 class="modal-title" v-if="editStatus">Ubah Anggota</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                            <div class="form-group">
                                <label for="nama">Nama Anggota</label>
                                <input type="text" class="form-control" name="nama" id="nama" v-bind:value="singleData.nama" required>
                            </div>
                            <div class="form-group">
                                <label for="sex">Jenis Kelamin</label>
                                <select name="sex" id="sex" class="form-control" required>
                                    <option value="" readonly>Pilih...</option>
                                    <option value="L" v-bind:selected="singleData.sex == 'L'">Laki - Laki</option>
                                    <option value="P" v-bind:selected="singleData.sex == 'P'">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" v-bind:value="singleData.alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="telp">Telepon</label>
                                <input type="text" class="form-control" name="telp" id="telp" v-bind:value="singleData.telp" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" v-bind:value="singleData.email" required>
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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

<script>
    let actionUrl = "{{ url('data/anggota') }}";
    let columns = [
        {data: "nama", class: "text-center", orderable: true},
        {data: "sex", class: "text-center", orderable: true},
        {data: "telp", class: "text-center", orderable: true},
        {data: "alamat", class: "text-center", orderable: true},
        {data: "email", class: "text-center", orderable: true},
        {render: function( index, row, data, meta ) {
            return `
                <a href="#" class="btn btn-warning btn-sm" onclick="controller.ubahData(event, ${meta.row})">
                    Edit
                </a>
                <a href="#" class="btn btn-danger btn-sm" onclick="controller.hapusData(event, ${data.id})">
                    Hapus
                </a>
            `
        }, orderable: false, width: "100px", class: "text-center"},
    ];
</script>
<script src="{{ asset('js/data.js') }}"></script>
<script type="text/javascript">
    $('select[name=sex]').on('change', function() {
        sex = $('select[name=sex]').val();

        if( sex == 0 ) {
            controller.table.ajax.url(actionUrl).load();
        } else {
            controller.table.ajax.url(actionUrl + '?sex=' + sex).load();
        }
    });
</script>

@endpush