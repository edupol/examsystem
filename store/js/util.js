// JavaScript Document
var XMLHttpRequestObject = false;
if (window.XMLHttpRequest) 
{	XMLHttpRequestObject = new XMLHttpRequest();
} else if (window.ActiveXObject) 
{	XMLHttpRequestObject = new
	ActiveXObject("Microsoft.XMLHTTP");
}
function getData(dataSource, divID)
{	if(XMLHttpRequestObject) 
	{	var obj = document.getElementById(divID);
		XMLHttpRequestObject.open("GET", dataSource);
		XMLHttpRequestObject.onreadystatechange = function()
		{	if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) 
			{	var str = 	XMLHttpRequestObject.responseText;
				obj.innerHTML = 	str;
			}
		 }
		 XMLHttpRequestObject.send(null);
	   }
  }	
function conf(n)
{ 	if(confirm("  ข้อสอบที่บันทึกไว้ในวิชา : "+n+" จะถูกลบทั้งหมด โปรดยืนยันการลบ  ")==true)		
	{ return true; } 
	return false;	
}
function chk()
{	if(document.sbjfrm.ans1.value==""){ alert('     โปรดกรอกข้อมูลในช่องคำตอบ 1    '); return false;} 
	if(document.sbjfrm.ans2.value==""){ alert('     โปรดกรอกข้อมูลในช่องคำตอบ 2    '); return false;} 
	if(document.sbjfrm.ans3.value==""){ alert('     โปรดกรอกข้อมูลในช่องคำตอบ 3    '); return false;} 
	if(document.sbjfrm.ans4.value==""){ alert('     โปรดกรอกข้อมูลในช่องคำตอบ 4    '); return false;} 
	if(document.sbjfrm.qtn.value==""){ alert('     โปรดกรอกข้อมูลในช่องคำถาม     '); return false;} 
	return true;
}