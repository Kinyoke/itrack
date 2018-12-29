// End point to your service that handles encryption
    const merchantURL = "http://localhost/mulaCheckOut/Encrypt.php";
    

    const no = Math.floor((Math.random() * 50000000) + 10000000);


    MulaCheckout.addPayWithMulaButton({ className:'checkout-button', checkoutType:'express'});

    // Initialize the mula checkout modal/redirect
    //on button click, redirect to express checkout
    document.querySelector(".mula-checkout-button").addEventListener("click", function () {
        
        validateForm();

    });
    
    var customerName = document.forms["contrubution-group-form"]["fullname"];
    var phonenumber = document.forms["contrubution-group-form"]["phonenumber"];
    var contributionAmount = document.forms["contrubution-group-form"]["contributionAmount"];

    var err_fullname = document.getElementById("err_fullname");
    var err_phoneNumber = document.getElementById("err_phoneNumber");
    var err_contributionAmount = document.getElementById("err_contributionAmount");
    var termsConditions = document.getElementById("terms-mark");
    var anonymous = document.getElementById("anonymous");
    var err_termsConditions = document.getElementById("err_termsConditions");

    var groupAccount = "";
    
    if(document.getElementById("groupAccount") != null){

        groupAccount = document.getElementById("groupAccount").value;
    
    }
        

    function validateForm() {
    
        //console.log("isChecked: "+(termsConditions.checked== true));

        if (customerName.value == "") {
            

            err_fullname.innerHTML = "Enter your fullname";
            
            return false;
        } else if (phonenumber.value == "") {
            
            err_phoneNumber.innerHTML = "Enter your phonenumber";
            
            return false;
        }  else if(!phonenumber.value.match('^(0|)[0-9]{9}$')){
            
            err_phoneNumber.innerHTML = "Enter a valid phone number";
            return false;

        }  else if (contributionAmount.value == "") {

            err_contributionAmount.innerHTML = "Enter your contribution amount";
            //contributionAmount.style.borderColor = "red";

            return false;

        }  else if (termsConditions.checked != true){

            err_termsConditions.innerHTML = "Please check the terms & conditions"
        
        }  else{
                
                var isAnonymous = 0;

                if(anonymous.checked){
                    isAnonymous = 1;
                }
                var customerPhone = sanitizePhoneNumber(phonenumber.value, "KE");
                var extraData = {"isAnonymous": isAnonymous};
                var csrfToken = $('meta[name="csrf-token"]').attr("content");

                $.ajax({
                  type: 'POST',
                  url: '../group/log-request',
                  data: {
                      userMSISDN : customerPhone,
                      userExtraData : extraData.toString(),
                      _csrf : csrfToken
                  },
                  cache: true,
                  success: function(data){
                    
                    console.log("Data: "+data);

                    // The params to be encrypted

                    encrypt(data).then(response => {
                            // console.log('response returned',response);
                        MulaCheckout.renderMulaCheckout({
                                        checkoutType: "express",
                                        merchantProperties: response,
                                    });
                            }
                         )
                        .catch(error => console.log('error gotten: ',error));
                
                  }
              });
            
            

        }

    } 
    

    function currentDateTime() {
        now = new Date();
        year = "" + now.getFullYear();
        month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
        day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
        hour = "" + (now.getHours() - 2); if (hour.length == 1) { hour = "0" + hour; }
        minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
        second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
        return year + "-" + month + "-" + day + " " + hour + ":" + (minute) + ":" + second;
    }

    function encrypt(transactionID) {

        var customeFullname = customerName.value;
        
        var customerPhone = sanitizePhoneNumber(phonenumber.value, "KE");

        var amountToContribute = contributionAmount.value;

        var slitCustomerName = customeFullname.split(" ");
        
        var customerFirstName = "";
        var customerLastName = "";
        
        if(slitCustomerName.length > 1){
        
          customerFirstName = slitCustomerName[0];
          customerLastName = slitCustomerName[1];
        
        } else{

          customerFirstName = customeFullname;
          customerLastName = customeFullname;

        }


        const currnetTimeStamp = currentDateTime();

            //console.log("currnetTimeStamp: ", currnetTimeStamp);

        const params = {
            merchantTransactionID: transactionID,
            customerFirstName: customerFirstName,
            customerLastName: customerLastName,
            customerEmail: 'test@gmail.com',
            amount: amountToContribute,
            accountNumber: groupAccount,
            currencyCode: 'KES',
            languageCode: 'en',
            serviceDescription: 'Payment for x service',
            serviceCode: 'MULAGROUPS',
            productCode: '',
            payerClientCode:"",
            MSISDN: customerPhone,
            countryCode: 'KE',  
            dueDate: currnetTimeStamp,
            accessKey: 'xkiCDsTKITl3ntBXj89XKFfMHCnQ0MvXXidZMg3A09sGd7OLqYB1eRd9bDzU',
            successRedirectUrl:"https://mula.co.ke:9301/site/success",
            failRedirectUrl: "https://mula.co.ke:9301/site/failed",
            paymentWebhookUrl: "http://10.1.7.184/wrappers/MulaWalletWrapper.php"
        }; 

        console.log("itemParams: "+params);

        return fetch(
        merchantURL, 
        {
            method:'POST', 
            body:JSON.stringify(params),
            mode:'cors',
            headers: {
                'Accept': 'application/json, text/plain, */*',
                'Content-Type': 'application/json'
            }

        }).then(response => response.json())

    }

    function sanitizePhoneNumber(memberMSISDN, countryCode) {
        
        var formattedMSISDN = "";
        var sanitizeMSISDN = "";

        var countryDialCode = "254";
        var mobileNumberRegex = "[^0-9\\s]";

        if(countryCode === "KE"){

            countryDialCode = "254";

        } else if (countryCode === "RW"){

            countryDialCode = "250";

        } else if (countryCode === "UG"){

            countryDialCode = "256";

        } else if (countryCode === "TZ"){

            countryDialCode = "255";

        }

        if (memberMSISDN.substr(0, 1) === "0") {
            memberMSISDN = memberMSISDN.substr(1);
        }

        if (memberMSISDN.substr(0, 1) === "+") {
            memberMSISDN = memberMSISDN.substr(1);
        }

        

        sanitizeMSISDN = memberMSISDN.replace("word(" + mobileNumberRegex + ")", memberMSISDN);
        formattedMSISDN = sanitizeMSISDN.replace(" ", "");

        
        if ((formattedMSISDN.substr(0, 1) === "0") && (formattedMSISDN.length == 10)) {
            formattedMSISDN = formattedMSISDN.substr(0, 1);
        }
        

        if (formattedMSISDN.length <= 9 && formattedMSISDN.length > 0) {
            formattedMSISDN = countryDialCode.concat(formattedMSISDN);
        }

        return formattedMSISDN;
    }

