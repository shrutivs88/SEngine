var whiteSpaceRegEx = /\s/g;
var alphabetsWithWhiteSpaceRegEx = /\w+/g;
var phoneRegEx = /^\d{10}$/;
var emailRegEx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
contactFirstName = "";
contactFirstNameErrFlag = true;
contactFirstNameErrMsg = "";
contactLastName = "";
contactLastNameErrFlag = true;
contactLastNameErrMsg = "";
contactEmail = "";
contactEmailErrFlag = true;
contactEmailErrMsg = "";
contactCategory = "";
contactCategoryErrFlag = true;
contactCategoryErrMsg = "";
contactDesignation = "";
contactDesignationErrFlag = true;
contactDesignationErrMsg = "";
contactPhone1= "";
contactPhone1ErrFlag = true;
contactPhone1ErrMsg = "";
contactPhone2= "";
contactPhone2ErrFlag = true;
contactPhone2ErrMsg = "";
contactCountry = "";
contactCountryErrFlag = true;
contactCountryErrMsg = "";
contactState = "";
contactStateErrFlag = true;
contactStateErrMsg = "";
contactCity = "";
contactCityErrFlag = true;
contactCityErrMsg = "";
contactLinkedIn = "";
contactLinkedInErrFlag = true;
contactLinkedInErrMsg = "";
contactFacebook = "";
contactFacebookErrFlag = true;
contactFacebookErrMsg = "";
contactTwitter = "";
contactTwitterErrFlag = true;
contactTwitterErrMsg = "";
contactAddress = "";
contactAddressErrFlag = true;
contactAddressErrMsg = "";

function validateContactFirstName() {
    var inputElement = $("#contact-first-name-div input");
    var errorElement = $("#contact-first-name-div p");
    contactFirstName = inputElement.val();
    contactFirstNameErrFlag = false;
    contactFirstNameErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactFirstName == "" || contactFirstName == null || contactFirstName == undefined) {
        contactFirstNameErrFlag = true;
        contactFirstNameErrMsg = "First Name Is Required !";
        inputElement.css({"border-color":"red"});
    } else if(contactFirstName.match(whiteSpaceRegEx)) {
        contactFirstNameErrFlag = true;
        contactFirstNameErrMsg = "Whitespace Is Not Allowed !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactFirstNameErrMsg);
}

function validateContactLastName() {
    var inputElement = $("#contact-last-name-div input");
    var errorElement = $("#contact-last-name-div p");
    contactLastName = inputElement.val();
    contactLastNameErrFlag = false;
    contactLastNameErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactLastName == "" || contactLastName == null || contactLastName == undefined) {
        contactLastNameErrFlag = true;
        contactLastNameErrMsg = "Last Name Is Required !";
        inputElement.css({"border-color":"red"});
    } else if(contactLastName.match(whiteSpaceRegEx)) {
        contactLastNameErrFlag = true;
        contactLastNameErrMsg = "Whitespace Is Not Allowed !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactLastNameErrMsg);
}

function validateContactEmail() {
    var inputElement = $("#contact-email-div input");
    var errorElement = $("#contact-email-div p");
    contactEmail = inputElement.val();
    contactEmailErrFlag = false;
    contactEmailErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactEmail == "" || contactEmail == null || contactEmail == undefined) {
        contactEmailErrFlag = true;
        contactEmailErrMsg = "Email Is Required !";
        inputElement.css({"border-color":"red"});
    } else if(contactEmail.match(whiteSpaceRegEx)) {
        contactEmailErrFlag = true;
        contactEmailErrMsg = "Whitespace Is Not Allowed !";
        inputElement.css({"border-color":"red"});
    } else if(!contactEmail.match(emailRegEx)) {
        contactEmailErrFlag = true;
        contactEmailErrMsg = "E-Mail Format Is Not Valid !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactEmailErrMsg);
}

