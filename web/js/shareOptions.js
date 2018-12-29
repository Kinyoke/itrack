                
function tweetCurrentPage()
{ 
    // window.open("https://twitter.com/share?url="+escape(window.location.href)+"&text="+document.title, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
    window.open("https://www.addtoany.com/add_to/twitter?linkurl="+escape(window.location.href)+"&linkname="+document.title, '', "resizable=yes, scrollbars=yes, titlebar=yes, width=800, height=900, top=10, left=10");
     
}

function facebookCurrentPage()
{ 
    // window.open("https://www.facebook.com/sharer/sharer.php?u="+escape(window.location.href)+"&text="+document.title, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
    window.open("https://www.addtoany.com/add_to/facebook?linkurl="+escape(window.location.href)+"&linkname="+document.title, "", "resizable=yes, scrollbars=yes, titlebar=yes, width=800, height=900, top=10, left=10");
     
}

function linkedInCurrentPage()
{ 
    // window.open("https://www.linkedin.com/shareArticle?mini=true&url="+escape(window.location.href)+"&text="+document.title, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
    window.open("https://www.addtoany.com/add_to/linkein?linkurl="+escape(window.location.href)+"&linkname="+document.title, "", "resizable=yes, scrollbars=yes, titlebar=yes, width=800, height=900, top=10, left=10");
     
}
