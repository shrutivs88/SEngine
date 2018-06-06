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
contactEmail2 = "";
contactEmailErrFlag2 = true;
contactEmailErrMsg2 = "";
contactEmail3 = "";
contactEmailErrFlag3 = true;
contactEmailErrMsg3 = "";
contactCategory = "";
contactCategoryErrFlag = true;
contactCategoryErrMsg = "";
contactDesignation = "";
contactDesignationErrFlag = true;
contactDesignationErrMsg = "";
/*contactMobile = "";
contactMobileErrFlag = true;
contactMobileErrMsg = "";*/
contactPhone1 = "";
contactPhone1ErrFlag = true;
contactPhone1ErrMsg = "";
contactPhone2 = "";
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
    var inputElement = $("#contact-first-name");
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
    inputElement.attr('title', contactFirstNameErrMsg);
}

function validateContactLastName() {
    var inputElement = $("#contact-last-name");
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
    inputElement.attr('title', contactLastNameErrMsg);
}

function validateContactEmail() {
	var contactEmail = $("#contact-email").val();
    EmailRegEx= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    contactEmailErrFlag = false;
    contactEmailErrMsg = "";
    $("#contact-email").css({"border":"1px solid green"});
    if(contactEmail == "" || contactEmail == null || contactEmail == undefined )
    {
        contactEmailErrFlag = true;
		
        $("#contact-email").css({"border":"1px solid red"}) ;
        contactEmailErrMsg="Email One is Required !";
    }
    else if(contactEmail.match(whiteSpaceRegEx)) {
	
        contactEmailErrFlag = true;
        contactEmailErrMsg = "Whitespace Is Not Allowed !";
        $("#contact-email").css({"border-color":"red"});
       // $("#contact-email-div p").text(clientEmailErrorMsg);
    }
    else if(!EmailRegEx.test(contactEmail))
	{ 

	contactEmailErrFlag = true;
        $("#contact-email").css({"border":"1px solid red"}) ;   
    }else{
	
		contactEmailErrFlag = false;
		contactEmailErrMsg = "";
	}
    $("#contact-email").text(contactEmailErrMsg);
}

function validateContactEmail2() {
    var contactEmail2 = $("#contact-email2").val();
    EmailRegEx= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    contactEmailErrFlag2 = false;
    contactEmailErrMsg2 = "";
    $("#contact-email2").css({"border":"1px solid green"});
    if(contactEmail2=="" ||contactEmail2==null ||contactEmail2== undefined )
    {
        contactEmailErrFlag2 = false;
        $("#contact-email2").css({"border":""}) ;
        //contactEmailErrMsg2="Email One is Required !";
    }
    else if(contactEmail2.match(whiteSpaceRegEx)) {
        contactEmailErrFlag2 = true;
        contactEmailErrMsg2 = "Whitespace Is Not Allowed !";
        $("#contact-email2").css({"border-color":"red"});
       // $("#contact-email-div p").text(clientEmailErrorMsg);
    }
    else if(!EmailRegEx.test(contactEmail2))
    {
		contactEmailErrFlag2 = true;
        $("#contact-email2").css({"border":"1px solid red"}) ;   
    }else{
		contactEmailErrFlag2 = false;
		contactEmailErrMsg2 = "";
	}
    $("#contact-email2").text(contactEmailErrMsg2);
}

