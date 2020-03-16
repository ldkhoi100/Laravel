{{-- Search --}}
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline mr-auto" action="{{ route('categories.search') }}" method="get">
        @csrf
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="keyword" placeholder="Search"
                        value="{{ (isset($_GET['keyword'])) ? $_GET['keyword'] : '' }}">
                </div>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-dark">Search</button>
            </div>
        </div>
    </form>
</div>