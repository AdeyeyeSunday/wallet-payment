<x-masterPage>
    @section('content')
        @if (Auth::user()->status == 0)
            <div class="w-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="text-center">
                                <h1 class="display-2 error-text fw-bold">
                                    <i class="ri-ghost-smile-fill align-bottom text-primary mx-1"></i>
                                </h1>
                                <h4 class="text-uppercase mt-4">{{ Auth::user()->name }}</h4>
                                <h6 class="text-uppercase mt-4">Account Awaiting Admin Approval</h6>
                                <p>Your account is awaiting admin approval. Thank you for your patience. If it takes more than 24 hours, please call us at 08026456658.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (Auth::user()->status > 0)
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <p><strong>Welcome {{ Auth::user()->name }} [{{ Auth::user()->h_number }}]</strong></p>
                <p>To fund your wallet instantly, Kindly use paystack to make payment or use any of the suggested accounts below.
                    Please note that bank deposits or transfers to our regular bank account may result in delayed crediting.
                </p>
                <ul>
                    <li>[ 47747483939 - GTBank ]</li>
                    <li>[ 44999994 - Wema bank ]</li>
                    <li>[ 4948494 - Moniepoint Microfinance Bank ]</li>
                    <li>[ 6755888585 - Sterling bank ]</li>
                </ul>
            </div>
            <div class="row">
                <center>
                    <div class="col-md-5 col-12">
                        <div class="card">
                            <center>
                                @if ($totalWallet != null)
                                <h3>Wallet Balance: <br> ₦ {{ number_format($totalWallet->wallet_amount ? : '', 0, ',', ',') }}
                                </h3>
                                @else
                                <h3>Wallet Balance: <br> ₦ 0:00</h3>
                                @endif
                                <div class="card-body">
                                    <div>
                                        <h4>Customer care</h4>
                                        <h5>08026456658</h5>
                                        <br>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-3 col-12 mb-3">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light"
                                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                                        aria-controls="offcanvasRight">+ Request for Refund </button>
                                                </div>
                                                <div class="col-md-3 col-12 mb-3">
                                                    <button type="button"
                                                        class="btn btn-secondary waves-effect waves-light"
                                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight2"
                                                        aria-controls="offcanvasRight">+ Top-up with Bank Deposit</button>
                                                </div>

                                                <div class="col-md-3 col-12 mb-3">
                                                    <button type="button"
                                                        class="btn btn-secondary waves-effect waves-light"
                                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight5"
                                                        aria-controls="offcanvasRight">+ Top-up with Paystack</button>
                                                </div>
                                                <div class="col-md-3 col-12 mb-3">
                                                    <button type="button" class="btn btn-danger waves-effect waves-light"
                                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight4"
                                                        aria-controls="offcanvasRight">+ Online Payment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Latest Deposit Transaction</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered border-primary mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Reference</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Channel</th>
                                                <th scope="col">Bank</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>

                <div>
                    {{-- make refund start from here --}}
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel">Refund Payment</h5>
                            <button type="button" class="btn-close text-reset" id="btn-close-offcanvas"
                                data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body" id="offcanvasRight">
                            <p style="font-weight: bold;">Kindly note that refunds will take 3 working days before approval
                            </p>
                            <form action="" id="form_refund">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="default-input">Full name</label>
                                    <input class="form-control" type="text" style="font-weight: bold;"
                                        value="{{ Auth::user()->name }}" readonly placeholder="Enter driver name">
                                    <br>
                                    <label class="form-label" for="default-input">Upi</label>
                                    <input class="form-control" type="text" style="font-weight: bold;"
                                        value="{{ Auth::user()->h_number }}" readonly placeholder="Enter email">
                                    <br>
                                    <label class="form-label" for="default-input">Amount Requesting</label>
                                    <input class="form-control" name="refund_amount" type="number"
                                        style="font-weight: bold;" id="refund_amount" name="refund_amount" required
                                        placeholder="Enter amount">
                                    <br>
                                    <label class="form-label" for="default-input">Reason for Refund</label>
                                    <textarea name="refund_reason" class="form-control" id="refund_reason" cols="5" rows="5" required></textarea>
                                    <br>
                                </div>
                                <p style="font-weight: bold;">Please note that we will not/do not have access to your
                                    account details...</p>
                                <center>
                                    <button type="refund_reason_submit" id="refund_reason_submit"
                                        class="btn btn-primary">Process</button>
                                </center>
                            </form>
                        </div>
                    </div>
                    {{-- make refund end from here --}}


                    {{-- make back top start from here --}}
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight2"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel">Bank Transaction Payment</h5>
                            <button type="button" class="btn-close text-reset" id="btn-close-offcanvas2"
                                data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body" id="offcanvasRight">
                            <p style="font-weight: bold;">Please note that bank deposits or transfers to our regular bank
                                account may result in delayed crediting.</p>
                            <form action="" id="form_bank_transzaction">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="default-input">Full name</label>
                                    <input class="form-control" type="text" style="font-weight: bold;"
                                        value="{{ Auth::user()->name }}" readonly required
                                        placeholder="Enter driver name">
                                    <br>

                                    <label class="form-label" for="default-input">Upi</label>
                                    <input class="form-control" type="text" style="font-weight: bold;"
                                        value="{{ Auth::user()->h_number }}" readonly=required placeholder="Enter email">
                                    <br>

                                    <label class="form-label" style="font-weight: bold;" for="channel-select">Select
                                        channel</label>
                                    <select name="chennel" id="channel-select" style="font-weight: bold;"
                                        class="form-control">
                                        <option value="" selected>Choose</option>
                                        @foreach ($chennel as $c)
                                            <option value="{{ $c->chennel_id }}">{{ $c->chennel }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label class="form-label" style="font-weight: bold;" for="bank-select">Select From
                                        Bank</label>
                                    <select name="bank" style="font-weight: bold;" id="bank-select"
                                        class="form-control" required>
                                        <option value="" selected>Choose</option>
                                    </select>

                                    <br>
                                    <label class="form-label" for="default-input">Enter amount</label>
                                    <input class="form-control" type="number" style="font-weight: bold;" id="amount"
                                        name="amount" required placeholder="Enter amount">
                                    <br>


                                    <label class="form-label" for="default-input">Upload bank payslip</label>
                                    <input class="form-control" type="file" id="file" name="file" required>
                                    <br>
                                </div>
                                <p style="font-weight: bold;">Please note that we will not/do not have access to your
                                    account details...</p>
                                <center>
                                    <button type="form_bank_transzaction_submit" id="form_bank_transzaction_submit"
                                        class="btn btn-primary" id="submit">Process</button>
                                </center>
                            </form>
                        </div>
                    </div>
                    {{-- make  back top end from here --}}
                    {{-- make paystack start from here --}}
                    <!-- HTML -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight5"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel">Paystack</h5>
                            <button type="button" class="btn-close text-reset" id="btn-close-offcanvas_paystack"
                                data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body" id="offcanvasRight">
                            <p style="font-weight: bold;">Kindly visit the payment attempts page to recheck your
                                transaction if you were
                                debited without being credited.</p>
                            <form action="" id="paymentForm">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="default-input">Full name</label>
                                    <input class="form-control" type="text" style="font-weight: bold;"
                                        value="{{ Auth::user()->name }}" readonly id="f_name" name="f_name" required
                                        placeholder="Enter driver name">
                                    <br>

                                    <label class="form-label" for="default-input">Email</label>
                                    <input class="form-control" type="email" style="font-weight: bold;"
                                        value="{{ Auth::user()->email }}" readonly id="email-address" name="email"
                                        required placeholder="Enter email">
                                    <br>

                                    <label class="form-label" for="default-input">Upi</label>
                                    <input class="form-control" type="text" style="font-weight: bold;"
                                        value="{{ Auth::user()->h_number }}" readonly id="upi" name="upi"
                                        required placeholder="Enter Upi">
                                    <br>
                                    <label class="form-label" for="default-input">Enter amount on invoice</label>
                                    <input class="form-control" type="number" style="font-weight: bold;" id="amount_p"
                                        name="amount_p" required placeholder="Enter amount">

                                    <br>
                                </div>
                                <p style="font-weight: bold;">Please note that we will not/do not have access to your
                                    account details...</p>
                                <center>
                                    <button type="button" id="paystack_submit" class="btn btn-primary"
                                        onclick="payWithPaystack()">Process</button>
                                </center>
                            </form>
                        </div>
                    </div>
                    {{-- make paystack end from here --}}

                    {{-- make payment start from here --}}
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight4"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasRightLabel">Make Payment</h5>
                            <button type="button" class="btn-close text-reset"
                                id="btn-close-offcanvas_paystack_online_payment" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body" id="offcanvasRight">
                            <p style="font-weight: bold;">Kindly visit the payment attempts page to recheck your
                                transaction if you were debited without being credited.</p>
                            <form action="" id="form_online_payment">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="default-input">Full name</label>
                                    <input class="form-control" type="text" style="font-weight: bold;"
                                        value="{{ Auth::user()->name }}" readonly id="f_name" name="f_name" required
                                        placeholder="Enter driver name">
                                    <br>

                                    <label class="form-label" for="default-input">Upi</label>
                                    <input class="form-control" type="text" style="font-weight: bold;"
                                        value="{{ Auth::user()->h_number }}" readonly id="upi" name="upi"
                                        required>
                                    <br>
                                    <input class="form-control" type="hideen" style="font-weight: bold;"
                                        value="{{ Auth::user()->email }}" readonly id="email_address_Payment"
                                        name="email_address_Payment" required placeholder="Enter email">
                                    <br>

                                    <label class="form-label" for="default-input">Enter amount on inovice</label>
                                    <input class="form-control" type="number" style="font-weight: bold;"
                                        id="inovice_amt" name="inovice_amt" required
                                        placeholder="Enter amount on inovice">
                                    <br>
                                    <label class="form-label" for="default-input">Enter amount</label>
                                    <input class="form-control" type="number" style="font-weight: bold;" id="amt_paid"
                                        name="amt_paid" required placeholder="Enter amount paid">
                                    <br>
                                    <label class="form-label" for="default-input">Upload ESH Invoice</label>
                                    <input class="form-control" type="file" id="invoice_file" name="invoice_file"
                                        required>
                                    <br>
                                </div>
                                <p style="font-weight: bold;">Please note that we will not/do not have access to your
                                    account details...</p>
                                <center>
                                    <button type="button" id="paystack_online_submit" class="btn btn-primary"
                                        onclick="payWithPaystackOnPayment()">Process</button>
                                </center>
                            </form>
                        </div>
                    </div>
                    {{-- make payment end from here --}}
                </div>
            </div>

            {{-- make Wallet start from here --}}
            <x-walletPayment></x-walletPayment>
            {{-- make Wallet end from here --}}

             {{-- make Wallet start from here --}}
            <x-sendMoney></x-sendMoney>
            {{-- make Wallet end from here --}}
        @endif
        <script src="https://js.paystack.co/v1/inline.js"></script>
        <!-- JavaScript -->

        <script>
            function payWithPaystackOnPayment() {
                let fname = document.getElementById("f_name").value;
                let upi = document.getElementById("upi").value;
                let emailPayment = document.getElementById("email_address_Payment").value;
                let inovice_amt = document.getElementById("inovice_amt").value;
                let amt_paid = parseFloat(document.getElementById("amt_paid").value) * 100;
                let fileInput = document.getElementById("invoice_file");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // Create a FormData object and append the file to it
                let formData = new FormData();
                formData.append("invoice_file", fileInput.files[0]);
                let handler = PaystackPop.setup({
                    key: 'pk_test_847382872cccdee5ff8bf870bdea04abcb6e30e2',
                    email: emailPayment,
                    amount: amt_paid,
                    metadata: {
                        upi: upi,
                        fname: fname,
                        inovice_amt: inovice_amt,
                        amt_paid: amt_paid,
                        invoice_file: formData, // Include the FormData object here
                    },
                    ref: '' + Math.floor((Math.random() * 1000000000) + 1),
                    callback: function(response) {
                        let reference = response.reference;
                        $.ajax({
                            url: '/verify_online_payment/' + reference,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response[0].status == true) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: response[0].message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    $("#paystack_online_submit").text("Process");
                                    $("#form_online_payment")[0].reset();
                                    $("#btn-close-offcanvas_paystack_online_payment").click();
                                } else if (response.status == 404) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: "Payment Verification Failed",
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }
                            }
                        });
                    }
                });

                // Open the Paystack payment iframe
                handler.openIframe();
            }
        </script>
        <script>
            // this a function top up the wallet payment
            function payWithPaystack() {
                // Get form input values
                let email = document.getElementById("email-address").value;
                let amount = parseFloat(document.getElementById("amount_p").value) * 100;
                let upi = document.getElementById("upi").value;
                // Initialize Paystack handler
                let handler = PaystackPop.setup({
                    key: 'pk_test_847382872cccdee5ff8bf870bdea04abcb6e30e2', // Replace with your public key
                    email: email,
                    amount: amount,
                    metadata: {
                        upi: upi
                    },
                    ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference
                    callback: function(response) {
                        let reference = response.reference;
                        $.ajax({
                            url: '/verify_payment/' + reference,
                            type: 'GET',
                            success: function(response) {
                                if (response[0].status == true) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: response[0].message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    $("#paystack_submit").text("Process");
                                    $("#paymentForm")[0].reset();
                                    $("#btn-close-offcanvas_paystack").click();
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 1500);
                                } else {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: "Payment Verification Failed",
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }
                            }
                        });

                    }
                });

                // Open the Paystack payment iframe
                handler.openIframe();
            }
        </script>


        <script>
            $(function() {
                fatchPayment();

                function fatchPayment() {
                    $.ajax({
                        url: '/dashboard_fetch',
                        method: 'get',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 200) {
                                $('tbody').html("");
                                $.each(response.getTop, function(key, item) {
                                    let status = "";
                                    let comment = ""
                                    let channelName = "";
                                    let bankName = "";
                                    if (item.status == 0) {
                                        status =
                                            ' <i class="mdi mdi-checkbox-blank-circle text-secondary me-1"></i><span class="badge bg-secondary">Pending</span>';
                                        buttonStatus = 'Active';
                                    } else if (item.status == 1) {
                                        status =
                                            ' <i class="mdi mdi-checkbox-blank-circle text-success me-1"></i><span class="badge bg-primary">Success</span>'
                                        buttonStatus = 'Deactivate';
                                    } else if (item.status == 2) {
                                        status =
                                            ' <i class="ri  ri-eye-fill text-danger me-1"></i><span class="badge bg-danger"> Denied</span>'
                                    }
                                    if (item.comment != null) {
                                        comment =
                                            '<button type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="' +
                                            item.comment + '">Comment</button>';
                                    }
                                    const amount = item.amount;
                                    let dollarUSLocale = Intl.NumberFormat('en-US');

                                    if (item.bank != null) {
                                        bankName = item.bank.bankname;
                                    } else {
                                        bankName = "Paystack";
                                    }

                                    if (item.chennel != null) {
                                        channelName = item.chennel.chennel;
                                    } else {
                                        channelName = "Online Deposit";
                                    }




                                    $('tbody').append(
                                        '<tr>\
                                                                                                                            <td style="font-weight: bold;">' +
                                        item
                                        .token_key +
                                        '</td>\
                                                                                                                            <td style="font-weight: bold;">' +
                                        dollarUSLocale
                                        .format(
                                            amount) +
                                        '</td>\
                                                                                                                            <td style="text-transform: capitalize; font-weight: bold;">' +
                                        channelName +
                                        '</td>\
                                                                                                                            <td style="text-transform: capitalize; font-weight: bold;">' +
                                        bankName +
                                        '</td>\
                                                                                                                            <td>' +
                                        status +
                                        ' ' +
                                        comment +
                                        '</td>\
                                                                                                                            <td style="text-transform: capitalize; font-weight: bold;">' +
                                        item
                                        .date + '</td>\
                                                                                                                         </tr>'
                                    );
                                });
                                $("table").DataTable({
                                    order: [0, 'desc'],
                                    retrieve: true,
                                });
                            }
                        }
                    });
                }


                $(document).ready(function() {
                    $('#channel-select').change(function() {
                        var selectedChannelId = $(this).val();
                        $.ajax({
                            url: '/get-related-records',
                            type: 'GET',
                            data: {
                                channel: selectedChannelId
                            },
                            success: function(response) {
                                // Handle the response data (e.g., update the bank dropdown options)
                                $('#bank-select').empty(); // Clear existing options
                                if (response.relatedBanks.length > 0) {
                                    $.each(response.relatedBanks, function(index, bank) {
                                        $('#bank-select').append('<option value="' +
                                            bank.bank_code + '">' + bank
                                            .bankname + '</option>');
                                    });
                                } else {
                                    $('#bank-select').append(
                                        '<option value="" selected>Choose</option>');
                                }
                            },
                            error: function(xhr) {
                                // Handle errors
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });



                $("#form_refund").submit(function(e) {
                    e.preventDefault();
                    $("#refund_reason_submit").text("Processing.....");
                    const fd = new FormData(this);
                    $.ajax({
                        url: '/refund',
                        method: 'post',
                        data: fd,
                        cache: false,
                        contentType: false,
                        processData: false,
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
                                $("#refund_reason_submit").text("Process");
                                $("#form_refund")[0].reset();
                                $("#btn-close-offcanvas").click();
                                fatchPayment();
                            } else if (response.status == 400) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $("#refund_reason_submit").text("Process");
                                fatchPayment();
                            }
                        }
                    });
                });

                $("#form_bank_transzaction").submit(function(e) {
                    e.preventDefault();
                    $("#form_bank_transzaction_submit").text("Processing.....");
                    const fd = new FormData(this);
                    $.ajax({
                        url: '/top_up_transwction',
                        method: 'post',
                        data: fd,
                        cache: false,
                        contentType: false,
                        processData: false,
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
                                $("#form_bank_transzaction_submit").text("Process");
                                $("#form_bank_transzaction")[0].reset();
                                $("#btn-close-offcanvas2").click();
                                fatchPayment();
                            }
                        }
                    });
                });
            });
        </script>
    @endsection
</x-masterPage>
