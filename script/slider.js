
  let currentSlide = 0;
  const slides = document.querySelectorAll('.slider .slide');

  function showNextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
  }

  setInterval(showNextSlide, 4000);


   // Hamburger toggle
  const hamburger = document.querySelector('.hamburger');
  const nav = document.querySelector('.navbar nav');
  
  hamburger.addEventListener('click', () => {
    nav.classList.toggle('active');
    hamburger.textContent = nav.classList.contains('active') ? '✕' : '☰';
    document.body.style.overflow = nav.classList.contains('active') ? 'hidden' : '';
  });
  
  // Close menu when clicking links
  document.querySelectorAll('.navbar nav a').forEach(link => {
    link.addEventListener('click', () => {
      nav.classList.remove('active');
      hamburger.textContent = '☰';
      document.body.style.overflow = '';
    });
  });