function validateContactEmail2() {
    var inputElement = $("#contact-email2-div input");
    var errorElement = $("#contact-email2-div p");
    contactEmail = inputElement.val();
    contactEmailErrFlag = false;
    contactEmailErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactEmail == "" || contactEmail == null || contactEmail == undefined) {
        contactEmailErrFlag = false;
      //  contactEmailErrMsg = "Second Email Is Required !";
      //  inputElement.css({"border-color":"red"});
    } else if(contactEmail.match(whiteSpaceRegEx)) {
        contactEmailErrFlag = true;
        contactEmailErrMsg = "Whitespace Is Not Allowed !";
        inputElement.css({"border-color":"red"});
    } else if(!contactEmail.match(emailRegEx)) {
        contactEmailErrFlag = true;
        contactEmailErrMsg = "E-Mail Format Is Not Valid !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactEmailErrMsg);
}

function validateContactEmail3() {
    var inputElement = $("#contact-email3-div input");
    var errorElement = $("#contact-email3-div p");
    contactEmail = inputElement.val();
    contactEmailErrFlag = false;
    contactEmailErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactEmail == "" || contactEmail == null || contactEmail == undefined) {
        contactEmailErrFlag = false;
        //contactEmailErrMsg = "Third Email Is Required !";
       // inputElement.css({"border-color":"red"});
    } else if(contactEmail.match(whiteSpaceRegEx)) {
        contactEmailErrFlag = true;
        contactEmailErrMsg = "Whitespace Is Not Allowed !";
        inputElement.css({"border-color":"red"});
    } else if(!contactEmail.match(emailRegEx)) {
        contactEmailErrFlag = true;
        contactEmailErrMsg = "E-Mail Format Is Not Valid !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactEmailErrMsg);
}
// this below validation is for email through company list to add client 

function validateClientEmails1()
{
    var clientEmail = $("#contact-email-div input").val();
    EmailRegEx= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    contactEmailErrFlag = false;
    contactEmailErrMsg = "";
    $("#contact-email-div input").css({"border":"1px solid green"});
    if(clientEmail=="")
    {
        contactEmailErrFlag = true;
        $("#contact-email-div input").css({"border":"1px solid red"}) ;
        contactEmailErrMsg="Email Is Required !";
    }
    else if(clientEmail.match(whiteSpaceRegEx)) {
        contactEmailErrFlag = true;
        contactEmailErrMsg = "Whitespace Is Not Allowed !";
        $("#contact-email-div input").css({"border-color":"red"});
        $("#contact-email-div p").text(contactEmailErrMsg);
    }
    else if(!EmailRegEx.test(clientEmail))
    {
        $("#contact-email-div input").css({"border":"1px solid red"}) ;   
    }
    $("#contact-email-div p").text(contactEmailErrMsg);
}



function validateClientEmails2()

{
    var clientEmail2 = $("#contact-email2-div input").val();
        EmailRegEx2= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        contactEmailErrFlag = false;
        contactEmailErrMsg = "";
       $("#contact-email2-div input").css({"border":"1px solid green"});
        if(clientEmail2=="")
        {
           contactEmailErrFlag = false;
          $("#contact-email2-div input").css({"border":""}) ;
           
        }
        else if(clientEmail2.match(whiteSpaceRegEx)) 
        {
            contactEmailErrFlag = true;
            contactEmailErrMsg = "Whitespace Is Not Allowed !";
            $("#contact-email2-div input").css({"border-color":"red"});
            $("#contact-email2-div p").text(contactEmailErrMsg);
        }
        else if(!EmailRegEx2.test(clientEmail2))
        {
            contactEmailErrFlag = true;
            $("#contact-email2-div input").css({"border":"1px solid red"}) ;   
            contactEmailErrMsg="Email Fromat is Wrong Please Re-enter !";  
        }
        $("#contact-email2-div p").text(contactEmailErrMsg);

}



