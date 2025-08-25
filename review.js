// Modal functionality
const modal = document.getElementById("reviewModal");
const addReviewBtn = document.getElementById("addReviewBtn");
const closeBtn = document.querySelector(".close-btn");

// Open the modal
addReviewBtn.onclick = function() {
    modal.style.display = "block";
}

// Close the modal
closeBtn.onclick = function() {
    modal.style.display = "none";
}

// Close the modal if clicked outside
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const hiddenInput = document.getElementById('userReview');

    // Set up click event for each star
    stars.forEach(star => {
        star.addEventListener('click', function () {
            const rating = parseInt(this.getAttribute('data-value')); // Get the rating from the clicked star
            hiddenInput.value = rating;  // Set the hidden input value to the selected rating

            // Remove the selected class from all stars
            stars.forEach(star => star.classList.remove('selected'));

            // Add the selected class to the stars up to the clicked one
            for (let i = 0; i < rating; i++) {
                stars[i].classList.add('selected');
            }
        });
    });
});
