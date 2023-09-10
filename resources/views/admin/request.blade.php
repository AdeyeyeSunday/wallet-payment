<x-masterPage>
    @section("content")
    <div class="col-12">
        <div class="card">
   <!-- add modal start from here -->
   <div class="card-body">

    <h4 class="card-title mb-4">Refund request Transactions</h4>

   <div class="table-responsive">
    <br>
    <table class="table table-bordered border-primary mb-0">
        <thead>
            <tr>
                {{-- <th scope="col">Action</th> --}}
                <th scope="col">Fullname</th>
                <th scope="col">Upi</th>
                <th scope="col">Amount</th>
                <th scope="col">Reason</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
           {{-- ajax table calling from here --}}
        </tbody>
    </table>
    <br><br>
</div>
<x-walletPayment></x-walletPayment>
  {{-- make sendMoney start from here --}}
  <x-sendMoney></x-sendMoney>
  {{-- make sendMoney end from here --}}
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
</div><!-- /.modal -->

</div>
<script>
    $(function(){
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

        fatchPayment();
 function fatchPayment() {
    $.ajax({
        url: '/requestFatch',
        method: 'get',
        dataType: 'json',
        success: function(response) {
            if (response.status == 200) {
                $('tbody').html("");
                $.each(response.request, function(key, item) {
                    let status = "";
                    let comment = "";
                    if (item.status == 0) {
                        status = '<i class="mdi mdi-checkbox-blank-circle text-secondary me-1"></i><span class="badge bg-secondary">Pending</span>';
                        buttonStatus = 'Active';
                    }
                     else if (item.status == 1) {
                        status = '<i class="mdi mdi-checkbox-blank-circle text-success me-1"></i><span class="badge bg-primary">Success</span>';
                        buttonStatus = 'Disactivate';
                    }

                    else if (item.status == 2)
                    {
                        status = '<i class="mdi mdi-checkbox-blank-circle text-danger me-1"></i><span class="badge bg-danger">Denied</span>';
                    }

                    comment = '<button type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="' +
                                                item.refund_reason + '">Comment</button>'

                    const amount = item.refund_amount;
                    let dollarUSLocale = Intl.NumberFormat('en-US');
                    // Format item.created_at into a human-readable format
                    const createdAt = new Date(item.created_at);
                    const formattedCreatedAt = createdAt.toLocaleString();
                    let actionButtons = ''; // Initialize the action buttons as an empty string
                    if (item.status == 0) {
                        // If status is 1, add approve and disapprove buttons
                        actionButtons = '<td><div class="d-flex gap-2 flex-wrap"> <div class="btn-group"><button type="button" class="btn btn-info btn-sm dropdown-toggle hearder" data-bs-toggle="dropdown" aria-expanded="false"> Action <i class="mdi mdi-chevron-down"></i></button> <div class="dropdown-menu"><div class="dropdown-header noti-title"><h5 class="font-size-13 text-muted text-truncate mn-0">Welcome ' + response.user + '!</h5></div>\
                            <a href="" class="dropdown-item download" id="' + item.id + '" value="' + item.id + '"><button class="btn btn-primary btn-sm approved" value="' + item.id + '">Approve Request</button></a>\
                            <a href="#" class="dropdown-item download" id="' + item.id + '" value="' + item.id + '"><button type="button" class="btn btn-sm btn-primary deny-request edit" value="' + item.id + '" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">Deny Request</button></a>\
                        </div></div></div></td>';
                    }
                    $('tbody').append('<tr>\
                        <td style="font-weight: bold;">' + item.user.name + '</td>\
                        <td style="font-weight: bold;">' + item.upi + '</td>\
                        <td style="font-weight: bold;">₦ ' + dollarUSLocale.format(amount) + '</td>\
                        <td style="text-transform: capitalize; font-weight: bold;"> '+comment+'</td>\
                        <td>' + status + '</td>\
                        <td style="text-transform: capitalize; font-weight: bold;">' + formattedCreatedAt + '</td>' + actionButtons + '</tr>');
                });
                $("table").DataTable({
                    order: [0, 'desc'],
                    retrieve: true,
                });
            }
        }
    });
}


$(document).on("click", ".approved" , function(e){
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
                url: '/requestApproval/'+id,
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
        });

        $(document).on("click", ".edit", function(e) {
                    e.preventDefault();
                    var id = $(this).val();
                    $.ajax({
                        url: '/getComment/' + id,
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
                        url: '/requestdisapproval',
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

    });
</script>
    @endsection
</x-masterPage>
