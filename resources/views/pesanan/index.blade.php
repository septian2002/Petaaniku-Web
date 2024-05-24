@extends('layout.app')

@section('title', 'Data Pesanan Baru')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">
                Data Pesanan Baru
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pesanan</th>
                            <th>Invoice</th>
                            <th>Member</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-detail-pemesanan" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pemesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tempat untuk menampilkan detail pemesanan -->
                    <p>Tanggal Pesanan: </p>
                    <p>Nama Pemesan: </p>
                    <p>Nama Produk: </p>
                    <p>Harga: </p>
                    <p>Jumlah: </p>
                    <p>Total Harga: </p>
                    <div id="detail-pemesanan-content"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(function() {

            function rupiah(angka){
                const format = angka.toString().split('').reverse().join('');
                const convert = format.match(/\d{1,3}/g);
                return 'Rp ' + convert.join('.').split('').reverse().join('');
            }

            function date(date){
                var date = new Date(date);
                var day = date.getDate();
                var month = date.getMonth();
                var year = date.getFullYear()

                return `${day}-${month}-${year}`;
            }

            const token = localStorage.getItem('token')
            $.ajax({
                url: '/api/pesanan/baru',
                headers: {
                    "Authorization": 'Bearer' + token
                },
                success: function({
                    data
                }) {
                    let row = '';
                    data.map(function(val, index) {
                        row += `
            <tr>
               <td>${index + 1}</td>
               <td>${new Date(val.created_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })}</td>
               <td>${val.invoice}</td>
               <td>${val.member.nama_member}</td>
               <td>${rupiah(val.grand_total)}</td>
               <td>
                    <a href="#" data-id="${val.id}" class="btn btn-success btn-aksi">Konfirmasi</a>
                </td>
            </tr>
            `;
                    });
                    $('tbody').append(row);
                }
        });

        $(document).on('click','.btn-aksi',function(){
            const id = $(this).data('id')

            $.ajax({
                url: '/api/pesanan/ubah_status/' +  id,
                type: 'POST',
                data : {
                    status : "Dikonfirmasi"
                },
                headers: {
                    "Authorization": 'Bearer' + token
                },
                success : function(data){
                    location.reload()
                }
            })
        })

    });

    // 
    // $(document).ready(function () {
    //     $('.btn-konfirmasi').click(function () {
    //         var orderId = $(this).data('id');

    //         // Permintaan AJAX untuk mendapatkan detail pemesanan
    //         $.ajax({
    //             url: '/orders/' + orderId,
    //             type: 'GET',
    //             success: function (response) {
    //                 // Tampilkan detail pemesanan dalam modal
    //                 $('#detail-pemesanan-content').html(response);
    //                 $('#modal-detail-pemesanan').modal('show');
    //             },
    //             error: function (xhr, status, error) {
    //                 console.error(error);
    //                 alert('Gagal mengambil detail pemesanan. Silakan coba lagi.');
    //             }
    //         });
    //     });
    // });

    // Tombol konfirmasi
    $(document).on('click', '.btn-aksi', function() {
        const id = $(this).data('id');
        const token = localStorage.getItem('token');

        const confirm_dialog = confirm('Apakah Anda yakin ingin mengkonfirmasi pesanan ini?');
        if (confirm_dialog) {
            $.ajax({
                url: '/api/pesanan/konfirmasi/' + id,
                type: "POST",
                headers: {
                    "Authorization": 'Bearer ' + token
                },
                success: function(data) {
                    if (data.message == 'success') {
                        alert('Pesanan berhasil dikonfirmasi');
                        location.reload(); // Reload halaman jika sukses
                    } else {
                        alert('Gagal mengkonfirmasi pesanan');
                    }
                }
            });
        }
    });
    </script>
@endpush
