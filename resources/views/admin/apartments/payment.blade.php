@extends('layouts.app')

@section('title', 'Pagamento')

@section('content')


  <form id="payment-form" action="" method="post" class="my-4">

    {{-- empty container for the Drop-I-in --}}
    <div id="dropin-container"></div>
    <input class="btn btn-success" type="submit" id="submit-button" />
    <input type="hidden" id="nonce" name="payment_method_nonce" />
  </form>
@endsection

@section('scripts')
  <script>
    const form = document.getElementById('payment-form');

    braintree.dropin.create({
      authorization: '{{ $token }}',
      container: '#dropin-container'
    }, function(createErr, instance) {
      form.addEventListener('submit', function() {
        instance.requestPaymentMethod(function(err, payload) {
          axios.post('{{ route('admin.apartments.payment', $token) }}', {
            nonce: payload.nonce,
            sponsorship: 3
          })
        })
      })
    });
  </script>

@endsection
