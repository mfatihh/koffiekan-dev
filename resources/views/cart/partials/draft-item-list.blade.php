
<div class="panel panel-default card" style="padding:20px;">
    <div class="panel-body table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Item</th>
                    <th>H/I</th>
                    <th>Harga Satuan</th>
                    {{-- <th class="text-right">Diskon per Item</th> --}}
                    <th class="text-center">Qty</th>
                    <th class="text-right">Subtotal</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 1 ?>
            @forelse($draft->items() as $key => $item)
                <tr>
                    <td>{{ $no }} <?php $no++ ?></td>
                    <td>
                        {{ $item->name }}
                    </td>
                <td>
                    {{-- {{ $item->h_i}} --}}
                </td> 
                    <td>{{ formatRp($item->price) }}</td>
                        {{ Form::open(['route' => ['cart.update-draft-item', $draft->draftKey], 'method' => 'patch']) }}
                        {{ Form::hidden('item_key', $key) }}
                    {{-- <td class="text-right"> --}}
                        {{ Form::hidden('item_discount', $item->item_discount, [
                            'id' => 'item_discount-' . $key,
                            'style' => 'width:80px;text-align:right']
                        ) }}
                    {{-- </td> --}}
                    
                    <td class="text-left">
                        <div class="input-group">
                          <!--<button type="button" value="-" class="button-minus minus" data-field="quantity">-</button>-->
                          <input type="number" step="1" max="" value="{{$item->qty}}" id="qty-{{ $key }}" name="qty" class="quantity-field">
                          <!--<button type="button" value="+" class="button-plus plus" data-field="quantity">+</button>-->
                          
                        </div>
                        
                    </td>
                    <td class="text-right">{{ formatRp($item->subtotal) }}</td>
                        
                    <td class="text-center show-on-hover-parent">
                            {{ Form::submit('Update', ['class'=>'btn btn-warning btn-sm']) }}
                            {{ Form::close() }}
                        {!! FormField::delete([
                            'route' => ['cart.remove-draft-item', $draft->draftKey],
                            'onsubmit' => 'Yakin ingin menghapus Item ini?',
                            'class' => '',
                            'style' => 'margin-top:3px;'
                        ], 'Hapus', ['id' => 'remove-item-' . $key, 'class' => ' show-on-hover btn btn-danger btn-sm','title' => 'Hapus item ini'], ['item_index' => $key]) !!}
                    </td>
                </tr>
            @empty
            @endforelse
            </tbody>
            <tfoot>
                {{-- <tr>
                    <th colspan="4" class="text-right">{{ trans('transaction.subtotal') }} :</th>
                    <th class="">{{ formatRp($draft->getSubtotal()) }}</th>
                    <th></th>
                </tr>--}}

                {{ Form::open(['route' => ['cart.draft-proccess', $draft->draftKey], 'method' => 'patch']) }}
                <tr>
                    <th class="text-right">Tanggal</th>
                    <th class="text-right"><input type="date" name="tanggal" value="{{$draft->tanggal}}" required></th>
                    <th colspan="2" class="text-right">{{ trans('transaction.total') }} :</th>
                    <th class="">{{ formatRp($draft->getTotal()) }}</th>
                    <th></th>
                </tr>
                
                <!--<tr>-->
                <!--    <th colspan="5" class="text-right">Tanggal</th>-->
                <!--    <th class="text-right"><input type="date" class="form-control" name="tanggal" value="{{$draft->tanggal}}" required></th>-->
                <!--    <th></th>-->
                <!--</tr> -->
                
            </tfoot>
        </table> {{--{!! FormField::textarea('notes', ['label' => trans('transaction.notes'), 'value' => $draft->notes]) !!} --}}
                        {{ Form::submit('Proses', ['class' => 'btn btn-info pull-right']) }}
                        {{ Form::close() }}
    </div>
</div>