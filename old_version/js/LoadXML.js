// Read an XML document and process with a function.
// Author. John D. Coryat 11/2005
// Copyright 1996-2005 John Coryat Systems. All rights reserved.
// Parameters: LoadXML( <url>,<element>,<runfunc> ) ;
// <url> - URL to receive XML data from
// <element> - Main Element to Process
// <runfunc> - Function in which to process
// parameters: runfunc( <element>, <XMLobject> ) ;
// <element> - Main Element to Process ( passed from LoadXML )
// <XMLobject> - Object to extract remaining xml data from
//
// Example:
//
// function runfunc(element,XMLobject)
// {
//  for (var i = 0; i < XMLobject.length; i++)
//  {
//   alert( XMLobject[i].getElementsByTagName("tag_name")[0].firstChild.nodeValue ) ;
//  }
// }
//

function LoadXML(url,element,runfunc)
{
 // branch for native XMLHttpRequest object
 if (window.XMLHttpRequest)
 {
  var req = new XMLHttpRequest();
  req.onreadystatechange = processReqChange;
  req.open("GET", url, true);
  req.send(null);
  // branch for IE/Windows ActiveX version
 } else if (window.ActiveXObject)
 {
  var req = new ActiveXObject("Microsoft.XMLHTTP");
  if (req)
  {
   req.onreadystatechange = processReqChange;
   req.open("GET", url, true);
   req.send();
  }
 }
 // handle onreadystatechange event of req object

 function processReqChange()
 {
  // only if req shows "loaded"
  if (req.readyState == 4)
  {
   // only if "OK"
   if (req.status == 200)
   {
    runfunc(element,req.responseXML.getElementsByTagName(element)) ;
   } else
   {
    alert("There was a problem retrieving the XML data:\n" + req.statusText) ;
   }
  }
 }
}