function validateContactEmail3() {
    var contactEmail3 = $("#contact-email3").val();
    EmailRegEx= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    contactEmailErrFlag3 = false;
    contactEmailErrMsg3 = "";
    $("#contact-email3").css({"border":"1px solid green"});
    if(contactEmail3=="" ||contactEmail3==null ||contactEmail3== undefined )
    {
        contactEmailErrFlag3 = false;
        $("#contact-email3").css({"border":""}) ;
       // contactEmailErrMsg3="Email One is Required !";
    }
    else if(contactEmail3.match(whiteSpaceRegEx)) {
        contactEmailErrFlag3 = true;
        contactEmailErrMsg3 = "Whitespace Is Not Allowed !";
        $("#contact-email3").css({"border-color":"red"});
       // $("#contact-email-div p").text(clientEmailErrorMsg);
    }
    else if(!EmailRegEx.test(contactEmail3))
    {
		contactEmailErrFlag3 = true;
        $("#contact-email3").css({"border":"1px solid red"}) ;   
    }else{
		contactEmailErrFlag3 = false;
    contactEmailErrMsg3 = "";
	}
    $("#contact-email3").text(contactEmailErrMsg3);	
}

function validateContactCategory() {
    var inputElement = $("#contact-category");
    contactCategory = inputElement.val();
    contactCategoryErrFlag = false;
    contactCategoryErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactCategory == "" || contactCategory == null || contactCategory == undefined) {
        contactCategoryErrFlag = true;
        contactCategoryErrMsg = "Category Is Required !";
        inputElement.css({"border-color":"red"});
    }
    inputElement.attr('title', contactCategoryErrMsg);
}

function validateContactDesignation() {
    var inputElement = $("#contact-designation");
    contactDesignation = inputElement.val();
    contactDesignationErrFlag = false;
    contactDesignationErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactDesignation == "" || contactDesignation == null || contactDesignation == undefined) {
        contactDesignationErrFlag = true;
        contactDesignationErrMsg = "Designation Is Required !";
        inputElement.css({"border-color":"red"});
    }
    inputElement.attr('title', contactDesignationErrMsg);
}

function validateContactPhone1(){
    var inputElement = $("#contact-phone1");
    contactPhone1 = inputElement.val();
    contactPhone1ErrFlag = false;
    contactPhone1ErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactPhone1 == "" || contactPhone1 == null || contactPhone1 == undefined) {
        contactPhone1ErrFlag = true;
        contactPhone1ErrMsg = "Mobile Is Required !";
        inputElement.css({"border-color":"red"});
    } else if(!contactPhone1.match(phoneRegEx)) {
        contactPhone1ErrFlag = true;
        contactPhone1ErrMsg = "Phone Number Format Is Not Valid !";
        inputElement.css({"border-color":"red"});
    }
    inputElement.attr('title', contactPhone1ErrMsg);
}

function validateContactPhone2(){
    var inputElement = $("#contact-phone2");
    contactPhone2 = inputElement.val();
    contactPhone2ErrFlag = false;
    contactPhone2ErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactPhone2 == "" || contactPhone2 == null || contactPhone2 == undefined) {
        contactPhone2ErrFlag = true;
        contactPhone2ErrMsg = "Mobile Is Required !";
        inputElement.css({"border-color":"red"});
    } else if(!contactPhone2.match(phoneRegEx)) {
        contactPhone2ErrFlag = true;
        contactPhone2ErrMsg = "Phone Number Format Is Not Valid !";
        inputElement.css({"border-color":"red"});
    }
    inputElement.attr('title', contactPhone2ErrMsg);
}
/*function validateContactMobile() {
    var inputElement = $("#contact-mobile");
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
    inputElement.attr('title', contactMobileErrMsg);
}
*/



function validateContactCountry() {
    var inputElement = $("#contact-country");
    contactCountry = inputElement.val();
    contactCountryErrFlag = false;
    contactCountryErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactCountry == "" || contactCountry == null || contactCountry == undefined) {
        contactCountryErrFlag = true;
        contactCountryErrMsg = "Country Is Required !";
        inputElement.css({"border-color":"red"});
    }
    inputElement.attr('title', contactCountryErrMsg);
}

function validateContactState() {
    var inputElement = $("#contact-state");
    contactState = inputElement.val();
    contactStateErrFlag = false;
    contactStateErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactState == "" || contactState == null || contactState == undefined) {
        contactStateErrFlag = true;
        contactStateErrMsg = "State Is Required !";
        inputElement.css({"border-color":"red"});
    }
    inputElement.attr('title', contactStateErrMsg);
}

