<x-masterPage>
    @section('content')
        {{-- <div class="col-12">
            <div class="card">
                <!-- add modal start from here -->
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ $tittle }}</h4>

                    <div class="table-responsive">
                        <br>
                        <div id="table-container">
                        <table id="datatable-buttons" class="table table-bordered border-primary mb-0"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Hospital Number</th>
                                    <th>Amount Charged</th>
                                    <th>Amount Paid</th>
                                    <th>Balance</th>
                                    <th>View Invoice</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($tran as $key => $tran)
                                    <tr>
                                        <td style="font-weight: bold;">{{ $key + 1 }}</td>
                                        <td style="font-weight: bold;">{{ $tran->upi }}</td>
                                        <td style="font-weight: bold;">{{ $tran->inovice_amt }}</td>
                                        <td style="font-weight: bold;">{{ $tran->amt_paid }}</td>
                                        <td style="font-weight: bold;">{{ $tran->balance }}</td>
                                        <td style="font-weight: bold;"><button type="button"
                                                class="btn btn-primary btn-sm waves-effect waves-light view-pay-slip"
                                                data-bs-toggle="modal"
                                                data-bs-target=".bs-example-modal-center2{{ $tran->id }}">View Pay
                                                slip</button></td>
                                        <td style="font-weight: bold;">{{ $tran->created_at->diffForHUmans() }}</td>
                                        @if ($tran->status == 0)
                                            <td style="font-weight: bold;"><i
                                                    class="mdi mdi-checkbox-blank-circle text-secondary me-1"></i><span
                                                    class="badge bg-secondary">Pending</span></td>
                                        @else
                                            <td style="font-weight: bold;"><i
                                                    class="mdi mdi-checkbox-blank-circle text-success me-1"></i><span
                                                    class="badge bg-success">Success</span></td>
                                        @endif

                                        @if (!$tittle)

                                        <td>
                                            <div class="d-flex gap-2 flex-wrap">
                                                <div class="btn-group"><button type="button"
                                                        class="btn btn-info btn-sm dropdown-toggle hearder"
                                                        data-bs-toggle="dropdown" aria-expanded="false"> Action <i
                                                            class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        <div class="dropdown-header noti-title">
                                                            <h5 class="font-size-13 text-muted text-truncate mn-0">Welcome
                                                                {{ Auth::user()->name }}</h5>
                                                        </div>
                                                        <a href="" class="dropdown-item download"><button
                                                                class="btn btn-primary btn-sm approve"
                                                                value="{{ $tran->id }}">Approve
                                                                payment</button></a>
                                                        <a href="#" class="dropdown-item download"><button
                                                                type="button"
                                                                class="btn btn-sm btn-primary deny-request edit"
                                                                value="{{ $tran->id }}" data-bs-toggle="modal"
                                                                data-bs-target=".bs-example-modal-center">Deny
                                                                Payment</button></a>\
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    <!-- /.View modal Image -->
                                    <div class="modal fade bs-example-modal-center2{{ $tran->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Pay slip</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset('storage/slip/' . $tran->invoice_file) }}"
                                                        class="img-fluid" alt="Responsive image" id="paySlipImage">
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                    </div>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                    <br><br>
                </div>
            </div>
        </div>
        </div>

        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).on("click", ".approve", function(e) {
                    e.preventDefault();
                    let id = $(this).val();
                    $.ajax({
                        url: '/medical_payment_status/' + id,
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
                                $("#table-container").load(location.href + " #datatable-buttons");
                            }
                        }
                    });
                });
            });
        </script> --}}

        <x-masterPage>
        @section('content')
            <div class="col-12">
                <div class="card">
                    <!-- add modal start from here -->
                    <div class="card-body">
                        <h4 class="card-title mb-4">Medical Payment Transactions</h4>

                        <div class="table-responsive">
                            <br>
                            <table class="table table-bordered border-primary mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Hospital Number</th>
                                        <th>Amount Charged</th>
                                        <th>Amount Paid</th>
                                        <th>Balance</th>
                                        <th>Chennel</th>
                                        <th>View Invoice</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        @if (Auth::user()->role == 1)
                                            <th>Actions</th>
                                        @endif
                                    </tr>

                                </thead>
                                <tbody>
                                    {{-- ajax table calling from here --}}
                                </tbody>
                            </table>
                            <br><br> <br><br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reason for denial</h5>
                            <button type="button" class="btn-close" id="btn-close-model" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_denial" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="comment_id" name="comment_id" id="">
                                <textarea name="comment" id="comment" class="form-control" required cols="5" rows="5"></textarea>
                                <br>
                                <center><button id="submit_denial" class="btn btn-primary">Process</button></center>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            {{-- walletPayment --}}
            <x-walletPayment></x-walletPayment>
              {{-- make sendMoney start from here --}}
                <x-sendMoney></x-sendMoney>
                {{-- make sendMoney end from here --}}
            <!-- /.View modal Image -->
            <div class="modal fade bs-example-modal-center2" tabindex="-1" role="dialog"
                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pay slip</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="" class="img-fluid" alt="Responsive image" id="paySlipImage">
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            </div>

            <script>
                $(function() {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    fatchTransactions();
                    function fatchTransactions() {
                        $.ajax({
                            url: '/FatchMedical',
                            method: 'get',
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 200) {
                                    $('tbody').html("");
                                    $.each(response.getTop, function(key, item) {
                                        let status = "";
                                        let image = "";
                                        let actions = "";
                                        let checkRole = "";
                                        let reason = "";

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
                                            reason =
                                                '<button type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="' +
                                                item.comment + '">Info</button>'
                                        }
                                        if (userRole == 1) { // Check the user's role
                                            if (item.status == 0) {
                                                actions =
                                                    '  <td><div class="d-flex gap-2 flex-wrap"> <div class="btn-group"><button type="button" class="btn btn-info btn-sm dropdown-toggle hearder" data-bs-toggle="dropdown" aria-expanded="false"> Action <i class="mdi mdi-chevron-down"></i></button> <div class="dropdown-menu"><div class="dropdown-header noti-title"><h5 class="font-size-13 text-muted text-truncate mn-0">Welcome ' +
                                                    response.user + '!</h5></div>\
                                                            <a href="" class="dropdown-item download" id="' + item.id +
                                                    '" value="' + item.id +
                                                    '" ><button class="btn btn-primary btn-sm approve" value="' +
                                                    item.id + '" >Approve payment</button></a>\
                                                            <a href="#" class="dropdown-item download" id="' + item.id +
                                                    '" value="' + item.id +
                                                    '"><button type="button" class="btn btn-sm btn-primary deny-request edit" value="' +
                                                    item.id + '" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">Deny Payment</button></a>\
                                                        </div></div></div></td>'
                                            }
                                        }

                                        const paySlipButton =
                                            '<button type="button" class="btn btn-primary btn-sm waves-effect waves-light view-pay-slip" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center2" data-image-url="' +
                                            item.invoice_file + '">Pay slip</button>';
                                        const amt_paid = item.amt_paid;
                                        const inovice_amt = item.inovice_amt;
                                        const balance = item.balance;
                                        const createdDate = new Date(item.updated_at);
                                        const formattedDate = createdDate.toLocaleString()

                                        let dollarUSLocale = Intl.NumberFormat('en-US');
                                        $('tbody').append(
                                            '<tr>\
                                                                 <td style="font-weight: bold;" >' +item.fname +'</td>\
                                                                  <td style="font-weight: bold;" >' +item.upi +'</td>\
                                                                  <td style="font-weight: bold;" >' +dollarUSLocale.format(inovice_amt) +'</td>\
                                                                  <td style="font-weight: bold;" >' + dollarUSLocale.format(amt_paid) +'</td>\
                                                                  <td style="font-weight: bold;" >' + dollarUSLocale.format(balance) +'</td>\
                                                                  <td style="text-transform:capitalize;font-weight: bold;">' + item.chennel +'</td>\
                                                                  <td style="text-transform:capitalize;font-weight: bold;">' + paySlipButton +'</td>\
                                                                  <td style="text-transform:capitalize;font-weight: bold;">' +formattedDate + '</td>\
                                                                  <td>' + status + ' ' + reason + '</td>\
                                                                 ' + actions + '\
                                              </tr>');
                                    });
                                    $('.view-pay-slip').click(function() {
                                        const imageUrl = '{{ asset('storage/slip/') }}' + '/' + $(this)
                                            .data('image-url');
                                        $('#paySlipImage').attr('src', imageUrl);
                                    });
                                    $("table").DataTable({
                                        order: [0, 'desc'],
                                        retrieve: true,
                                    });
                                }
                            }
                        });
                    }


                    $(document).on("click", ".edit", function(e) {
                        e.preventDefault();
                        var id = $(this).val();
                        $.ajax({
                            url: '/getDepositComment/' + id,
                            method: 'get',
                            success: function(response) {
                                $('#comment_id').val(id);
                            }
                        });
                    });


                    $("#form_denial").submit(function(e) {
                        e.preventDefault();
                        $("#submit_denial").text("Process....");
                        const fd = new FormData(this);
                        $.ajax({
                            url: '/requestTransaction',
                            method: 'post',
                            data: fd,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {
                                console.log(200);
                                if (response.status == 200) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    $("#submit_denial").text("Process");
                                    $("#form_denial")[0].reset();
                                    $("#btn-close-model").click();
                                    fatchTransactions();
                                }
                            }
                        });
                    });


                    $(document).on("click", ".approve", function(e) {
                        e.preventDefault();
                        let id = $(this).val();
                        $.ajax({
                            url: '/status_update_Transaction/' + id,
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
                                    fatchTransactions();
                                }
                            }
                        });
                    });

                });
            </script>
        @endsection
    </x-masterPage>

@endsection
</x-masterPage>
