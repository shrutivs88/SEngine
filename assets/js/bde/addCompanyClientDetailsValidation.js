
var whiteSpaceRegEx = /\s/g;
var phoneRegEx = /^\d{10}$/;
var clients = [];
var client = {
    "clientFirstName":"",
    "clientLastName":"",
    "clientEmail":"",
    "clientEmail2":"",
    "clientEmail3":"",
    // "clientMobile":"",
    "clientPhone1":"",
    "clientPhone2":"",
    "clientCategory":"",
    "clientDesignation":"",
    "clientCity":"",
    "clientState":"",
    "clientCountry":"",
    "clientAddress":"",
    "clientLinkedInid":"",
    "clientFacebookid":"",
    "clientTwitterid":"",
};

var clientFirstNameErrorFlag = true;
var clientLastNameErrorFlag = true;
var clientEmailErrorFlag = true;
var clientEmailErrorFlag2 = true;
var clientEmailErrorFlag3 = true;
//  var clientMobileErrorFlag = true;
var clientPhone1ErrorFlag = true;
var clientPhone2ErrorFlag = true;
var clientCategoryErrorFlag = true;
var clientDesignationErrorFlag = true;
var clientCityErrorFlag = true;
var clientStateErrorFlag = true;
var clientCountryErrorFlag  = true;
var clientAddressErrorFlag = true;
var clientLinkedInErrorFlag = true;
var clientFacebookIdErrorFlag = true;
var clientTwitterIdErrorFlag = true;

var clientFirstNameErrorMsg = "";
var clientLastNameErrorMsg = "";
var clientEmailErrorMsg = "";
var clientEmailErrorMsg2 = "";
var clientEmailErrorMsg3 = "";
//   var clientMobileErrorMsg = "";
var clientPhone1ErrorMsg = "";
var clientPhone2ErrorMsg = "";
var clientCategoryErrorMsg = "";
var clientDesignationErrorMsg = "";
var clientCityErrorMsg = "";
var clientStateErrorMsg = "";
var clientCountryErrorMsg = "";
var clientAddressErrorMsg = "";
var clientLinkedInErrorMsg = "";
var clientFacebookIdErrorMsg = "";
var clientTwitterIdErrorMsg = "";

