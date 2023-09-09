<x-masterPage>
    @section("content")
    <div class="col-12">
        <div class="card">
   <!-- add modal start from here -->
   <div class="card-body">
    <h4 class="card-title mb-4">Awaiting Transactions</h4>

   <div class="table-responsive">
    <br>
    <table class="table table-bordered border-primary mb-0">
        <thead>
            <tr>
                {{-- <th scope="col">Action</th> --}}
                <th scope="col">Refrence</th>
                <th scope="col">Amount</th>
                <th scope="col">Channel</th>
                <th scope="col">Bank</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col">Pay slip</th>
                <th scope="col">Action</th>
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


<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reason for denial</h5>
                <button type="button" class="btn-close" id="btn-close-model" data-bs-dismiss="modal" aria-label="Close"></button>
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

<x-walletPayment></x-walletPayment>

<!-- /.View modal Image -->
<div class="modal fade bs-example-modal-center2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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

    $(function(){

        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

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
                            let image = "";
                            if (item.status == 0) {
                                status = ' <i class="mdi mdi-checkbox-blank-circle text-secondary me-1"></i><span class="badge bg-secondary">Pending</span>';
                                buttonStatus = 'Active';
                            } else if (item.status == 1) {
                                status = ' <i class="mdi mdi-checkbox-blank-circle text-success me-1"></i><span class="badge bg-primary">Success</span>'
                                buttonStatus = 'Disactivate';
                            }

                            const paySlipButton = '<button type="button" class="btn btn-primary btn-sm waves-effect waves-light view-pay-slip" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center2" data-image-url="' + item.file + '">Pay slip</button>';

                            const amount =item.amount;
                            const channelName = item.chennel.chennel; // Access it from 'item'
                            const bankName = item.bank.bankname;
                            let dollarUSLocale = Intl.NumberFormat('en-US');
                            $('tbody').append('<tr>\
                                                                                        <td style="font-weight: bold;" >' + item.token_key + '</td>\
                                                                                        <td style="font-weight: bold;" >' + dollarUSLocale.format(amount) +'</td>\
                                                                                        <td style="text-transform:capitalize;font-weight: bold;">' + channelName + '</td>\
                                                                                        <td style="text-transform:capitalize;font-weight: bold;">' + bankName + '</td>\
                                                                                        <td>' + status + '</td>\
                                                                                        <td style="text-transform:capitalize;font-weight: bold;">' + item.date + '</td>\
                                                                                        <td style="text-transform:capitalize;font-weight: bold;">' + paySlipButton + '</td>\
                                                                                        <td><div class="d-flex gap-2 flex-wrap"> <div class="btn-group"><button type="button" class="btn btn-info btn-sm dropdown-toggle hearder" data-bs-toggle="dropdown" aria-expanded="false"> Action <i class="mdi mdi-chevron-down"></i></button> <div class="dropdown-menu"><div class="dropdown-header noti-title"><h5 class="font-size-13 text-muted text-truncate mn-0">Welcome ' +response.user +'!</h5></div>\
                                                                                                    <a href="" class="dropdown-item download"  id="' +item.id + '" value="' + item.id + '" ><button class="btn btn-primary btn-sm approve" value="' + item.id + '" >Approve payment</button></a>\
                                                                                                    <a href="#" class="dropdown-item download" id="' + item.id + '" value="' + item.id + '"><button type="button" class="btn btn-sm btn-primary deny-request edit" value="' + item.id + '" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">Deny Payment</button></a>\
                                                                                                    </div></div></div></td>\
                                                                                             </tr>');
                        });
                        $('.view-pay-slip').click(function () {
                            const imageUrl = '{{ asset('storage/slip/') }}' + '/' + $(this).data('image-url');
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
                        url: '/requestdeposit',
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
                                fatchPayment();
                            }
                        }
                    });
                });


        $(document).on("click", ".approve" , function(e){
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
                url: '/status_update/'+id,
                method: 'post',
                dataType: 'json',
                success: function(response){
                    if(response.status == 200){
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
