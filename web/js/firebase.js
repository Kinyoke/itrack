var config = {
  apiKey: "AIzaSyBfAesp9nvE14DbrHc3oEhMUtwQ5qsWV-Y",
  authDomain: "essy-9d7b1.firebaseapp.com",
  databaseURL: "https://essy-9d7b1.firebaseio.com",
  projectId: "essy-9d7b1",
  storageBucket: "essy-9d7b1.appspot.com",
  messagingSenderId: "1087475089720"
};

firebase.initializeApp(config);


// Initialize Firebase
/*var config = {
  apiKey: "AIzaSyAmRjGTWPGovadlntnVUUyWyf8yPq3FQ2M",
  authDomain: "mula-consumer.firebaseapp.com",
  databaseURL: "https://mula-consumer.firebaseio.com",
  projectId: "mula-consumer",
  storageBucket: "mula-consumer.appspot.com",
  messagingSenderId: "64744613589"
};

firebase.initializeApp(config);*/


    const storageService = firebase.storage();
    const databaseService = firebase.database().ref('groupsMula/');
    const storageRef = storageService.ref();
    var storage = firebase.storage();


    //this checks from which pannel/view is the request coming from
    var isAdminPanel = document.getElementById('profile-group-id') !=null;

    var isDiscoveryPanel = document.getElementById('discoveryPageGroupID') !=null;

    var hasAdminPhoneNumber = document.getElementById('discoveryPageAdminNumber') !=null;

    var isMemberPanel = document.getElementById('memberPageGroupID') !=null;

    var imageGroupID = "";

    if(isAdminPanel){

      imageGroupID = document.getElementById("profile-group-id").value;

    }

    //login to firebase
    groupLogin();
      
    if(isAdminPanel){

      //uploading images to firebase database
      
      uploadGroupImages();
      
      uploadGroupCoverPhoto();

      document.getElementById("edit-back-alt").style.display = "none"; 

    }


    function uploadGroupImages(){
      
      $('#floatCameraButton, #cameraAlighnCeter').on('click', function() {
        
        if(this.id === 'floatCameraButton'){
            
            $('#profile-image-upload')[0].click();

        
        } else if(this.id === 'cameraAlighnCeter'){

            $('#profile-image-upload')[0].click();

        }

      });

      $('#profile-image-upload').change(function() {
          
          //let selectedFile = new FormData(this.files[0]);
          let selectedFile = document.querySelector('#profile-image-upload').files[0];
          let selectGroupID = document.getElementById("profile-group-id").value;

          if(isEmptyStorage(selectedFile)){

              const uploadTask = storageRef.child(`images/group-profiles/${selectGroupID}/${selectedFile.name}`).put(selectedFile); //create a child directory called images, and place the file inside this directory
              
              uploadTask.on('state_changed', (snapshot) => {
              // Observe state change events such as progress, pause, and resume
              }, (error) => {
              // Handle unsuccessful uploads
              
              // console.log("selected Error: ",error);

              }, () => {
               // Do something once upload is complete
            
                
                firebase.auth().onAuthStateChanged(function(user) {
          
                  if (user) {

                        // User is signed in.
                        var isAnonymous = user.isAnonymous;
                        var userId = user.uid;
                        // var dateTimelog = new Date().toLocaleString();
                        var dateTimelog = new Date().getTime();

                        // console.log("selected isAnonymous: ",isAnonymous);
                        // console.log("selected uid: ",userId);
                        // console.log("selected dateTimelog: ",dateTimelog);


                        firebase.database().ref('groupsweb/' + selectGroupID+"/" + dateTimelog).set({

                          groupID: selectGroupID,
                          imageType: "slider",
                          imageURL:selectedFile.name

                        });

                        // location.reload();

                  }

                });

              });

          } else{
            
            // console.log("selected isEmpty: true");

          }
      });

    }

    function uploadGroupCoverPhoto(){


      $('#edit-back-alt, #upload-cover-photo').on('click', function() {
        
        if(this.id === 'edit-back-alt'){
            
            $('#cover-photo-upload')[0].click();

        
        } else if(this.id === 'upload-cover-photo'){

            $('#cover-photo-upload')[0].click();

        }

      });

      $('#cover-photo-upload').change(function() {
          
          //let selectedFile = new FormData(this.files[0]);
          let selectedFile = document.querySelector('#cover-photo-upload').files[0];
          let selectGroupID = document.getElementById("profile-group-id").value;

          if(isEmptyStorage(selectedFile)){

              const uploadTask = storageRef.child(`images/group-profiles/${selectGroupID}/${selectedFile.name}`).put(selectedFile); //create a child directory called images, and place the file inside this directory
              
              uploadTask.on('state_changed', (snapshot) => {
              // Observe state change events such as progress, pause, and resume
              }, (error) => {
              // Handle unsuccessful uploads
              
              // console.log("selected Error: ",error);

              }, () => {
               // Do something once upload is complete
            
                
                firebase.auth().onAuthStateChanged(function(user) {
          
                  if (user) {

                        // User is signed in.
                        var isAnonymous = user.isAnonymous;
                        var userId = user.uid;
                        // var dateTimelog = new Date().toLocaleString();
                        var dateTimelog = new Date().getTime();

                        // console.log("selected isAnonymous: ",isAnonymous);
                        // console.log("selected uid: ",userId);
                        // console.log("selected dateTimelog: ",dateTimelog);
                        // console.log("selected selectedFile: ",selectedFile);
                        // console.log("selected selectGroupID: ",selectGroupID);
            

                        firebase.database().ref('groupsweb/' + selectGroupID+"/" + dateTimelog).set({

                          groupID: selectGroupID,
                          imageType: "coverPhoto",
                          imageURL:selectedFile.name

                        });

                        // location.reload();

                  }

                });

              });

          } else{
            
            // console.log("selected isEmpty: true");

          }
      });

    }

    
    //this checks if the user has selected an image
    function isEmptyStorage(obj) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }
        return true;
    }

  
    function handleSignUp() {
      
      var email = 'mulagroups@gmail.com';
      var password = 'groupsmula1234';

      // Sign in with email and pass.
      // [START createwithemail]
      firebase.auth().createUserWithEmailAndPassword(email, password).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;

        groupLogin();
      
      });

      // [END createwithemail]
    }

    function groupLogin() {
      
      var email = 'mulagroups@gmail.com';
      var password = 'groupsmula1234';

      // Sign in with email and pass.
      // [START authwithemail]
      firebase.auth().signInWithEmailAndPassword(email, password).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        // [START_EXCLUDE]
        if (errorCode === 'auth/wrong-password') {
              
        } else {
          // alert(errorMessage);
          //handleSignUp()

        }

      });



      firebase.auth().onAuthStateChanged(function(user) {
        
        if (user) {

          if(isAdminPanel){
            var mainSlider = "";

            if(document.getElementById("mainSlider") != null){
            
              mainSlider = document.getElementById("mainSlider");
            
            }

            var sliderMainDiv = "";
            var defaultImgDiv = "";

            getGroupsImages(mainSlider, imageGroupID, sliderMainDiv, defaultImgDiv);
          
          }


          if(isDiscoveryPanel || isMemberPanel){
              
              var groupAccountIDs = "";

              if(isMemberPanel){

                groupAccountIDs = getAllDocumentElementsByID("memberPageGroupID");
              
              }else{

                groupAccountIDs = getAllDocumentElementsByID("discoveryPageGroupID");
              
              }

              var sliderElementsData = getAllDocumentElementsByID("carouselExampleSlidesOnly");

              var defaultImgElementsData = getAllDocumentElementsByID("defaultImage");

              var groupWalletBalaceElementsData = getAllDocumentElementsByID("group-wallet-balance");

              var groupAdminNumberElementsData = getAllDocumentElementsByID("discoveryPageAdminNumber");

              var groupProgressBarElementsData = getAllDocumentElementsByID("group-progress-bar");

              var groupTargetAmountElementsData = getAllDocumentElementsByID("groupTargetAmount");


              for(var indexCount = 0; indexCount < groupAccountIDs.length; indexCount++){

                  var mainGroupID = groupAccountIDs[indexCount].value; 

                  var mainFrameDiv = sliderElementsData[indexCount].firstElementChild;  

                  sliderMainDiv = sliderElementsData[indexCount];

                  defaultImgDiv = defaultImgElementsData[indexCount];
              
                  getGroupsImages(mainFrameDiv, mainGroupID, sliderMainDiv, defaultImgDiv);

                  const countIndex = indexCount;


                  if(hasAdminPhoneNumber){

                      if(groupAdminNumberElementsData[indexCount] != null){

                        var groupWalletID = groupAccountIDs[indexCount].value;
                        var groupAdminPhone = groupAdminNumberElementsData[indexCount].value;
                      
                        // groupWalletBalaceElementsData[indexCount].innerHTML = 'KES 0' ;
                        $.ajax({
                            type: 'GET',
                            url: '../group/wallet-balance',
                            dataType: 'json',
                            data: {
                                groupID : groupWalletID,
                                adminNo : groupAdminPhone
                            },
                            cache: true,
                            success: function(data){

                                groupWalletBalaceElementsData[countIndex].innerHTML = 'KES ' + data + ' raised ';

                                //calculate progress
                                var progress = (data*100)/groupTargetAmountElementsData[countIndex].value;

                                // $(groupProgressBarElementsData[countIndex]).css({"width": ""+ progress + "%"})
                                $(groupProgressBarElementsData[countIndex]).animate({
                                    width: progress + "%"
                                }, 2500);

                            }
                        });

                      }

                      
                  }

              }


          }


        }

      });
      
    }


    function getGroupsImages(mainSlider, mainGroupID, sliderMainDiv, defaultImgDiv){

       firebase.auth().onAuthStateChanged(function(user) {
        
        if (user) {

              // User is signed in.
              var isAnonymous = user.isAnonymous;
              var userId = user.uid;
              // var dateTimelog = new Date().toLocaleString();
              var dateTimelog = new Date().getTime();

              var leadsRef = firebase.database().ref('groupsweb/' + mainGroupID);
              
              var indexCount = 0;
              var groupImgUrls = [];

              var indexCountCoverPhoto = 0;
              var groupCoverPhotoUrl = [];

              leadsRef.on('value', function(snapshot) {
                  indexCount = 0;

                  //console.log("clearData");
                  
                  snapshot.forEach(function(childSnapshot) {
                    
                    var childData = childSnapshot.val();

                    var imgURL = (childSnapshot.val() && childSnapshot.val().imageURL) || 'no image';

                    var imgType = (childSnapshot.val() && childSnapshot.val().imageType) || 'no image';

                    if(imgType === "slider"){

                      groupImgUrls[indexCount] = imgURL;
                      indexCount++;

                    }

                    if(imgType === "coverPhoto"){

                      groupCoverPhotoUrl[0] = imgURL;

                    }


                  });

                  // console.log("sliderImages: groupImgUrls: ", groupImgUrls);
                  // console.log("sliderImages: groupImgUrls: ", groupImgUrls.length);
                  //manage group images
                  if(groupImgUrls.length > 0) {
                    
                      if(isAdminPanel){
                        
                        if(document.getElementById("cameraAlighnCeter") != null){
                        
                          document.getElementById("cameraAlighnCeter").style.display = "none"; 
                        
                        }

                        if(document.getElementById("sliderImageClass") != null){
                          document.getElementById("sliderImageClass").style.display = "block"; 
                        }
                    
                        
                      }

                      if(isDiscoveryPanel || isMemberPanel){

                        defaultImgDiv.style.display = "none"; 
                        sliderMainDiv.style.display = "block";
                        
                      }

                      getImagesFirebase(groupImgUrls, mainSlider, mainGroupID);
                  
                  } else {

                      if(isAdminPanel){    
        
                        if(document.getElementById("sliderImageClass") != null){
                          document.getElementById("sliderImageClass").style.display = "none"; 
                        }
                      
                      }

                      if(isDiscoveryPanel || isMemberPanel){
                        
                        sliderMainDiv.style.display = "none";
                         
                      }

                  }

                  //manage cover photos for groups
                  if(groupCoverPhotoUrl.length > 0){
                      
                      if(isAdminPanel){

                                  // Points to 'images'  
                          refPath = storage.ref(`images/group-profiles/${mainGroupID}/` + groupCoverPhotoUrl[0]);
                       
                          (function(pid) {
                              
                              refPath.getDownloadURL().then(function(url) {

                                          document.getElementById("img-cover-photo").src = url;
                                          // console.log("groupCoverImg", url);

                                          document.getElementById("upload-cover-photo").style.display = "none"; 
                                          document.getElementById("edit-back-alt").style.display = "block"; 

                                      }).catch(function(error) {

    
                                    // console.log(error);

                                    document.getElementById("upload-cover-photo").style.display = "block"; 
                                    document.getElementById("edit-back-alt").style.display = "none";

                            });

                        })(1);

                      
                      }

                  }

              });

        }

      });
    }


    function getImagesFirebase(photos, mainSlider, mainGroupID) {

      // Points to 'images'  

      mainSlider.innerHTML = "";
      for (var i = 0; i <= photos.length - 1; i++) {
          
        loadImages(i, mainGroupID);

      }

      function loadImages(i, mainGroupID) {
        
        setTimeout(function() {

          photoId = i + 1;
        
          refPath = storage.ref(`images/group-profiles/${mainGroupID}/` + photos[i]);

          (function(pid) {
              
              refPath.getDownloadURL().then(function(url) {
                
                  var imgSlider = document.createElement("img");

                  imgSlider.className = "d-block w-100 h-100";
                  imgSlider.setAttribute("id", 'imageSlider');
                  
                  var sliderImg = document.createElement("div");
                  
                  if(i === 0){

                    sliderImg.className = "carousel-item active";

                  } else {
                    
                    sliderImg.className = "carousel-item";

                  }

                  if(isMemberPanel){

                    sliderImg.setAttribute("id", 'sliderImageGroupDetails');
                    
                  } else{

                    sliderImg.setAttribute("id", 'sliderImage');

                  }

                  imgSlider.src = url;
                  sliderImg.append(imgSlider);
                  mainSlider.appendChild(sliderImg);

              }).catch(function(error) {
                  //console.log(error);

                  if(isAdminPanel){

                    if(document.getElementById("sliderImageClass") != null){

                      document.getElementById("sliderImageClass").style.display = "none"; 
                    
                    }

                    if(document.getElementById("cameraAlighnCeter") != null){

                      document.getElementById("cameraAlighnCeter").style.display = "block"; 
                    
                    }
                  
                  }

              });

          })(photoId);

          // console.log("img: ",i); 
        }, 1000);

      }
      
    }
    

    function getAllDocumentElementsByID(groupElementID){
        var documentElementIDElements = document.getElementById(groupElementID);
        var documentElementIDArray = [];
        var documentElementIDIndexCount;

        while(documentElementIDElements) {
            documentElementIDArray.push(documentElementIDElements);
            documentElementIDElements.id = "a-different-id";
            documentElementIDElements = document.getElementById(groupElementID);
        }

        for(documentElementIDIndexCount = 0;documentElementIDIndexCount < documentElementIDArray.length; ++documentElementIDIndexCount) {
            documentElementIDArray[documentElementIDIndexCount].id = groupElementID;
        }

        return documentElementIDArray;      
    }