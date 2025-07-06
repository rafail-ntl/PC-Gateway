document.addEventListener('DOMContentLoaded', function () {
  const slider = document.querySelector('.slider');
  const prevBtn = document.querySelector('.prev');
  const nextBtn = document.querySelector('.next');
  const dotsContainer = document.querySelector('.slider-dots');
  const sliderWrapper = document.querySelector('.slider-wrapper');

  const MOBILE_BREAKPOINT = 768;
  const slideInterval = 5000;

  let originalSlides = Array.from(document.querySelectorAll('.slide'));
  let allSlides = [];
  let currentIndex = 0;
  let isMobile = window.innerWidth < MOBILE_BREAKPOINT;
  let isAnimating = false;
  let autoSlideInterval;

  function handleAddToCart(event) {
    event.preventDefault();
    const form = event.target.closest('form');
    const button = form.querySelector('button[type="submit"]');
    const originalText = button.textContent;

    button.disabled = true;

    fetch(form.action, {
      method: 'POST',
      body: new FormData(form)
    })
      .then(response => {
        if (response.ok) {
          window.location.reload();
        } else {
          alert('Error adding to cart');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An error occurred');
      })
      .finally(() => {
        button.textContent = originalText;
        button.disabled = false;
      });
  }

  function getVisibleSlideCount() {
    return isMobile ? 1 : 3;
  }

  function updateSlider(animate = true) {
    const slideWidth = sliderWrapper.clientWidth / getVisibleSlideCount();
    slider.style.transition = animate ? 'transform 0.5s ease' : 'none';
    slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    updateDots();
  }

  function createDots() {
    for (let i = 0; i < originalSlides.length; i++) {
      const dot = document.createElement('span');
      dot.dataset.index = i;
      dot.classList.toggle('active', i === getRealIndex());
      dot.addEventListener('click', () => goToSlide(i));
      dotsContainer.appendChild(dot);
    }
  }

  function updateDots() {
    const dots = dotsContainer.querySelectorAll('span');
    dots.forEach((dot, index) => {
      dot.classList.toggle('active', index === getRealIndex());
    });
  }

  function getRealIndex() {
    return currentIndex - 1;
  }

  function goToSlide(index) {
    const target = index + 1;
    navigateTo(target);
  }

  function navigate(offset) {
    if (isAnimating) return;
    isAnimating = true;
    currentIndex += offset;
    updateSlider(true);

    slider.addEventListener('transitionend', onTransitionEnd, { once: true });
  }

  function onTransitionEnd() {
    const lastRealIndex = originalSlides.length + 1;
    if (currentIndex >= lastRealIndex) {
      currentIndex = 1;
      updateSlider(false);
    } else if (currentIndex < 1) {
      currentIndex = originalSlides.length;
      updateSlider(false);
    }
    isAnimating = false;
  }

  function navigateTo(index) {
    if (isAnimating) return;
    isAnimating = true;
    currentIndex = index;
    updateSlider(true);
    slider.addEventListener('transitionend', () => {
      isAnimating = false;
    }, { once: true });
  }

  function nextSlide() {
    navigate(1);
    resetAutoSlide();
  }

  function prevSlide() {
    navigate(-1);
    resetAutoSlide();
  }

  function startAutoSlide() {
    autoSlideInterval = setInterval(() => {
      nextSlide();
    }, slideInterval);
  }

  function resetAutoSlide() {
    clearInterval(autoSlideInterval);
    startAutoSlide();
  }

  function initializeSlider() {
    isMobile = window.innerWidth < MOBILE_BREAKPOINT;
    slider.innerHTML = '';
    dotsContainer.innerHTML = '';
    isAnimating = false;
    clearInterval(autoSlideInterval);

    let clonesBefore = [];
    let clonesAfter = [];

    if (isMobile) {
      clonesBefore = [originalSlides[originalSlides.length - 1].cloneNode(true)];
      clonesAfter = [originalSlides[0].cloneNode(true)];
      currentIndex = 1;
    } else {
      clonesBefore = [
        originalSlides[originalSlides.length - 2].cloneNode(true),
        originalSlides[originalSlides.length - 1].cloneNode(true),
      ];
      clonesAfter = [
        originalSlides[0].cloneNode(true),
        originalSlides[1].cloneNode(true),
      ];
      currentIndex = 1;
    }

    clonesBefore.forEach(clone => slider.appendChild(clone));
    originalSlides.forEach(slide => slider.appendChild(slide.cloneNode(true)));
    clonesAfter.forEach(clone => slider.appendChild(clone));

    allSlides = slider.querySelectorAll('.slide');

    document.querySelectorAll('.add-to-cart-form').forEach(form => {
      form.addEventListener('submit', handleAddToCart);
    });

    createDots();
    updateSlider(false);
    startAutoSlide();
  }

  prevBtn.addEventListener('click', prevSlide);
  nextBtn.addEventListener('click', nextSlide);

  window.addEventListener('resize', () => {
    const nowMobile = window.innerWidth < MOBILE_BREAKPOINT;
    if (nowMobile !== isMobile) {
      initializeSlider();
    } else {
      updateSlider(false);
    }
  });

  let touchStartX = 0;
  slider.addEventListener('touchstart', (e) => {
    touchStartX = e.touches[0].clientX;
    clearInterval(autoSlideInterval);
  }, { passive: true });

  slider.addEventListener('touchend', (e) => {
    const touchEndX = e.changedTouches[0].clientX;
    const diff = touchStartX - touchEndX;

    if (Math.abs(diff) > 50) {
      diff > 0 ? nextSlide() : prevSlide();
    } else {
      resetAutoSlide();
    }
  }, { passive: true });

  slider.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
  slider.addEventListener('mouseleave', resetAutoSlide);

  initializeSlider();
});
document.addEventListener('DOMContentLoaded', function () {
  const slider = document.querySelector('.slider');
  const prevBtn = document.querySelector('.prev');
  const nextBtn = document.querySelector('.next');
  const dotsContainer = document.querySelector('.slider-dots');
  const sliderWrapper = document.querySelector('.slider-wrapper');

  const MOBILE_BREAKPOINT = 768;
  const slideInterval = 5000;

  let originalSlides = Array.from(document.querySelectorAll('.slide'));
  let allSlides = [];
  let currentIndex = 0;
  let isMobile = window.innerWidth < MOBILE_BREAKPOINT;
  let isAnimating = false;
  let autoSlideInterval;

  function handleAddToCart(event) {
    event.preventDefault();
    const form = event.target.closest('form');
    const button = form.querySelector('button[type="submit"]');
    const originalText = button.textContent;

    button.disabled = true;

    fetch(form.action, {
      method: 'POST',
      body: new FormData(form)
    })
      .then(response => {
        if (response.ok) {
          window.location.reload();
        } else {
          alert('Error adding to cart');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An error occurred');
      })
      .finally(() => {
        button.textContent = originalText;
        button.disabled = false;
      });
  }

  function getVisibleSlideCount() {
    return isMobile ? 1 : 3;
  }

  function updateSlider(animate = true) {
    const slideWidth = sliderWrapper.clientWidth / getVisibleSlideCount();
    slider.style.transition = animate ? 'transform 0.5s ease' : 'none';
    slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    updateDots();
  }

  function createDots() {
    for (let i = 0; i < originalSlides.length; i++) {
      const dot = document.createElement('span');
      dot.dataset.index = i;
      dot.classList.toggle('active', i === getRealIndex());
      dot.addEventListener('click', () => goToSlide(i));
      dotsContainer.appendChild(dot);
    }
  }

  function updateDots() {
    const dots = dotsContainer.querySelectorAll('span');
    dots.forEach((dot, index) => {
      dot.classList.toggle('active', index === getRealIndex());
    });
  }

  function getRealIndex() {
    return currentIndex - 1;
  }

  function goToSlide(index) {
    const target = index + 1;
    navigateTo(target);
  }

  function navigate(offset) {
    if (isAnimating) return;
    isAnimating = true;
    currentIndex += offset;
    updateSlider(true);

    slider.addEventListener('transitionend', onTransitionEnd, { once: true });
  }

  function onTransitionEnd() {
    const lastRealIndex = originalSlides.length + 1;
    if (currentIndex >= lastRealIndex) {
      currentIndex = 1;
      updateSlider(false);
    } else if (currentIndex < 1) {
      currentIndex = originalSlides.length;
      updateSlider(false);
    }
    isAnimating = false;
  }

  function navigateTo(index) {
    if (isAnimating) return;
    isAnimating = true;
    currentIndex = index;
    updateSlider(true);
    slider.addEventListener('transitionend', () => {
      isAnimating = false;
    }, { once: true });
  }

  function nextSlide() {
    navigate(1);
    resetAutoSlide();
  }

  function prevSlide() {
    navigate(-1);
    resetAutoSlide();
  }

  function startAutoSlide() {
    autoSlideInterval = setInterval(() => {
      nextSlide();
    }, slideInterval);
  }

  function resetAutoSlide() {
    clearInterval(autoSlideInterval);
    startAutoSlide();
  }

  function initializeSlider() {
    isMobile = window.innerWidth < MOBILE_BREAKPOINT;
    slider.innerHTML = '';
    dotsContainer.innerHTML = '';
    isAnimating = false;
    clearInterval(autoSlideInterval);

    let clonesBefore = [];
    let clonesAfter = [];

    if (isMobile) {
      clonesBefore = [originalSlides[originalSlides.length - 1].cloneNode(true)];
      clonesAfter = [originalSlides[0].cloneNode(true)];
      currentIndex = 1;
    } else {
      clonesBefore = [
        originalSlides[originalSlides.length - 2].cloneNode(true),
        originalSlides[originalSlides.length - 1].cloneNode(true),
      ];
      clonesAfter = [
        originalSlides[0].cloneNode(true),
        originalSlides[1].cloneNode(true),
      ];
      currentIndex = 1;
    }

    clonesBefore.forEach(clone => slider.appendChild(clone));
    originalSlides.forEach(slide => slider.appendChild(slide.cloneNode(true)));
    clonesAfter.forEach(clone => slider.appendChild(clone));

    allSlides = slider.querySelectorAll('.slide');

    document.querySelectorAll('.add-to-cart-form').forEach(form => {
      form.addEventListener('submit', handleAddToCart);
    });

    createDots();
    updateSlider(false);
    startAutoSlide();
  }

  prevBtn.addEventListener('click', prevSlide);
  nextBtn.addEventListener('click', nextSlide);

  window.addEventListener('resize', () => {
    const nowMobile = window.innerWidth < MOBILE_BREAKPOINT;
    if (nowMobile !== isMobile) {
      initializeSlider();
    } else {
      updateSlider(false);
    }
  });

  let touchStartX = 0;
  slider.addEventListener('touchstart', (e) => {
    touchStartX = e.touches[0].clientX;
    clearInterval(autoSlideInterval);
  }, { passive: true });

  slider.addEventListener('touchend', (e) => {
    const touchEndX = e.changedTouches[0].clientX;
    const diff = touchStartX - touchEndX;

    if (Math.abs(diff) > 50) {
      diff > 0 ? nextSlide() : prevSlide();
    } else {
      resetAutoSlide();
    }
  }, { passive: true });

  slider.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
  slider.addEventListener('mouseleave', resetAutoSlide);

  initializeSlider();
});
