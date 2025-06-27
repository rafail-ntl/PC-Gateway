document.addEventListener("DOMContentLoaded", function() {
    const sortSelect = document.getElementById('sort');
    const filterSelect = document.getElementById('filter');

    sortSelect.addEventListener('change', () => {
        sortProducts(sortSelect.value);
    });

    filterSelect.addEventListener('change', () => {
        filterProducts(filterSelect.value);
    });
});

function sortProducts(criteria) {
    const container = document.querySelector('.pro-container');
    const products = container.querySelectorAll('.pro');
    const sortedProducts = Array.from(products);

    sortedProducts.sort((a, b) => {
        let aPrice = parseFloat(a.querySelector('h4').textContent.replace(/[^0-9.]/g, ''));
        let bPrice = parseFloat(b.querySelector('h4').textContent.replace(/[^0-9.]/g, ''));

        switch (criteria) {
            case 'az':
                return a.querySelector('.des span').textContent.localeCompare(b.querySelector('.des span').textContent);
            case 'za':
                return b.querySelector('.des span').textContent.localeCompare(a.querySelector('.des span').textContent);
            case 'lowtohigh':
                return aPrice - bPrice;
            case 'hightolow':
                return bPrice - aPrice;
            default:
                return 0;
        }
    });

    container.innerHTML = '';
    sortedProducts.forEach(product => {
        container.appendChild(product);
    });
}



function filterProducts(category) {
    const container = document.querySelector('.pro-container');
    const products = container.querySelectorAll('.pro');

    products.forEach(product => {
        const productCategory = product.querySelector('.des span').textContent;

        if (category === 'all' || productCategory === category) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}
