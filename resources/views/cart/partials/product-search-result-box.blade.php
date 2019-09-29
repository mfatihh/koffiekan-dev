<div class="panel-body table-responsive">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>{{ trans('product.name') }}</th>
                <th>H / I </th>
                {{-- <th>Sisa Stok</th></th> --}}
                <th>{{ trans('product.price') }}</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($queriedProducts as $product)
            <tr>
                <td>{{ $product->name }}</td>
                {{-- <td>{{ $product->sisa_stok }}</td> --}}
                <td>{{ $product->h_i}}</td>
                <td>{{ formatRp($product->getPrice($draftType)) }}</td>
                <td width="50%">
                    <form action="{{ route('cart.add-draft-item', [$draftKey, $product->id]) }}" method="post" style="width:250px;">
                        <input type="hidden" name="query" value="{{ isset($query) ? $query : request('query') }}">
                        <input type="hidden" name="_token" value="{{ isset($formToken) ? $formToken : csrf_token() }}">
                        
                        <div class="input-group">
                          <button type="button" value="-" class="button-minus minus" data-field="quantity">-</button>
                          <input type="number" step="1" max="" value="0" id="qty-{{ $product->id }}" name="qty" class="quantity-field">
                          <button type="button" value="+" class="button-plus plus" data-field="quantity">+</button>
                          
                          <button type="submit" class="btn btn-info btn-sm" id="add-product-{{ $product->id }}" >add</button>
                        </div>
                        <!--<div class="input-group">-->
                        <!--  <input type="button" value="-" class="minus">-->
                        <!--  <input type="number" step="1" max="" value="1" id="qty-{{ $product->id }}" name="qty" >-->
                        <!--  <input type="button" value="+" class="plus">-->
                          
                        <!--<input type="submit" class="btn btn-info btn-sm" id="add-product-{{ $product->id }}" value="Add">-->
                        <!--</div>-->
                        <!--<input type="number" id="qty-{{ $product->id }}" style="width:50px" name="qty" value="1" min="1">-->
                        <!--<input type="submit" class="btn btn-info btn-sm" id="add-product-{{ $product->id }}" value="Tambah">-->
                    </form>
                    {{-- @if ($loop->last)
                    {{ link_to_route('cart.show', trans('cart.search_box_cleanup'), [$draftKey], [
                        'class' => 'btn btn-sm btn-default pull-right'
                    ]) }}
                    @endif --}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">
                    Produk tidak ada
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>