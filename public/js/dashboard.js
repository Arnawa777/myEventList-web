// Disable Fitur Upload Trix 
document.addEventListener('trix-file-accept', function (e) {
    e.preventDefault();
})

// Upload Preview
function previewImageData() {
    const image = document.querySelector('#picture');
    const imgPreview = document.querySelector('.img-preview');
    const blob = URL.createObjectURL(image.files[0]);
    imgPreview.src = blob;
}

function previewImageVideo() {
    const video = document.getElementById('video');
    const linkVideo = video.value;
    console.log(linkVideo);
    const imgVideoPreview = document.querySelector('.img-video-preview');
    const linkFirst = 'http://img.youtube.com/vi/';
    const linkLast = '/mqdefault.jpg';
    const linkYoutube = linkVideo.match(/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/);
    const blob = `${linkFirst}${linkYoutube[1]}${linkLast}`;
    imgVideoPreview.src = blob;
}

// Upload Preview User Profile
function previewImage() {
    const image = document.querySelector('#picture');
    const imgPreview = document.querySelector('.profile-preview');
    const blob = URL.createObjectURL(image.files[0]);
    imgPreview.src = blob;
}

$(document).ready(function () {
    $('input#deleteInput').wrap('<span class="deleteicon"></span>').after($('<span>x</span>').click(function () {
        $(this).prev('input').val('').trigger('change').focus();
    }));
});