const smallImages = document.querySelectorAll('.small-img-group .small-img');
const mainImage = document.getElementById('main-img');


smallImages.forEach(img => {
    img.addEventListener('click', function() {
        mainImage.src = this.src;
    });
});
