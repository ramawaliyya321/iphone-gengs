<!-- Sale & Revenue Start -->
@if(auth()->user()->role == 'admin')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Users</p>
                    <h6 class="mb-0">{{$user}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-mobile fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Unit iPhone</p>
                    <h6 class="mb-0">{{$iphone}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-dollar-sign fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Revenue</p>
                    <h6 class="mb-0">@rupiah($transaksi)</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Users</p>
                    <h6 class="mb-0">0</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-mobile fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">My Rent</p>
                    <h6 class="mb-0">0</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-dollar-sign fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Revenue</p>
                    <h6 class="mb-0">0</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@livewire('LihatTransaksi')
@endif
<!-- Sale & Revenue End -->