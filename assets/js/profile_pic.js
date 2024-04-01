// Get reference to the input field and the preview image element
const uploadInput = document.getElementById('profile');
const previewImg = document.getElementById('previewImg');

// Add event listener to the input field
uploadInput.addEventListener('change', function() {
// Check if any file is selected
if (uploadInput.files && uploadInput.files[0]) {
    // Create a FileReader object
    const reader = new FileReader();

    // Set the image file to be read by the FileReader
    reader.readAsDataURL(uploadInput.files[0]);

    // Set up the onload event to set the src attribute of the preview image
    reader.onload = function(e) {
    previewImg.src = e.target.result; // Set the src attribute with the data URL
    previewImg.style.display = 'block'; // Make the preview image visible
    };
}
});