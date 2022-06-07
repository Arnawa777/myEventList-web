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