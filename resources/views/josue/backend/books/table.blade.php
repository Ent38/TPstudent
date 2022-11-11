@section('css')
    <link rel="stylesheet"
        href="{{ asset('josue/backend/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('josue/backend/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
@endsection

<div class="animated fadeIn">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">@lang('books List')</strong>
                    @can('add_book')
                        <a href="{{ route('books.create') }}"
                            class="pull-right btn btn-sm btn-success">@lang('New book')</a>
                    @endcan
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                            <tr>

                                <th>@lang('Book')</th>

                                <th>@lang('Name')</th>

                                <th>@lang('number of chapters')</th>

                                <th>@lang('action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td><img src="{{ $book->avatar }}" alt="" width="60"
                                            height="60"><a
                                            href="{{ route('books.show', [$book->slug]) }}">{{ $book->name }}</a>
                                    </td>
                                    <td>{{ $book->name }}</td>

                                    <td>{{ $book->nfc }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('books.edit',[$book->slug]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>

                                            <form id="deletes-form"
                                                action="{{ route('books.destroy', $book->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-sm btn-danger" href="#"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('deletes-form').submit();">
                                                    <i class="nav-icon fa fa-trash"></i>
                                                </a>
                                            </form>
                                        </div></td>

                                </tr>


                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>


    </div>
</div><!-- .animated -->

@section('script')
    <script src="{{ asset('josue/backend/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('josue/backend/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('josue/backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('josue/backend/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('josue/backend/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('josue/backend/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('josue/backend/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('josue/backend/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('josue/backend/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('josue/backend/vendors/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('josue/backend/assets/js/init-scripts/data-table/datatables-init.js') }}"></script>
@endsection