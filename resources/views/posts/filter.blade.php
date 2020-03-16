<div class="col-12">
    <div class="row">
        <div class="col-6">

            <a class="btn btn-outline-primary" href="" data-toggle="modal" data-target="#postsModal">
                Filter
            </a>

            <br>

            @if(isset($totalPostsFilter))

            <span class="text-muted">
                {{'Found' . ' ' . $totalPostsFilter . ' '. 'posts:'}}
            </span>

            @endif

            @if(isset($categoriesFilter))

            <div class="pl-5">

                <span class="text-muted"><i class="fa fa-check" aria-hidden="true"></i>
                    {{ 'In the categories' . ' ' . $categoriesFilter->name }}</span>

            </div>

            @endif

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="postsModal" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <form action="{{ route('posts.filterByCategory') }}" method="get">
            @csrf

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <!--Filter by categories -->
                    <div class="select-by-program">

                        <div class="form-group row">

                            <label class="col-sm-5 col-form-label border-right">Filter Post by categories</label>

                            <div class="col-sm-7">

                                <select class="custom-select w-100" name="id">

                                    <option value="">Select categories</option>

                                    @foreach($categories as $category)

                                    @if(isset($categoriesFilter))

                                    @if($category->id == $categoriesFilter->id)

                                    <option value="{{$category->id}}" selected>{{ $category->name }}</option>

                                    @else

                                    <option value="{{$category->id}}">{{ $category->name }}</option>

                                    @endif

                                    @else

                                    <option value="{{$category->id}}">{{ $category->name }}

                                    </option>

                                    @endif

                                    @endforeach

                                </select>

                            </div>

                        </div>
                        <!-- </form> -->
                    </div>
                    <!--End-->
                </div>

                <div class="modal-footer">
                    <button type="submit" id="submitAjax" class="btn btn-primary">Chọn</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </div>
        </form>
    </div>
</div>