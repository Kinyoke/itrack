var totalContr = 0;
var totalPledge = 0;
var totalMember = 0;

var hidenElemContr = 0;
var hidenElemMemb = 0;
var hidenElemPledge = 0;

var temp_Val;


$(document).ready(function(){
    /* Add shadow to Navbar*/
	if ($(".tuggle-nav").length > 0) { $(".navbar").attr("class","navbar navbar-light border-bottom navbar-expand-lg shadowX"); }

	/* Toggle Dashboard Navbar */
	if ($(".tuggle-nav").length > 0) { $(".navbar").attr("class","navbar navbar-light border-bottom navbar-expand-lg shadowX"); }

	/* Remove Navbar */
	if($(".ndestroy").length > 0){ $(".navbar").css({"display":"none"}); }

	totalContr = $(".listX-contrib").length;
	totalPledge = $(".listX-pledge").length;
	totalMember = $(".listX-member").length;

      hidenElemContr = $(".listX-contrib").length-4;
      hidenElemMemb = $(".listX-member").length - 4;
      hidenElemPledge = $(".listX-pledge").length - 4;

	if (totalContr > 4) { $(".info-more-btn-contr").css({"display":"block"}); $("#info-more-contr-btn-label").text(totalContr-4); }
	if (totalPledge > 4) { $(".info-more-btn-pledge").css({"display":"block"}); $("#info-more-pledge-btn-label").text(totalPledge-4); }
	if (totalMember > 4) { $(".info-more-btn-member").css({"display":"block"}); $("#info-more-member-btn-label").text(totalMember-4); }
      
      if ($(".isActivated").length > 0) {
            temp_Val = sessionStorage;
            if (temp_Val.getItem("isActivated") != "deactivate") {
                  $(".isActivated").click();
                  temp_Val.setItem("isActivated", "deactivate");
            }else{
                  sessionStorage.clear();
            }
      }

      if ($(".isInactive").length > 0) {
            // sessionStorage.setItem("isActivated", "Activated");
            $(".isInactive").click();
      }

      // $(".w-webflow-badge").css({"display":"none ! important"});

      displayAll();
});


setTimeout(function(){
      totalContr = $(".listX-contrib").length;
      totalPledge = $(".listX-pledge").length;
      totalMember = $(".listX-member").length;

      hidenElemContr = $(".listX-contrib").length-4;
      hidenElemMemb = $(".listX-pledge").length - 4;
      hidenElemPledge = $(".listX-member").length - 4;
      
      if (totalContr > 4) { $(".info-more-btn-contr").css({"display":"block"}); $("#info-more-contr-btn-label").text(totalContr-4); }
      if (totalPledge > 4) { $(".info-more-btn-pledge").css({"display":"block"}); $("#info-more-pledge-btn-label").text(totalPledge-4);}
      if (totalMember > 4) { $(".info-more-btn-member").css({"display":"block"}); $("#info-more-member-btn-label").text(totalMember-4);}
}, 30000);


/* Link for return to first Form in Fundraiser Creation */
$("#back-link").click(function(){
    /* Show first form */
    $(".create-main-pane:eq(1)").attr("class", "create-main-pane");
    $(".create-main-pane:eq(0)").attr("class", "create-main-pane create-main-pane-active");
});



$("#make-plage-btn-rd").click(function(){
	location.href = "../group/pledge";
});

// $("#edit-group-btn").click(function(){
// 	location.href = "../group/edit";
// });


$(".edit-cancel-btn").click(function(){
	location.href = "../group/info?id=<?= $group->GROUP_ID?>&num=<?= $_SESSION['phoneNumber'] ?>";
});


var tabHeight = 370;
var itemCounter = 5;
var leftItems = 0;
$(".member-more-btn").click(function(){
	tabHeight+=375;
	leftItems = (itemCounter <= 5)? totalItems : leftItems;
	leftItems =  leftItems - 4;
	$("#myTabContent").css({"height":""+tabHeight+"px"});
	for (var i = itemCounter; i < 11; i++) {
		itemCounter++;
		$(".member-cont-item-container:eq("+itemCounter+")").css({"display":"block"});
	}
	$("#more-btn-label").text(leftItems); 
});


var visibleItemsContr = 3;
var stepCounterContr = 9;
var displayValContr = 2;
var contrFlag = true;


$(".info-more-btn-contr").click(function(){

 
	contrFlag = (displayValContr > 0)? true : false;
	if (contrFlag) {
		for (var i = visibleItemsContr; i < stepCounterContr; i++) {
            if (i <= totalContr) {
                $(".listX-contrib:eq("+visibleItemsContr+")").css({"display":"block"});
                  visibleItemsContr++;
            }else{
                break;
           	}
		}
		
		stepCounterContr += 8;
		displayValContr = (hidenElemContr - visibleItemsContr > 0)? hidenElemContr - visibleItemsContr : 0;
		$("#info-more-contr-btn-label").text(displayValContr);
		if (displayValContr == 0) {
                  $("#info-more-contr-btn-label").text("");
			$(".indicator-contr").attr("class", "fa fa-chevron-up indicator-contr");
			$("#more-contr-less-label").text(" less");
		}

		$("html, body").animate({ scrollTop: $(document).height()-$(window).height() }, 500);
	}

	if (!contrFlag) {
		for (var i = visibleItemsContr; i > 4; i--) {
			visibleItemsContr--;
			$(".listX-contrib:eq("+visibleItemsContr+")").css({"display":"none"});
		}
		$("#info-more-contr-btn-label").text(hidenElemContr);
		stepCounterContr = 9;
		displayValContr = 2;
		if (displayValContr > 0) {
			$(".indicator-contr").attr("class", "fa fa-chevron-down indicator-contr");
			$("#more-contr-less-label").text(" more");
		}

		$("html, body").animate({ scrollTop: 350 }, 500);
	}
	
});




var visibleItemsMemb = 3;
var stepCounterMemb = 9;
var displayValMemb = 2;
var memFlag = true;

$(".info-more-btn-member").click(function(){
	memFlag = (displayValMemb > 0)? true : false;
	if (memFlag) {
	for (var i = visibleItemsMemb; i < stepCounterMemb; i++) {
		$(".listX-member:eq("+visibleItemsMemb+")").css({"display":"block"});
            visibleItemsMemb++;
	}
		stepCounterMemb += 8;
		displayValMemb = (hidenElemMemb - visibleItemsMemb > 0)? hidenElemMemb - visibleItemsMemb : 0;
		$("#info-more-member-btn-label").text(displayValMemb);
		if (displayValMemb == 0) {
                  $("#info-more-member-btn-label").text("");
			$(".indicator-member").attr("class", "fa fa-chevron-up indicator-member");
			$("#more-member-less-label").text("less");
		}

		$("html, body").animate({ scrollTop: $(document).height()-$(window).height() }, 500);
	}

	if (!memFlag) {
		for (var i = visibleItemsMemb; i > 4; i--) {
			visibleItemsMemb--;
			$(".listX-member:eq("+visibleItemsMemb+")").css({"display":"none"});
		}
		$("#info-more-member-btn-label").text(hidenElemMemb);
		stepCounterMemb = 9;
		displayValMemb = 2;
		if (displayValMemb > 0) {
			$(".indicator-member").attr("class", "fa fa-chevron-down indicator-member");
			$("#more-member-less-label").text(" more");
		}

		$("html, body").animate({ scrollTop: 300 }, 500);
	}
	
});




var visibleItemsPledge = 3;
var stepCounterPledge = 9;
var displayValPledge = 2;
var pledgeFlag = true;



