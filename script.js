
let userBox =document.querySelector('.header .header-2 .user-box');

document.querySelector('#user-btn').onclick = () =>{
    userBox.classList.toggle('active');
    
}

let navbar =document.querySelector('.header .header-2 .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    
}

var slideIndex = 0;
showSlides();

function plusSlides(n){
    showSlides(slideIndex += n, false); // Disable auto transition for manual navigation
}

function currentSlide(n){
    showSlides(slideIndex = n, false); // Disable auto transition for manual navigation
}

function showSlides(n = slideIndex, auto = true){
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    
    // If manual navigation was used, prevent the slideIndex from being incremented automatically
    if (n > slides.length) { slideIndex = 1; }
    if (n < 1) { slideIndex = slides.length; }
    
    // Hide all slides
    for (i = 0; i < slides.length; i++){
        slides[i].style.display = "none";
    }
    
    // Reset dots
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    
    // Only allow automatic transitions if auto is true
    if(auto) {
        slideIndex++;
        if(slideIndex > slides.length) {
            slideIndex = 1;
        }
        setTimeout(function(){ showSlides(slideIndex); }, 4000); // Auto transition every 4 seconds
    }
}
/*genre
const dropdownItems = document.querySelectorAll('.dropdown__item')

dropdownItems.forEach((item) =>{
    const dropdownButton = item.querySelector('.dropdown__button')

    dropdownButton.addEventListener('click', () =>{
        const showDropdown = document.querySelector('.show-dropdown')

       toggleItem(item)

       if(showDropdown && showDropdown!= item){
        toggleItem(showDropdown)

       }
    })
})

dropdownButton.addEventListener('mouseleave', () => {
    if (item.classList.contains('show-dropdown')) {
        console.log('Dropdown remains open')
    }
});

const toggleItem = (item) =>{
    const dropdownContainer = item.querySelector('.dropdown__container')


    if(item.classList.contains('show-dropdown')){
        dropdownContainer.removeAttribute('style')
            item.classList.remove('show-dropdown')
    } else{
        dropdownContainer.style.height = dropdownContainer.scrollHeight + 'px'
        item.classList.add('show-dropdown')
    }
}

dropdownButton.addEventListener('mouseleave', () => {
    if (item.classList.contains('show-dropdown')) {
        
    }
});
dropdownContainer.addEventListener('mouseleave', () => {
    leaveTimeout = setTimeout(() => {
        toggleItem(item);
    }, 500);
});

dropdownContainer.addEventListener('mouseenter', () => {
    clearTimeout(leaveTimeout);
});*/

/*admin productdropdownItems.forEach((item) => {
    const dropdownButton = item.querySelector('.dropdown__button');
    const dropdownContainer = item.querySelector('.dropdown__container');
    let leaveTimeout; // Variable to store timeout reference

    dropdownButton.addEventListener('click', () => {
        const showDropdown = document.querySelector('.show-dropdown');

        toggleItem(item);

        if (showDropdown && showDropdown !== item) {
            toggleItem(showDropdown);
        }
    });

    // Function to start delay before closing
    function startCloseDelay() {
        leaveTimeout = setTimeout(() => {
            console.log("Closing dropdown after delay"); // Debugging
            item.classList.remove('show-dropdown');
        }, 4000); // 4 seconds delay
    }

    // Ensure dropdown does not close if user hovers back
    function cancelCloseDelay() {
        clearTimeout(leaveTimeout);
        console.log("Canceling close delay"); // Debugging
    }

    // When the mouse leaves both the button and dropdown, start the delay
    item.addEventListener('mouseleave', startCloseDelay);

    // When mouse re-enters, stop the closing delay
    item.addEventListener('mouseenter', cancelCloseDelay);
});

const toggleItem = (item) => {
    const dropdownContainer = item.querySelector('.dropdown__container');

    if (item.classList.contains('show-dropdown')) {
        dropdownContainer.removeAttribute('style');
        item.classList.remove('show-dropdown');
    } else {
        dropdownContainer.style.height = dropdownContainer.scrollHeight + 'px';
        item.classList.add('show-dropdown');
    }
};


document.querySelector('#closing-update').onclick = () =>{
    document.querySelector('.edit-product-form').style.display = 'none';
    window.location.href = 'admin_products.php';
}
document.addEventListener('DOMContentLoaded', () => {
    const closeUpdateButton = document.querySelector('#close-update');

    if (closeUpdateButton) {
        console.log('Cancel button found!');
        closeUpdateButton.onclick = () => {
            console.log('Cancel button clicked!');
            document.querySelector('.edit-product-form').style.display = 'none';
            window.location.href = 'admin_products.php';
        };
    } else {
        console.log('Cancel button not found!');
    }
});*/

/*admin mssg

// Function to open the modal and set message ID and existing reply
function openReplyModal(messageId, existingReply) {
    document.getElementById('modalMessageId').value = messageId;
    document.getElementById('modalReply').value = existingReply;
    document.getElementById('replyModal').style.display = 'block';
}

// Function to close the modal
function closeReplyModal() {
    document.getElementById('replyModal').style.display = 'none';
}

// Close the modal if clicked outside of the modal content
window.onclick = function(event) {
    var modal = document.getElementById('replyModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}*/

/*document.addEventListener("DOMContentLoaded", function () {
    const dropdownItems = document.querySelectorAll('.dropdown__item');

    dropdownItems.forEach((item) => {
        const dropdownButton = item.querySelector('.dropdown__button');
        const dropdownContainer = item.querySelector('.dropdown__container');
        let leaveTimeout;

        if (dropdownButton) {
            dropdownButton.addEventListener('click', (event) => {
                console.log('Dropdown button clicked for:', item); // Add this line
                event.stopPropagation();

                const isOpen = item.classList.contains('show-dropdown');

                document.querySelectorAll('.show-dropdown').forEach(drop => {
                    drop.classList.remove('show-dropdown');
                });

                if (!isOpen) {
                    item.classList.add('show-dropdown');
                }
            });
        } else {
            console.log("dropdown button was not found in: ", item);
        }

        if (dropdownContainer) {
            dropdownContainer.addEventListener('click', (event) => {
                console.log("dropdown container clicked");
                event.stopPropagation();
            });
        }

        item.addEventListener('mouseleave', () => {
            leaveTimeout = setTimeout(() => {
                item.classList.remove('show-dropdown');
            }, 3000);
        });

        item.addEventListener('mouseenter', () => {
            clearTimeout(leaveTimeout);
        });
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.dropdown__item')) {
            document.querySelectorAll('.show-dropdown').forEach(drop => {
                drop.classList.remove('show-dropdown');
            });
        }
    });
});*/