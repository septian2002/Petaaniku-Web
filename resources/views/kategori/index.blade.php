@extends('layout.app')

@section('title', 'Data Kategori')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">
                Data Kategori
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
                            <th>Nama Kategori</th>
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
                            <form class="form-kategori">
                                <div class="form-group">
                                    <label for="">Nama Kategori</label>
                                    <input type="text" class="form-control" name="nama_kategori"
                                        placeholder="Nama Kategori" required>
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
    $.ajax({
        url: '/api/categories',
        success: function({ data }) {
            let row = '';
            data.map(function(val, index) {
                row += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${val.nama_kategori}</td>
                    <td>
                        <a href="#modal-form" data-id="${val.id_kategori}" class="btn btn-warning modal-ubah">Edit</a>
                        <a href="#" data-id="${val.id_kategori}" class="btn btn-danger btn-hapus">Hapus</a>
                    </td>
                </tr>
                `;
            });
            $('tbody').append(row);
        }
    });

    $(document).on('click', '.btn-hapus', function() {
        const id_kategori = $(this).data('id');
        const token = localStorage.getItem('token');

        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: '/api/categories/' + id_kategori,
                type: "DELETE",
                headers: {
                    "Authorization": 'Bearer ' + token
                },
                success: function(data) {
                    if (data.success) {
                        alert('Data berhasil dihapus');
                        location.reload();
                    }
                }
            });
        }
    });

    $('.modal-tambah').click(function() {
        $('#modal-form').modal('show');
        $('input[name="nama_kategori"]').val('');

        $('.form-kategori').off('submit').on('submit', function(e) {
            e.preventDefault();
            const token = localStorage.getItem('token');
            const frmdata = new FormData(this);

            $.ajax({
                url: '/api/categories',
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
                }
            });
        });
    });

    $(document).on('click', '.modal-ubah', function() {
        const id_kategori = $(this).data('id');
        $('#modal-form').modal('show');

        $.get(`/api/categories/${id_kategori}`, function({ data }) {
            $('input[name="nama_kategori"]').val(data.nama_kategori);
        });

        $('.form-kategori').off('submit').on('submit', function(e) {
            e.preventDefault();
            const token = localStorage.getItem('token');
            const frmdata = new FormData(this);

            $.ajax({
                url: `/api/categories/${id_kategori}?_method=PUT`,
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
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON;
                    if (errors) {
                        let errorMessage = "Failed to update category:\n";
                        $.each(errors, function(key, value) {
                            errorMessage += `${key}: ${value}\n`;
                        });
                        alert(errorMessage);
                    } else {
                        alert('Failed to update category: Unknown error');
                    }
                }
            });
        });
    });
});

    </script>
@endpush
