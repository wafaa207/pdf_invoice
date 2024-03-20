@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Invoices</h3>
                            <a href="{{ route('invoices.create') }}" class="btn btn-primary">Create Invoice</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">No.</th>
                                        <th>Company</th>
                                        <th>Client</th>
                                        <th>Total</th>
                                        <th>Due Date</th>
                                        <th>export</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td><span class="text-muted">{{ $invoice->number }}</span></td>
                                            <td>{{ $invoice->company->company_name }}</td>
                                            <td>{{ $invoice->user->name }}</td>
                                            <td>${{ $invoice->total }}</td>
                                            <td>{{ $invoice->due_date }}</td>
                                            <td>
                                                <button data-id="{{ $invoice->id }}" class="btn btn-danger pdf-button"><i
                                                        class="fa fa-file-pdf"></i></button>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">
                                Showing <span>{{ $invoices->firstItem() }}</span> to
                                <span>{{ $invoices->lastItem() }}</span> of <span>{{ $invoices->total() }}</span> entries
                            </p>

                            <ul class="pagination m-0 ms-auto">
                                @if ($invoices->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                            <i class="fa fa-chevron-left"></i>
                                            prev
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $invoices->previousPageUrl() }}">
                                            <i class="fa fa-chevron-left"></i>
                                            prev
                                        </a>
                                    </li>
                                @endif

                                @foreach ($invoices->getUrlRange(1, $invoices->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $invoices->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($invoices->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $invoices->nextPageUrl() }}">
                                            next
                                            <i class="fa fa-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                            next
                                            <i class="fa fa-chevron-right"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.pdf-button').click(function() {
                var invoiceId = $(this).data('id');
                var url = "{{ url('/invoices') }}/" + invoiceId + "/pdf";

                window.open(url, '_blank');
            });
        });
    </script>
@endsection
