const controller = new Vue({
    el: "#controller",
    data: {
        editStatus: false,
        datas: [],
        singleData: {},
        singleDatay: {},
        actionUrl: actionUrl,
        pesan: pesan,
        konfirmasi: konfirmasi,
        detailStatus: false,
    },
    mounted: function () {
        this.datatable();
    },
    methods: {
        datatable() {
            const _this = this;
            _this.table = $("#tableNich")
                .DataTable({
                    responsive: {
                        details: {
                            type: "column",
                        },
                    },
                    ajax: {
                        url: _this.actionUrl,
                        type: "get",
                    },
                    columns: columns,
                })
                .on("xhr", function () {
                    _this.datas = _this.table.ajax.json().data;
                });
        },

        tambahData: function () {
            this.editStatus = false;
            this.detailStatus = false;
            this.singleData = {};

            $("#modal-nich").modal();
        },
        ubahData: function (event, index) {
            this.editStatus = true;
            this.detailStatus = false;
            this.singleData = this.datas[index];
            this.singleDatay = this.datas[index].buku;

            $("#modal-nich").modal();
        },
        detailData: function (event, index) {
            this.editStatus = true;
            this.detailStatus = true;
            this.singleData = this.datas[index];

            $("#modal-nich").modal();
        },
        hapusData: function (event, id) {
            this.konfirmasi().then((result) => {
                if (result.isConfirmed) {
                    $(event.target).parents("tr").remove();
                    axios
                        .post(this.actionUrl + "/" + id, { _method: "DELETE" })
                        .then((respon) => this.pesan("dihapus", "success"));
                }
            });
        },

        submitForm(event, id) {
            event.preventDefault();
            const _this = this;
            let actionUrl = !this.editStatus
                ? this.actionUrl
                : this.actionUrl + "/" + id;
            axios
                .post(actionUrl, new FormData($(event.target)[0]))
                .then((respon) => {
                    $("#modal-nich").modal("hide");
                    _this.table.ajax.reload();
                    this.pesan(id ? "diubah" : "ditambah", "success");
                });
        },
    },
});
