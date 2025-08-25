/*admin mssg*/

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
}

let accountBox =document.querySelector('.header .header-2 .flex .account-box');

    document.querySelector('#user-btn').onclick = () =>{
    accountBox.classList.toggle('active');
    }