@extends('layouts.app')

@section('content')
    <div class="py-12">
        @csrf
        <div id="dropin-container" style="display: flex;justify-content: center;align-items: center;"></div>
        <div style="display: flex;justify-content: center;align-items: center; color: white">
            <a id="submit-button" class="btn btn-sm btn-success">Submit payment</a>
        </div>
        <script>
            const button = document.querySelector('#submit-button');

            braintree.dropin.create({
                authorization: '{{ $token }}',
                container: '#dropin-container',
                locale: 'it_IT'
            }, function(createErr, instance) {
                button.addEventListener('click', function() {
                    instance.requestPaymentMethod(function(err, payload) {
                        axios.post('{{ route('admin.braintree') }}', {
                            nonce: payload.nonce,
                            sponsorship: 3
                        })
                    });
                });
                a
            });
        </script>
    </div>
@endsection

@section('scripts')
@endsection
