@extends('layouts.admin')

@section("title", "Katalog")
@section("header", "Katalog")

@push("css")
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
<component id="controller">
    <div class="row">
        <div class="col-6">
        <div class="card">
            <div class="card-header">
                <a href="#" v-on:click.prevent="tambahData()" class="btn bn-sm btn-primary pull-right">Tambah Katalog</a>
            </div>
            <div class="card-body">
                <table id="tableNich" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
        </div>
    </div>

        <!-- modal box -->
        <div class="modal fade" id="modal-nich">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form v-bind:action="actionUrl" method="POST" autocomplete="off" v-on:submit="submitForm($event, singleData.id)">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="!editStatus">Tambah Katalog</h4>
                            <h4 class="modal-title" v-if="editStatus">Ubah Katalog</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                            <div class="form-group">
                                <label for="nama">Nama Katalog</label>
                                <input type="text" class="form-control" name="nama" id="nama" v-bind:value="singleData.nama" required>
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
    let actionUrl = "{{ url('data/katalog') }}";
    let columns = [
        {data: "nama", class: "text-center", orderable: true},
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

@endpush