$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    $(".kycUpload").change(function() {
        var kycFile = this.files[0];
        var fileType = kycFile.type;
        var match = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'];
        if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]))){
            alert('Sorry, only PDF, JPG, JPEG, & PNG files are allowed to upload.');
            $(".kycUpload").val('');
            return false;
        }
    });

    $(".signature").change(function() {
        var kycFile = this.files[0];
        var fileType = kycFile.type;
        var match = ['image/jpeg', 'image/png', 'image/jpg'];
        if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))){
            alert('Sorry, only JPG, JPEG, & PNG files are allowed to upload.');
            $(".signature").val('');
            return false;
        }
    });
});