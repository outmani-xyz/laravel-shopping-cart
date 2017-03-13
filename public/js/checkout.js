var $form = $('#checkout-form');
$form.submit(function (event) {
    $('#charge-error').addClass('hidden');
    Stripe.setPublishableKey('pk_test_I7amB1y2akLr0TfjsErqoxeB');
    Stripe.card.createToken({
        number: $('#card-number').val(),
        cvc: $('#card-cvc').val(),
        exp_month: $('#card-expiry-month').val(),
        exp_year: $('#card-expiry-year').val()
    }, stripeResponseHandler);
    return false;
});
function stripeResponseHandler(status, response) {
    $form.find('button').prop('disabled', true);
    if (response.error) {
        $('#charge-error').removeClass('hidden');
        $('#charge-error').text(response.error.message);
    } else {
        var token = response.id;
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // Submit the $form:
        $form.get(0).submit();
    }
    $form.find('button').prop('disabled', false);

}