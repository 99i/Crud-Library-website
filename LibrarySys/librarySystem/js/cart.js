document.addEventListener('DOMContentLoaded', () => {
    const quantityInputs = document.querySelectorAll('input[type="number"]');
    const totalPriceElement = document.getElementById('total-price');

    if (!quantityInputs.length || !totalPriceElement) return;

    const updateTotalPrice = () => {
        let total = 0;

        quantityInputs.forEach(input => {
            const itemPrice = parseFloat(
                input.closest('figure').querySelector('p').textContent.replace('Price: $', '').trim()
            );

            const itemQuantity = parseInt(input.value) || 0;
            total += itemPrice * itemQuantity;
        });

        totalPriceElement.textContent = total.toFixed(2);
    };

    quantityInputs.forEach(input => {
        input.addEventListener('input', updateTotalPrice);
    });
});
