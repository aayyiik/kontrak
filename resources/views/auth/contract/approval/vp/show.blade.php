@extends('layouts.master-dashboard')
@section('page-title', 'Rincian Harga')
@section('active-contract', 'active')
@section('address')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Rincian Harga</li>
    </ol>
@endsection
@push('styles')
    <style>
        .dataTables_scroll {
            margin-bottom: 10px;
        }
    </style>
@endpush
@section('dashboard')
    <div>
        <div class="card">
            <div class="card-header card-forestgreen">
                <h6 class="card-title pt-1">Kontrak</h6>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i
                            class="fas fa-expand fa-xs icon-border-default"></i>
                    </button>
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i
                            class="fas fa-minus fa-xs icon-border-yellow"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pekerjaanTable"
                        class="table table-sm table-hovered table-bordered table-hover table-striped datatable2">
                        <thead>
                            <tr>
                                <th class="text-center pr-0" style="vertical-align: middle; width: 5%;">No.</th>
                                <th class="text-center pr-0" style="vertical-align: middle; width: 20%;">Nomor Kontrak</th>
                                <th class="text-center pr-0" style="vertical-align: middle; width: 20%;">Direktur</th>
                                <th class="text-center pr-0" style="vertical-align: middle; width: 20%;">Kontak</th>
                                <th class="text-center pr-0" style="vertical-align: middle; width: 20%;">Alamat</th>
                                <th class="text-center pr-0" style="vertical-align: middle; width: 20%;">Status</th>
                                <th class="text-center pr-0" style="vertical-align: middle; width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                                <tr>
                                    <td style="vertical-align: middle;">{{ $contracts->number }}</td>
                                    <td style="vertical-align: middle;">{{ $contracts->director }}</td>
                                    <td style="vertical-align: middle;">{{ $contracts->address }}</td>
                                    <td style="vertical-align: middle;">{{ $contracts->phone }}</td>
                                </tr>
                  
                        </tbody>
                    </table><br>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-forestgreen">
                <h6 class="card-title pt-1">Kontrak</h6>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                    </button>
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <embed src="{{asset('CEK.pdf')}}" width="100%" height="600px" type="application/pdf">
            </div>
        </div>
        <div class="card">
            <div class="card-header card-forestgreen">
                <h6 class="card-title pt-1">Kontrak</h6>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                    </button>
                    <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('contract.avp-approval', ['contract' => $contracts->id]) }}" method="POST">
                    @csrf
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_id" id="exampleRadios1" value="7" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Accept
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_id" id="exampleRadios2" value="3">
                        <label class="form-check-label" for="exampleRadios2">
                            Reject
                        </label>
                    </div>
                    <div class="form-group shadow-textarea">
                        <label for="exampleFormControlTextarea6">Review</label>
                        <textarea class="form-control z-depth-1" name="notes" id="exampleFormControlTextarea6" rows="3" placeholder="Write something here..."></textarea>
                    </div>
                    <div class="row justify-content-end mr-0">
                        <button type="submit" class="btn btn-success btn-xs text-right" data-toggle="confirmation" data-placement="left">Save</button>
                     
                    </div>
                </form>
            </div>            
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        // DataTable
        $(function() {
            $('#pekerjaanTable .second-row th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text"  class="form-control" placeholder="" />');
            });
            $(document).ready(function() {
                $('.datatable2').DataTable({
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        ['10', '25', '50', '100', 'All']
                    ],
                    ordering: false,
                    scrollY: '500px',
                    scrollCollapse: true,
                    pageLength: 100,
                    initComplete: function() {
                        this.api().columns([0, 1, 2, 3, 4, 5]).every(function() {
                            var that = this;

                            $('input', this.header()).on('keyup change clear',
                                function() {
                                    if (that.search() !== this.value) {
                                        that
                                            .search(this.value)
                                            .draw();
                                    }
                                });
                        });
                    },
                });
            });
        });
    </script>
@endpush
