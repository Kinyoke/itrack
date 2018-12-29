<!-- The "Pay with mula" button needs to have the "mula-checkout-button" class -->
<a class="checkout-button"></a>

<!-- Include a polyfil for to support the old browsers -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcomponentsjs/1.0.17/webcomponents-loader.js"></script>

<!-- Initialize the "Pay with mula" button -->
<script type="text/javascript">
  	// End point to your service that handles encryption
  	const merchantURL = "http://localhost/mulaCheckout/Encrypt.php";

	const no = Math.floor((Math.random() * 50000000) + 10000000);

  	const params = {
		  merchantTransactionID: no,
		  customerFirstName: 'Customer',
		  customerLastName: 'Customer',
		  customerEmail: 'test@gmail.com',
		  amount: 100,
		  accountNumber: no,
		  currencyCode: 'KES',
		  languageCode: 'en',
		  serviceDescription: 'Payment for x service',
		  transactionID: no,
		  serviceCode: 'MULDEV2870',
		  productCode: '',
	      payerClientCode:"",
		  MSISDN: '254722333867',
		  countryCode: 'KE',  
	      accessKey:"$2a$08$mUzstyugC2iF3ZISWzuyx.GUYgkyh3R9nnIzK2pIs1QoBf.znmubq",
		  dueDate: '2018-11-15 16:30:00',
		  successRedirectUrl:"http://localhost/mulaCheckout/success.php",
	      failRedirectUrl: "http://localhost/mulaCheckout/failed.php",
	      paymentWebhookUrl: "http://localhost/mulaCheckout/payment_webhook.php"
	  }; // The params to be encrypted
 
		MulaCheckout.addPayWithMulaButton({ className:'checkout-button', checkoutType:'express'});

  		// Initialize the mula checkout modal/redirect
        //on button click, redirect to express checkout
        document.querySelector(".mula-checkout-button").addEventListener("click", function () {

	    function encrypt() {
	        return fetch(
			merchantURL, 
			{
				method:'POST', 
				body:JSON.stringify(params),
				mode:'cors'
			}).then(response => response.json())
	    }

	    encrypt().then(response => {
	    	console.log('response returned',response);
		MulaCheckout.renderMulaCheckout({
	                    checkoutType: "express",
            		    merchantProperties: response,
        	        });
		    }
	   	 )
		    .catch(error => console.log('error gotten',error));;

    });
</script>