$(".info-more-btn-pledge").click(function(){
	pledgeFlag = (displayValPledge > 0)? true : false;
	if (pledgeFlag) {
	for (var i = visibleItemsPledge; i < stepCounterPledge; i++) {
		$(".listX-pledge:eq("+visibleItemsPledge+")").css({"display":"block"});
            visibleItemsPledge++;
	}
		stepCounterPledge += 8;
		displayValPledge = (hidenElemPledge - visibleItemsPledge > 0)? hidenElemPledge - visibleItemsPledge : 0;
		$("#info-more-pledge-btn-label").text(displayValPledge);
		if (displayValPledge == 0) {
                  $("#info-more-pledge-btn-label").text("");
			$(".indicator-pledge").attr("class", "fa fa-chevron-up indicator-pledge");
			$("#more-pledge-less-label").text("less");
		}
	}
	if (!pledgeFlag) {
		for (var i = visibleItemsPledge; i > 4; i--) {
			visibleItemsPledge--;
			$(".listX-pledge:eq("+visibleItemsPledge+")").css({"display":"none"});
		}
		$("#info-more-pledge-btn-label").text(hidenElemPledge);
		stepCounterPledge = 9;
		displayValPledge = 2;
		if (displayValPledge > 0) {
			$(".indicator-pledge").attr("class", "fa fa-chevron-down indicator-pledge");
			$("#more-pledge-less-label").text(" more");
		}
	}
	
});



var payload = {
	"MERCHANT_PAYERS": [
        {
            "HUB_CLIENT_ID": 7,
            "CLIENT_NAME": "M-PESA",
            "CLIENT_CODE": "SAFKE",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "SERVICE_NAME": "SAFKE",
            "SERVICE_CODE": "SAFKE",
            "HUB_SERVICE_ID": 1,
            "ACTIVE_STATUS": 1,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "STATUS_MESSAGE": "Payment Mode is Active",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/mpesa.gif",
            "WEB_TEMPLATE_ID": "",
            "PAYBILL": "369369",
            "NETWORK_ID": "63902",
            "REFERENCE_LABEL": "Paybill No",
            "IS_SELECTED": "1",
            "PAYMENT_INSTRUCTIONS": "#P#To complete this M-Pesa transaction, you will need to use service PIN on your handset. #P# #L1#1. You will receive an M-Pesa authorization request on your phone to compelete payment #L2#. Enter your unique M-Pesa PIN and press 'Send' #L3#.Press '1' to confirm and press 'Send' #P# #P#If you don't have an M-Pesa Service PIN you'll be instructed to create a new one. In to create a new Service PIN on M-Pesa, you'll need to provide your national ID number.",
            "IS_DEFAULT": "1",
            "ORDER_ID": "1",
            "ABBREVIATION": "MP",
            "COLOR_CODE": "#60b01d",
            "SHORT_NAME": "M-Pesa",
            "SHOW_LOGO": "1",
            "CHECKOUT_TYPE": "USSD_PUSH",
            "CAN_PAY_FOR_OTHER": 1,
            "PAYER_REFERENCE": "811926",
            "CHARGE_SYNC_MODE": 1,
            "PAYMENT_COUNT": 3,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "MPESA is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 10,
            "CLIENT_NAME": "Airtel Money",
            "CLIENT_CODE": "AIRTELKE",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "",
            "HUB_SERVICE_ID": 1,
            "ACTIVE_STATUS": 1,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "STATUS_MESSAGE": "Payment Mode is Active",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/airtel.jpg",
            "WEB_TEMPLATE_ID": "",
            "PAYBILL": "369369",
            "NETWORK_ID": "63902",
            "REFERENCE_LABEL": "Business No",
            "IS_SELECTED": "1",
            "PAYMENT_INSTRUCTIONS": " Pay",
            "IS_DEFAULT": "1",
            "ORDER_ID": "2",
            "ABBREVIATION": "AM",
            "COLOR_CODE": "#60b01d",
            "SHORT_NAME": "Airtel Money",
            "SHOW_LOGO": "1",
            "CHECKOUT_TYPE": "STK_LAUNCH",
            "CAN_PAY_FOR_OTHER": 1,
            "PAYER_REFERENCE": "811926",
            "CHARGE_SYNC_MODE": 1,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "Airtel Money is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 50,
            "CLIENT_NAME": "Equitel",
            "CLIENT_CODE": "Equitel",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 3,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "Equitel",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/Equitel.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "1",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "3",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "EQ",
            "COLOR_CODE": "#60b01d",
            "SHORT_NAME": "Equitel",
            "SHOW_LOGO": "1",
            "CHECKOUT_TYPE": "IN_APP",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "Equitel is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 34,
            "CLIENT_NAME": "Kenya Commercial Bank",
            "CLIENT_CODE": "KCB",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 1,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "KCB",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/kcb.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "0",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "4",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "K",
            "COLOR_CODE": "#8dc63f",
            "SHORT_NAME": "KCB",
            "SHOW_LOGO": "1",
            "CHECKOUT_TYPE": "CARD_CHECKOUT",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "KCB is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 101,
            "CLIENT_NAME": "Co-operative Bank",
            "CLIENT_CODE": "COOB",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 1,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "COOB",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/coop-bank.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "1",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "5",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "CB",
            "COLOR_CODE": "#00543d",
            "SHORT_NAME": "Co-op Bank",
            "SHOW_LOGO": "1",
            "CHECKOUT_TYPE": "CARD_CHECKOUT",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "Co-op Bank is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 27,
            "CLIENT_NAME": "Stanbic Bank Kenya",
            "CLIENT_CODE": "CFCKE",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 3,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "DSTVKE",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/cfc.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "0",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "6",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "CS",
            "COLOR_CODE": "#00539a",
            "SHORT_NAME": "Stanbic",
            "SHOW_LOGO": "0",
            "CHECKOUT_TYPE": "CARD_CHECKOUT",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "Stanbic Bank is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 9,
            "CLIENT_NAME": "Standard Chartered",
            "CLIENT_CODE": "SCBKE",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 3,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "SCBKE",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/StandardChartered.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "0",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "7",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "SC",
            "COLOR_CODE": "#0072ae",
            "SHORT_NAME": "SCB",
            "SHOW_LOGO": "0",
            "CHECKOUT_TYPE": "CARD_CHECKOUT",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "Stan Chart is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 26,
            "CLIENT_NAME": "Diamond Trust Bank",
            "CLIENT_CODE": "DTBKE",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 1,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "DTBKE",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is Active",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/dtb.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "0",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "8",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "DT",
            "COLOR_CODE": "#fa0028",
            "SHORT_NAME": "DTB",
            "SHOW_LOGO": "1",
            "CHECKOUT_TYPE": "IN_APP",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "DTB is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 12,
            "CLIENT_NAME": "Barclays Bank",
            "CLIENT_CODE": "BARK",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 3,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "BBKE",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/barclays.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "0",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "9",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "B",
            "COLOR_CODE": "#01aef2",
            "SHORT_NAME": "Barclays",
            "SHOW_LOGO": "0",
            "CHECKOUT_TYPE": "CARD_CHECKOUT",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "Barclays is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 15,
            "CLIENT_NAME": "NIC Bank",
            "CLIENT_CODE": "NICKE",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 3,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "NICKE",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/nic.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "0",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "9",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "N",
            "COLOR_CODE": "#167cc4",
            "SHORT_NAME": "NIC",
            "SHOW_LOGO": "0",
            "CHECKOUT_TYPE": "CARD_CHECKOUT",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "NIC is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 102,
            "CLIENT_NAME": "I&M",
            "CLIENT_CODE": "I&M",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 3,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "I&M",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/inm.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "0",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "10",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "I",
            "COLOR_CODE": "#104870",
            "SHORT_NAME": "I&M",
            "SHOW_LOGO": "0",
            "CHECKOUT_TYPE": "CARD_CHECKOUT",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "I&M is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 28,
            "CLIENT_NAME": "National Bank",
            "CLIENT_CODE": "NBK",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 3,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "NBK",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/NationalBank.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "0",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "11",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "N",
            "COLOR_CODE": "#e0b403",
            "SHORT_NAME": "National Bank",
            "SHOW_LOGO": "0",
            "CHECKOUT_TYPE": "CARD_CHECKOUT",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "National Bank is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 103,
            "CLIENT_NAME": "Family Bank",
            "CLIENT_CODE": "FAMB",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 3,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "FAMB",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/FamilyBank.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "0",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "12",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "FB",
            "COLOR_CODE": "#0288c7",
            "SHORT_NAME": "Family Bank",
            "SHOW_LOGO": "0",
            "CHECKOUT_TYPE": "CARD_CHECKOUT",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "Family Bank is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 43,
            "CLIENT_NAME": "Faulu Bank",
            "CLIENT_CODE": "FAUB",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 3,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "FAUB",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/Faulu.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "0",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "13",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "FB",
            "COLOR_CODE": "#652d90",
            "SHORT_NAME": "Faulu Bank",
            "SHOW_LOGO": "0",
            "CHECKOUT_TYPE": "CARD_CHECKOUT",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "Faulu is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 104,
            "CLIENT_NAME": "CBA",
            "CLIENT_CODE": "CBA",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 3,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "CBA",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/CBA.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "0",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "14",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "C",
            "COLOR_CODE": "#230c02",
            "SHORT_NAME": "CBA",
            "SHOW_LOGO": "0",
            "CHECKOUT_TYPE": "CARD_CHECKOUT",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "CBA is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 5,
            "CLIENT_NAME": "Bank of Africa",
            "CLIENT_CODE": "BOA",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "ACTIVE_STATUS": 3,
            "CAN_PAY": 1,
            "VIEWABLE": "1",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "BOA",
            "HUB_SERVICE_ID": "1",
            "STATUS_MESSAGE": "Payment Mode is currently inactive",
            "LOGO": "https://admin.cellulant.co.ke:9101/client/images/logos/services/bof.gif",
            "WEB_TEMPLATE_ID": null,
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Bank A/C No",
            "IS_SELECTED": "0",
            "PAYMENT_INSTRUCTIONS": "",
            "IS_DEFAULT": "0",
            "ORDER_ID": "15",
            "PAYMENT_INSTRUCTION": "",
            "ABBREVIATION": "B",
            "COLOR_CODE": "#008443",
            "SHORT_NAME": "BOA",
            "SHOW_LOGO": "0",
            "CHECKOUT_TYPE": "CARD_CHECKOUT",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "",
            "CHARGE_SYNC_MODE": 0,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "Bank of Africa is currently not available as a payment option on mula. We will notify you when you can use"
        },
        {
            "HUB_CLIENT_ID": 162,
            "CLIENT_NAME": "Card",
            "CLIENT_CODE": "CyberSCKE",
            "COUNTRY_ID": 117,
            "COUNTRY": "Kenya",
            "SERVICE_NAME": "",
            "SERVICE_CODE": "",
            "HUB_SERVICE_ID": "",
            "ACTIVE_STATUS": 3,
            "CAN_PAY": 1,
            "VIEWABLE": 0,
            "STATUS_MESSAGE": "Payment Mode is Active",
            "LOGO": "https://mula.co.ke/mula_ke/api/v1/images/services/Card-Payment-logo.png",
            "WEB_TEMPLATE_ID": "",
            "PAYBILL": "",
            "NETWORK_ID": "",
            "REFERENCE_LABEL": "Card",
            "IS_SELECTED": "1",
            "PAYMENT_INSTRUCTIONS": " Pay",
            "IS_DEFAULT": "1",
            "ORDER_ID": "3",
            "PAYMENT_INSTRUCTION": "Please follow instructions on the next page",
            "ABBREVIATION": "CD",
            "COLOR_CODE": "#CCDDCC",
            "SHORT_NAME": "",
            "SHOW_LOGO": "1",
            "CHECKOUT_TYPE": "CARD",
            "CAN_PAY_FOR_OTHER": 0,
            "PAYER_REFERENCE": "CELLULANT-CARD",
            "CHARGE_SYNC_MODE": 1,
            "PAYMENT_COUNT": 0,
            "IS_CHARGING_PAYER": "NO",
            "PAYER_CHARGE": "",
            "TITLE": "Alert",
            "MESSAGE": "Card is currently not available as a payment option on mula. We will notify you when you can use",
            "PAYMENT_ACTIVATION_DESC": "For your security, we will activate your card by charging you a refundable amount. Provide this amount from your bank statement, to validate ownership of the card."
        }
    ]

};


