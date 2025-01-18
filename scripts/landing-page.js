document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('.carousel');
    const items = document.querySelectorAll('.carousel-item');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let activeIndex = 0;

    function updateCarousel(newIndex) {
        // Remove active class and hide all items
        items.forEach((item) => {
            item.classList.remove('active');
            item.style.opacity = '0'; // Hide non-active items
        });

        // Add active class to the new active item
        items[newIndex].classList.add('active');
        items[newIndex].style.opacity = '1'; // Show active item

        activeIndex = newIndex;

        // Update carousel position to center the active item
        const containerWidth = carousel.parentElement.clientWidth;
        const itemWidth = items[0].clientWidth;
        const offset = -(newIndex * itemWidth) + (containerWidth / 2) - (itemWidth / 2);
        carousel.style.transform = `translateX(${offset}px)`;
    }

    // Arrow button functionality
    prevBtn.addEventListener('click', () => {
        const newIndex = (activeIndex - 1 + items.length) % items.length;
        updateCarousel(newIndex);
    });

    nextBtn.addEventListener('click', () => {
        const newIndex = (activeIndex + 1) % items.length;
        updateCarousel(newIndex);
    });

    // Initialize carousel
    updateCarousel(activeIndex);
});


window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    const navbar = document.querySelector('.navbar ul');
    const h2Element = document.querySelector('h2');  // Targeting the first h2 element
  
    // Get the position of the h2 element relative to the viewport
    const h2Top = h2Element.getBoundingClientRect().top;
  
    // Check if the h2 element is out of the viewport (scroll past it)
    if (window.scrollY > h2Top) {
      // Add sticky class to the header
      header.classList.add('sticky');
    } else {
      // Remove sticky class
      header.classList.remove('sticky');
    }
  });

  

  document.addEventListener("DOMContentLoaded", () => {
    const fadeInElements = document.querySelectorAll(".fade-in");
  
    const handleScroll = () => {
      fadeInElements.forEach((element) => {
        const rect = element.getBoundingClientRect();
        const windowHeight = window.innerHeight || document.documentElement.clientHeight;
  
        if (rect.top <= windowHeight - 50) {
          element.classList.add("visible");
        }
      });
    };
  
    // Add event listeners for scroll and initial load
    window.addEventListener("scroll", handleScroll);
    handleScroll(); // Trigger on load to catch elements already in view
  });

  // stat section number counter

  document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll(".stat-num");
    const speed = 200; // Adjust the speed (higher number = slower animation)
  
    const countUp = (element) => {
      const target = +element.innerText;
      const increment = Math.ceil(target / speed);
      let current = 0;
  
      const updateCounter = () => {
        current += increment;
        if (current > target) {
          current = target;
        }
        element.innerText = current.toLocaleString(); // Format with commas
        if (current < target) {
          requestAnimationFrame(updateCounter);
        }
      };
  
      updateCounter();
    };
  
    const observer = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const element = entry.target;
            countUp(element);
            observer.unobserve(element); // Stop observing once animation is triggered
          }
        });
      },
      { threshold: 0.5 } // Trigger when 50% of the section is visible
    );
  
    counters.forEach((counter) => observer.observe(counter));
  });
  