function validateClientFirstName()
{
    var inputElement = $("#contact-first-name-div input");
    var errorElement = $("#contact-first-name-div p");
    clientFirstName = inputElement.val();
    clientFirstNameErrorFlag = false;
    clientFirstNameErrorMsg = "";
    inputElement.css({"border-color":"green"});
    if(clientFirstName == "" || clientFirstName == null || clientFirstName == undefined) {
        clientFirstNameErrorFlag = true;
        clientFirstNameErrorMsg = "First Name Is Required !";
        inputElement.css({"border-color":"red"});
    } else if(clientFirstName.match(whiteSpaceRegEx)) {
        clientFirstNameErrorFlag = true;
        clientFirstNameErrorMsg = "Whitespace Is Not Allowed !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(clientFirstNameErrorMsg);
}

function validateClientLastName()
{
    var inputElement = $("#contact-last-name-div input");
    var errorElement = $("#contact-last-name-div p");
    clientLastName = inputElement.val();
    clientLastNameErrorFlag = false;
    clientLastNameErrorMsg = "";
    inputElement.css({"border-color":"green"});
    if(clientLastName == "" || clientLastName == null || clientLastName == undefined) {
        clientLastNameErrorFlag = true;
        clientLastNameErrorMsg = "Last Name Is Required !";
        inputElement.css({"border-color":"red"});
    } else if(clientLastName.match(whiteSpaceRegEx)) {
        clientLastNameErrorFlag = true;
        clientLastNameErrorMsg = "Whitespace Is Not Allowed !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(clientLastNameErrorMsg);

}

//this below email is for validating the contacts through company list

function validateClientEmails1()
{
    var clientEmail = $("#contact-email-div input").val();
    EmailRegEx= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    clientEmailErrorFlag = false;
    clientEmailErrorMsg = "";
    $("#contact-email-div input").css({"border":"1px solid green"});
    if(clientEmail=="")
    {
        clientEmailErrorFlag = true;
        $("#contact-email-div input").css({"border":"1px solid red"}) ;
        clientEmailErrorMsg="Email One is Required !";
    }
    else if(clientEmail.match(whiteSpaceRegEx)) {
        clientEmailErrorFlag = true;
        clientEmailErrorMsg = "Whitespace Is Not Allowed !";
        $("#contact-email-div input").css({"border-color":"red"});
        $("#contact-email-div p").text(clientEmailErrorMsg);
    }
    else if(!EmailRegEx.test(clientEmail))
    {
        $("#contact-email-div input").css({"border":"1px solid red"}) ;   
    }
    $("#contact-email-div p").text(clientEmailErrorMsg);
}



function validateClientEmails2()

{
    var clientEmail2 = $("#contact-email2-div input").val();
        EmailRegEx2= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        clientEmailErrorFlag2 = false;
        clientEmailErrorMsg2 = "";
       $("#contact-email2-div input").css({"border":"1px solid green"});
        if(clientEmail2=="")
        {
            clientEmailErrorFlag2 = false;
          $("#contact-email2-div input").css({"border":""}) ;
           
        }
        else if(clientEmail2.match(whiteSpaceRegEx)) 
        {
            clientEmailErrorFlag2 = true;
            clientEmailErrorMsg2 = "Whitespace Is Not Allowed !";
            $("#contact-email2-div input").css({"border-color":"red"});
            $("#contact-email2-div p").text(clientEmailErrorMsg2);
        }
        else if(!EmailRegEx2.test(clientEmail2))
        {
            clientEmailErrorFlag2 = true;
            $("#contact-email2-div input").css({"border":"1px solid red"}) ;   
            clientEmailErrorMsg="Email Fromat is Wrong Please Re-enter !";  
        }
        $("#contact-email2-div p").text(clientEmailErrorMsg2);

}

function validateClientEmails3()
{
    var clientEmail3 = $("#contact-email3-div input").val();
    EmailRegEx3= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    clientEmailErrorFlag3 = false;
    clientEmailErrorMsg3 = "";
    $("#contact-email3-div input").css({"border":"1px solid green"});
    if(clientEmail3=="")
    {
        clientEmailErrorFlag3 = false;
        $("#contact-email3-div input").css({"border":""}) ;
      
    } 
    else if(clientEmail3.match(whiteSpaceRegEx)) {
        clientEmailErrorFlag3 = true;
        clientEmailErrorMsg3 = "Whitespace Is Not Allowed !";
        $("#contact-email3-div input").css({"border-color":"red"});
        $("#contact-email3-div p").text(clientEmailErrorMsg3);
    }
    else if(!EmailRegEx3.test(clientEmail3))
    {
        clientEmailErrorFlag3 = true;
        $("#contact-email3-div input").css({"border":"1px solid red"}) ;
        contactEmailErrMsg="Email Fromat is Wrong Please Re-enter !";    
    }
        $("#contact-email3-div p").text(clientEmailErrorMsg3);
}

function validateClientPhone1()
{
    var inputElement = $("#contact-phone1-div input");
    var errorElement = $("#contact-phone1-div p");
    clientPhone1 = inputElement.val();
    clientPhone1ErrorFlag = false;
    contactPhone1ErrMsg = "";
    inputElement.css({"border-color":"green"});
    if(clientPhone1 == "" || clientPhone1 == null || clientPhone1 == undefined) {
        clientPhone1ErrorFlag = true;
        contactPhone1ErrMsg = "Phone Number one Is Required !";
        inputElement.css({"border-color":"red"});
    } else if(!clientPhone1.match(phoneRegEx)) {
        clientPhone1ErrorFlag = true;
        contactPhone1ErrMsg = "Phone Number Format Is Not Valid !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(contactPhone1ErrMsg);

}

function validateClientPhone2()
{
    var inputElement = $("#contact-phone2-div input");
    var errorElement = $("#contact-phone2-div p");
    clientPhone2 = inputElement.val();
    clientPhone2ErrorFlag = false;
    clientPhone2ErrorMsg = "";
    inputElement.css({"border-color":"green"});
    if(clientPhone2 == "" || clientPhone2 == null || clientPhone2 == undefined) {
        clientPhone2ErrorFlag = true;
        clientPhone2ErrorMsg = "Phone Number two Is Required !";
        inputElement.css({"border-color":"red"});
    } else if(!clientPhone2.match(phoneRegEx)) {
        clientPhone2ErrorFlag = true;
        clientPhone2ErrorMsg = "Phone Number Format Is Not Valid !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(clientPhone2ErrorMsg);
}

function validateClientCategoty()
{
    var inputElement = $("#contact-category-div input");
    var errorElement = $("#contact-category-div p");
    clientCategory = inputElement.val();
    clientCategoryErrorFlag = false;
    clientCategoryErrorMsg = "";
    inputElement.css({"border-color":"green"});
    if(clientCategory == "" || clientCategory == null || clientCategory == undefined) {
        clientCategoryErrorFlag = true;
        clientCategoryErrorMsg = "Category Is Required !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(clientCategoryErrorMsg);
}

function validateClientDesignation()
{
    var inputElement = $("#contact-designation-div input");
    var errorElement = $("#contact-designation-div p");
    clientDesignation = inputElement.val();
    clientDesignationErrFlag = false;
    clientDesignationErrorMsg = "";
    inputElement.css({"border-color":"green"});
    if(clientDesignation == "" || clientDesignation == null || clientDesignation == undefined) {
        contactDesignationErrFlag = true;
        clientDesignationErrorMsg = "Designation Is Required !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(clientDesignationErrorMsg);
}

function validateClientCity()
{
    var inputElement = $("#contact-city-div select");
    var errorElement = $("#contact-city-div p");
    clientCity = inputElement.val();
    clientCityErrorFlag = false;
    clientCityErrorMsg = "";
    inputElement.css({"border-color":"green"});
    if(clientCity == "" || clientCity == null || clientCity == undefined) {
        clientCityErrorFlag = true;
        clientCityErrorMsg = "City Is Required !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(clientCityErrorMsg);
}

function validateClientState()
{ 
    var inputElement = $("#contact-state-div select");
    var errorElement = $("#contact-state-div p");
    clientState = inputElement.val();
    clientStateErrorFlag = false;
    clientStateErrorMsg = "";
    inputElement.css({"border-color":"green"});
    if(clientState == "" || clientState == null || clientState == undefined) {
        clientStateErrorFlag = true;
        clientStateErrorMsg = "State Is Required !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(clientStateErrorMsg);
}

function validateClientCountry()
{
    var inputElement = $("#contact-country-div select");
    var errorElement = $("#contact-country-div p");
    clientCountry = inputElement.val();
    clientCountryErrorFlag = false;
    clientCountryErrorMsg = "";
    inputElement.css({"border-color":"green"});
    if(clientCountry == "" || clientCountry == null || clientCountry == undefined) {
        clientCountryErrorFlag = true;
        clientCountryErrorMsg = "Country Is Required !";
        inputElement.css({"border-color":"red"});
    }
    errorElement.text(clientCountryErrorMsg);
}

function validateClientAddress()
{
    var inputElement = $("#contact-address-div textarea");
    var errorElement = $("#contact-address-div p");
    clientAddress = inputElement.val();
    clientAddressErrorFlag = false;
    clientAddressErrorMsg = "";
    inputElement.css({"border-color":"green"});
    if(clientAddress == "" || clientAddress == null || clientAddress == undefined) {
        clientAddressErrorFlag = true;
        clientAddressErrorMsg = "Address Is Required !";
        inputElement.css({"border-color":"red"});
        }
errorElement.text(clientAddressErrorMsg);
}

function validateClientLinkedIn()
{
    var clientLinkedIn = $("#clientLinkedInid").val().trim();
    // clientLinkedInErrorFlag=false;
    //clientLinkedInErrorMsg="";
  //  $("#clientLinkedInid").css({"border":"2px solid green"});
    if(clientLinkedIn=="" )
    {
        clientLinkedInErrorFlag=true;
        // $("#clientLinkedInid").css({"border":"2px solid red"}) ;
        // clientLinkedInErrorMsg="Please Enter Your Linkedin id";
    }else if(/(ftp|http|https):\/\/?(?:www\.)?linkedin.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/.test(clientLinkedIn))
    {
        clientLinkedInErrorFlag=false;
        // clientLinkedInErrorMsg="<p style='color:green;'>valid Linkedin URL</p>"; 
    }
$("#clientLinkedInError").text(clientLinkedInErrorMsg);
}

function validateClientFacebookId()
{
    var clientFacebookId = $("#clientFacebookid").val().trim();
    // clientFacebookIdErrorFlag=false;
    //  clientFacebookIdErrorMsg="";
 //   $("#clientFacebookid").css({"border":"2px solid green"});
    if(clientFacebookId=="")
    {
        //clientFacebookIdErrorFlag=true;
        clientFacebookIdErrorFlag=false;
    //$("#clientFacebookid").css({"border":"2px solid red"}) ;
        //clientFacebookIdErrorMsg="Please Enter Your FacebookmId";
    }
$("#clientFacebookIdError").text(clientFacebookIdErrorMsg);
}

function validateClientTwitterId()
{
    var clientTwitterId = $("#clientTwitterid").val().trim();
    // clientTwitterIdErrorFlag=false;      
    // clientTwitterIdErrorMsg="";
  //  $("#clientTwitterid").css({"border":"2px solid green"});
    if(clientTwitterId=="")
    {
        clientTwitterIdErrorFlag=false;
        // $("#clientTwitterid").css({"border":"2px solid red"}) ;
        //  clientTwitterIdErrorMsg="Please Enter your TwitterId";
    }
$("#clientTwitterIdError").text(clientTwitterIdErrorMsg);
}

//this below function is used for the reset for add contact in company Client list 

function addContactFormReset() {
    addContactFormResetErrFlags();
    addContactFormResetErrMsgs();
    addContactFormResetErrOnForm();
    $("#server-message").text("");
    resetLocations();
}

function addContactFormResetErrFlags() {
            clientFirstNameErrorFlag = true;
            clientLastNameErrorFlag = true;
            clientEmailErrorFlag = true;  
           clientEmailErrorFlag2= true;
            clientEmailErrorFlag3= true;
            clientPhone1ErrorFlag = true;
            clientPhone2ErrorFlag = true;
            clientCategoryErrorFlag = true;
            clientDesignationErrorFlag = true;
            clientCityErrorFlag = true;
            clientStateErrorFlag = true;
            clientCountryErrorFlag  = true;
            clientAddressErrorFlag = true;
            clientLinkedInErrorFlag = true;
            clientFacebookIdErrorFlag = true;
            clientTwitterIdErrorFlag = true;
}

function addContactFormResetErrMsgs() {
    clientFirstNameErrorMsg = "";
    clientLastNameErrorMsg = "";
    clientEmailErrorMsg = "";
    clientEmailErrorMsg2 = "";
    clientEmailErrorMsg3 = "";
    clientPhone1ErrorMsg = "";
    clientPhone2ErrorMsg = "";
    clientCategoryErrorMsg = "";
    clientDesignationErrorMsg = "";
    clientCityErrorMsg = "";
    clientStateErrorMsg = "";
    clientCountryErrorMsg = "";
    clientAddressErrorMsg = "";
    clientLinkedInErrorMsg = "";
    clientFacebookIdErrorMsg = "";
    clientTwitterIdErrorMsg = "";
}

function addContactFormResetErrOnForm() {
        $("#clientFirstName").text("");
        $("#clientFirstName").val("");
        $("#clientFirstName").css({"border-color":"#ccc"});
        $("#clientLastName").text("");
        $("#clientLastName").val("");
        $("#clientLastName").css({"border-color":"#ccc"});
        $("#clientEmail").text("");
        $("#clientEmail").val("");
        $("#clientEmail").css({"border-color":"#ccc"});    
        $("#clientEmail2").text("");
        $("#clientEmail2").val("");
        $("#clientEmail2").css({"border-color":"#ccc"});   
        $("#clientEmail3").text("");
        $("#clientEmail3").val("");
        $("#clientEmail3").css({"border-color":"#ccc"});

/*
        $("#clientMobile").text("");
        $("#clientMobile").val("");
        $("#clientMobile").css({"border-color":"#ccc"});
*/
        $("#clientPhone1").text("");
        $("#clientPhone1").val("");
        $("#clientPhone1").css({"border-color":"#ccc"});      
        $("#clientPhone2").text("");
        $("#clientPhone2").val("");
        $("#clientPhone2").css({"border-color":"#ccc"});
        $("#clientCategory").text("");
        $("#clientCategory").val("");
        $("#clientCategory").css({"border-color":"#ccc"});
        $("#clientDesignation").text("");
        $("#clientDesignation").val("");
        $("#clientDesignation").css({"border-color":"#ccc"});
        $("#clientCity").text("");
        $("#clientCity").val("");
        $("#clientCity").css({"border-color":"#ccc"});
        $("#clientState").text("");
        $("#clientState").val("");
        $("#clientState").css({"border-color":"#ccc"});
        $("#clientCountry").text("");
        $("#clientCountry").val("");
        $("#clientCountry").css({"border-color":"#ccc"});
        $("#clientAddress").text("");
        $("#clientAddress").val("");
        $("#clientAddress").css({"border-color":"#ccc"});
        $("#clientLinkedInid").text("");
        $("#clientLinkedInid").val("");
        $("#clientLinkedInid").css({"border-color":"#ccc"});
        $("#clientFacebookid").text("");
        $("#clientFacebookid").val("");
        $("#clientFacebookid").css({"border-color":"#ccc"});
        $("#clientTwitterid").text("");
        $("#clientTwitterid").val("");
        $("#clientTwitterid").css({"border-color":"#ccc"});
        }



      

       

        



        