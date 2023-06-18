@extends('layouts.master-dashboard')
@section('page-title', 'Rincian Harga')
@section('active-contract','active')
@section('address')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
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
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            
            <a href="{{route('contract.vendor-edit', $contract->id)}}" class="btn btn-primary btn-xs mb-3"><b>Contract Detail</b></a>
            {{-- belum bisa --}}
            <form action="{{route('contract.buyer-return', ['contract'=>$contract->pivot->contract_id,  'vendor'=>$contract->pivot->vendor_id])}}" method="POST">
                @csrf
                <button class="btn btn-danger btn-xs mb-3" type="submit">Contract Return</button>
            </form>

            {{-- <a href="" class="btn btn-danger btn-xs mb-3"><b>Contract Return</b></a> --}}

            <div class="table-responsive">
                <table id="pekerjaanTable" class="table table-sm table-hovered table-bordered table-hover table-striped datatable2">
                    <thead>
                        <tr>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 5%;">No.</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 20%;">Nomor Kontrak</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 20%;">Direktur</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 20%;">Kontak</th>
                            <th class="text-center pr-0" style="vertical-align: middle; width: 20%;">Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        <tr>
                            {{-- <td class="text-center" style="vertical-align: middle;">{{$loop->iteration}}</td> --}}
                            <td style="vertical-align: middle;">{{$contract->pivot->number}}</td>
                            <td style="vertical-align: middle;">{{$contract->pivot->director}}</td>
                            <td style="vertical-align: middle;">{{$contract->pivot->address}}</td>
                            <td style="vertical-align: middle;">{{$contract->pivot->phone}}</td>
                            </td>
                        </tr>
                  
                    </tbody>
                </table><br>
            </div>
        </div>
    </div>

    @if ($contract->pivot->status_id >= 5)
    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title pt-1">LEGAL REVIEW</h6>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Review</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$review->name}}</td>
                            <td>{{$review->created_at}}</td>
                            <td>{{$review->review_contract}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
        </div>            
    </div>
    <div class="card">
        <div class="card-header card-forestgreen">
            <h6 class="card-title pt-1">APPROVAL REVIEW</h6>
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-xs pr-0" data-card-widget="maximize"><i class="fas fa-expand fa-xs icon-border-default"></i>
                </button>
                <button type="button" class="btn btn-tool btn-xs" data-card-widget="collapse"><i class="fas fa-minus fa-xs icon-border-yellow"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Review</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $review)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$review->name}}</td>
                            <td>{{$review->created_at}}</td>
                            <td>{{$review->review_contract}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
        </div>            
    </div>
    @endif
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
        {{-- belum bisa if yg sesuai status --}}
        @if ($contract->pivot->status_id < 4)
            <form action="{{route('contract.buyer-reviewLegal', ['contract'=>$contract->pivot->contract_id,  'vendor'=>$contract->pivot->vendor_id])}}" method="POST">
                @csrf
                <button class="btn btn-info btn-lg" type="submit">SUBMIT TO LEGAL REVIEW</button>
            </form>
        @elseif ($contract->pivot->status_id == 4)
            <a type="button" class="btn btn-info btn-lg disabled">PROCESS REVIEW BY LEGAL</a>
        @elseif ($contract->pivot->status_id == 5)
            <form action="{{route('contract.buyer-reviewAVP', ['contract'=>$contract->pivot->contract_id,  'vendor'=>$contract->pivot->vendor_id])}}" method="POST">
                @csrf
                <button class="btn btn-info btn-lg" type="submit">SUBMIT TO KABAG</button>
            </form>
        @elseif ($contract->pivot->status_id == 6)
            <a type="button" class="btn btn-info btn-lg disabled">PROCESS REVIEW BY KABAG</a>
        @endif
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

                        $('input', this.header()).on('keyup change clear', function() {
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