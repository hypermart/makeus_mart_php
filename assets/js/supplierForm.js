//Bucket Configurations
var bucketName = "sample-files-big";
var bucketRegion = "us-east-2";
var IdentityPoolId = "us-east-2:33e1923d-3bc2-440b-90fc-a826d13ae01e";

AWS.config.update({
    region: bucketRegion,
    credentials: new AWS.CognitoIdentityCredentials({
        IdentityPoolId: IdentityPoolId
    })
});

var s3 = new AWS.S3({
    apiVersion: '2006-03-01',
    params: { Bucket: bucketName }
});

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

    $("#supplierRegistrationForm").validate({
        rules:{
            firstName: "required",
            //lastName: "required",
            //middleName: "required",
            //dateOfBirth: "required",
            'email':{
                email: true,
                required: true
            },
            'mobileNo':{
                required : true,
                minlength:10
            },
            companyName: "required"
            //addressLineOne: "required",
            //addressLineTwo: "required",
            //city: "required",
            //pincode: "required",
            //'kycUpload[]': {
            //    required : true
            //},
            //bankName: "required",
            //bankAddress: "required",
            //accountType: "required",
            //accountNumber: "required",
            //ifscCode: "required",
            //signature: "required"
        },
        messages: {
            firstName:"Please fill first name",
            //middleName:"Please fill middle name",
            //lastName:"Please fill last name",
            //dateOfBirth:"Please fill date of birth",
            email:{
                email:"Enter valid email",
                required:"Enter email address"
            },
            mobileNo:{
                minlength:"Please enter valid mobile no.",
                required:"Please enter mobile no."
            },
            companyName: "Please enter company name"
            //addressLineOne: "Please enter address line one",
            //addressLineTwo: "Please enter address line two",
            //city: "Please enter city",
            //pincode: "Please enter pincode",
            //kycUpload: "Please select file",
            //bankName: "Please enter bank name",
            //bankAddress: "Please enter bank address",
            //accountType: "Please enter account type",
            //accountNumber: "Please enter account number",
            //ifscCode: "Please enter ifsc code",
            //signature: "Please select signature"
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                type: 'POST',
                url: 'supplier.php',
                data: formData,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('.registerBtn').attr("disabled","disabled");
                    $('#supplierRegistrationForm').css("opacity",".5");
                },
                success: function(response){ 
                    //console.log("Response is" + response);
                    $("#supplierRegistrationForm")[0].reset();
                    $('#supplierRegistrationForm').css("opacity","");
                    $(".registerBtn").removeAttr("disabled");
                    $(".alert-message").html('<div class="alert alert-success alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            'Form is successfully submitted' +
                        '</div>');

                    //Uploading the CSV file to s3 bucket
                    var supplierCSV = [];
                    supplierCSV.push(response);
                    console.log("Response is" + JSON.stringify(supplierCSV));
                    
                    var fields = Object.keys(supplierCSV[0])
                    var replacer = function(key, value) { return value === null ? '' : value } 
                    var csv = supplierCSV.map(function(row){
                        return fields.map(function(fieldName){
                            return JSON.stringify(row[fieldName], replacer)
                        }).join(',')
                    })
                    csv.unshift(fields.join(',')) // add header column
                    csv = csv.join('\r\n');
                    //console.log(csv);
        
                    let fileToSave = new Blob([csv], {
                        type: "csv",
                        name: 'supplier.csv'
                    });
        
                    var BUCKET_REGION = "us-east-2";
                    var file = fileToSave;
                    var name = response.supplierCode;
                    var fileName = name + '.' + file.type;
                    var filePath = 'supplier-csvs/' + fileName;
                    var fileUrl = 'https://' + BUCKET_REGION + '.amazonaws.com/my-first-bucket/' + filePath;

                    s3.upload({
                        Key: filePath,
                        Body: file,
                        ACL: 'public-read'
                    }, function (err, data) {
                        if (err) {
                            console.log(err);
                        }
                        console.log('Successfully Uploaded!');
                    });
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