@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="row row-cards">
                        <div class="col-12">
                            <form class="card" id="invoiceForm" method="POST" action="{{ route('invoices.store') }}">
                                @csrf
                                @method('post')
                                <div class="card-header justify-content-center" style="background-color: #72a8bd;">
                                    <h3 class="card-title" style="color: white">Create New Invoice</h3>
                                </div>
                                <br>
                                <div class="card-body">
                                    <div class="row row-cards" id="invoiceRows">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Company</label>
                                                <select required name="company_id"
                                                    class="form-control form-select form-control-rounded">
                                                    <option value="">choose one</option>
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}">{{ $company->company_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <select required name="user_id"
                                                    class="form-control form-select form-control-rounded">
                                                    <option value="">choose one</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Date Issued</label>
                                                <input type="date" class="form-control form-control-rounded"
                                                    name="date_issued" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Due Date</label>
                                                <input type="date" class="form-control form-control-rounded"
                                                    name="due_date" required>
                                            </div>
                                        </div>

                                        <div class="row invoice-row">
                                            <div class="col-md-5">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">Description</label>
                                                    <input type="text" class="form-control form-control-rounded mb-2"
                                                        name="description[]" placeholder="Text.." required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">Price</label>
                                                    <input type="number" class="form-control form-control-rounded mb-2"
                                                        name="price[]" placeholder="Price.." required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3 mb-0">
                                                    <label class="form-label">Qty</label>
                                                    <input type="number" class="form-control form-control-rounded mb-2"
                                                        name="qty[]" placeholder="Qty.." required>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="mb-3 mb-0">
                                                    <a style="margin-top: 30px"
                                                        class="btn btn-success form-control-rounded add-row"><i
                                                            class="fa fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Discount</label>
                                                <input type="number" name="discount"
                                                    class="form-control form-control-rounded" placeholder="type number.."
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tax</label>
                                                <input type="number" name="tax"
                                                    class="form-control form-control-rounded " placeholder="tax..">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const invoiceForm = document.getElementById('invoiceForm');
            const invoiceRows = document.getElementById('invoiceRows');

            function addRow() {
                const newRow = document.createElement('div');
                newRow.classList.add('row', 'invoice-row');

                newRow.innerHTML = `
                    <div class="col-md-5">
                        <div class="mb-3 mb-0">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control form-control-rounded mb-2"
                                name="description[]" placeholder="Text.." required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3 mb-0">
                            <label class="form-label">Price</label>
                            <input type="number" class="form-control form-control-rounded mb-2"
                                name="price[]" placeholder="Price.." required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3 mb-0">
                            <label class="form-label">Qty</label>
                            <input type="number" class="form-control form-control-rounded mb-2"
                                name="qty[]" placeholder="Qty.." required>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-3 mb-0">
                            <a class="btn btn-danger form-control-rounded remove-row" style="margin-top: 30px;"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                `;

                // Select the invoice-row div and append the new row under it
                const invoiceRow = invoiceRows.querySelector('.invoice-row');
                invoiceRow.appendChild(newRow);
            }

            invoiceForm.querySelector('.add-row').addEventListener('click', function(event) {
                event.preventDefault();
                addRow();
            });

            invoiceForm.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-row')) {
                    event.preventDefault();
                    event.target.closest('.invoice-row').remove();
                }
            });
        });
    </script>
@endsection


