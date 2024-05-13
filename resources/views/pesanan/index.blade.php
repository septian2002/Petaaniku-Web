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

    // Tombol konfirmasi
    $(document).on('click', '.btn-konfirmasi', function() {
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

//     $(function() {

// function rupiah(angka){
//     const format = angka.toString().split('').reverse().join('');
//     const convert = format.match(/\d{1,3}/g);
//     return 'Rp ' + convert.join('.').split('').reverse().join('');
// }

// function date(date){
//     var date = new Date(date);
//     var day = date.getDate();
//     var month = date.getMonth();
//     var year = date.getFullYear()

//     return `${day}-${month}-${year}`;
// }

// const token = localStorage.getItem('token')
// $.ajax({
//     url: '/api/pesanan/baru',
//     headers: {
//         "Authorization": 'Bearer' + token
//     },
//     success: function({
//         data
//     }) {
//         let row = '';
//         data.map(function(val, index) {
//             row += `
//     <tr>
//        <td>${index + 1}</td>
//        <td>${new Date(val.created_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })}</td>
//        <td>${val.invoice}</td>
//        <td>${val.member.nama_member}</td>
//        <td>${rupiah(val.grand_total)}</td>
//        <td>
//             <button class="btn btn-success btn-detail" data-id="${val.id}">Detail</button>
//        </td>
//     </tr>
//     `;
//         });
//         $('tbody').append(row);
//     }
// });

// $(document).on('click', '.btn-detail', function() {
//     const id = $(this).data('id');
//     const token = localStorage.getItem('token');

//     $.ajax({
//         url: '/api/pesanan/detail/' + id,
//         headers: {
//             "Authorization": 'Bearer ' + token
//         },
//         success: function(data) {
//             let detailHtml = `
//         <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
//             <div class="modal-dialog modal-lg">
//                 <div class="modal-content">
//                     <div class="modal-header">
//                         <h5 class="modal-title" id="detailModalLabel">Detail Pemesanan</h5>
//                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                             <span aria-hidden="true">&times;</span>
//                         </button>
//                     </div>
//                     <div class="modal-body">
//                         <table class="table">
//                             <thead>
//                                 <tr>
//                                     <th scope="col">Nama Produk</th>
//                                     <th scope="col">Harga</th>
//                                     <th scope="col">Jumlah</th>
//                                     <th scope="col">Total Harga</th>
//                                 </tr>
//                             </thead>
//                             <tbody>
//             `;

//             data.detail_pesanan.forEach(function(detail) {
//                 detailHtml += `
//                 <tr>
//                     <td>${detail.nama_produk}</td>
//                     <td>${rupiah(detail.harga)}</td>
//                     <td>${detail.jumlah}</td>
//                     <td>${rupiah(detail.total_harga)}</td>
//                 </tr>
//                 `;
//             });

//             detailHtml += `
//                             </tbody>
//                         </table>
//                     </div>
//                     <div class="modal-footer">
//                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
//                         <button type="button" class="btn btn-primary btn-konfirmasi" data-id="${id}">Konfirmasi Pemesanan</button>
//                     </div>
//                 </div>
//             </div>
//         </div>
//             `;

//             $('body').append(detailHtml);
//             $('#detailModal').modal('show');
//         }
//     });
// });

// $(document).on('click','.btn-konfirmasi',function(){
//     const id = $(this).data('id')

//     $.ajax({
//         url: '/api/pesanan/ubah_status/' +  id,
//         type: 'POST',
//         data : {
//             status : "Dikonfirmasi"
//         },
//         headers: {
//             "Authorization": 'Bearer' + token
//         },
//         success : function(data){
//             location.reload()
//         }
//     })
// })

// });
    </script>
@endpush
