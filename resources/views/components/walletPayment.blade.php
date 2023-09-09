   {{-- make Wallet start from here --}}
   <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight6"
   aria-labelledby="offcanvasRightLabel">
   <div class="offcanvas-header">
       <h5 id="offcanvasRightLabel">Wallet Payment</h5>
       <button type="button" class="btn-close text-reset" id="btn-close-offcanvas_Wallet_payment"
           data-bs-dismiss="offcanvas" aria-label="Close"></button>
   </div>
   <div class="offcanvas-body" id="offcanvasRight">
       <p style="font-weight: bold;">Kindly visit the payment attempts page to recheck your
           transaction if you were debited without being credited.</p>
       <form action="" id="form_wallet_payment">
           @csrf
           <div class="mb-3">
               <label class="form-label" for="default-input">Full name</label>
               <input class="form-control" type="text" style="font-weight: bold;"
                   value="{{ Auth::user()->name }}" readonly id="fname" name="fname" required
                   placeholder="Enter driver name">
               <br>

               <label class="form-label" for="default-input">Upi</label>
               <input class="form-control" type="text" style="font-weight: bold;"
                   value="{{ Auth::user()->h_number }}" readonly id="upi" name="upi" required>
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
               <input class="form-control" type="file" id="invoice_file" name="invoice_file" required>
               <br>
           </div>
           <p style="font-weight: bold;">Please note that we will not/do not have access to your
               account details...</p>
           <center>
               <button type="submit" id="Wallet_Submit" class="btn btn-primary">Process</button>
           </center>
       </form>
   </div>
</div>
{{-- make Wallet end from here --}}
<script>
       $("#form_wallet_payment").submit(function(e) {
                    e.preventDefault();
                    $("#Wallet_Submit").text("Processing.....");
                    const fd = new FormData(this);
                    $.ajax({
                        url: '/wallet_payment',
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
                                    timer: 2000
                                })
                                $("#Wallet_Submit").text("Process");
                                $("#form_wallet_payment")[0].reset();
                                $("#btn-close-offcanvas_Wallet_payment").click();
                            } else if (response.status == 400) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                $("#Wallet_Submit").text("Process");
                            }
                        }
                    });
                });

</script>
