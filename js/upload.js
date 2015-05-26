/*
$(function () {

	// 判斷是否有預設值
	var defaultValue = false;
	if (0 < $.trim($('#fullIdPath').val()).length) {
		$fullIdPath = $('#fullIdPath').val().split(',');
		defaultValue = true;
	}
	
	// 設定預設選項
	if (defaultValue) {
		$('#schoolname').selectOptions($fullIdPath[0]); 
	}
	
	// 開始產生關聯下拉式選單
	$('#schoolname').change(function () {
		// 觸發系所下拉式選單
		alert(" 0.0") ;
		$('#departmentname').removeOption(/.?/).ajaxAddOption(
			'../php/upload_selection.php', 
			{ 'schoolname': $(this).val(), 'lv': 2 }, 
			false, 
			function () {
				
				// 設定預設選項
				if (defaultValue) {
					$(this).selectOptions($fullIdPath[1]).trigger('change');
				} else {
					$(this).selectOptions().trigger('change');
				}
			}
		).change(function () {
			// 觸發課程下拉式選單
			$('#subjectname').removeOption(/.?/).ajaxAddOption(
				'../php/upload_selection.php', 
				{ 'schoolname': $('#schoolname').val(),'departmentname': $(this).val(), 'lv': 3 }, 
				false
			).change(function () {
			// 觸發教授下拉式選單
				$('#professor').removeOption(/.?/).ajaxAddOption(
					'../php/upload_selection.php', 
					{ 'schoolname': $('#schoolname').val(),'departmentname': $('#departmentname').val(),'subjectname': $(this).val(), 'lv': 4 }, 
					false
				);
			});
		});
	}).trigger('change');

});

var http_request = false ;

function makeRequest(url){

	http_request = false;

	if (window.XMLHttpRequest) { // Mozilla, Safari,...
		http_request = new XMLHttpRequest();
		if (http_request.overrideMimeType) {
			http_request.overrideMimeType('text/xml');
		}
	} else if (window.ActiveXObject) { // IE
		try {
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				http_request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {}
		}
	}

	if (!http_request) {
		alert('Giving up :( Cannot create an XMLHTTP instance');
		return false;
	}
	http_request.onreadystatechange = alertContents;
	http_request.open('GET', url, true);
	http_request.send(null);

}*/

function alertContents(index) {
	var selectObj ;
	if (http_request.readyState == 4) {
		if (http_request.status == 200) {
			switch(index){
				case 1:
					selectObj = document.getElementById("departmentname") ;	
					break ;
				case 2:
					selectObj = document.getElementById("subjectname") ;	
					break ;
				case 3:
					selectObj = document.getElementById("professor") ;	
					break ;
				default:
					document.writeln("ERROR!!");
					break;
			}	

			if (index!=3) {
				selectObj.options.length = 1;   
			}
			
			
			//alert(http_request.responseText);
			var json_back = JSON.parse(http_request.responseText) ;
			var for_select_the_first_option = 0 ;
			//var content ;
			for(var key in json_back){ 
       			//content +="屬性名稱："+ key+"; 值："+json_back[key]+"\n"; 

       			//jsAddItemToSelect(selectObj,key,json_back[key]) ;
       			
       			if (index==3) {
	       			if (for_select_the_first_option==0) {
	       				selectObj.value = json_back[key] ;
	       				///alert("HAH") ;
	       				break ;
	       				//for_select_the_first_option = 1 ;
	       			}
       			}
       			else
       			{
       				jsAddItemToSelect(selectObj,key,json_back[key]) ;
       			}
       			/*
       			if (for_select_the_first_option==0) {
       				selectObj.value = json_back[key] ;
       				for_select_the_first_option = 1 ;
       			}
       			if (index==1) {
       				getdata(2) ;
       			}
       			*/
			}
			//alert(content);
		} else {
			alert('There was a problem with the request.');
		}
	}

}

function getdata(index)
{
	http_request = false ;
	
	var request_string = "php/upload_selection.php" ;
	var schoolname = document.getElementById("schoolname") ;
	var schoolname_select_id ;
	var departmentname = document.getElementById("departmentname") ;
	var departmentname_select_id ;
	var subjectname = document.getElementById("subjectname") ;
	var subjectname_select_id ;

	//判斷是否有選擇
	if (index>=1) {
		schoolname_select_id = schoolname.selectedIndex ;
		if (schoolname_select_id==0) {
			return ;
		}
	}
	if (index>=2) {
		departmentname_select_id = departmentname.selectedIndex ;
		if (departmentname_select_id==0) {
			return ;
		}
	}
	
	if (index>=3) {
		subjectname_select_id = subjectname.selectedIndex ;
		if (subjectname_select_id==0) {
			return ;
		}
	}

	var request_string_temp = "" ;
	//根據不同階段 請求不同資料
	 switch(index){
		case 3:
			request_string_temp += ("subjectname=" + subjectname.options[subjectname.selectedIndex].text + "&") ;
		case 2:
			request_string_temp += ("departmentname=" + departmentname.options[departmentname.selectedIndex].text + "&") ;
		case 1:
			request_string_temp += ("schoolname=" + schoolname.options[schoolname.selectedIndex].text + "&") ;
			break;
		default:
			document.writeln("show others!!");
			break;
	}

	//開始送出查詢資料給upload_selection.php
	if (window.XMLHttpRequest) { // Mozilla, Safari,...
		http_request = new XMLHttpRequest();
		if (http_request.overrideMimeType) {
			http_request.overrideMimeType('text/xml') ;
		}
	} else if (window.ActiveXObject) { // IE
		try {
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				http_request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {}
		}
	}
	if (!http_request) {
		alert('Giving up :( Cannot create an XMLHTTP instance');
		return false;
	}

	request_string = request_string + "?" + request_string_temp + "level=" + index ;
	//alert(request_string) ;
	//http_request.a = index ;
	http_request.onreadystatechange = function(){alertContents(index)} ;
	http_request.open('GET', request_string, true) ;
	http_request.send(null) ;
}

function jsAddItemToSelect(objSelect, objItemText, objItemValue) {        
	var varItem = new Option(objItemText, objItemValue);
	objSelect.options.add(varItem);          
}        