function validateContactCity() {
    var inputElement = $("#contact-city");
    contactCity = inputElement.val();
    contactCityErrFlag = false;
    contactCityErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactCity == "" || contactCity == null || contactCity == undefined) {
        contactCityErrFlag = true;
        contactCityErrMsg = "City Is Required !";
        inputElement.css({"border-color":"red"});
    }
    inputElement.attr('title', contactCityErrMsg);
}

function validateContactAddress() {
    var inputElement = $("#contact-address");
    contactAddress = inputElement.val();
    contactAddressErrFlag = false;
    contactAddressErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(contactAddress == "" || contactAddress == null || contactAddress == undefined) {
        contactAddressErrFlag = true;
        contactAddressErrMsg = "Address Is Required !";
        inputElement.css({"border-color":"red"});
    }
    inputElement.attr('title', contactAddressErrMsg);
}

function validateContactLinkedIn() {
    var inputElement = $("#contact-linkedin");
    contactLinkedIn = inputElement.val();
    contactLinkedInErrFlag = false;
    contactLinkedInErrMsg = "";
    inputElement.css({"border-color":"green"});
   /* if(contactLinkedIn == "" || contactLinkedIn == null || contactLinkedIn == undefined) {
        contactLinkedInErrFlag = true;
        contactLinkedInErrMsg = "LinkedIn Is Required !";
        inputElement.css({"border-color":"red"});
    }*/
    inputElement.attr('title', contactLinkedInErrMsg);
}

function validateContactFacebook() {
    var inputElement = $("#contact-facebook");
    contactFacebook = inputElement.val();
    contactFacebookErrFlag = false;
    contactFacebookErrMsg = "";
    inputElement.css({"border-color":"green"});
   /* if(contactFacebook == "" || contactFacebook == null || contactFacebook == undefined) {
        contactFacebookErrFlag = true;
        contactFacebookErrMsg = "Facebook Is Required !";
        inputElement.css({"border-color":"red"});
    }*/
    inputElement.attr('title', contactFacebookErrMsg);
}

function validateContactTwitter() {
    var inputElement = $("#contact-twitter");
    contactTwitter = inputElement.val();
    contactTwitterErrFlag = false;
    contactTwitterErrMsg = "";
    inputElement.css({"border-color":"green"});
  /*  if(contactTwitter == "" || contactTwitter == null || contactTwitter == undefined) {
        contactTwitterErrFlag = true;
        contactTwitterErrMsg = "Twitter Is Required !";
        inputElement.css({"border-color":"red"});
    }*/
    inputElement.attr('title', contactTwitterErrMsg);
}
/*&& contactLinkedInErrFlag == false && contactFacebookErrFlag == false && contactTwitterErrFlag == false
validateContactLinkedIn();
    validateContactFacebook();
    validateContactTwitter();*/

function isFormValid() {
	
    validateContactFirstName();
    validateContactLastName();
    validateContactEmail();
	validateContactEmail2();
	validateContactEmail3();
    validateContactCategory();
    validateContactDesignation();
    validateContactPhone1();
    validateContactPhone2();
    validateContactCountry();
    validateContactState();
    validateContactCity();
    validateContactAddress();
  
	

    if(contactFirstNameErrFlag == false && contactLastNameErrFlag == false && contactEmailErrFlag == false && 
		contactEmailErrFlag2 == false && contactEmailErrFlag3 == false && contactCategoryErrFlag == false && contactDesignationErrFlag == false && contactPhone1ErrFlag == false && 
            contactPhone2ErrFlag == false && contactCountryErrFlag == false && contactStateErrFlag == false && 
                contactCityErrFlag == false  && contactAddressErrFlag == false)
					{
                        return true;
                    }else{
					return false;	
					}
                   
}