function testPayload(arg) {
	for(var i = 0; i < arg["MERCHANT_PAYERS"].length; i++){
		var pane_fst;
		if ((i % 4) == 0) {
			var pane_fst = document.createElement("div");
			pane_fst.className = "pay-opts-pad";
			if (i == 0) {
				pane_fst.id = "activepad";
			}
		}

		var elem = document.createElement("a");
			elem.className = "pay-opts-item pay-opts-item-active";
		
		var img = document.createElement("img");
		img.src =  ""+arg["MERCHANT_PAYERS"][i]["LOGO"]+"";
		img.className = "pay-opts-item-img p-0 pb-0";
		elem.append(img);
		pane_fst.append(elem);
		$(".pay-opts").append(pane_fst);
	}
	
}


testPayload(payload);

var pointer = 0;

$(".pay-opts-item-more").click(function(){
	pointer = (pointer < $(".pay-opts-pad").length-1)? pointer+=1 : $(".pay-opts-pad").length-1;
	$(".pay-opts-pad:eq("+(pointer-1)+")").attr("id", "");
	$(".pay-opts-pad:eq("+pointer+")").attr("id", "activepad");
      if (pointer == 1) {
            $(".pay-opts-item-less").css({"display":"block"});
            $(".pay-opts-item-more").css({"display":"block"});
      }
      if (pointer == 4) {
            $(".pay-opts-item-more").css({"display":"none"});
      }
});


$(".pay-opts-item-less").click(function(){
	pointer = (pointer > 0)? pointer-=1 : 0;
	$(".pay-opts-pad:eq("+(pointer+1)+")").attr("id", "");
	$(".pay-opts-pad:eq("+pointer+")").attr("id", "activepad");
      if (pointer == 0) {
            $(".pay-opts-item-less").css({"display":"none"});
            $(".pay-opts-item-more").css({"display":"block"});
      }
      if (pointer < 4) {
            $(".pay-opts-item-more").css({"display":"block"});
      }
});


function displayAll(){
      if (screen.width <= 690) {
            for (var i = 4; i < $(".pay-opts-item").length; i++) {
                  // $(".pay-opts-pad:eq("+(pointer+1)+")").attr("id", "");
                  // $(".pay-opts-pad:eq("+i+")").attr("id", "activepad");
                  // $(".pay-opts-pad:eq("+i+")").css({"display":"block"});
                  $(".pay-opts-item:eq("+i+")").css({"display":"block"});
                  console.log("i val: "+i);
            }
      }
      
      if (screen.width > 690){

            testPayload(payload);

                  // $(".pay-opts-pad:eq(0)").attr("id", "activepad");
                  // $(".pay-opts-pad:eq(0)").css({"display":"block"});
                  // $(".pay-opts-item:eq(0)").css({"display":"block"});
                  // $(".pay-opts-item:eq(1)").css({"display":"block"});
                  // $(".pay-opts-item:eq(2)").css({"display":"block"});
                  // $(".pay-opts-item:eq(3)").css({"display":"block"});

                  for (var i = 1; i < $(".pay-opts-pad").length; i++) {
                        $(".pay-opts-pad:eq("+i+")").attr("id", "");
                        // $(".pay-opts-pad:eq("+i+")").css({"display":"none"});
                  }

                  // for (var i = 4; i < $(".pay-opts-item").length; i++) {
                  //       // $(".pay-opts-pad:eq("+(pointer+1)+")").attr("id", "");
                  //       $(".pay-opts-item:eq("+i+")").css({"display":"none"});
                  // }
      }
}


