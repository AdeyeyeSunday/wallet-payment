<x-masterPage>
    @section('content')
        <div class="col-12">
            <div class="card">
                <!-- add modal start from here -->
                <div class="card-body">
                    <h4 class="card-title mb-4">Refund Transactions</h4>
                    <div class="table-responsive">
                        <br>
                        <table class="table table-bordered border-primary mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- ajax table calling from here --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       {{-- walletPayment from here --}}
        <x-walletPayment></x-walletPayment>
         {{-- make sendMoney start from here --}}
         <x-sendMoney></x-sendMoney>
         {{-- make sendMoney end from here --}}
        <script>
            $(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                fatchPayment();

                function fatchPayment() {
                    $.ajax({
                        url: '/Fatchlist',
                        method: 'get',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 200) {
                                $('tbody').html("");
                                $.each(response.request, function(key, item) {
                                    let status = "";
                                    let comment = "";
                                    if (item.status == 0) {
                                        status =
                                            ' <i class="mdi mdi-checkbox-blank-circle text-secondary me-1"></i><span class="badge bg-secondary">Pending</span>';
                                        buttonStatus = 'Active';
                                    } else if (item.status == 1) {
                                        status =
                                            ' <i class="mdi mdi-checkbox-blank-circle text-success me-1"></i><span class="badge bg-primary">Success</span>'
                                        buttonStatus = 'Disactivate';
                                    } else if (item.status == 2) {
                                        status =
                                            ' <i class="mdi mdi-checkbox-blank-circle text-danger me-1"></i><span class="badge bg-danger">Denied</span>'
                                    }

                                    if (item.comment != null) {
                                        comment =
                                            '<button type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="' +
                                            item.comment + '">Comment</button>';
                                    }
                                    const amount = item.refund_amount;
                                    let dollarUSLocale = Intl.NumberFormat('en-US');
                                    // Format item.created_at into a human-readable format
                                    const updatedAt = new Date(item.created_at);
                                    const formattedupdatedAt = updatedAt.toLocaleString();

                                    $('tbody').append(
                                        '<tr>\
                                                                                                       <td style="font-weight: bold;">₦ ' +
                                        dollarUSLocale.format(amount) +
                                        '</td>\
                                                                                                       <td style="text-transform: capitalize; font-weight: bold;"> ' +
                                        item.refund_reason + '</td>\
                                                                                                       <td>' + status + ' ' +
                                        comment +
                                        '</td>\
                                                                                                       <td style="text-transform: capitalize; font-weight: bold;">' +
                                        formattedupdatedAt + '</td>\
                                                                                                             </tr>');
                                });

                                $("table").DataTable({
                                    order: [0, 'desc'],
                                    retrieve: true,
                                });
                            }
                        }
                    });
                }

                $(document).on("click", ".approve", function(e) {
                    e.preventDefault();
                    let id = $(this).val();
                    $.ajax({
                        url: '/status_update/' + id,
                        method: 'post',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                fatchPayment();
                            }
                        }
                    });
                })
            });
        </script>
    @endsection
</x-masterPage>
