<div class="modal fade" id="{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog rounded-5">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-semibold" id="{{ $id }}Label">Confirm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $text }}

                <div class="row mt-4">
                    <div class="col-6">
                        <button type="button" class="btn btn-light w-100" data-bs-dismiss="modal">
                            No, Cancel
                        </button>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-danger text-white w-100" href="{{ $url }}"
                            onclick="event.preventDefault(); document.getElementById('form-submit').submit();">
                            Yes, Now
                        </a>
                    </div>

                    <form id="form-submit" action="{{ $url }}" method="POST" class="d-none">
                        @csrf @if ($method != null)
                            @method($method)
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
