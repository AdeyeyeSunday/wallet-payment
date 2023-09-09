   {{-- make send start from here --}}
   <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight7" aria-labelledby="offcanvasRightLabel">
       <div class="offcanvas-header">
           <h5 id="offcanvasRightLabel">Send Money To ESH</h5>
           <button type="button" class="btn-close text-reset" id="btn-close-offcanvas_send_Money"
               data-bs-dismiss="offcanvas" aria-label="Close"></button>
       </div>
       <div class="offcanvas-body" id="offcanvasRight">
           <p style="font-weight: bold;">Kindly visit the payment attempts page to recheck your
               transaction if you were debited without being credited.</p>
           <form action="" id="form_send_money">
               @csrf
               <div class="mb-3">
                   <label class="form-label" for="default-input">Full name</label>
                   <input class="form-control" type="text" style="font-weight: bold;"
                       value="{{ Auth::user()->name }}" readonly id="fname" name="fname" required
                       placeholder="Enter  name">
                   <br>
                   <label class="form-label" for="default-input">Upi</label>
                   <input class="form-control" type="text" style="font-weight: bold;"
                       value="{{ Auth::user()->h_number }}" readonly id="upi" name="upi" required>
                   <br>
                   <label class="form-label" for="default-input">Enter amount</label>
                   <input class="form-control" type="number" style="font-weight: bold;" id="amount" name="amount"
                       required placeholder="Enter amount">
                   <br>
               </div>
               <p style="font-weight: bold;">Please note that we will not/do not have access to your
                   account details...</p>
               <center>
                   <button type="submit" id="Send_Submit" class="btn btn-primary">Process</button>
               </center>
           </form>
       </div>
   </div>
   {{-- make send end from here --}}
   <script>
       $("#form_send_money").submit(function(e) {
           e.preventDefault();
           $("#Send_Submit").text("Processing.....");
           const fd = new FormData(this);
           $.ajax({
               url: '/sendMoney',
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
                       $("#Send_Submit").text("Process");
                       $("#form_send_money")[0].reset();
                       $("#btn-close-offcanvas_send_Money").click();
                   } else if (response.status == 400) {
                       Swal.fire({
                           position: 'top-end',
                           icon: 'error',
                           title: response.message,
                           showConfirmButton: false,
                           timer: 2000
                       })
                       $("#Send_Submit").text("Process");
                   }
               }
           });
       });
   </script>
