<x-masterPage>
    @section("content")

    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex text-muted">
                        <div class="flex-shrink-0 me-3 align-self-center">
                            <div id="radialchart-1" class="apex-charts" dir="ltr"></div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1" style="font-weight: bold;">Users</p>
                            <h5 class="mb-3" style="font-weight: bold;">2.2k</h5>

                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3 align-self-center">
                            <div id="radialchart-2" class="apex-charts" dir="ltr"></div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1" style="font-weight: bold;">Online Payment</p>
                            <h5 class="mb-3" style="font-weight: bold;">2.2k</h5>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex text-muted">
                        <div class="flex-shrink-0 me-3 align-self-center">
                            <div id="radialchart-3" class="apex-charts" dir="ltr"></div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1" style="font-weight: bold;">Total Approved</p>
                            <h5 class="mb-3" style="font-weight: bold;">20000</h5>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-sm-6">
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
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="mb-1" style="font-weight: bold;">Total Deapproved</p>
                            <h5 class="mb-3" style="font-weight: bold;">50000</h5>
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
        <div class="col-xl-6">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Latest Transaction</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered border-primary mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">ID & Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>


                                        <td>
                                            <p class="mb-1 font-size-12">#AP1234</p>
                                            <h5 class="font-size-15 mb-0">David Wiley</h5>
                                        </td>
                                        <td>02 Nov, 2019</td>
                                        <td>$ 1,234</td>
                                        <td>1</td>

                                        <td>
                                            $ 1,234
                                        </td>
                                        <td>
                                            <i class="mdi mdi-checkbox-blank-circle text-success me-1"></i> Confirm
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Transaction Notifications</h4>

                    <div class="pe-3" data-simplebar style="max-height: 287px;">
                        <a href="#" class="text-body d-block">
                            <div class="d-flex py-3">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <img class="rounded-circle avatar-xs" alt="" src="assets/images/users/avatar-2.jpg">
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-14 mb-1">Scott Elliott</h5>
                                    <p class="text-truncate mb-0">
                                        If several languages coalesce
                                    </p>
                                </div>
                                <div class="flex-shrink-0 font-size-13">
                                    20 min ago
                                </div>
                            </div>
                        </a>
                        <a href="#" class="text-body d-block">
                            <div class="d-flex py-3">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <div class="avatar-xs">
                                        <span class="avatar-title bg-soft-primary rounded-circle text-primary">
                                            <i class="mdi mdi-account-supervisor"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-14 mb-1">Team A</h5>
                                    <p class="text-truncate mb-0">
                                        Team A Meeting 9:15 AM
                                    </p>
                                </div>
                                <div class="flex-shrink-0 font-size-13">
                                    9:00 am
                                </div>
                            </div>
                        </a>
                        <a href="#" class="text-body d-block">
                            <div class="d-flex py-3">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <img class="rounded-circle avatar-xs" alt="" src="assets/images/users/avatar-3.jpg">
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-14 mb-1">Frank Martin</h5>
                                    <p class="text-truncate mb-0">
                                        Neque porro quisquam est
                                    </p>
                                </div>
                                <div class="flex-shrink-0 font-size-13">
                                    8:54 am
                                </div>
                            </div>
                        </a>
                        <a href="#" class="text-body d-block">
                            <div class="d-flex py-3">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <div class="avatar-xs">
                                        <span class="avatar-title bg-soft-primary rounded-circle text-primary">
                                            <i class="mdi mdi-email-outline"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-14 mb-1">Updates</h5>
                                    <p class="text-truncate mb-0">
                                        It will be as simple as fact
                                    </p>
                                </div>
                                <div class="flex-shrink-0 font-size-13">
                                    27-03-2020
                                </div>
                            </div>
                        </a>

                        <a href="#" class="text-body d-block">
                            <div class="d-flex py-3">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <img class="rounded-circle avatar-xs" alt=""
                                        src="assets/images/users/avatar-4.jpg">
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="font-size-14 mb-1">Terry Garrick</h5>
                                    <p class="text-truncate mb-0">
                                        At vero eos et accusamus et
                                    </p>
                                </div>
                                <div class="flex-shrink-0 font-size-13">
                                    27-03-2020
                                </div>
                            </div>
                        </a>

                    </div>
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


    @endsection
</x-masterPage>
