@extends('layout.app')

@section('title', 'Data Product')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">
                Data Product
            </h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-4">
                <a href="#modal-form" class="btn btn-primary modal-tambah">Tambah Data</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                        <form class="form-produk">
                            <div class="form-group">
                                <label for="nama_barang">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_barang" placeholder="Nama Produk" required>
                            </div>
                            <div class="form-group">
                                <label for="id_kategori">Kategori</label>
                                <select name="id_kategori" id="id_kategori" class="form-control" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id_kategori }}">{{ $category->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" name="harga" placeholder="Harga" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control" name="gambar" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            // menampilkan data dari database
            $.ajax({
                url: '/api/products',
                success: function({ data }) {
                    let row = '';
                    data.map(function(val, index) {
                        let categoryNama = val.category ? val.category.nama_kategori : 'Tidak ada kategori';
                        row += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${val.nama_barang}</td>
                                <td>${categoryNama}</td>
                                <td>${val.harga}</td>
                                <td>${val.deskripsi}</td>
                                <td><img src="/uploads/produk/${val.gambar}" width="150"></td>
                                <td>
                                    <a data-toggle="modal" href="#modal-form" data-id="${val.id}" class="btn btn-warning modal-ubah">Edit</a>
                                    <a href="#" data-id="${val.id}" class="btn btn-danger btn-hapus">Hapus</a>
                                </td>
                            </tr>
                        `;
                    });
                    $('tbody').append(row);
                }
            });

            // hapus data
            $(document).on('click', '.btn-hapus', function() {
                const id = $(this).data('id');
                const token = localStorage.getItem('token');

                if (confirm('Apakah anda yakin?')) {
                    $.ajax({
                        url: '/api/products/' + id,
                        type: "DELETE",
                        headers: {
                            "Authorization": 'Bearer ' + token
                        },
                        success: function(data) {
                            if (data.message == 'success') {
                                alert('Data berhasil dihapus');
                                location.reload();
                            }
                        }
                    });
                }
            });

            // tambah data
            $('.modal-tambah').click(function() {
                $('#modal-form').modal('show');
                $('.form-produk').off('submit').on('submit', function(e) {
                    e.preventDefault();
                    const token = localStorage.getItem('token');
                    const frmdata = new FormData(this);

                    $.ajax({
                        url: '/api/products',
                        type: 'POST',
                        data: frmdata,
                        cache: false,
                        contentType: false,
                        processData: false,
                        headers: {
                            "Authorization": 'Bearer ' + token
                        },
                        success: function(data) {
                            if (data.success) {
                                alert('Data berhasil ditambah');
                                location.reload();
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                let errorMessages = [];
                                for (let key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        errorMessages.push(errors[key].join(' '));
                                    }
                                }
                                alert('Kesalahan validasi: ' + errorMessages.join('\n'));
                            } else {
                                alert('Terjadi kesalahan. Silakan coba lagi.');
                            }
                        }
                    });
                });
            });


            // edit data
            $(document).on('click', '.modal-ubah', function() {
                $('#modal-form').modal('show');
                const id = $(this).data('id');

                $.get(`/api/product/${id}`, function({ data }) {
                    $('input[name="nama_barang"]').val(data.nama_barang);
                    $('textarea[name="deskripsi"]').val(data.deskripsi);
                    $('input[name="harga"]').val(data.harga);
                    $('select[name="id_kategori"]').val(data.id_kategori); // sesuaikan pilihan kategori
                });

                // hapus handler submit sebelumnya
                $('.form-produk').off('submit').on('submit', function(e) {
                    e.preventDefault();
                    const token = localStorage.getItem('token');
                    const frmdata = new FormData(this);

                    $.ajax({
                        url: `api/products/${id}?_method=PUT`,
                        type: 'POST',
                        data: frmdata,
                        cache: false,
                        contentType: false,
                        processData: false,
                        headers: {
                            "Authorization": 'Bearer ' + token
                        },
                        success: function(data) {
                            if (data.success) {
                                alert('Data berhasil diubah');
                                location.reload();
                            }
                        }
                    });
                });
            });
        });
    </script>
@endpush
