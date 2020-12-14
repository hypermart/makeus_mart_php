$(document).ready(function(e){
    $("#kycUpload").change(function() {
        var kycFile = this.files[0];
        var fileType = kycFile.type;
        var match = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'];
        if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]))){
            alert('Sorry, only PDF, JPG, JPEG, & PNG files are allowed to upload.');
            $("#kycUpload").val('');
            return false;
        }
    });

    $("#registrationForm").validate({
        rules:{
            firstName: "required",
            lastName: "required",
            middleName: "required",
            dateOfBirth: "required",
            'email':{
                email: true,
                required: true
            },
            'mobileNo':{
                required : true,
                minlength:10
            },
            addressLineOne: "required",
            addressLineTwo: "required",
            city: "required",
            pincode: "required",
            'kycUpload[]': {
                required : true
            },
            bankName: "required",
            bankAddress: "required",
            accountType: "required",
            accountNumber: "required",
            ifscCode: "required",
            signature: "required"
        },
        messages: {
            firstName:"Please fill first name",
            middleName:"Please fill middle name",
            lastName:"Please fill last name",
            dateOfBirth:"Please fill date of birth",
            email:{
                email:"Enter valid email",
                required:"Enter email address"
            },
            mobileNo:{
                minlength:"Please enter valid mobile no.",
                required:"Please enter mobile no."
            },
            addressLineOne: "Please enter address line one",
            addressLineTwo: "Please enter address line two",
            city: "Please enter city",
            pincode: "Please enter pincode",
            kycUpload: "Please select file",
            bankName: "Please enter bank name",
            bankAddress: "Please enter bank address",
            accountType: "Please enter account type",
            accountNumber: "Please enter account number",
            ifscCode: "Please enter ifsc code",
            signature: "Please select signature"
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                type: 'POST',
                url: 'influencer.php',
                data: formData,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('.registerBtn').attr("disabled","disabled");
                    $('#registrationForm').css("opacity",".5");
                },
                success: function(response){ 
                    console.log("Response is" + response);
                    $("#registrationForm")[0].reset();
                    $('#registrationForm').css("opacity","");
                    $(".registerBtn").removeAttr("disabled");
                    $(".alert-message").html('<div class="alert alert-success alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            'Form is successfully submitted' +
                        '</div>');
                },
                error: function(err) {
                    console.log("Error is " + JSON.stringify(err));
                    $(".alert-message").html('<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            'Something went wrong' +
                        '</div>');
                }
            });
        }
    });  
});