function validateClientEmails3()
{
    var clientEmail3 = $("#contact-email3-div input").val();
    EmailRegEx3= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    contactEmailErrFlag = false;
    contactEmailErrMsg = "";
    $("#contact-email3-div input").css({"border":"1px solid green"});
    if(clientEmail3=="")
    {
        contactEmailErrFlag = false;
        $("#contact-email3-div input").css({"border":""}) ;
      
    } 
    else if(clientEmail3.match(whiteSpaceRegEx)) {
        contactEmailErrFlag = true;
        contactEmailErrMsg = "Whitespace Is Not Allowed !";
        $("#contact-email3-div input").css({"border-color":"red"});
        $("#contact-email3-div p").text(contactEmailErrMsg);
    }
    else if(!EmailRegEx3.test(clientEmail3))
    {
        contactEmailErrFlag = true;
        $("#contact-email3-div input").css({"border":"1px solid red"}) ;
        contactEmailErrMsg="Email Fromat is Wrong Please Re-enter !";    
    }
        $("#contact-email3-div p").text(contactEmailErrMsg);
}



function validateContactCategory() {
    var inputElement = $("#contact-category-div input");
    var errorElement = $("#contact-category-div p");
    contactCategory = inputElement.val();
    contactCategoryErrFlag = false;
    contactCategoryErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactCategory == "" || contactCategory == null || contactCategory == undefined) {
        contactCategoryErrFlag = true;
        contactCategoryErrMsg = "Category Is Required !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactCategoryErrMsg);
}

function validateContactDesignation() {
    var inputElement = $("#contact-designation-div input");
    var errorElement = $("#contact-designation-div p");
    contactDesignation = inputElement.val();
    contactDesignationErrFlag = false;
    contactDesignationErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactDesignation == "" || contactDesignation == null || contactDesignation == undefined) {
        contactDesignationErrFlag = true;
        contactDesignationErrMsg = "Designation Is Required !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactDesignationErrMsg);
}

/*function validateContactMobile() {
    var inputElement = $("#contact-mobile-div input");
    var errorElement = $("#contact-mobile-div p");
    contactMobile = inputElement.val();
    contactMobileErrFlag = false;
    contactMobileErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactMobile == "" || contactMobile == null || contactMobile == undefined) {
        contactMobileErrFlag = true;
        contactMobileErrMsg = "Mobile Is Required !";
        inputElement.css({"border-color":"red"});
    } else if(!contactMobile.match(phoneRegEx)) {
        contactMobileErrFlag = true;
        contactMobileErrMsg = "Phone Number Format Is Not Valid !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactMobileErrMsg);
}*/

function validateContactPhone1(){
    var inputElement = $("#contact-phone1-div input");
    var errorElement = $("#contact-phone1-div p");
    contactPhone1 = inputElement.val();
    contactPhone1ErrFlag = false;
    contactPhone1ErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactPhone1 == "" || contactPhone1 == null || contactPhone1 == undefined) {
        contactPhone1ErrFlag = true;
        contactPhone1ErrMsg = "Phone Number one Is Required !";
        inputElement.css({"border-color":"red"});
    } else if(!contactPhone1.match(phoneRegEx)) {
        contactPhone1ErrFlag = true;
        contactPhone1ErrMsg = "Phone Number Format Is Not Valid !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactPhone1ErrMsg);
}

function validateContactPhone2(){
    var inputElement = $("#contact-phone2-div input");
    var errorElement = $("#contact-phone2-div p");
    contactPhone2 = inputElement.val();
    contactPhone2ErrFlag = false;
    contactPhone2ErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactPhone2 == "" || contactPhone2 == null || contactPhone2 == undefined) {
        contactPhone2ErrFlag = true;
        contactPhone2ErrMsg = "Phone Number two Is Required !";
        inputElement.css({"border-color":"red"});
    } else if(!contactPhone2.match(phoneRegEx)) {
        contactPhone2ErrFlag = true;
        contactPhone2ErrMsg = "Phone Number Format Is Not Valid !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactPhone2ErrMsg);
}



