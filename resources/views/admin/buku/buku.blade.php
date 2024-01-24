@extends('layouts.admin')

@push("css")
@endpush

@section('content')
<component id="controller">
    <div class="row">
        <div class="col mb-3">
            <a href="#" v-on:click.prevent="tambahData()" class="btn bn-sm btn-primary pull-right">Tambah Buku</a>
        </div>
        <div class="col-md-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" v-model="search" class="form-control" autocomplete="off" placeholder="Cari buku...">
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12" v-for="buku in filteredList">
            <!-- <div class="info-box" v-on:click="editData(buku)"> -->
            <div class="info-box">
                <div class="info-box-content">
                    <span class="info-box-text h6">@{{ buku.judul }} (@{{ buku.qty_stok }})</span>
                    <span class="info-box-number d-flex justify-content-between">Rp. @{{ formatPrice(buku.harga_pinjam) }},-
                        <span>
                            <a href="" class="badge badge-warning" v-on:click.prevent="editData(buku)">Ubah</a>
                            <a href="" class="badge badge-danger" v-on:click.prevent="hapusData($event, buku.id)">Hapus</a>
                        </span>
                    </span>
                    
                </div>
            </div>
        </div>

    </div>

        <!-- modal box -->
        <div class="modal fade" id="modal-nich">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- <form v-bind:action="actionUrl" method="POST" autocomplete="off" v-on:submit="submitForm($event, data.id)"> -->
                    <form v-bind:action="actionUrl" method="POST" autocomplete="off">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="!editStatus">Tambah Buku</h4>
                            <h4 class="modal-title" v-if="editStatus">Ubah Buku</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="_method" value="PUT" v-if="editStatus">
                            <!-- <input type="hidden" name="_method" value="DELETE" v-if="hapus"> -->

                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="isbn">ISBN</label>
                                        <input type="text" class="form-control" name="isbn" id="isbn" v-bind:value="data.isbn" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" class="form-control" name="judul" id="judul" v-bind:value="data.judul" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <input type="text" class="form-control" name="tahun" id="tahun" v-bind:value="data.tahun" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="id_penerbit">Penerbit</label>
                                        <input type="text" class="form-control" name="id_penerbit" id="id_penerbit" v-bind:value="data.id_penerbit" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="id_pengarang">Pengarang</label>
                                        <input type="text" class="form-control" name="id_pengarang" id="id_pengarang" v-bind:value="data.id_pengarang" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="id_katalog">Katalog</label>
                                        <input type="text" class="form-control" name="id_katalog" id="id_katalog" v-bind:value="data.id_katalog" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="qty_stok">Stok Tersedia</label>
                                        <input type="text" class="form-control" name="qty_stok" id="qty_stok" v-bind:value="data.qty_stok" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="harga_pinjam">Harga Pinjam</label>
                                        <input type="text" class="form-control" name="harga_pinjam" id="harga_pinjam" v-bind:value="data.harga_pinjam" required>
                                    </div>
                                </div>
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

<script>
    let actionUrl = "{{ url('data/buku') }}";
    let app = new Vue({
        el: "#controller",
        data: {
            search: "",
            data_buku: [],
            data: {},
            actionUrl: actionUrl,
            editStatus: false,
            pesan: pesan,
            konfirmasi: konfirmasi,
            
        },
        mounted: function() {
            
            this.databuku();
        },
        methods: {
            databuku() {
                const _this = this;
                $.ajax({
                    url: actionUrl,
                    method: "GET",
                    success: function(data) {
                        _this.data_buku = JSON.parse(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            },
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace(".", ",");
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                // return value;
            },
            editData(buku) {
                this.data = buku;
                this.editStatus = true;
                $("#modal-nich").modal();


                this.actionUrl = actionUrl + "/" + buku.id;
            },
            tambahData: function() {
                this.editStatus = false;
                this.data = {};

                $("#modal-nich").modal();
            },
            submitForm(event, id) {
                event.preventDefault();
                const _this = this;
                let actionUrl = !this.editStatus ? this.actionUrl : this.actionUrl + "/" + id;
                axios.post(actionUrl, new FormData($(event.target)[0]))
                .then(respon => {
                    $("#modal-nich").modal("hide");
                    _this.table.ajax.reload();
                    this.pesan( id ? "diubah" : "ditambah", "success" );
                    
                });
            },
            hapusData: function(event, id) {
                this.actionUrl = `{{ url('data/buku/${id}') }}`
                if( confirm("Yakin kawan?") ) {
                    axios.post(this.actionUrl, {_method: "DELETE"})
                    .then( (respon) => location.reload() );
                }

                // this.konfirmasi().then((result) => {
                //     if (result.isConfirmed) {
                //         // console.log($(event.target).parents(".info-box"));
                //         $(event.target).parents(".info-box").remove();
                //         axios.post(this.actionUrl, {_method: "DELETE"})
                //         .then( (respon) => this.pesan( "dihapus", "success" ) );
                //     }
                // });
            },
        },
        computed: {
            filteredList() {
                return this.data_buku.filter((buku) => {
                    return buku.judul.toLowerCase().includes(this.search.toLowerCase())
                });
            }
        },
    });
</script>
{{-- <!-- <script src="{{ asset('js/data.js') }}"></script> --> --}}

@endpush