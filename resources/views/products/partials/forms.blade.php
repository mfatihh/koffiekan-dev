{{-- @inject('sup', 'App\Supplier') --}}
@if (Request::get('action') == 'create')
{!! Form::open(['route' => 'products.store']) !!}
{!! FormField::text('name', ['label' => __('product.name'), 'required' => true]) !!}
<div class="row">
    <div class="col-md-6">{!! FormField::price('cash_price', ['label' => __('product.cash_price'), 'required' => true])
        !!}</div>
    <div class="col-md-6">{!! FormField::price('credit_price', ['label' => __('product.credit_price')]) !!}</div>
</div>

<div class="form-group row">
    <label for="kode_produk" class="col-md-4 col-form-label text-md-right">Kode Produk</label>

    <div class="col-md-8">
        <input id="kode_produk" type="text" class="form-control" name="kode_produk" required>

        @if ($errors->has('kode_produk'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('kode_produk') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="harga_kiloan" class="col-md-4 col-form-label text-md-right">Harga Kiloan</label>

    <div class="col-md-8">
        <input id="harga_kiloan" type="number" class="form-control" name="harga_kiloan" required>

        @if ($errors->has('harga_kiloan'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('harga_kiloan') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="harga_satuan" class="col-md-4 col-form-label text-md-right">Harga Satuan</label>

    <div class="col-md-8">
        <input id="harga_satuan" type="number" class="form-control" name="harga_satuan" required>
        @if ($errors->has('harga_satuan'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('harga_satuan') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="wadah" class="col-md-4 col-form-label text-md-right">Wadah</label>

    <div class="col-md-8">
        <input id="wadah" type="number" class="form-control" name="wadah" required>
        @if ($errors->has('wadah'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('wadah') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="stiker" class="col-md-4 col-form-label text-md-right">Stiker</label>

    <div class="col-md-8">
        <input id="stiker" type="number" class="form-control" name="stiker" required>
        @if ($errors->has('stiker'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('stiker') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="ongkir" class="col-md-4 col-form-label text-md-right">Ongkir</label>

    <div class="col-md-8">
        <input id="ongkir" type="number" class="form-control" name="ongkir" required>
        @if ($errors->has('ongkir'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('ongkir') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="amplop" class="col-md-4 col-form-label text-md-right">Amplop</label>

    <div class="col-md-8">
        <input id="amplop" type="number" class="form-control" name="amplop" required>
        @if ($errors->has('amplop'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('amplop') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="box" class="col-md-4 col-form-label text-md-right">Box</label>

    <div class="col-md-8">
        <input id="box" type="number" class="form-control" name="box" required>
        @if ($errors->has('box'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('box') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="brosur" class="col-md-4 col-form-label text-md-right">Brosur</label>

    <div class="col-md-8">
        <input id="brosur" type="number" class="form-control" name="brosur" required>
        @if ($errors->has('brosur'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('brosur') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="isolatip_wrap" class="col-md-4 col-form-label text-md-right">Isolatip / Wrap</label>

    <div class="col-md-8">
        <input id="isolatip_wrap" type="number" class="form-control" name="isolatip_wrap" required>
        @if ($errors->has('isolatip_wrap'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('isolatip_wrap') }}</strong>
        </span>
        @endif
    </div>
</div>

{{-- 
<div class="form-group row">
    <label for="diskon_reseller" class="col-md-4 col-form-label text-md-right">Diskon Reseller</label>

    <div class="col-md-8">
        <input id="diskon_reseller" type="number" class="form-control" name="diskon_reseller" required>
        @if ($errors->has('diskon_reseller'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('diskon_reseller') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="diskon_baru" class="col-md-4 col-form-label text-md-right">Diskon Baru</label>

    <div class="col-md-8">
        <input id="diskon_baru" type="number" class="form-control" name="diskon_baru" required>
        @if ($errors->has('diskon_baru'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('diskon_baru') }}</strong>
        </span>
        @endif
    </div>
</div> --}}
{!! FormField::select('supplier', $sup->pluck('name','name'), ['label' => 'Supplier', 'required' => true]) !!}
<div class="form-group row">
    <label for="min_stok" class="col-md-4 col-form-label text-md-right">min_stok</label>

    <div class="col-md-8">
        <input id="min_stok" type="number" class="form-control" name="min_stok" required>
        @if ($errors->has('min_stok'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('min_stok') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="sisa_stok" class="col-md-4 col-form-label text-md-right">sisa_stok Baru</label>

    <div class="col-md-8">
        <input id="sisa_stok" type="number" class="form-control" name="sisa_stok" required>
        @if ($errors->has('sisa_stok'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('sisa_stok') }}</strong>
        </span>
        @endif
    </div>
</div>
{!! Form::submit(__('product.create'), ['class' => 'btn btn-success']) !!}
{{ link_to_route('products.index', __('app.cancel'), [], ['class' => 'btn btn-default']) }}
{!! Form::close() !!}
@endif
@if (Request::get('action') == 'edit' && $editableProduct)
{!! Form::model($editableProduct, ['route' => ['products.update', $editableProduct->id],'method' => 'patch']) !!}
{!! FormField::text('name', ['label' => __('product.name'), 'required' => true]) !!}
<div class="row">
    <div class="col-md-6">{!! FormField::price('cash_price', ['label' => __('product.cash_price'), 'required' => true])
        !!}</div>
    <div class="col-md-6">{!! FormField::price('credit_price', ['label' => __('product.credit_price')]) !!}</div>
</div>

<div class="form-group row">
    <label for="jenis_produk" class="col-md-4 col-form-label text-md-right">{{
        __('Nama') }}</label>

    <div class="col-md-8">
        <input id="jenis_produk" type="text" class="form-control" name="jenis_produk" required autofocus>

        @if ($errors->has('jenis_produk'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('jenis_produk') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="kode_produk" class="col-md-4 col-form-label text-md-right">Kode Produk</label>

    <div class="col-md-8">
        <input id="kode_produk" type="text" class="form-control" name="kode_produk" required>

        @if ($errors->has('kode_produk'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('kode_produk') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="harga_kiloan" class="col-md-4 col-form-label text-md-right">Harga Kiloan</label>

    <div class="col-md-8">
        <input id="harga_kiloan" type="number" class="form-control" name="harga_kiloan" required>

        @if ($errors->has('harga_kiloan'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('harga_kiloan') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="harga_satuan" class="col-md-4 col-form-label text-md-right">Harga Satuan</label>

    <div class="col-md-8">
        <input id="harga_satuan" type="number" class="form-control" name="harga_satuan" required>
        @if ($errors->has('harga_satuan'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('harga_satuan') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="wadah" class="col-md-4 col-form-label text-md-right">Wadah</label>

    <div class="col-md-8">
        <input id="wadah" type="number" class="form-control" name="wadah" required>
        @if ($errors->has('wadah'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('wadah') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="stiker" class="col-md-4 col-form-label text-md-right">Stiker</label>

    <div class="col-md-8">
        <input id="stiker" type="number" class="form-control" name="stiker" required>
        @if ($errors->has('stiker'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('stiker') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="ongkir" class="col-md-4 col-form-label text-md-right">Ongkir</label>

    <div class="col-md-8">
        <input id="ongkir" type="number" class="form-control" name="ongkir" required>
        @if ($errors->has('ongkir'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('ongkir') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="amplop" class="col-md-4 col-form-label text-md-right">Amplop</label>

    <div class="col-md-8">
        <input id="amplop" type="number" class="form-control" name="amplop" required>
        @if ($errors->has('amplop'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('amplop') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="box" class="col-md-4 col-form-label text-md-right">Box</label>

    <div class="col-md-8">
        <input id="box" type="number" class="form-control" name="box" required>
        @if ($errors->has('box'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('box') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="brosur" class="col-md-4 col-form-label text-md-right">Brosur</label>

    <div class="col-md-8">
        <input id="brosur" type="number" class="form-control" name="brosur" required>
        @if ($errors->has('brosur'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('brosur') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="isolatip_wrap" class="col-md-4 col-form-label text-md-right">Isolatip / Wrap</label>

    <div class="col-md-8">
        <input id="isolatip_wrap" type="number" class="form-control" name="isolatip_wrap" required>
        @if ($errors->has('isolatip_wrap'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('isolatip_wrap') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="safety_factor" class="col-md-4 col-form-label text-md-right">Safety Factor</label>

    <div class="col-md-8">
        <input id="safety_factor" type="number" class="form-control" name="safety_factor" required>
        @if ($errors->has('safety_factor'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('safety_factor') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="harga_modal" class="col-md-4 col-form-label text-md-right">Harga Modal</label>

    <div class="col-md-8">
        <input id="harga_modal" type="number" class="form-control" name="harga_modal" required>
        @if ($errors->has('harga_modal'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('harga_modal') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="harga_jual" class="col-md-4 col-form-label text-md-right">Harga Jual</label>

    <div class="col-md-8">
        <input id="harga_jual" type="number" class="form-control" name="harga_jual" required>
        @if ($errors->has('harga_jual'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('harga_jual') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="profit" class="col-md-4 col-form-label text-md-right">Profit</label>

    <div class="col-md-8">
        <input id="profit" type="number" class="form-control" name="profit" required>
        @if ($errors->has('profit'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('profit') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="margin" class="col-md-4 col-form-label text-md-right">Margin</label>

    <div class="col-md-8">
        <input id="margin" type="number" class="form-control" name="margin" required>
        @if ($errors->has('margin'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('margin') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="harga_reseller" class="col-md-4 col-form-label text-md-right">Harga Reseller</label>

    <div class="col-md-8">
        <input id="harga_reseller" type="number" class="form-control" name="harga_reseller" required>
        @if ($errors->has('harga_reseller'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('harga_reseller') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="diskon_reseller" class="col-md-4 col-form-label text-md-right">Diskon Reseller</label>

    <div class="col-md-8">
        <input id="diskon_reseller" type="number" class="form-control" name="diskon_reseller" required>
        @if ($errors->has('diskon_reseller'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('diskon_reseller') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="diskon_baru" class="col-md-4 col-form-label text-md-right">Diskon Baru</label>

    <div class="col-md-8">
        <input id="diskon_baru" type="number" class="form-control" name="diskon_baru" required>
        @if ($errors->has('diskon_baru'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('diskon_baru') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="supplier" class="col-md-4 col-form-label text-md-right">supplier</label>

    <div class="col-md-8">
        <input id="supplier" type="text" class="form-control" name="supplier" required>
        @if ($errors->has('supplier'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('supplier') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="min_stok" class="col-md-4 col-form-label text-md-right">min_stok</label>

    <div class="col-md-8">
        <input id="min_stok" type="number" class="form-control" name="min_stok" required>
        @if ($errors->has('min_stok'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('min_stok') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="sisa_stok" class="col-md-4 col-form-label text-md-right">sisa_stok Baru</label>

    <div class="col-md-8">
        <input id="sisa_stok" type="number" class="form-control" name="sisa_stok" required>
        @if ($errors->has('sisa_stok'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('sisa_stok') }}</strong>
        </span>
        @endif
    </div>
</div>
@if (request('q'))
{{ Form::hidden('q', request('q')) }}
@endif
@if (request('page'))
{{ Form::hidden('page', request('page')) }}
@endif
{!! Form::submit(__('product.update'), ['class' => 'btn btn-success']) !!}
{{ link_to_route('products.index', __('app.cancel'), Request::only('q'), ['class' => 'btn btn-default']) }}
{!! Form::close() !!}
@endif
@if (Request::get('action') == 'delete' && $editableProduct)
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{ __('product.delete') }}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-condensed">
            <tbody>
                <tr>
                    <th>{{ __('product.name') }}</th>
                    <td>{{ $editableProduct->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('product.unit') }}</th>
                    <td>{{ $editableProduct->unit->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('product.cash_price') }}</th>
                    <td>{{ formatRp($editableProduct->cash_price) }}</td>
                </tr>
                <tr>
                    <th>{{ __('product.credit_price') }}</th>
                    <td>{{ formatRp($editableProduct->credit_price) }}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        {{ __('product.delete_confirm') }}
    </div>
    <div class="panel-footer">
        {!! FormField::delete(['route'=>['products.destroy',$editableProduct->id]], __('app.delete_confirm_button'), [
        'class'=>'btn btn-danger'
        ], [
        'product_id'=>$editableProduct->id,
        'page' => request('page'),
        'q' => request('q'),
        ]) !!}
        {{ link_to_route('products.index', __('app.cancel'), Request::only('q'), ['class' => 'btn btn-default']) }}
    </div>
</div>
@endif