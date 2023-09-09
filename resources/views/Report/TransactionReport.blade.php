<x-masterPage>
    @section('content')
        <div class="col-12">
            <div class="card">
                <!-- add modal start from here -->
                <div class="card-body">
                    <h4 class="card-title mb-4">Online and Wallet Transactions Report</h4>
                    <div class="table-responsive">
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <label for="">Patient upi:</label>
                                    <input type="text"style="font-weight: bold;" class="form-control" name="upi"
                                        id="">
                                </div>
                                <div class="col">
                                    <label for="">From:</label>
                                    <input type="date"style="font-weight: bold;" class="form-control" name="f_date"
                                        id="">
                                </div>
                                <div class="col">
                                    <label for="">To:</label>
                                    <input type="date"style="font-weight: bold;" class="form-control" name="t_date"
                                        id="">
                                </div>
                                <div class="col">
                                    <label for="">Category:</label>
                                    <select name="category" style="font-weight: bold;"class="form-control" id="">
                                        <option value="" selected>~~ Select ~~</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Success</option>
                                        <option value="2">Denied</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" style="margin-top: 30px">Download Excel</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered border-primary mb-0">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">Action</th> --}}
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Upi</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Bank</th>
                                    <th scope="col">Chennel</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- ajax table calling from here --}}
                            </tbody>
                        </table>
                        <br><br><br><br>
                    </div>
                    <x-walletPayment></x-walletPayment>
                    {{-- make sendMoney start from here --}}
                    <x-sendMoney></x-sendMoney>


                </div>
                <script>
                    $(function() {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });


                        fatchSend();
                        function fatchSend() {
                            $.ajax({
                                url: '/TransactionReportFetch',
                                method: 'get',
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status == 200) {
                                        const uniqueNames = {}; // To track unique names

                                        $('tbody').html(""); // Clear the table body

                                        $.each(response.request, function(key, item) {
                                            let status = "";
                                            let comment = "";
                                            if (item.status == 0) {
                                                status =
                                                    '<i class="mdi mdi-checkbox-blank-circle text-secondary me-1"></i><span class="badge bg-secondary">Pending</span>';
                                                buttonStatus = 'Active';
                                            } else if (item.status == 1) {
                                                status =
                                                    '<i class="mdi mdi-checkbox-blank-circle text-success me-1"></i><span class="badge bg-primary">Success</span>';
                                                buttonStatus = 'Disactivate';
                                            } else if (item.status == 2) {
                                                status =
                                                    '<i class="mdi mdi-checkbox-blank-circle text-danger me-1"></i><span class="badge bg-danger">Denied</span>';
                                            }
                                            if (item.comment != null) {
                                                comment = item.comment;
                                            }

                                            const amount = item.amount;
                                            let dollarUSLocale = Intl.NumberFormat('en-US');
                                            // Format item.created_at into a human-readable format
                                            const updated_at = new Date(item.updated_at);
                                            const formattedCreatedAt = updated_at.toLocaleString();

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

                                            const userName = item.user.name;

                                            // Check if the user's name is unique
                                            if (!uniqueNames[userName]) {
                                                uniqueNames[userName] = true; // Mark as seen

                                                // Append the row to the table body
                                                $('tbody').append(
                                                    '<tr>\
                                            <td style="font-weight: bold;">' + userName + '</td>\
                                            <td style="font-weight: bold;">' + item.upi + '</td>\
                                            <td style="font-weight: bold;">₦ ' + dollarUSLocale.format(amount) + '</td>\
                                            <td style="font-weight: bold;"> ' + bankName + '</td>\
                                            <td style="font-weight: bold;"> ' + channelName + '</td>\
                                            <td>' + status + '</td>\
                                            <td style="font-weight: bold;">' + comment + '</td>\
                                            <td style="text-transform: capitalize; font-weight: bold;">' + formattedCreatedAt + '</td>\
                                            </tr>'
                                                );
                                            } else {
                                                // Append the row with an empty name cell
                                                $('tbody').append(
                                                    '<tr>\
                                            <td></td>\
                                            <td style="font-weight: bold;"></td>\
                                            <td style="font-weight: bold;">₦ ' + dollarUSLocale.format(amount) + '</td>\
                                            <td style="font-weight: bold;"> ' + bankName + '</td>\
                                            <td style="font-weight: bold;"> ' + channelName + '</td>\
                                            <td>' + status + '</td>\
                                            <td style="font-weight: bold;">' + comment + '</td>\
                                            <td style="text-transform: capitalize; font-weight: bold;">' + formattedCreatedAt + '</td>\
                                            </tr>'
                                                );
                                            }
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
