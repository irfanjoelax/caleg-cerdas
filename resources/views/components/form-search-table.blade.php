<form action="{{ $url }}" method="GET">
    <div class="input-group">
        <input type="search" name="keyword" class="form-control" value="{{ $request }}" placeholder="Pencarian..">
        <button type="submit" class="btn btn-outline-primary">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>