function validateContactCountry() {
    var inputElement = $("#contact-country-div select");
    var errorElement = $("#contact-country-div p");
    contactCountry = inputElement.val();
    contactCountryErrFlag = false;
    contactCountryErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactCountry == "" || contactCountry == null || contactCountry == undefined) {
        contactCountryErrFlag = true;
        contactCountryErrMsg = "Country Is Required !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactCountryErrMsg);
}

function validateContactState() {
    var inputElement = $("#contact-state-div select");
    var errorElement = $("#contact-state-div p");
    contactState = inputElement.val();
    contactStateErrFlag = false;
    contactStateErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactState == "" || contactState == null || contactState == undefined) {
        contactStateErrFlag = true;
        contactStateErrMsg = "State Is Required !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactStateErrMsg);
}

function validateContactCity() {
    var inputElement = $("#contact-city-div select");
    var errorElement = $("#contact-city-div p");
    contactCity = inputElement.val();
    contactCityErrFlag = false;
    contactCityErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactCity == "" || contactCity == null || contactCity == undefined) {
        contactCityErrFlag = true;
        contactCityErrMsg = "City Is Required !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactCityErrMsg);
}

function validateContactLinkedIn() {
    var inputElement = $("#contact-linkedin-div input");
    //var errorElement = $("#contact-linkedin-div p");
    contactLinkedIn = inputElement.val();
    contactLinkedInErrFlag = false;
    contactLinkedInErrMsg = "";
   // inputElement.css({"border-color":"green"});
   /* if(contactLinkedIn == "" || contactLinkedIn == null || contactLinkedIn == undefined) {
        contactLinkedInErrFlag = true;
        contactLinkedInErrMsg = "LinkedIn Is Required !";
        inputElement.css({"border-color":"red"});
    }*/
    //errorElement.text(contactLinkedInErrMsg);
}

function validateContactFacebook() {
    var inputElement = $("#contact-facebook-div input");
   // var errorElement = $("#contact-facebook-div p");
    contactFacebook = inputElement.val();
    contactFacebookErrFlag = false;
    contactFacebookErrMsg = "";
  //  inputElement.css({"border-color":"green"});
   /* if(contactFacebook == "" || contactFacebook == null || contactFacebook == undefined) {
        contactFacebookErrFlag = true;
        contactFacebookErrMsg = "Facebook Is Required !";
        inputElement.css({"border-color":"red"});
    }*/
    //errorElement.text(contactFacebookErrMsg);
}

function validateContactTwitter() {
    var inputElement = $("#contact-twitter-div input");
    //var errorElement = $("#contact-twitter-div p");
    contactTwitter = inputElement.val();
    contactTwitterErrFlag = false;
    contactTwitterErrMsg = "";
    //inputElement.css({"border-color":"green"});
    /*if(contactTwitter == "" || contactTwitter == null || contactTwitter == undefined) {
        contactTwitterErrFlag = true;
        contactTwitterErrMsg = "Twitter Is Required !";
        inputElement.css({"border-color":"red"});
    }*/
    //errorElement.text(contactTwitterErrMsg);
}

function validateContactAddress() {
    var inputElement = $("#contact-address-div textarea");
    var errorElement = $("#contact-address-div p");
    contactAddress = inputElement.val();
    contactAddressErrFlag = false;
    contactAddressErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactAddress == "" || contactAddress == null || contactAddress == undefined) {
        contactAddressErrFlag = true;
        contactAddressErrMsg = "Address Is Required !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactAddressErrMsg);
}

function addContactFormReset() {
    addContactFormResetErrFlags();
    addContactFormResetErrMsgs();
    addContactFormResetErrOnForm();
    $("#server-message").text("");
}

