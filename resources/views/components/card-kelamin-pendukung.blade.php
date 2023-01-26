<div class="bg-white shadow p-4 rounded-4">
    <h6 class="mb-2">Pendukung by Jenis Kelamin</h6>
    <hr>
    <div class="">
        <div class="d-flex align-items-center justify-content-between">
            <p class="text-success m-0">Pria</p>
            <p class="text-danger m-0">Wanita</p>
        </div>
        <div class="d-flex align-items-center">
            <div class="bg-success py-1 rounded-0 text-white text-center" style="width: {{ $totalPria }}%">
                {{ $totalPria }}%
            </div>
            <div class="bg-danger py-1 rounded-0 text-white text-center" style="width: {{ $totalWanita }}%">
                {{ $totalWanita }}%
            </div>
        </div>
    </div>
</div>
