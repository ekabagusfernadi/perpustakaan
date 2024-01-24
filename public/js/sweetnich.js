// pesan
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  width: 300,
  background: "#898989",
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

const pesan = function(aksi, gambar) {
  Toast.fire({
    icon: gambar,
    title: `<span style="color: white">Data berhasil ${aksi}</span>`
  })
}

// konfirmasi
const Toast1 = Swal.mixin({
  toast: true,
  width: 300,
  background: "#898989",
  
})

const konfirmasi = function() {
  return Swal.fire({
    width: 300,
    background: "#676767",
		title: `<h5 style="color: white; letter-spacing: 2px; font-size: 18px">Apakah anda yakin?</h5>`,
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
	})
} 