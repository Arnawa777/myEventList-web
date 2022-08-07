    // Disable Fitur Upload Trix 
    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault();
    })

    // Upload Preview
    function previewImage(){
        const image = document.querySelector('#picture');
        const imgPreview = document.querySelector('.img-preview');
        const blob = URL.createObjectURL(image.files[0]);
        imgPreview.src = blob;
    } 


    // Upload Preview User Profile
    function previewImage(){
        const image = document.querySelector('#picture');
        const imgPreview = document.querySelector('.profile-preview');
        const blob = URL.createObjectURL(image.files[0]);
        imgPreview.src = blob;
    }