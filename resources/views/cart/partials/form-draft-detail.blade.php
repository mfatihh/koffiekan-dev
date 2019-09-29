<legend>{{ trans('transaction.detail') }}</legend>
{{ Form::open(['route' => ['cart.draft-proccess', $draft->draftKey], 'method' => 'patch']) }}
{{-- {{ Form::open(['route' => ['transaksi.proses'], 'method' => 'post']) }} --}}
{!! FormField::text('customer[name]', ['label' => trans('transaction.customer_name'), 'value' => $draft->customer['name'], 'required' => true]) !!}
{!! FormField::text('diskon', ['label' => 'Diskon %']) !!}
<div class="row">
    <div class="col-md-6">{!! FormField::text('customer[phone]', ['label' => trans('transaction.customer_phone'), 'value' => $draft->customer['phone']]) !!}</div>
    <div class="col-md-6">{!! FormField::price('payment', ['label' => trans('transaction.payment'), 'value' => $draft->payment, 'required' => true]) !!}</div>
</div>
{!! FormField::text('potongan_harga') !!}
{!! FormField::text('jenis_pembayaran') !!}
{!! FormField::text('ongkir') !!}
{!! FormField::text('media_pembelian') !!}
{!! FormField::text('jasa_kirim') !!}
{!! FormField::text('l_b') !!}
{!! FormField::text('no_resi') !!}
{!! FormField::text('alamat_kirim') !!}
{!! FormField::text('kab_kota') !!}
{!! FormField::text('e_mail') !!}
{{ Form::hidden('total', $draft->getTotal()) }}
{!! FormField::textarea('notes', ['label' => trans('transaction.notes'), 'value' => $draft->notes]) !!}
{{ Form::submit(trans('transaction.proccess'), ['class' => 'btn btn-info']) }}
{{ Form::close() }}