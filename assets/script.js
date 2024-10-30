   // Hamburger menu logic
document.addEventListener('DOMContentLoaded', function() {
    const hamMenu = document.querySelector('#mobileLink');
    const offScreenMenu = document.querySelector('#offScreenMenu');

    hamMenu.addEventListener('click', () => {
        hamMenu.classList.toggle('active');
        offScreenMenu.classList.toggle('active');

        console.log("Hamburger clicked");

        document.querySelector('.m1').classList.toggle('active');
        document.querySelector('.m2').classList.toggle('active');
        document.querySelector('.m3').classList.toggle('active');
    });

    // Typing effect logic
    const dynamicText = document.querySelector(".homeContainer h1 span");
    const words = ["Investment", "Savings", "Budgeting", "Financial Freedom"];

    let wordIndex = 0;
    let charIndex = 0;
    let isDeleting = false;

    const typeEffect = () => {
        const currentWord = words[wordIndex];
        const currentChar = currentWord.substring(0, charIndex);
        dynamicText.textContent = currentChar;

        if (!isDeleting && charIndex < currentWord.length) {
            charIndex++;
            setTimeout(typeEffect, 200);
        } else if (isDeleting && charIndex > 0) {
            charIndex--;
            setTimeout(typeEffect, 100);
        } else {
            isDeleting = !isDeleting;
            wordIndex = !isDeleting ? (wordIndex + 1) % words.length : wordIndex;
            setTimeout(typeEffect, 1200);
        }
    }

    typeEffect();
});