function selectEdMember(ev, index){
      var trigger_1 = (ev.target == $(".pay-opts-item")[index])? true : false;
      var trigger_2 = (ev.target == $(".pay-opts-item-img")[index])? true : false;
      return trigger_1 || trigger_2;
}

function mobileMoneyElements(){
      if ($("#w-msisdn").attr("type") == "hidden") {
            $("#w-msisdn").attr("type", "text");
            $(".w-msisdn-cd").css({"display":"block"});
            $("#w-msisdn-err").css({"display":"block"});
            $("#w-acc-nm").attr("type", "hidden");
            $("#w-acc-no").attr("type", 'hidden');
      }
}

function bankAccElements(){
      if ($("#w-acc-nm").attr("type") == "hidden" && $("#w-acc-no").attr("type") == "hidden") {
            $("#w-msisdn").attr("type", "hidden");
            $("#w-msisdn-err").css({"display":"none"});
            $(".w-msisdn-cd").css({"display":"none"});
            $("#w-acc-nm").attr("type", "text");
            $("#w-acc-no").attr("type", "text");
      }
}


$(window).click(function(e){

      // if (e.target.className != "fa a-search") {
      //       // alert(e.target.className);
      //       $(".search-container").css({"margin-top":"-80px"});
      // }
	switch(e.target.className)
	{
		case "pay-opts-item pay-opts-item-active": 
            case "pay-opts-item-img p-0 pb-0":

			for(var i = 0; i < $(".pay-opts-item").length; i++)
			{
				$(".pay-opts-item-img:eq("+i+")").css({"filter":"grayscale(1)"});
				$(".pay-opts-item:eq("+i+")").css({"border": "2px solid rgba(220, 220, 220, 0.6)"});
				if (selectEdMember(e, i)){
                              $(".pay-opts-item:eq("+i+")").css({"border": "2px solid #007AFF"});
					$(".pay-opts-item-img:eq("+i+")").css({"filter":"grayscale(0)"});
					var imgSrc = $(".pay-opts-item")[i].firstChild.src;
					if(hasPayBill(payload, imgSrc, $("#payer_client"))){
                                    mobileMoneyElements();                              
					
                              }else{

                                    bankAccElements();

					}
				}
			}
		break;

            case "listX-pledge listX-pledge-active p-2 mt-1 row":
            case "col-lg-10 list-row list-row-pledge":
            case "phone-pledge phone m-0 text-muted":
            case "amount-pledge my-2 font-semibold float-right":
            case "name my-2 name-pledge":
            case "mb-0 acronym-pledge":
            case "col-lg-10 list-row":
                  for (var i = 0; i < $(".listX-pledge").length; i++) {
                        if (selectedListItem(e, i)) {
                              var acronym = $(".acronym-pledge")[i].innerHTML;
                              var amount = $(".amount-pledge")[i].innerHTML;
                              var name = $(".name-pledge")[i].innerHTML;
                              var phonen = $(".phone-pledge")[i].innerHTML;
                              var dueDate = $(".pladge-due-date")[i].innerHTML;
                              var dateTmp = dueDate.replace(' 00:00:00', '').split("-");         

                              if ($(".listX-pledge")[i].id == "listX-pledge-member" || $(".phone-pledge")[i].id == "76HJGGFAhg347hjgff") {
                                    
                                    $("#initials-e").text(acronym);
                                    $("#pledger-alias-e").text(name);
                                    $("#pledger-mno-e").text(phonen);
                                    $("#in-p-amount").val(amount.replace('KES', ''));
                                    $("#datepicker").val(dateTmp[1]+"\\"+dateTmp[2]+"\\"+dateTmp[0]);
                                    $("#actPledgeEd").click();

                              }else{
      
                                    $("#initials").text(acronym);
                                    $("#pledger-alias").text(name);
                                    $("#pledger-mno").text(phonen);
                                    $("#p-amount").text(amount);
                                    $("#p-due-date-r").text(dateTmp[1]+"\\"+dateTmp[2]+"\\"+dateTmp[0]);
                                    $("#actPledgeRem").click();
                              }
                        }   
                  }
            break;

	}


});


// pre-select payment options by initiating click for the first payment option item
if ($(".pay-opts-item").length > 0) {
      $(".pay-opts-item")[0].click();
}

/*
*form validation for withdraw 
*/

var validate_flag_w = 0;

const flagPointer_w = new Array(0, 0); 

var btn_w_sf = false;

$("#act-withdraw-btn").click(function(){
      
            var hiddenItems = 0;
            var visibleItems = 0;

            for(var i = 0; i < $(".w-form-inputs").length; i++){

                  if(($(".w-form-inputs:eq("+i+")").attr("type") != "hidden")){
                        visibleItems++;
                  }else{
                        hiddenItems++;
                  }
                  
            }

            flagPointer_w[0] = visibleItems;

            //console.log("HiddenItems: "+hiddenItems+">>>> visibleItems: "+visibleItems);

            btn_w_sf = true;

      //console.log(flagPointer_w[0]+" >> "+flagPointer_w[1])

      switch(flagPointer_w[0]){
            case 2:
                  if (flagPointer_w[0] == flagPointer_w[1]) {
                        $("#act-withdraw-btn").attr("name", "act-withdraw-btn");
                        $("#act-withdraw-btn").attr("form", "withdraw-form");
                  }else{
                        for (var i = 0; i < $(".w-form-inputs").length; i++) {
                              if ($(".w-form-inputs:eq("+i+")").val() == "") {
                                    $(".w-form-inputs:eq("+i+")").css({"border":"1px solid red"});
                              }
                        }
                  }
            break;

            case 3:
                  if (flagPointer_w[0] == flagPointer_w[1]) {
                        $('#act-withdraw-btn').attr('name','act-withdraw-btn-bank');
                        $('#act-withdraw-btn').attr('id','act-withdraw-btn-bank');
                        $('#act-withdraw-btn-bank').attr('form','withdraw-form');
                  }else{
                        for (var i = 0; i < $(".w-form-inputs").length; i++) {
                              if ($(".w-form-inputs:eq("+i+")").val() == "") {
                                    $(".w-form-inputs:eq("+i+")").css({"border":"1px solid red"});
                              }
                        }
                  }
      
            break;
      }
});
                              
