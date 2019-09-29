<div class="row container">
    <div class="col-md-8 card">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">{{ trans('transaction.confirm') }}</h3></div>
            <div class="panel-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>H/I</th>
                            <th class="text-right">Harga</th>
                            {{-- <th class="text-right">Diskon per Item</th> --}}
                            <th class="text-center">Jumlah</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($draft->items() as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-right">{{ formatRp($item->price) }}</td>
                            {{-- <td class="text-right">{{ formatRp($item->item_discount) }}</td> --}}
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-right">{{ formatRp($item->subtotal) }}</td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">{{ trans('transaction.total') }} :</th>
                            <th class="text-right">{{ formatRp($draft->getSubtotal()) }}</th>
                        </tr>
                        
                        <tr>
                            <th colspan="4" class="text-right">Tanggal :</th>
                            <th class="text-right">{{$draft->tanggal}}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"></h3></div>
            
            
            <div class="panel-footer">
                {{ Form::open(['route' => ['cart.store', $draft->draftKey]]) }}
                {{ Form::submit(trans('transaction.save'), ['id' => 'save-transaction-draft', 'class' => 'btn btn-success']) }}
                {{ link_to_route('cart.show', trans('app.back'), $draft->draftKey, ['class' => 'btn btn-default']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>