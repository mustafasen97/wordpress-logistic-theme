document.addEventListener('DOMContentLoaded', function () {
  // --- Homepage Logic ---
  if (document.querySelector('#services-slider')) {
    new Splide('#services-slider', {
      type: 'loop',
      perPage: 4,
      focus: 'center',
      padding: '10%',
      gap: '0',
      arrows: true,
      pagination: true,
      autoplay: true,
      interval: 5000,
      breakpoints: {
        1024: { perPage: 2, padding: '10%' },
        768: { perPage: 1, padding: '15%' }
      }
    }).mount();
  }

  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('is-open');
    });
  }

  document.querySelectorAll('.faq-trigger').forEach(trigger => {
    trigger.addEventListener('click', function () {
      const parent = this.parentElement;

      document.querySelectorAll('.faq-item').forEach(item => {
        if (item !== parent) item.classList.remove('active');
      });

      parent.classList.toggle('active');
    });
  });

  // --- Services Page Logic (Animation Observer) ---
  const fadeElements = document.querySelectorAll('.service-box, .process-item');
  
  if (fadeElements.length > 0) {
    const observerOptions = {
      threshold: 0.1,
      rootMargin: "0px 0px -50px 0px"
    };

    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = "1";
          entry.target.style.transform = "translateY(0)";
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    fadeElements.forEach(el => {
      // Set initial state via JS to avoid hiding content if JS fails
      el.style.opacity = "0";
      el.style.transform = "translateY(20px)";
      el.style.transition = "opacity 0.6s ease-out, transform 0.6s ease-out";
      observer.observe(el);
    });
  }
});
