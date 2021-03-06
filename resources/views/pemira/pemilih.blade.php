@extends('layouts.dashboard.master')
@section('title')
    Pemilih Management
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- breadcumb -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 float-right">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">@yield('title')</h2>
                                    @can('create-pemilih')
                                        <button type="button"
                                            class="btn btn-outline-primary btn-sm waves-effect waves-light float-right ml-2"
                                            id="createNewItem">Create USers</button>
                                        <button type="button"
                                            class="btn btn-outline-primary btn-sm waves-effect waves-light float-right ml-2"
                                            data-toggle="modal" data-target="#importuser">Import Pemilih</button>
                                        <a href="{{ route('export-pemilih') }}"
                                            class="btn btn-outline-info btn-sm waves-effect waves-light float-right mr-2">Export
                                            Pemilih</a>
                                    @endcan
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover data-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>NIM</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                                <th>Sesi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>NIM</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                                <th>Sesi</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-header -->
    </div>
    @can('create-pemilih')
        <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modelHeading"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="ItemForm" name="ItemForm" class="form-horizontal">
                            <input type="hidden" name="Item_id" id="Item_id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>NIM Mahasiswa</label>
                                            {!! Form::text('nim', null, ['placeholder' => 'Nim Mahasiswa', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Masukan Email</label>
                                            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Asal Jurusan</label>
                                            <select class="form-control" name="jurusan" id="exampleFormControlSelect1">
                                                <option>D3 Teknik Telekomunikasi</option>
                                                <option>S1 Teknik Telekomunikasi</option>
                                                <option>S1 Teknik Desain Komunikasi Visual</option>
                                                <option>S1 Teknik Infomatika</option>
                                                <option>S1 Software Engginer</option>
                                                <option>S1 Sistem Informasi</option>
                                                <option>S1 Teknik Elektro</option>
                                                <option>S1 Data Sains</option>
                                                <option>S1 Logistik</option>
                                                <option>S1 Teknik Industri</option>
                                            </select>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn btn-primary tombol" id="saveBtn" value="create"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- impoer --}}
        <div class="modal fade" id="importuser" tabindex="-1" role="dialog" aria-labelledby="importuserLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importuserLabel">Import User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" novalidate="" action="{{ route('import-pemilih') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <fieldset class="form-group">
                                            <label for="status">Upload File Excel</label>
                                            <div class="custom-file">
                                                <input type="file" name="excel" class="custom-file-input" />
                                                <label class="custom-file-label" for="inputGroupFile01">XLS or CSV</label>
                                            </div>
                                        </fieldset>
                                        <div class="form-group">
                                            <p class="text-center">Untuk Contoh File Import Bisa di Unduh disini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="{{ url('images/sampel.xlsx') }}" class="btn btn-warning">Unduh Sample</a>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection


@section('css-tambahan')
    <link rel="stylesheet" href="{{ asset('cdn/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cdn/datatables/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cdn/datatables/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('js-tambahan')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('cdn/datatables/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('cdn/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('cdn/datatables/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('cdn/datatables/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('cdn/datatables/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('cdn/datatables/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: true,
                pageLength: 5,
                lengthMenu: [5, 10, 20, 50, 100, 200, 500],
                responsive: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('pemilih.index') }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nim',
                        name: 'nim'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'jurusan',
                        name: 'jurusan'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas'
                    },
                    {
                        data: 'sesi',
                        name: 'sesi'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            $('#createNewItem').click(function() {
                $('#saveBtn').val("create-Item");
                $('#Item_id').val('');
                $('#ItemForm').trigger("reset");
                $('#modelHeading').html("Create User");
                $('.tombol').html("Submit");
                $('#ajaxModel').modal('show');
            });

            @can('create-pemilih')
                $('body').on('click', '.editItem', function() {
                var Item_id = $(this).data('id');
                $('.tombol').html("Save Change");
                $.get("{{ url('dashboard/users') }}" + '/' + Item_id + '/edit', function(data) {
                $('#modelHeading').html("Edit Item");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#Item_id').val(data.id);
                $('input[name=name]').val(data.name);
                $('input[name=email]').val(data.email);
                $('input[name=nim]').val(data.nim);
                $('select[name=jurusan]').val(data.jurusan);
                })
                });
            
                $('#saveBtn').click(function(e) {
                e.preventDefault();
                $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('#ItemForm').serialize(),
                url: "{{ route('pemilih.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(response) {
                if (response.success) {
                Swal.fire({
                icon: "success",
                title: "Selamat",
                text: response.success
                });
                $('#ItemForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
                } else {
                Swal.fire({
                icon: "error",
                title: "Mohon Maaf !",
                text: response.error
                });
                }
                },
                error: function() {
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!"
                });
                }
                });
                });
            @endcan

            @can('delete-pemilih')
                $('body').on('click', '.deleteItem', function() {
            
                var Item_id = $(this).data("id");
                var url = $(this).data("url");
                Swal.fire({
                title: 'Apakah Anda Yakin ?',
                text: "Anda Akan Menghapus Pengguna Ini !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                url: url,
                success: function(response) {
                if (response.success) {
                Swal.fire({
                icon: "success",
                title: "Selamat",
                text: response.success
                });
                $('#ItemForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
                } else {
                Swal.fire({
                icon: "error",
                title: "Mohon Maaf !",
                text: response.error
                });
                }
                },
                error: function() {
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!"
                });
                }
                });
                }
                })
                });
            @endcan

            $('body').on('click', '.sesi_aktif', function() {
                let id = $(this).attr("data-id");
                let _token = $('meta[name="csrf-token"]').attr("content");
                Swal.fire({
                    title: 'Apakah Kamu Yakin ?',
                    text: "Kamu akan mengubah sesi ini",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Change Now'
                }).then(result => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/sesi/aktif",
                            type: "POST",
                            data: {
                                id: id,
                                _token: _token
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Selamat",
                                        text: response.success
                                    });
                                    table.draw();
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Mohon Maaf !",
                                        text: response.error,
                                        confirmButtonText: 'Tutup'
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                    confirmButtonText: 'Cancel'
                                });
                            }
                        });
                    }
                });
            });

            $('body').on('click', '.sesi_pasif', function() {
                let id = $(this).attr("data-id");
                let _token = $('meta[name="csrf-token"]').attr("content");
                Swal.fire({
                    title: 'Apakah Kamu Yakin ?',
                    text: "Kamu akan mengubah sesi ini",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Change Now'
                }).then(result => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/sesi/pasif",
                            type: "POST",
                            data: {
                                id: id,
                                _token: _token
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Selamat",
                                        text: response.success
                                    });
                                    table.draw();
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Mohon Maaf !",
                                        text: response.error,
                                        confirmButtonText: 'Tutup'
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                    confirmButtonText: 'Cancel'
                                });
                            }
                        });
                    }
                });
            });
        });

    </script>
@endsection
