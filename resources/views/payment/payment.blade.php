<x-masterPage>
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Payment History</h4>
                        <button type="button" style="margin-left: 91%;" class="btn btn-primary waves-effect waves-light"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">+ Make payment
                        </button>
                        <!-- add modal start from here -->
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                            aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 id="offcanvasRightLabel">Make payment</h5>
                                <button type="button" class="btn-close text-reset" id="btn-close-offcanvas"
                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body" id="offcanvasRight">
                                <p style="font-weight: bold;">Kindly visit payment attempts page to recheck your transaction if you were debited without been credited.</p>
                                <form action="" id="form_payment">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="default-input">Full name</label>
                                        <input class="form-control" type="text"  style="font-weight: bold;" value="{{ Auth::user()->name }}" readonly id="f_name" name="f_name" required
                                            placeholder="Enter driver name">
                                        <br>
                                        <label class="form-label" for="default-input">Email</label>
                                        <input class="form-control" type="email" style="font-weight: bold;"  value="{{ Auth::user()->email }}" readonly id="email" name="email" required
                                            placeholder="Enter email">
                                        <br>
                                        <label class="form-label" for="default-input">Upi</label>
                                        <input class="form-control" type="text"  style="font-weight: bold;"  value="{{ Auth::user()->h_number }}" readonly id="h_number" name="h_number" required
                                            placeholder="Enter email">
                                        <br>

                                        <label class="form-label" for="default-input">Enter amount</label>
                                        <input class="form-control" type="number" style="font-weight: bold;"  id="amount" name="amount" required
                                            placeholder="Enter amount">
                                        <br>

                                        <label class="form-label" for="default-input">Upload payslip</label>
                                        <input class="form-control" type="file" id="file" name="file" required>
                                        <br>
                                    </div>
                                    <p style="font-weight: bold;"  >Please, note that we will not/do not have access to your account details...</p>
                                    <center> <button type="submit" id="submit" class="btn btn-primary" id="submit">Process</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                        <!-- add modal start from here -->
                        <div class="table-responsive">
                            <br>
                            <table class="table table-bordered border-primary mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Tittle</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Date</th>
                                    </tr>

                                </thead>
                                <tbody>
                                   {{-- ajax table calling from here --}}
                                </tbody>
                            </table>
                            <br><br><br><br><br><br><br><br><br>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
              {{-- make sendMoney start from here --}}
            <x-sendMoney></x-sendMoney>
            {{-- make sendMoney end from here --}}
        </div>


        <script>
            $(function(){
                fatchPayment();
                function fatchPayment(){
                    $.ajax({
                        url: '/topfetch',
                        method: 'get',
                        dataType: 'json',
                        success: function(response){
                            if (response.status == 200) {
                                $('tbody').html("");
                                $.each(response.getTop, function(key, item) {
                                    let status = "";
                                    if (item.status == 0) {
                                        status = ' <i class="mdi mdi-checkbox-blank-circle text-secondary me-1"></i><span class="badge bg-secondary">Pending</span>';
                                        buttonStatus = 'Active';
                                    } else if (item.status == 1) {
                                        status = ' <i class="mdi mdi-checkbox-blank-circle text-success me-1"></i><span class="badge bg-primary">Success</span>'
                                        buttonStatus = 'Disactivate';
                                    }

                                    const amount =item.amount;
                                let dollarUSLocale = Intl.NumberFormat('en-US');
                                    $('tbody').append('<tr>\
                                                                                                <td style="font-weight: bold;" >' + item.token_key + '</td>\
                                                                                                <td style="font-weight: bold;" >' + dollarUSLocale.format(amount) +'</td>\
                                                                                                <td style="text-transform:capitalize;font-weight: bold;">' + item.channel + '</td>\
                                                                                                <td>' + status + '</td>\
                                                                                                <td style="text-transform:capitalize;font-weight: bold;">' + item.date + '</td>\
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


            });
        </script>
    @endsection
</x-masterPage>
