var totalContr = 0; var totalPledge = 0; var totalMember = 0; var hidenElemContr = 0;
var hidenElemMemb = 0; var hidenElemPledge = 0;
var csrfToken = $('meta[name="csrf-token"]').attr("content");



//console.log(csrfToken);

    function loadData(payload, callback, callbackNext) {
        $.ajax({
            type: 'POST',
            url:  '../group/proxy-server',
            data: payload,
            dataType: 'json',   
            success: function(data){
                callback(data);
            }
        });
    }


    function getLength(arg){ 
        var length = 0;
        for(var i = 0; i < arg.length; i++){
            if (arg[i]["TRANSACTION_TYPE"] == "CONTRIBUTION") {
                length++;
            }
        }
        return length;
    }

    //display pledge list.
    function pledges(arg){

        var parentContainer = document.getElementsByClassName('listX-pledge-list')[0];

        var parentList; var acronymPane; var acronym; var listRow; var listAmount;

        var listName; var listNumber; var listLifeTime; var listDueDate;

        var response = JSON.parse(arg);
        
        var old_elm_length = $(".listX-pledge").length;
        
        var new_elem_length =  response.length;
        
        var current_elem_length = old_elm_length + new_elem_length; 

        var indexer = 0;

        for(var i = 0; i < response.length; i++){

            if (new_elem_length > old_elm_length) {

                        indexer = parseInt(i+old_elm_length);

                        parentList = document.createElement("li");
                        
                        acronymPane = document.createElement("div");

                        acronymPane.className = "acronym xs-hidden list-row float-left";

                        acronym = document.createElement("p");

                        acronym.className = "mb-0 acronym-pledge";

                        listRow = document.createElement("div");

                        listRow.className = "col-lg-10 list-row list-row-pledge";

                        listAmount = document.createElement("p");

                        listAmount.className = "amount-pledge my-2 font-semibold float-right";

                        listName = document.createElement("p");

                        listName.className = "name my-2 name-pledge";

                        listNumber = document.createElement("p");

                        listNumber.className = "phone-pledge phone m-0 text-muted";

                        listNumber.style = "display: none";

                        listLifeTime = document.createElement("p");

                        listLifeTime.className = "phone m-0 text-muted float-left";

                        listDueDate = document.createElement("p");

                        listDueDate.className = "pladge-due-date m-0 text-muted";

                        listDueDate.style = "display: none";

                        var list_items_count = $(".listX-pledge").length;

                        if (list_items_count < 4) {
                            parentList.className = "listX-pledge listX-pledge-active p-2 mt-1 row";
                        }else{
                            parentList.className = "listX-pledge p-2 mt-1 row";
                        }

                        name = ""+response[indexer]["MEMBER_NAMES"]+"";
                        var initials = name.match(/\b\w/g) || [];
                        initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();

                        acronym.innerHTML = initials;

                        listAmount.innerHTML = "KES "+response[indexer]["AMOUNT"];

                        listName.innerHTML = response[indexer]["MEMBER_NAMES"];

                        listNumber.innerHTML = response[indexer]["ISSUER_MSISDN"];

                        var today = new Date();
                        
                        var dueDate = new Date(response[indexer]["DUE_DATE"]);
                        
                        var msInDay = 24 * 60 * 60 * 1000;

                        dueDate.setHours(0,0,0,0);
                        
                        today.setHours(0,0,0,0);

                        var diff = (+dueDate - +today)/msInDay;

                        listLifeTime.innerHTML = "Due in "+parseInt(diff-1)+" days";

                        listDueDate.innerHTML = "Due in "+parseInt(diff-1)+" days";

                        listRow.append(listAmount);

                        listRow.append(listName);

                        listRow.append(listNumber);

                        listRow.append(listLifeTime);

                        listRow.append(listDueDate);

                        acronymPane.append(acronym);

                        parentList.append(acronymPane);
                        parentList.append(listRow);

                        parentContainer.append(parentList);
            }

        }
        
    }

    //display contribution list
    function contribution(arg){
        
        var parentContainer = document.getElementsByClassName('listX-contrib-list')[0];

        var parentList; var acronymPane; var acronym; var listRow; var listAmount;

        var listName; var listNumber; var listLifeTime; var listStatus;

        var response = JSON.parse(arg);
        
        var old_elm_length = $(".listX-contrib").length;
        
        var new_elem_length =  getLength(response["DATA"]["GROUP_REPORT"]);
        
        var current_elem_length = new_elem_length - old_elm_length; 

        var indexer = 0;

        for(var i = 0; i < response["DATA"]["GROUP_REPORT"].length; i++){

            if (new_elem_length > old_elm_length) {
            

                    if (response["DATA"]["GROUP_REPORT"][i]["TRANSACTION_TYPE"] == "CONTRIBUTION") {

                        indexer++;

                        if(indexer > old_elm_length){

                            parentList = document.createElement("li");
                            
                            acronymPane = document.createElement("div");

                            acronymPane.className = "acronym xs-hidden list-row float-left";

                            acronym = document.createElement("p");

                            acronym.className = "mb-0";

                            listRow = document.createElement("div");

                            listRow.className = "col-lg-10 list-row";

                            listAmount = document.createElement("p");

                            listAmount.className = "font-semibold my-2 float-right";

                            listName = document.createElement("p");

                            listName.className = "name my-2";

                            listNumber = document.createElement("p");

                            listNumber.className = "phone m-0 text-muted";

                            listNumber.style = "display: none";

                            listLifeTime = document.createElement("p");

                            listLifeTime.className = "phone m-0 text-muted float-left";

                            listStatus = document.createElement("p");

                            listStatus.className = "m-0 text-muted float-right";

                            var list_items_count = $(".listX-contrib").length;

                            if (list_items_count < 4) {
                                parentList.className = "listX-contrib p-2 mt-1 listX-contrib-active row";
                            }else{
                                parentList.className = "listX-contrib p-2 mt-1 row";
                            }

                            name = ""+response["DATA"]["GROUP_REPORT"][i]["MEMBER_NAMES"]+"";
                            var initials = name.match(/\b\w/g) || [];
                            initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();

                            acronym.innerHTML = initials;

                            listAmount.innerHTML = response["DATA"]["GROUP_REPORT"][i]["CURRENCY"]+" "+
                            response["DATA"]["GROUP_REPORT"][i]["AMOUNT"];

                            listName.innerHTML = response["DATA"]["GROUP_REPORT"][i]["MEMBER_NAMES"];

                            listNumber.innerHTML = response["DATA"]["GROUP_REPORT"][i]["TRANSACTION_DATE"];

                            var today = new Date();
                            
                            var createdOn = new Date(response["DATA"]["GROUP_REPORT"][i]["TRANSACTION_DATE"]);
                            
                            var msInDay = 24 * 60 * 60 * 1000;

                            createdOn.setHours(0,0,0,0);
                            
                            today.setHours(0,0,0,0)

                            var diff = (+today - +createdOn)/msInDay

                            listLifeTime.innerHTML = parseInt(diff-1)+" days ago";

                            listStatus.innerHTML = (response["DATA"]["GROUP_REPORT"][i]["TRANSACTION_STATUS"] == 1)? "success" : "Failed";

                            listStatus.style = (listStatus.innerHTML == "success")? "color: green ! important" : "color: red ! important";

                            listRow.append(listAmount);

                            listRow.append(listName);

                            listRow.append(listNumber);

                            listRow.append(listLifeTime);

                            listRow.append(listStatus);

                            acronymPane.append(acronym);

                            parentList.append(acronymPane);
                            parentList.append(listRow);

                            parentContainer.append(parentList);

                        }
                    }

                
            }

        }
        

    }


    //display member list
    function members(arg){


        var parentContainer = document.getElementsByClassName('listX-member-list')[0];

        var parentList; var acronymPane; var acronym; var listRow; var listMemberType;

        var listName; var listNumber;

        var response = JSON.parse(arg);
        
        var old_elm_length = $(".listX-member").length;
        
        var new_elem_length =  response["DATA"]["GROUP_MEMBERS"].length;
        
        var current_elem_length = old_elm_length + new_elem_length; 

        var indexer = 0;

        for(var i = 0; i < response["DATA"]["GROUP_MEMBERS"].length; i++){

            if (new_elem_length > old_elm_length) {

                for (var j = 0; j < 10; j++) {

                        indexer = parseInt(i+old_elm_length);

                        parentList = document.createElement("li");
                        
                        acronymPane = document.createElement("div");

                        acronymPane.className = "acronym xs-hidden list-row float-left";

                        acronym = document.createElement("p");

                        acronym.className = "mb-0";

                        listRow = document.createElement("div");

                        listRow.className = "col-lg-10 list-row";

                        listMemberType = document.createElement("p");

                        listMemberType.className = "phone text-muted float-right";

                        listName = document.createElement("p");

                        listName.className = "name my-2";

                        listNumber = document.createElement("p");

                        listNumber.className = "phone m-0 text-muted";

                        var list_items_count = $(".listX-contrib").length;

                        if (list_items_count < 4) {
                            parentList.className = "listX-member listX-member-active p-2 mt-1 row";
                        }else{
                            parentList.className = "listX-member p-2 mt-1 row";
                        }

                        name = ""+response["DATA"]["GROUP_MEMBERS"][indexer]["GROUP_MEMBER_NAME"]+"";
                        var initials = name.match(/\b\w/g) || [];
                        initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();

                        acronym.innerHTML = initials;

                        listMemberType.innerHTML = response["DATA"]["GROUP_MEMBERS"][indexer]["GROUP_MEMBER_TYPE"];

                        listName.innerHTML = response["DATA"]["GROUP_MEMBERS"][indexer]["GROUP_MEMBER_NAME"];

                        listNumber.innerHTML = response["DATA"]["GROUP_MEMBERS"][indexer]["GROUP_MEMBER_MSISDN"];

                        listRow.append(listMemberType);

                        listRow.append(listName);

                        listRow.append(listNumber);

                        acronymPane.append(acronym);

                        parentList.append(acronymPane);
                        parentList.append(listRow);

                        parentContainer.append(parentList);

                    }
            }

        }
        
    
    }



    setTimeout(function(){
        
        //request for contribution list.
        loadData({"request_service":"CONTRIBUTION", _csrf: csrfToken}, contribution);
        //request for member list.
        loadData({"request_service":"GROUP_DATA", _csrf: csrfToken}, members);
        //request for pledges list.
        loadData({"request_service":"PLEDGES", _csrf: csrfToken}, pledges);
    
    }, 10000); //set time interval, repeat after 2 minutes



