<x-masterPage>
    @section('content')
        <div class="row">
            <div class="col-xl-2 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex text-muted">
                            <div class="flex-shrink-0 me-3 align-self-center">
                                <div id="radialchart-1" class="apex-charts" dir="ltr"></div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden" id="wallet_Reload">
                                <p class="mb-1" style="font-weight: bold;">Wallet Payment</p>
                                <h5 class="mb-3" style="font-weight: bold;">
                                    {{ number_format($transWalletPayment, 2, '.', ',') }}</h5>

                            </div>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-2 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3 align-self-center">
                                <div id="radialchart-2" class="apex-charts" dir="ltr"></div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden" id="paystack_Reload">
                                <p class="mb-1" style="font-weight: bold;">Paystack Deposit</p>
                                <h5 class="mb-3" style="font-weight: bold;">₦{{ number_format($online, 2, '.', ',') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->


            <div class="col-xl-2 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex text-muted">
                            <div class="flex-shrink-0 me-3 align-self-center">
                                <div id="radialchart-3" class="apex-charts" dir="ltr"></div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden" id="bank_Reload">
                                <p class="mb-1" style="font-weight: bold;">Bank Deposit</p>
                                <h5 class="mb-3" style="font-weight: bold;">
                                    ₦{{ number_format($bankDeposit, 2, '.', ',') }}</h5>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-2 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex text-muted">
                            <div class="flex-shrink-0  me-3 align-self-center">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                        <i class="ri-group-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden" id="send_Reload">
                                <p class="mb-1" style="font-weight: bold;"> Money Sent</p>
                                <h5 class="mb-3" style="font-weight: bold;">₦{{ number_format($sent, 2, '.', ',') }}</h5>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body -->

                </div>
                <!-- end card -->
            </div>
            <div class="col-xl-2 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex text-muted">
                            <div class="flex-shrink-0  me-3 align-self-center">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                        <i class="ri-group-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden" id="Paystack_Reload">
                                <p class="mb-1" style="font-weight: bold;">Paystack Payment</p>
                                <h5 class="mb-3" style="font-weight: bold;">
                                    ₦{{ number_format($onlinePayment, 2, '.', ',') }}</h5>
                            </div>

                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>

            <div class="col-xl-2 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex text-muted">
                            <div class="flex-shrink-0  me-3 align-self-center">
                                <div class="avatar-sm">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                        <i class="ri-group-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden" id="info">
                                <p class="mb-1" style="font-weight: bold;">Total Refund</p>
                                <h5 class="mb-3" style="font-weight: bold;">₦{{ number_format($refund, 2, '.', ',') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-xl-7">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Latest Deposit Transaction</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Upi</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Channel</th>
                                            <th scope="col">Bank</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_Refreash"></tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart" height="100px"></canvas>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
                <x-walletPayment></x-walletPayment>
                {{-- make sendMoney start from here --}}
                <x-sendMoney></x-sendMoney>
                {{-- make sendMoney end from here --}}
            </div>
            <!-- end col -->
        </div>

        <script>
            $(document).ready(function() {
                setInterval(function() {
                    $("#info").load(window.location.href + " #info");
                }, 3000);
            });
            $(document).ready(function() {
                setInterval(function() {
                    $("#Paystack_Reload").load(window.location.href + " #Paystack_Reload");
                }, 3000);
            });
            $(document).ready(function() {
                setInterval(function() {
                    $("#send_Reload").load(window.location.href + " #send_Reload");
                }, 3000);
            });
            $(document).ready(function() {
                setInterval(function() {
                    $("#wallet_Reload").load(window.location.href + " #wallet_Reload");
                }, 3000);
            });
            $(document).ready(function() {
                setInterval(function() {
                    $("#paystack_Reload").load(window.location.href + " #paystack_Reload");
                }, 3000);
            });
            $(document).ready(function() {
                setInterval(function() {
                    $("#send_Reload").load(window.location.href + " #send_Reload");
                }, 3000);
            });
        </script>



        <script type="text/javascript">
            var customColors = [
                'rgb(31, 58, 147)',
                'rgb(134, 26, 89)',
                'rgb(0, 128, 128)',
                'rgb(62, 71, 82)',
                'rgb(93, 50, 88)',
                'rgb(36, 107, 125)',
                'rgb(123, 0, 67)',
                'rgb(0, 60, 48)',
                'rgb(128, 0, 0)',
                'rgb(8, 48, 107)',
                'rgb(72, 0, 86)',
                'rgb(107, 16, 0)'
            ];

            function createChart() {
                var labels = {{ Js::from($labels) }};
                var users = {{ Js::from($data) }};
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'My First dataset',
                        backgroundColor: customColors,
                        data: users,
                    }]
                };

                const config = {
                    type: 'polarArea',
                    data: data,
                    options: {}
                };

                return new Chart(
                    document.getElementById('myChart'),
                    config
                );
            }

            // Initial chart creation
            var myChart = createChart();
            setInterval(function() {
                myChart.destroy();
                myChart = createChart();
            }, 8000);
        </script>


        <script>
            $(function() {

                $(document).ready(
                    function() {
                        setInterval(function() {
                            var randomnumber = Math.floor(Math.random() * 100);
                            fatchPayment();
                        }, 3000);
                    });
                fatchPayment();

                function fatchPayment() {
                    $.ajax({
                        url: '/dashboardFatch',
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
                                    const createdAt = new Date(item.created_at);
                                    const formattedCreatedAt = createdAt.toLocaleString();

                                    if (item.chennel != null) {
                                        channelName = item.chennel.chennel;
                                    } else {
                                        channelName = "Online Deposit";
                                    }

                                    $('tbody').append(
                                        '<tr>\
                                                                                                                                                                <td style="font-weight: bold;">' +
                                        item
                                        .upi +
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
                                        formattedCreatedAt +
                                        '</td>\
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
            });
        </script>
    @endsection
</x-masterPage>
