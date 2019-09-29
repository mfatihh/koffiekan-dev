
<div class="card" style="padding:20px;">
    <div class="panel-heading">
        <form method="get" action="{{ route('cart.show', $draft->draftKey) }}" style="float:left;margin-right:5px;">
            <select  name="query" style="padding:5px;width:150px;" onchange="this.form.submit()">
                <option value="">Pilih Produk</option>
                @foreach ($products as $item)
                    <option value="{{$item->id}}" {{ request('query') ==  $item->id ? 'selected="selected"' : '' }}>{{$item->name}}</option>
                @endforeach
            </select>
        </form>
        {{-- <form method="get" action="{{ route('cart.show', $draft->draftKey) }}">
            
            <div class="input-group">
                
                    <input type="text" name="query" class="form-control" width="50%;" placeholder="search produk">
                    <span class="input-group-btn">
                        <button class="btn " type="submit"><i class="fa fa-search"></i></button>
                    </span> </div>
            @if ($queriedProducts)
            {{ link_to_route('cart.show', trans('cart.search_box_cleanup'), [$draft->draftKey], ['class' => 'btn btn-sm']) }}
            @endif
        </form> --}}
    </div>
    <div id="product-search-result-box">
    @includeWhen ($queriedProducts, 'cart.partials.product-search-result-box', [
        'draftType' => $draft->type,
        'draftKey' => $draft->draftKey
    ])
    </div>
</div>