@extends('layouts.app')

@section('title', 'Entry Transaksi')

@section('content')
<div class="wrapper container">
        
    
<?php use Facades\App\Cart\CartCollection; ?>
@if (CartCollection::isEmpty())
<h3 class="page-header">Transaksi Penjualan</h3>
<form action="{{ route('cart.add') }}" method="POST">
    {{ csrf_field() }}
    <p class="text-muted">Silakan buat Transaksi Baru:</p>
    <input type="submit" class="btn btn-default navbar-btn" name="create-cash-draft" id="cash-draft-create-button"
        value="{{ trans('transaction.create_cash') }}">
    <input type="submit" class="btn btn-default navbar-btn" name="create-credit-draft" id="credit-draft-create-button"
        value="{{ trans('transaction.create_credit') }}">
</form>
@endif
@includeWhen(! CartCollection::isEmpty(), 'cart.partials.transaction-draft-tabs')
@if ($draft)
@if (Request::get('action') == 'confirm')
@include('cart.partials.draft-confirm')
@else
<div class="row">
    <div class="col-md-6">@include('cart.partials.product-search-box')</div>
    <div class="col-md-6">@include('cart.partials.draft-item-list')</div>
</div>
<div class="modal fade" id="modTambah" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <legend>{{ trans('transaction.detail') }}</legend>
                
            </div>
        </div>
    </div>
</div>
</div>
@endif
@endif
@endsection

@section('css')
<style>
input,
textarea {
  border: 1px solid #eeeeee;
  box-sizing: border-box;
  margin: 0;
  outline: none;
  padding: 10px;
}

input[type="button"] {
  -webkit-appearance: button;
  cursor: pointer;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.input-group {
  clear: both;
  margin: 15px 0;
  position: relative;
}

.input-group input[type='button'] {
  background-color: #eeeeee;
  min-width: 38px;
  width: auto;
  border:none;
  transition: all 300ms ease;
}

.input-group .button-minus,
.input-group .button-plus {
  font-weight: bold;
  height: 38px;
  padding: 0;
  width: 38px;
  border:none;
  position: relative;
}

.input-group .quantity-field {
  position: relative;
  height: 38px;
  left: -6px;
  text-align: center;
  width: 62px;
  display: inline-block;
  font-size: 13px;
  margin: 0 0 5px;
  resize: vertical;
}

.button-plus {
  left: -13px;
}

input[type="number"] {
  -moz-appearance: textfield;
  -webkit-appearance: none;
}

</style>
@endsection

@if ($draft)
@section('script')

<script>
    (function () {
        var delay = (function () {
            var timer = 0;
            return function (callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();

        $('#query').keyup(function () {
            delay(function () {
                var query = $('#query').val();
                if (query.length >= 3) {
                    $.post(
                        "{{ route('api.products.search') }}", {
                            query: query,
                            draftKey: '{{ $draft->draftKey }}',
                            draftType: '{{ $draft->type }}',
                            formToken: '{{ csrf_token() }}',
                        },
                        function (data) {
                            $('#product-search-result-box').html(data);
                        });
                }
            }, 200);
        });
    })();
</script>
<script>
    $('#dis_id').on('change', function (e) {
        console.log(e);
        var dis_id = e.target.value;
        $.get('../distributor/' + dis_id, function (data) {
            console.log(data);
            $('#csname').empty();
            //$('#csname').append('<option value="" disable="true" selected="true">Nama Dis</option>');

            $.each(data, function (index, Obj) {
                $('#csname').append('<option value="' + Obj.name + '">' + Obj.name +
                    '</option>');
                $('#csphone').append('<option value="' + Obj.no_telp + '">' + Obj.name +
                    '</option>');
                $('#csemail').append('<option value="' + Obj.email + '">' + Obj.email +
                    '</option>');
            })
        });
    });
</script>

<script>
    
    $(document).ready(function() {
			$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 0 ? 0 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});
		});
</script>

@endsection
@endif