function addContactFormResetErrFlags() {
    contactFirstNameErrFlag = true;
    contactLastNameErrFlag = true;
    contactEmailErrFlag = true;
    contactEmail2ErrFlag = true;
    contactEmail3ErrFlag = true;
    contactCategoryErrFlag = true;
    contactDesignationErrFlag = true;
    contactPhone1ErrFlag = true;
    contactPhone2ErrFlag = true;
    contactCountryErrFlag = true;
    contactStateErrFlag = true;
    contactCityErrFlag = true;
    contactLinkedInErrFlag = true;
    contactFacebookErrFlag = true;
    contactTwitterErrFlag = true;
    contactAddressErrFlag = true;
}

function addContactFormResetErrMsgs() {
    contactFirstNameErrMsg = "";
    contactLastNameErrMsg = "";
    contactEmailErrMsg = "";
    contactEmail2ErrMsg = "";
    contactEmail3ErrMsg = "";
    contactCategoryMsg = "";
    contactDesignationErrMsg = "";
    contactPhone1ErrMsg = "";
    contactPhone2ErrMsg = "";
    contactCountryErrMsg = "";
    contactStateErrMsg = "";
    contactCityErrMsg = "";
    contactLinkedInErrMsg = "";
    contactFacebookErrMsg = "";
    contactTwitterErrMsg = "";
    contactAddressErrMsg = "";
}

function addContactFormResetErrOnForm() {
    $("#contact-first-name-div p").text("");
    $("#contact-last-name-div p").text("");
    $("#contact-email-div p").text("");
    $("#contact-email2-div p").text("");
    $("#contact-email3-div p").text("");
    $("#contact-category-div p").text("");
    $("#contact-designation-div p").text("");
    $("#contact-phone1-div p").text("");
    $("#contact-phone2-div p").text("");
    $("#contact-country-div p").text("");
    $("#contact-state-div p").text("");
    $("#contact-city-div p").text("");
    $("#contact-linkedin-div p").text("");
    $("#contact-facebook-div p").text("");
    $("#contact-twitter-div p").text("");
    $("#contact-address-div p").text("");

    $("#contact-first-name-div input").val("");
    $("#contact-last-name-div input").val("");
    $("#contact-email-div input").val("");
    $("#contact-email2-div input").val("");
    $("#contact-email3-div input").val("");
    $("#contact-category-div input").val("");
    $("#contact-designation-div input").val("");
    $("#contact-phone1-div pv input").val("");
    $("#contact-phone2-div pv input").val("");
    $("#contact-country-div select").val("");
    $("#contact-state-div select").val("");
    $("#contact-city-div select").val("");
    $("#contact-linkedin-div input").val("");
    $("#contact-facebook-div input").val("");
    $("#contact-twitter-div input").val("");
    $("#contact-address-div textarea").val("");

    $("#contact-first-name-div input").css({"border-color":"#ccc"});
    $("#contact-last-name-div input").css({"border-color":"#ccc"});
    $("#contact-email-div input").css({"border-color":"#ccc"});
    $("#contact-email2-div input").css({"border-color":"#ccc"});
    $("#contact-email3-div input").css({"border-color":"#ccc"});
    $("#contact-category-div input").css({"border-color":"#ccc"});
    $("#contact-designation-div input").css({"border-color":"#ccc"});
    $("#contact-phone1-div input").css({"border-color":"#ccc"});
    $("#contact-phone2-div input").css({"border-color":"#ccc"});
    $("#contact-country-div select").css({"border-color":"#ccc"});
    $("#contact-state-div select").css({"border-color":"#ccc"});
    $("#contact-city-div select").css({"border-color":"#ccc"});
    $("#contact-linkedin-div input").css({"border-color":"#ccc"});
    $("#contact-facebook-div input").css({"border-color":"#ccc"});
    $("#contact-twitter-div input").css({"border-color":"#ccc"});
    $("#contact-address-div textarea").css({"border-color":"#ccc"});

}