var regEx_w1 = /[^a-zA-Z\'\s{\^}]/gm;;
var regEx_number1 = /[^0-9]/g;
// var regEx_w2 = /[^a-z]/g 

var flagSet_w1 = false;
var flagSet_w2 = false;
var flagSet_w3 = false;
var flagSet_w4 = false;

$("#w-amount").on("keyup", function(){
      $(".w-form-inputs").css({"border":""});
      var custom_msg = {
            "NUMBER_ONLY" : "Please enter a valid amount",
            // "MATCH_REGEX" : "Please enter a valid amount",
            "MINIMUM_VAL" : 10,
            "MAXIMUM_VAL" : 1000,
            "MINIMUM" : "Sorry entered amount is less than minimum required amount of KES ", 
            "MAXIMUM" : "Sorry entered amount exceeds contributed amount",
            "IS_VALID" : 1
      };
      
      var flagReturned = validateInput(regEx_number1, $("#w-amount"), custom_msg, $("#w-amount-err"), validate_flag_w);
      
      if(flagReturned === 1 ){

            if(!flagSet_w1){

                  flagPointer_w[1] += flagReturned;
                  flagSet_w1 = true;

            }

      }else{
      
            if(flagSet_w1){
                  flagPointer_w[1] -= 1;
                  flagSet_w1 = false;
            }

      }
      //console.log("w-amount flagReturned "+flagReturned);
      
});

if($("#w-msisdn") !=null){

      $('#w-msisdn').attr('autocomplete', 'off');
      
}

$("#w-msisdn").on("keyup", function(){
      $(".w-form-inputs").css({"border":""});
      
      var custom_msg = {
            "NUMBER_ONLY" : "Please enter a valid mobile number",
            "MATCH_REGEX" : "^(0|)[0-9]{9}$",
      };

      var flagReturned = validateInput(regEx_number1, $("#w-msisdn"), custom_msg, $("#w-msisdn-err"), validate_flag_w);
      
      if(flagReturned === 1 ){

            if(!flagSet_w2){

                  flagPointer_w[1] += flagReturned;
                  flagSet_w2 = true;

            }

      }else{
            if(flagSet_w2){
                  flagPointer_w[1] -= 1;
                  flagSet_w2 = false;
            }

      }

      //console.log("w-msisdn flagReturned++ "+flagReturned);
});

if($("#w-acc-nm") !=null){

      $('#w-acc-nm').attr('autocomplete', 'off');
      
}

$("#w-acc-nm").on("keyup", function(){
      $(".w-form-inputs").css({"border":""});

      var custom_msg = {
            "NUMBER_ONLY" : "Please enter a valid account name",
            "MATCH_REGEX" : "[^a-z]",
      };
//"[a-z{30}$]
      var flagReturned = validateInput(regEx_w1, $("#w-acc-nm"), custom_msg, $("#w-acc-nm-err"), validate_flag_w);
      
      if(flagReturned === 1 ){

            if(!flagSet_w3){

                  flagPointer_w[1] += flagReturned;
                  flagSet_w3 = true;

            }

      }else{
            if(flagSet_w3){
                  flagPointer_w[1] -= 1;
                  flagSet_w3 = false;
            }

      }

      //console.log("w-acc-nm flagReturned++ "+flagReturned);
});

if($("#w-acc-no") !=null){

      $('#w-acc-no').attr('autocomplete', 'off');
      
}

$("#w-acc-no").on("keyup", function(){
      $(".w-form-inputs").css({  "border":""});
      
      var custom_msg = {
          "NUMBER_ONLY" : "Please enter a valid account number",
          "MATCH_REGEX" : "^(0|)[0-9]{12}$",
      };

      var flagReturned = validateInput(regEx_number1, $("#w-acc-no"), custom_msg, $("#w-acc-no-err"), validate_flag_w);
      
      if(flagReturned === 1 ){

            if(!flagSet_w4){

                  flagPointer_w[1] += flagReturned;
                  flagSet_w4 = true;

            }

      }else{
            if(flagSet_w4){
                  flagPointer_w[1] -= 1;
                  flagSet_w4 = false;
            }

      }

      //console.log("w-acc-no flagReturned "+flagReturned);
});



/*
*input validation for create group page
*/

const flagPointer_c = new Array(0, 0); 
var validate_flag_c = 0;
var btn_cn_sf = false;

$("#next_page_btn").click(function(){
      
      var hiddenItems = 0;
      var visibleItems = 0;

      for(var i = 0; i < $(".create-form-input").length; i++){

            if(($(".create-form-input:eq("+i+")").attr("type") != "hidden")){
                  visibleItems++;
            }else{
                  hiddenItems++;
            }
                  
      }

      flagPointer_c[0] = visibleItems;

      //console.log("HiddenItems: "+hiddenItems+">>>> visibleItems: "+visibleItems);

      btn_cn_sf = true;

      //console.log(flagPointer_c[0]+" >> "+flagPointer_c[1])

      switch(flagPointer_c[0]){
            case 3:
                  if (flagPointer_c[0] == flagPointer_c[1]) {
                        $(".create-main-pane:eq(0)").attr("class", "create-main-pane");
                        $(".create-main-pane:eq(1)").attr("class", "create-main-pane create-main-pane-active");
                  }else{
                        for (var i = 0; i < $(".create-form-input").length; i++) {
                              if ($(".create-form-input:eq("+i+")").val() == "") {
                                    $(".create-form-input:eq("+i+")").css({"border":"1px solid red"});
                              }
                        }
                  }
            break;

      }


});


var flagSet_c1 = false;
var flagSet_c2 = false;
var flagSet_c3 = false;

var regEx_c1 = /[^a-zA-Z\'\s{\^}]/gm;
var regEx_c2 = /[^0-9]/g;
var regEx_c3 = /[^a-zA-Z\'\^0-9]/gm;

$("#mname").on("keyup", function(){
      $(".create-form-input").css({"border":""});
      var custom_msg = {
            "NUMBER_ONLY" : "Please enter a valid name",
            "MATCH_REGEX" : "[a-z{30}$]",
      };

      var flagReturned = validateInput(regEx_c1, $("#mname"), custom_msg, $("#mname-err"), validate_flag_c);
      
      if(flagReturned === 1 ){

            if(!flagSet_c1){

                  flagPointer_c[1] += flagReturned;
                  flagSet_c1 = true;

            }

      }else{
            if(flagSet_c1){
                  flagPointer_c[1] -= 1;
                  flagSet_c1 = false;
            }

      }

      //console.log("w-msisdn flagReturned --"+flagReturned);
});

if($("#mnumber") !=null){

      $('#mnumber').attr('autocomplete', 'off');
      
}

$("#mnumber").on("keyup", function(){
      $(".create-form-input").css({"border":""}); 
      var custom_msg = {
            "NUMBER_ONLY" : "Please enter a valid mobile number",
            "MATCH_REGEX" : "^(0|)[0-9]{9}$",
      };

      var flagReturned = validateInput(regEx_c2, $("#mnumber"), custom_msg, $("#mnumber-err"), validate_flag_c);
      
      if(flagReturned === 1 ){

            if(!flagSet_c2){

                  flagPointer_c[1] += flagReturned;
                  flagSet_c2 = true;

            }

      }else{
            if(flagSet_c2){
                  flagPointer_c[1] -= 1;
                  flagSet_c2 = false;
            }

      }

      //console.log("w-msisdn flagReturned --"+flagReturned);
});



$("#userid").on("keyup", function(){
      $(".create-form-input").css({"border":""});
      var custom_msg = {
            "NUMBER_ONLY" : "Please enter a valid ID/passport number",
            "MATCH_REGEX" : "[a-zA-Z0-9{12}$]",
      };

      var flagReturned = validateInput(regEx_c3, $("#userid"), custom_msg, $("#userid-err"), validate_flag_c);
      
      if(flagReturned === 1 ){

            if(!flagSet_c3){

                  flagPointer_c[1] += flagReturned;
                  flagSet_c3 = true;

            }

      }else{
            if(flagSet_c3){
                  flagPointer_c[1] -= 1;
                  flagSet_c3 = false;
            }

      }

      //console.log("w-msisdn flagReturned --"+flagReturned);
});


const flagPointer_cf = new Array(0, 0); 
var validate_flag_cf = 0;
var btn_cf_sf = false;


$("#create-group-btn").click(function(){
      
      var hiddenItems = 0;
      var visibleItems = 0;

      for(var i = 0; i < $(".create-form-input_f").length; i++){

            if(($(".create-form-input_f:eq("+i+")").attr("type") != "hidden")){
                  visibleItems++;
            } else{
                  hiddenItems++;
            }

      }

      flagPointer_cf[0] = visibleItems;

      //console.log("HiddenItems: "+hiddenItems+">>>> visibleItems: "+visibleItems);


      btn_cf_sf = true;

      // console.log(flagPointer_cf[0]+" >> "+flagPointer_cf[1]);

      switch(flagPointer_cf[0]){
            case 3:
                  if (flagPointer_cf[0] == flagPointer_cf[1]) {
                        
                        var termsConditions = document.getElementById("terms-mark");
                        var err_termsConditions = document.getElementById("err_termsConditions");

                        if (termsConditions.checked != true) {

                              err_termsConditions.innerHTML = "Please check the terms & conditions"
                          
                        } else {
 
                              $("#create-group-btn").attr("name", "create-group-btn");
                              $("#create-group-btn").attr("form", "create-group-form");
                        
                        }

                        
                  } else {
                        for (var i = 0; i < $(".create-form-input_f").length; i++) {
                              if ($(".create-form-input_f:eq("+i+")").val() == "") {
                                    $(".create-form-input_f:eq("+i+")").css({"border":"1px solid red"});
                              }
                        }
                  }
            break;

      }


});



var flagSet_cf1 = false;
var flagSet_cf2 = false;
var flagSet_cf3 = false;
var flagSet_cf4 = false;
var flagSet_cf5 = false;
var flagSet_cf6 = false;
var flagSet_cf7 = false;

var regEx_cf1 = /[^a-zA-Z0-9\'\s{\^}]/gm;
var regEx_cf2 = /[^0-9]/g;
var regEx_cf3 = /[^a-zA-Z\'\^0-9]/gm;
var regEx_cf4 = /[^a-zA-Z0-9\"\'\,\.\s]/gmi;

$("#group-name").on("keyup", function(){
      $(".create-form-input_f").css({"border":""});
      var custom_msg = {
            "MATCH_REGEX" : "[a-zA-Z0-9]",
            "WORD_COUNT" : "COUNT",
            "MINIMUM_WORD_COUNT": 1,
            "MAXIMUM_WORD_COUNT": 10,
            "MINIMUM_WORD_COUNT_MSG": "Word count less than minimum required for a group Name!",
            "MAXIMUM_WORD_COUNT_MSG": "Word count exceeds maximum required words for a group Name!"
      };


      var flagReturned = validateInput(regEx_cf1, $("#group-name"), custom_msg, $("#group-name-err"), validate_flag_cf);
      
      if(flagReturned === 1 ){

            if(!flagSet_cf1){

                  flagPointer_cf[1] += flagReturned;
                  flagSet_cf1 = true;

            }

      }else{
            if(flagSet_cf1){
                  flagPointer_cf[1] -= 1;
                  flagSet_cf1 = false;
            }

      }

//      console.log("w-msisdn flagReturned --"+flagReturned);
});


$("#group-desc").on("keyup", function(){
      $(".create-form-input_f").css({"border":""});
      var custom_msg = {
            "MATCH_REGEX" : "[a-zA-Z0-9]",
            "WORD_COUNT" : "COUNT",
            "MINIMUM_WORD_COUNT": 10,
            "MAXIMUM_WORD_COUNT": 120,
            "MINIMUM_WORD_COUNT_MSG": "Word count less than minimum of 10 words required for a group description. Please keep typing!",
            "MAXIMUM_WORD_COUNT_MSG": "Word count exceeds maximum of 120 words required words for a group description!"
      };

      var flagReturned = validateInput(regEx_cf4, $("#group-desc"), custom_msg, $("#group-desc-err"), validate_flag_cf);
      
      if(flagReturned === 1 ){

            if(!flagSet_cf2){

                  flagPointer_cf[1] += flagReturned;
                  flagSet_cf2 = true;

            }

      }else{
            if(flagSet_cf2){
                  flagPointer_cf[1] -= 1;
                  flagSet_cf2 = false;
            }

      }

//      console.log("w-msisdn flagReturned --"+flagReturned);
});


$("#amount-target").on("keyup", function(){
      $(".create-form-input_f").css({"border":""});
      var custom_msg = {
            "MATCH_REGEX" : "[0-9]",
            "NUMBER_ONLY" : "Please enter valid amount!",
            "MINIMUM_VAL" : "10",
            "MAXIMUM_VAL" : "999999999999",
            "MINIMUM" : "Amount less than minimum required amount of ",
            "MAXIMUM" : "Amount exceeds maximum amount to be contributed within one group!",
      };

      var flagReturned = validateInput(regEx_cf2, $("#amount-target"), custom_msg, $("#amount-target-err"), validate_flag_cf);
      
      if(flagReturned === 1 ){

            if(!flagSet_cf3){

                  flagPointer_cf[1] += flagReturned;
                  flagSet_cf3 = true;

            }

      }else{
            if(flagSet_cf3){
                  flagPointer_cf[1] -= 1;
                  flagSet_cf3 = false;
            }

      }

 //     console.log("w-msisdn flagReturned --"+flagReturned);
});




/*
*input validation for log in page
*/

const flagPointer_l = new Array(0, 0); 
var validate_flag_l = 0;
var btn_l_sf = false;

$("#mnumber").keyup(function(event) {
    if (event.keyCode === 13) {
        $("#login-btn").click();
    }
});

$("#login-btn").click(function(){
      
            var hiddenItems = 0;
            var visibleItems = 0;

            for(var i = 0; i < $(".l-form-input").length; i++){

                  if(($(".l-form-input:eq("+i+")").attr("type") != "hidden")){
                        visibleItems++;
                  }else{
                        hiddenItems++;
                  }
                  
            }

            flagPointer_l[0] = visibleItems;

            //console.log("HiddenItems: "+hiddenItems+">>>> visibleItems: "+visibleItems);

            btn_l_sf = true;

      //console.log(flagPointer_l[0]+" >> "+flagPointer_l[1])

      switch(flagPointer_l[0]){
            case 1:
                  if (flagPointer_l[0] == flagPointer_l[1]) {
                        sessionStorage.setItem("user_msisdn", $("#mnumber").val());
                        $("#login-btn").attr("form", "form-login");
                        $("#login-btn").attr("name", "login-btn");
                  }else{
                        for (var i = 0; i < $(".l-form-input").length; i++) {
                              if ($(".l-form-input:eq("+i+")").val() == "") {
                                    $(".l-form-input:eq("+i+")").css({"border":"1px solid red"});
                              }
                        }
                  }
            break;

      }
});


var flagSet_l = false;
var regEx_l = /[^0-9]/g;

if($("#mnumber") !=null){

      $('#mnumber').attr('autocomplete', 'off');
      
}

$("#mnumber").on("keyup", function(){

      $(".l-form-input").css({"border":""});
      
      var custom_msg = {
            "NUMBER_ONLY" : "Please enter a valid mobile number",
            "MATCH_REGEX" : "^(0|)[0-9]{9}$",
      };


      var flagReturned = validateInput(regEx_l, $("#mnumber"), custom_msg, $("#l-mnumber-err"), validate_flag_l);
      
      if(flagReturned === 1 ){

            if(!flagSet_l){

                  flagPointer_l[1] += flagReturned;
                  flagSet_l = true;

            }

      }else{
            if(flagSet_l){
                  flagPointer_l[1] -= 1;
                  flagSet_l = false;
            }

      }

      //console.log("l-mnumber flagReturned "+flagReturned);
});



/*
*input validation for verify page
*/

const flagPointer_v = new Array(0, 0); 
var validate_flag_v = 0;
var btn_v_sf = false;

$("#verify-btn").click(function(){
      
            var hiddenItems = 0;
            var visibleItems = 0;

            for(var i = 0; i < $(".v-form-input").length; i++){

                  if(($(".v-form-input:eq("+i+")").attr("type") != "hidden")){
                        visibleItems++;
                  }else{
                        hiddenItems++;
                  }
                  
            }

            flagPointer_v[0] = visibleItems;

            //console.log("HiddenItems: "+hiddenItems+">>>> visibleItems: "+visibleItems);

            btn_v_sf = true;

      //console.log(flagPointer_v[0]+" >> "+flagPointer_v[1])

      switch(flagPointer_v[0]){
            case 1:
                  if (flagPointer_v[0] == flagPointer_v[1]) {
                        // sessionStorage.clear("user_msisdn");
                        $("#verify-btn").attr("form", "verify-form");
                        $("#verify-btn").attr("name", "verify-btn");
                  }else{
                        for (var i = 0; i < $(".v-form-input").length; i++) {
                              if ($(".v-form-input:eq("+i+")").val() == "") {
                                    $(".v-form-input:eq("+i+")").css({"border":"1px solid red"});
                              }
                        }
                  }
            break;

      }
});


var flagSet_v = false;
var regEx_v = /[^0-9]/g;

$("#m-code").on("keyup", function(){
      $(".v-form-input").css({"border":""});
      var custom_msg = {
            "NUMBER_ONLY" : "Please enter a valid code",
            "MATCH_REGEX" : "^(0|)[0-9]{4}$"
      };

      var flagReturned = validateInput(regEx_l, $("#m-code"), custom_msg, $("#v-code-err"), validate_flag_l);
      
      if(flagReturned === 1 ){

            if(!flagSet_v){

                  flagPointer_v[1] += flagReturned;
                  flagSet_v = true;

            }

      }else{
            if(flagSet_v){
                  flagPointer_v[1] -= 1;
                  flagSet_v = false;
            }

      }

      //console.log("l-mnumber flagReturned "+flagReturned);
});



//make pledge form validation

const flagPointer_p = new Array(0, 0); 
var validate_flag_p = 0;
var btn_p_s = false;

$("#make_pledge_btn").click(function(){

	console.log("click");
      
            var hiddenItems = 0;
            var visibleItems = 0;

            for(var i = 0; i < $(".pledge-form-input").length; i++){

                  if(($(".pledge-form-input:eq("+i+")").attr("type") != "hidden")){
                        visibleItems++;
                  }else{
                        hiddenItems++;
                  }
                  
            }

            flagPointer_p[0] = visibleItems;

            //console.log("HiddenItems: "+hiddenItems+">>>> visibleItems: "+visibleItems);

            btn_p_s = true;

      //console.log(flagPointer_l[0]+" >> "+flagPointer_l[1])

      switch(flagPointer_p[0]){
            case 4:
            if ($("#datepicker").val() != "" && $("#pledge-reminder").val() != "" && $("#pledge-amount").val() != "" && $("#mname").val() != "" && $("#mnumber").val() != "") {
            	
                  flagPointer_p[0] -= 1;
            	flagPointer_p[1] = (flagPointer_p[1] < flagPointer_p[0])? flagPointer_p[1] +=1 : flagPointer_p[1] +=0;
            	var temp = $("#datepicker").val().split("/");
                  var temp2 = temp[0]+""+temp[1]+""+temp[2];
                  var trigger = false;
                  console.log("temp: "+temp2.match(/[^0-9]/gm)+" temp val "+temp);
                  if (!(temp2.match(/[0-9]/gm) != null && temp[0] <= 12 && temp[1] <= 31 && temp2.length == 8)) {
                        $("#timeline-err").text("Please enter date in mm/dd/yyyy");
                        flagPointer_p[1] -= 1;
                        trigger = true;
                  }else{
                        if (trigger) {
                              flagPointer_p[1] += 1;
                              trigger = false;
                              $("#timeline-err").text("");
                        }
                  }
                  if (flagPointer_p[0] == flagPointer_p[1]) {
                        $("#make_pledge_btn").attr("form", "pledge-form");
                        $("#make_pledge_btn").attr("name", "make_pledge_btn");
                 }else{
                        for (var i = 0; i < $(".pledge-form-input").length; i++) {
                              if ($(".pledge-form-input:eq("+i+")").val() == "") {
                                    $(".pledge-form-input:eq("+i+")").css({"border":"1px solid red"});
                              }
                        }
                }
            }else{
                        for (var i = 0; i < $(".pledge-form-input").length; i++) {
                              if ($(".pledge-form-input:eq("+i+")").val() == "") {
                                    $(".pledge-form-input:eq("+i+")").css({"border":"1px solid red"});
                              }
                        }
                }
            break;

      }

       console.log(flagPointer_p[0]+" >> "+flagPointer_p[1]);
});


var flagSet_p1 = false;
var flagSet_p2 = false;
var flagSet_p3 = false;

var regEx_p1 = /[^a-zA-Z\'\s{\^}]/gm;
var regEx_p2 = /[^0-9]/g;
var regEx_p3 = /[^a-zA-Z\'\^0-9]/gm;

$("#mname").on("keyup", function(){
      $(".pledge-form-input").css({"border":""});
      var custom_msg = {
            "NUMBER_ONLY" : "Please enter a valid name",
            "MATCH_REGEX" : "[a-z{30}$]",
      };

      var flagReturned = validateInput(regEx_p1, $("#mname"), custom_msg, $("#mname-err"), validate_flag_p);
      
      if(flagReturned === 1 ){

            if(!flagSet_p1){

                  flagPointer_p[1] += flagReturned;
                  flagSet_p1 = true;

            }

      }else{
            if(flagSet_p1){
                  flagPointer_p[1] -= 1;
                  flagSet_p1 = false;
            }

      }

      //console.log("w-msisdn flagReturned --"+flagReturned);
});





if($("#mnumber") !=null){

      $('#mnumber').attr('autocomplete', 'off');
      
}

$("#mnumber").on("keyup", function(){
      $(".pledge-form-input").css({"border":""}); 
      var custom_msg = {
            "NUMBER_ONLY" : "Please enter a valid mobile number",
            "MATCH_REGEX" : "^(0|)[0-9]{9}$",
      };

      var flagReturned = validateInput(regEx_p2, $("#mnumber"), custom_msg, $("#mnumber-err"), validate_flag_p);
      
      if(flagReturned === 1 ){

            if(!flagSet_p2){

                  flagPointer_p[1] += flagReturned;
                  flagSet_p2 = true;

            }

      }else{
            if(flagSet_p2){
                  flagPointer_p[1] -= 1;
                  flagSet_p2 = false;
            }

      }

      //console.log("w-msisdn flagReturned --"+flagReturned);
});


$("#pledge-amount").on("keyup", function(){
      $(".pledge-form-input").css({"border":""}); 
      var custom_msg = {
            "NUMBER_ONLY" : "Please enter a valid amount",
            "MATCH_REGEX" : "[0-9]",
      };

      var flagReturned = validateInput(regEx_p2, $("#pledge-amount"), custom_msg, $("#pledge-amount-err"), validate_flag_p);
      
      if(flagReturned === 1 ){

            if(!flagSet_p3){

                  flagPointer_p[1] += flagReturned;
                  flagSet_p3 = true;

            }

      }else{
            if(flagSet_p3){
                  flagPointer_p[1] -= 1;
                  flagSet_p3 = false;
            }

      }

      //console.log("w-msisdn flagReturned --"+flagReturned);
});

$("#datepicker").on("keyup", function(){
      $(".pledge-form-input").css({"border":""}); 
});






function validateInput(reg, input, custom_msg, log_elem, flag){

      var result = input.val().match(reg);
      var inputValue = input.val();
      var inputValueStatus = input.val().length != 0;

      if(inputValueStatus){


            if(custom_msg["NUMBER_ONLY"] != null){
                  
                  if (result != null || input == "") {
                   
                        log_elem.text(custom_msg["NUMBER_ONLY"]);

                        flag = 0;
                        return flag;
                  } else{
                        log_elem.text(custom_msg[""]);

                        flag = 1;      
                  } 

            } 

            if(custom_msg["MINIMUM_VAL"] != null){
                  
                  if(inputValue < custom_msg["MINIMUM_VAL"]){

                        log_elem.text(custom_msg["MINIMUM"]+custom_msg["MINIMUM_VAL"]);
                        flag = 0;
                  } else if(inputValue > custom_msg["MAXIMUM_VAL"]){
            
                        log_elem.text(custom_msg["MAXIMUM"]);
                        flag = 0;
                  } else{

                        flag = 1;
                        log_elem.text("");

                  }

            }

            if(custom_msg["MATCH_REGEX"] != null){
                  
                  if(!input.val().match(custom_msg["MATCH_REGEX"])){

                        log_elem.text(custom_msg["NUMBER_ONLY"]);
                        flag = 0;
                        return flag;
                  } else{
                        log_elem.text("");      
                        flag = 1;
                  } 
            }


            if (custom_msg["WORD_COUNT"] != null) {
                  if(document.getElementById(input.attr("id")).value.split(' ').length < custom_msg["MINIMUM_WORD_COUNT"]){

                        log_elem.text(custom_msg["MINIMUM_WORD_COUNT_MSG"]);
                        flag = 0;
                        return flag;
                  }else if(document.getElementById(input.attr("id")).value.split(' ').length > custom_msg["MAXIMUM_WORD_COUNT"]){
                        log_elem.text(custom_msg["MAXIMUM_WORD_COUNT_MSG"]);      
                        flag = 0;
                  }else{
                        log_elem.text("");      
                        flag = 1;
                  } 
            }

      } else {

            log_elem.text("");

      }

      
      return flag;

}


function selectedListItem(ev, index){

      var trigger_1 = (ev.target == $(".listX-pledge")[index])? true : false;
      var trigger_2 = (ev.target == $(".name-pledge")[index])? true : false;
      var trigger_3 = (ev.target == $(".phone-pledge")[index])? true : false;
      var trigger_4 = (ev.target == $(".amount-pledge")[index])? true : false;
      var trigger_5 = (ev.target == $(".acronym-pledge")[index])? true : false;
      var trigger_6 = (ev.target == $(".list-row-pledge")[index])? true : false;

      return (trigger_1 || trigger_2 || trigger_3 || trigger_4 || trigger_5 || trigger_6);
}



$("#editPledge-btn").click(function(){
      //console.log($("#p-due-date").val()+" 00:00:00");
});

$(".amount-selected").click(function(){
      for (var i = 0; i < $(".amount-selected").length; i++) {
              $(".amount-selected")[i].id = "";
            if ($(this)) {
                  $(this).attr("id", "active-amount");
                  $("#pledge-amount").val($(this).val());
            }
      }
});


function hasPayBill(payload, icon, payer_client) {
	for(var i = 0; i < payload["MERCHANT_PAYERS"].length; i++){
		if (payload["MERCHANT_PAYERS"][i]["LOGO"] == icon) {
			if (payload["MERCHANT_PAYERS"][i]["PAYBILL"] != "") {
                        payer_client.val(payload["MERCHANT_PAYERS"][i]["HUB_CLIENT_ID"]);
				return true;
			}else{
                        payer_client.val(payload["MERCHANT_PAYERS"][i]["HUB_CLIENT_ID"]);
				return false;
			}
		}
	}
}


$("#openSideNav").click(function(){
	// $("body").css({"overflow-y":"hidden"});
      $(".navbar-side").css({"display":"block"});
      if (screen.width <= 414) {
            $("#navbar-side-ovely").css({"width":"15%"});
            $("#navbar-side-content").css({"width":"60%"});
      }
      // else if(screen.width <= 320){
      //       $("#dashboard").css({"margin-left" : "35px"});
      //       $("#closeNavSide").css({"top" : "0", "margin-top" : "-17%", "margin-right" : "35%" ,"right" : "0"});
      //       $(".menu-link").css({"text-align" : "right","padding-bottom" : "10px", "right" : "0", "margin-right" : "25px"});
      // }
      else if(screen.width >= 1023){
            $("#closeNavSide").css({"top" : "0", "margin-top" : "1%", "right" : "0", "margin-right" : "12%", "float":"right"});
            $("#navbar-side-ovely").css({"width":"44%"});
            $("#navbar-side-content").css({"width":"20%"});
      }else if(screen.width == 768){
            // $("#dashboard").css({"margin-left" : "35px"});
            $("#closeNavSide").css({"top" : "0", "margin-top" : "-16.2%", "right" : "0", "margin-right" : "25%", "float":"right"});
            $("#navbar-side-ovely").css({"width":"35%"});
            $("#navbar-side-content").css({"width":"30%"});
      }else{
            $("#navbar-side-ovely").css({"width":"45%"});
            $("#navbar-side-content").css({"width":"30%"});
      }
});

$("#closeNavSide, #navbar-side-ovely").click(function() {
	$("#navbar-side-ovely").css({"width":"90%"});
	setTimeout(function() 
  	{
  		$("body").css({"overflow-y":"auto"});
    	       $(".navbar-side").css({"display":"none"});
  	}, 300);

})


$("#Withdraw-v1").click(function(){
      if ($("#mnumber-w").val() != "" && $("#userid-w").val() != "") { sessionStorage.setItem("UID", $("#userid-w").val()); }
});

$("#change-no-btn").click(function(){
      sessionStorage.setItem("isActivated", "Activated");   
});

$("#resend-withdraw-vcode-btn").click(function(){ sessionStorage.setItem("isActivated", "Activated"); $("#userid-w").val(sessionStorage.getItem("UID")); $("#Withdraw-v1").click(); });

$("#actionVerification-b").click(function(){ sessionStorage.clear();});

$("#image-banner").mouseenter(function(){
      $("#updt-cv-photo").css({"display":"block","width":"220px","height":"45px","background-color":"rgb(20, 20, 20)"});
      $(".group-cover-btn").css({"margin-left":"6%", "margin-top":"3.5%"});
      document.getElementById("upload-cv-text").innerHTML = "Update cover photo";
      setTimeout(function(){ $("#icont-txt").css({"display":"block", "color":"white"}); }, 600);
});

$("#image-banner").mouseleave(function(){
      $("#icont-txt").css({"display":"none", "color":"transparent"});   
      document.getElementById("upload-cv-text").innerHTML = "";
      $("#updt-cv-photo").css({"width":"30px","height":"30px","background-color":"transparent"});
});


$(document).scroll(function(){
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            // $(".navbar").css({"position":"fixed","width":"100%","background-color":"white","top":"0","z-index":"2000"});
            // $("#image-banner, #img-cover-photo").css({"height":"0px"});
            // $("#img-cover-photo").css({"width":"0%"});  
            // setTimeout(function(){
                  // $(".dashboar-nav").css({"position":"fixed","z-index":"1000","top":"0","margin-top":"50px", "margin-bottom":"0px", "width":"100%"});
            // }, 1000);
            // $(".mt-0, .my-0").css({"margin-top":"220px ! important"});
            // $(".section").css({"margin-top":"180px ! important"});
            // $(".body-main").css({"margin-top":"260px"});
            // $(".row, .mt-4").css({"margin-top":"200px ! important"});
      }else if (document.body.scrollTop < 100 || document.documentElement.scrollTop < 100) {
            // $(".navbar").css({"position":"relative","width":"100%","background-color":"white","top":"0","z-index":"2000"});
            // $("#img-cover-photo").css({"height":"100%"});
            // $("#image-banner").css({"height":"110px"});
            // $("#img-cover-photo").css({"height":"100%"});
            // alert("down");     
            // setTimeout(function(){
                  // $(".dashboar-nav").css({"position":"relative","background-color":"white","z-index":"1000","top":"0","height":"130px","margin-top":"50px"});
            // }, 600);
            // $(".mt-0, .my-0").css({"margin-top":"220px ! important"});
            // $(".body-main").css({"margin-top":"0px"});  
            // $(".row, .mt-4").css({"margin-top":"0px ! important"});
      }
});


var isSeachBarVisible = false;

$(".fa-search").click(function(){
      if (!isSeachBarVisible) {
            $(".search-container").css({"margin-top":"70px"});
            isSeachBarVisible = true;
      }else{
            $(".search-container").css({"margin-top":"-80px"});
            isSeachBarVisible = false;
      }
});


$("#v-resend-code").click(function(){
      $("#resendc-mnumber").val(sessionStorage.getItem("user_msisdn"));
});


$("#send-reminder-btn").click(function(){
	$("#pledger-name").val($("#pledger-alias").text());
});



function visibilityMobile(){
      if (screen.width <= 690) {
            $("#stats-mobile-container").css({"display":"block"});
      }
}




// ITRACK

$("window").on("ready", function(argument) {
   alert("sdffd");   
});