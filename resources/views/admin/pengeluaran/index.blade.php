@extends('layouts.base')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Pengeluaran</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                    </div>
                </div>
                <!-- Zero configuration table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <button type="button" class="btn btn-outline-primary mr-1 mb-1" data-toggle="modal"
                                            data-target="#CreateAdd">
                                            Create Pengeluaran
                                        </button>
                                        @if (session('message'))
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-hidden="true">&times;</button>
                                                <h5 class="card-text"> <i class=""></i>{{ session('message') }}</h5>
                                            </div>
                                        @endif
                                        <div class="table-responsive">
                                            <table class="table zero-configuration pengeluaran" id="pengeluaran">
                                                <thead>
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Jumlah</th>
                                                        <th>Keterangan</th>
                                                        <th>Tanggal</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                {{-- <tbody id="data">

                                                </tbody> --}}
                                                <tbody>
                                                    @foreach ($data as $item)
                                                        <tr>
                                                            <td>{{ $item->code }}</td>
                                                            <td>Rp. {{ number_format($item->qty) }}</td>
                                                            <td>{{ $item->description }}</td>
                                                            <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-icon btn-icon rounded-circle btn-flat-success mr-1 mb-1"
                                                                    data-toggle="modal"
                                                                    data-target="#Update{{ $item->id }}"><i
                                                                        class="feather icon-edit"></i></button>
                                                                <button type="button"
                                                                    class="btn btn-icon btn-icon rounded-circle btn-flat-danger mr-1 mb-1"
                                                                    data-toggle="modal"
                                                                    data-target="#Delete{{ $item->id }}"><i
                                                                        class="feather icon-trash"></i></button>
                                                            </td>
                                                            @include('admin.pengeluaran.modal')
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Zero configuration table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <div class="modal fade" id="CreateAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Input Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pengeluaran-data.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Jumlah <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="number" name="qty" placeholder="Jumlah Pendapatan"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <div class="controls">
                                        <textarea class="form-control" name="description" id="basicTextarea" rows="3" placeholder="Deskripsion"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.css"> --}}
@endsection
@section('js')
    {{-- <script src="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: "{{ route('pengeluaran-data.index') }}",
                success: function(data) {
                    $('#data').html('');
                    $.each(data.data, function(i, v) {
                        let content = `
                    <tr>
                        <td> ${v.code} </td>
                        <td> ${v.qty} </td>
                        <td> ${v.description} </td>
                        <td> ${v.created_at} </td>
                        <td>
                            <button type="button" class="edit btn btn-icon btn-icon rounded-circle btn-flat-success mr-1 mb-1" data-toggle="modal"><i class="feather icon-edit"></i></button>
                            <button type="button" class="btn btn-icon btn-icon rounded-circle btn-flat-danger mr-1 mb-1" data-toggle="modal" data-target="#Delete $item->id "><i class="feather icon-trash"></i></button>
                        </td>
                    </tr>
                    `
                        $('#data').append(content);
                    });
                }
            });

            $('#data').on("click", ".edit", function() {

            });
        })
    </script>
@endsection
